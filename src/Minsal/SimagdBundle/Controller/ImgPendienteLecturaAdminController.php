<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\ImgPendienteLectura;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class ImgPendienteLecturaAdminController extends Controller
{
    public function leerAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        $estudio = $object->getIdEstudio()->getId();
        
        $em = $this->getDoctrine()->getManager();
        
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();
        
        $lectura = $em->getRepository('MinsalSimagdBundle:ImgLectura')->findOneBy(array(
                                                    'idEstudio' => $estudio,
                                                    'idEstablecimiento' => $estabLocal));
        if ($lectura) {
            $this->addFlash('sonata_flash_success', 'Lectura registrada para: <br/> <strong>' .
						$lectura->getIdEstudio()->getIdExpediente()->getIdPaciente() . '</strong>');
            return $this->redirect($this->generateUrl('simagd_lectura_edit', array('id' => $lectura->getId())));
        }
        
        $this->addFlash('sonata_flash_success', 'Lectura no iniciada para estudio imagenológico');
        return $this->redirect($this->generateUrl('simagd_lectura_create', array('__est' => $estudio)));
    }
    
    public function registrarEnMiListaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $pndL = $this->admin->getObject($id);
        if (!$pndL) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        $estudio = $pndL->getIdEstudio()->getId();

        return $this->redirect($this->generateUrl('simagd_lectura_agregarPendiente', array('__est' => $estudio)));
    }
    
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em                 = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $tiposEmpleado      = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $radiologos         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                    ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                    ->getQuery()->getResult();
        $transcriptores     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                    ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 4, 5))
                                    ->getQuery()->getResult();
        
        $tipos              = $em->getRepository('MinsalSimagdBundle:ImgCtlTipoNotaDiagnostico')->findAll();
        $estadosDiag        = $em->getRepository('MinsalSimagdBundle:ImgCtlEstadoDiagnostico')->findAll();
        
        $modalidades        = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->findBy(array('idAtencion' => '97'));

        /** Patrones para diagnóstico */
        $patronesDiag       = $em->getRepository('MinsalSimagdBundle:ImgCtlPatronDiagnostico')
                                    ->obtenerPatronesDiagnosticoUtilizablesV2($estabLocal->getId())
                                    ->getQuery()->getResult();
        /** Fin --- Patrones para diagnóstico */

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'      => $tiposEmpleado,
                        'radiologos'        => $radiologos,
                        'tiposNota'         => $tipos,
                        'default_empLogged'        => $sessionUser->getIdEmpleado(),
                        'tipoNotaDefault'   => 1,
                        'transcriptores'    => $transcriptores,
                        'estadosDiag'       => $estadosDiag,
                        'estadoDiagDefault' => 2,
                        'modalidades'       => $modalidades,
			'patronesDiag'      => $patronesDiag,
                    ));
    }
    
    public function listarPendientesLecturaAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS                 = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE          = json_decode($BS_FILTERS, true);
        
        $em                         = $this->getDoctrine()->getManager();

	$securityContext            = $this->container->get('security.context');
	$sessionUser               = $securityContext->getToken()->getUser();
        $estabLocal                 = $sessionUser->getIdEstablecimiento();

        $resultados                 = $em->getRepository('MinsalSimagdBundle:ImgLectura')->obtenerPendientesLecturaV2($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowInterpretar    = ($this->admin->getRoutes()->has('leer') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
                    
	$isUser_allowRegInicial     = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgPendienteLectura();

            $resultados[$key]['pndL_fechaIngresoLista']             = $resultado['pndL_fechaIngresoLista']->format('Y-m-d H:i:s A');
            $resultados[$key]['est_fechaEstudio']                   = $resultado['est_fechaEstudio']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['prz_fechaAtendido']                  = $resultado['prz_fechaAtendido'] ? $resultado['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaRealizado']                 = $resultado['prz_fechaRealizado'] ? $resultado['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaProcesado']                 = $resultado['prz_fechaProcesado'] ? $resultado['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaAlmacenado']                = $resultado['prz_fechaAlmacenado'] ? $resultado['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['prc_fechaCreacion']    = $resultado['prc_fechaCreacion'] ? $resultado['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['solcmpl_fechaSolicitud']             = $resultado['solcmpl_fechaSolicitud'] ? $resultado['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';

            $resultados[$key]['lct_createUrl']                      = $resultado['lctPdr_id'] ?
                                                                            $this->generateUrl('simagd_lectura_edit',
                                                                                array('id' => $resultado['lctPdr_id'],
                                                                                      '__est' => $resultado['est_id'],
                                                                                      '__estPdr' => $resultado['estPdr_id']
                                                                                )) :
                                                                            $this->generateUrl('simagd_lectura_create',
                                                                                array('__est' => $resultado['est_id'],
                                                                                      '__xrad' => $resultado['pndL_anexadoPorRadiologo'] ? TRUE : NULL,
                                                                                      '__xradAnx' => $resultado['pndL_id_radiologoAnexa'],
                                                                                      '__estPdr' => $resultado['estPdr_id']
                                                                            ));
            
            $resultados[$key]['allowInterpretar']                   = $isUser_allowInterpretar;
            
            $resultados[$key]['allowRegInicial']                    = $isUser_allowRegInicial;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function anexarEstudioEnListaSinLecturaAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from estudio
        $estudio        = $request->request->get('__est');
        $this->get('request')->request->set('__est', $estudio ? $estudio : NULL);

        //Get parameter from estudio padre (en caso de ser complementario)
        $estudioPdr     = $request->request->get('__estPdr');
        $this->get('request')->request->set('__estPdr', $estudioPdr ? $estudioPdr : NULL);
        
        $this->get('request')->request->set('__xrad', TRUE);
        
        //Nueva instancia
        $pndLectura     = $this->admin->getNewInstance();

        //Crear registro
        try {
            /*$pndLectura = */$this->admin->create($pndLectura);
        } catch (Exception $e) {
            $status     = 'failed';
        }
        
        $response       = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function asignarElementoListaTrabajoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
	$status     = 'OK';
        
        /*
         * request
         */
        $id_radX    = $request->request->get('__radx');
        $pndL_rows  = $request->request->get('__ar_rowsAffected');
        
        $em         = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
//        $start      = $request->request->get('start');
//        $end        = $request->request->get('end');
//        
//        $cita->setFechaHoraInicio(\DateTime::createFromFormat('Y-m-d H:i', $start));
        
        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:ImgPendienteLectura')
                        ->asignarElementoListaTrabajo($estabLocal->getId(), $id_radX, $sessionUser->getIdEmpleado()->getId(), $pndL_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response   = new Response();
        $response->setContent(json_encode(array('update' => $status)));
        return $response;
    }

}