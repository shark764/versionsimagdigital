<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\Metodos\Funciones;
use Doctrine\DBAL as DBAL;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Exception\ModelManagerException;

class ImgEstudioPacienteAdminController extends CRUDController
{
    /**
     * Redirigir inmediatamente hacia la busqueda de paciente
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST') /*|| false === $this->admin->isGranted('VIEW')*/) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        //Get parameters
        if (!$this->get('request')->query->get('__exp')) {
            $this->get('request')->query->set('__exp', null);
        }

        $id_expRequest      = $this->get('request')->query->get('__exp');
        
        $em                 = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $tiposEmpleado      = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $medicos            = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 2, 4))
                                ->getQuery()->getResult();
        
        $tiposEstab         = $em->getRepository('MinsalSiapsBundle:CtlTipoEstablecimiento')->findAll();
        
        $establecimientos   = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->obtenerEstabParaRefDiag('idEstablecimientoDiagnosticante')
                                                        ->getQuery()->getResult();
        
        $expRequest         = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($id_expRequest ? $id_expRequest : '-1');
        
        $collection_tiposEmpleado  = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        $collection_radiologos     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))->getQuery()->getResult();
        $collection_prioridades    = $em->getRepository('MinsalSimagdBundle:ImgCtlPrioridadAtencion')->obtenerPrioridadesAtencionV2();
        $collection_modalidades    = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $collection_examenes       = $em->getRepository('MinsalSiapsBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $collection_proyecciones   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->findAll();
        $collection_sexos          = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();
        
        /*
         * GROUP_DEPENDENT_ENTITIES
         */
        $GROUP_DEPENDENT_ENTITIES   = array();
        try {
            $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerProyeccionesAgrupadasV2($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        //Objeto
//         $arrayObj = $this->admin->getObject('91');

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'       => $tiposEmpleado,
                        'medicos'           => $medicos,
                        'tiposEstab'        => $tiposEstab,
                        'establecimientos'  => $establecimientos,
                        'default_empLogged' => $sessionUser->getIdEmpleado(),
                        'defaultEstab'      => $estabLocal,
                        'expRequest'        => $expRequest,/*,
                        'arrayObj3' => $arrayObj->getSimpleObjectPropertiesAsArray()*/
                        'collection_tiposEmpleado'  => $collection_tiposEmpleado,
                        'collection_radiologos'     => $collection_radiologos,
                        'collection_default_empLogged'  => $sessionUser->getIdEmpleado(),
                        'collection_prioridades'    => $collection_prioridades,
                        'collection_modalidades'    => $collection_modalidades,
                        'collection_sexos'          => $collection_sexos,
                        'collection_examenes'       => $collection_examenes,
                        'collection_proyecciones'   => $collection_proyecciones,
                        'collection_default_exmRx'  => 27,
                        'collection_default_mldRx'  => 13,
                        'collection_default_prAtn'  => 3,
                        'GROUP_DEPENDENT_ENTITIES'  => $GROUP_DEPENDENT_ENTITIES,
                    ));
    }
    
    /**
     * 
     * @return type
     */
    public function resultadosBusquedaEstudioAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);
        
        $em                     = $this->getDoctrine()->getManager();
        
	$securityContext 	= $this->container->get('security.context');
	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();
        
        $resultados             = null;
        
        /*
	* NUM. de Expediente en búsqueda mínima.
	*/
        if (is_array($BS_FILTERS_DECODE) && array_key_exists('xparam', $BS_FILTERS_DECODE))
        {
            if (array_key_exists('explocal_numero', $BS_FILTERS_DECODE['xparam']) && !$BS_FILTERS_DECODE['xparam']['explocal_numero']['value'])
            {
                $limiteResultados   = array_key_exists('limitarResultados', $BS_FILTERS_DECODE['xparam']) ?
                        $BS_FILTERS_DECODE['xparam']['limitarResultados']['value'] : 100;

                $estabAlojado       = array_key_exists('establecimientoAlojado', $BS_FILTERS_DECODE['xparam']) ?
                        $BS_FILTERS_DECODE['xparam']['establecimientoAlojado']['value'] : $estabLocal->getId();

                $fechaNacimiento    = array_key_exists('fechaNacimiento', $BS_FILTERS_DECODE['xparam']) ?
                        \DateTime::createFromFormat('Y-m-d', $BS_FILTERS_DECODE['xparam']['fechaNacimiento']['value']) : null;

                $fechaDesde         = array_key_exists('fechaDesde', $BS_FILTERS_DECODE['xparam']) ?
                                            \DateTime::createFromFormat('Y-m-d H:i A', $BS_FILTERS_DECODE['xparam']['fechaDesde']['value']) : null;

                $fechaHasta         = array_key_exists('fechaHasta', $BS_FILTERS_DECODE['xparam']) ?
                                            \DateTime::createFromFormat('Y-m-d H:i A', $BS_FILTERS_DECODE['xparam']['fechaHasta']['value']) : null;

                $criteria = array();

                if ($fechaNacimiento) {
                    $criteria['fechaNacimiento']    = $fechaNacimiento;
                }

                /*
                 * advance search
                 */
                $BS_FILTERS_DECODE['xparam']['explocal_numero']['value']    = null;
                $resultados         = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')
                                                ->obtenerEstudiosPacienteV2(
                                                                $estabAlojado,
                                                                $fechaDesde,
                                                                $fechaHasta,
                                                                $criteria,
                                                                $limiteResultados,
                                                                $BS_FILTERS_DECODE
                                                        );
        
        
//                var_dump($resultados);
//                throw new AccessDeniedException();

            }
            else
            {
                /*
                 * minimum search
                 */
                $resultados         = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')
                                                ->obtenerEstudiosPacienteV2(
                                                        $estabLocal->getId(),
                                                        null,
                                                        null,
                                                        array(),
                                                        100,
                                                        $BS_FILTERS_DECODE
                                                );
        
        
//                var_dump($resultados);
//                throw new AccessDeniedException();
            }
        }
                       
	$isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	
	$isUser_allowDownload   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('download')) ? TRUE : FALSE;
	
	$allowSolCmpl           = ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE') ||
                    $securityContext->isGranted('ROLE_ADMIN')) ? TRUE : FALSE;
	
	$PACS_SERVER_CONFIGURED = $isUser_allowDownload !== false ?
				      $em->getRepository('MinsalSimagdBundle:ImgCtlPacsEstablecimiento')->getConfiguredServerPACSConnection($estabLocal->getId())
				      : null;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgEstudioPaciente();

            $resultados[$key]['est_fechaEstudio']                   = $resultado['est_fechaEstudio']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['prz_fechaAtendido']                  = $resultado['prz_fechaAtendido'] ? $resultado['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaRealizado']                 = $resultado['prz_fechaRealizado'] ? $resultado['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaProcesado']                 = $resultado['prz_fechaProcesado'] ? $resultado['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaAlmacenado']                = $resultado['prz_fechaAlmacenado'] ? $resultado['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['prc_fechaCreacion']    = $resultado['prc_fechaCreacion'] ? $resultado['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prc_fechaProximaConsulta']           = $resultado['prc_fechaProximaConsulta'] ? $resultado['prc_fechaProximaConsulta']->format('Y-m-d') : '';
            
            $resultados[$key]['cit_fechaCreacion']              = $resultado['cit_fechaCreacion'] ? $resultado['cit_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaConfirmacion']          = $resultado['cit_fechaConfirmacion'] ? $resultado['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaReprogramacion']        = $resultado['cit_fechaReprogramacion'] ? $resultado['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaHoraInicio']                = $resultado['cit_fechaHoraInicio'] ? $resultado['cit_fechaHoraInicio']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaHoraFin']                   = $resultado['cit_fechaHoraFin'] ? $resultado['cit_fechaHoraFin']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['solcmpl_fechaSolicitud']             = $resultado['solcmpl_fechaSolicitud'] ? $resultado['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['allowShow']                          = $isUser_allowShow;
            
            $resultados[$key]['allowDownload']                      = $isUser_allowDownload;

            $resultados[$key]['est_url_weasis'] = $isUser_allowDownload !== false ?
                                                        ($PACS_SERVER_CONFIGURED !== null && $resultado['est_estudioUid'] !== null ?
                                                                'http://'
                                                                . trim($PACS_SERVER_CONFIGURED->getIp())
                                                                . ':8081/weasis-pacs-connector/viewer.jnlp?studyUID='
                                                                . trim($resultado['est_estudioUid'])
                                                        : '') : '';
            $resultados[$key]['est_url_oviyam2']    = $isUser_allowDownload !== false ?
                                                        ($PACS_SERVER_CONFIGURED !== null && $resultado['est_estudioUid'] !== null ?
                                                                'http://'
                                                                . trim($PACS_SERVER_CONFIGURED->getIp())
                                                                . ':8081/oviyam2/viewer.html?patientID='
                                                                . trim($resultado['explocal_numero'])
                                                                . '&studyUID='
                                                                . trim($resultado['est_estudioUid'])
                                                        : '') : '';
            
            $resultados[$key]['allowSolCmpl']                       = (false !== $allowSolCmpl && !$resultado['solcmpl_id']) ? TRUE : FALSE;
            
            $resultados[$key]['solcmpl_createUrl']                  = $this->generateUrl('simagd_solicitud_estudio_complementario_create',
		    array('__prc' => $resultado['prc_id'], '__est' => $resultado['est_id']));
		    
	    /** Anexar por radiólogo */
	    $countLct       = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->countEstudioLecturasRealizadas($resultado['est_id']);
	    $countPndL      = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->countEstudioPendienteLectura($resultado['est_id']);
	    $countLctEst    = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->countEstudioLecturaEstudio($resultado['est_id']);
                    
            $resultados[$key]['allowAnexarPndL']                    = ($countLct['numReg'] === 0 && $countPndL['numReg'] === 0 && $countLctEst['numReg'] === 0 &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
            
            $resultados[$key]['study_url_diagnosis']    = $resultados[$key]['allowAnexarPndL'] !== false ?
                                                                $this->generateUrl('simagd_lectura_create', array(
                                                                        '__est' => $resultado['est_id'],
                                                                        '__xrad' => TRUE,
                                                                        '__xradAnx' => $sessionUser->getIdEmpleado()->getId(),
                                                                        '__estPdr' => $resultado['estPdr_id'],
                                                                        '__przLct' => TRUE)
                                                                ) : null;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    /**
     * 
     * @return type
     */
    public function obtenerExpedientesEstabAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $numeroExp          = $this->get('request')->query->get('query');
        
        $em                 = $this->getDoctrine()->getManager();
        
        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->obtenerExpedientesEstabV2($estabLocal->getId(), $numeroExp);

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgEstudioPaciente();

            $resultados[$key]['pct_edad']   = $resultado['pct_fechaNacimiento'] ? $resultado['pct_fechaNacimiento']->diff((new \DateTime('now'))) : null;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

}