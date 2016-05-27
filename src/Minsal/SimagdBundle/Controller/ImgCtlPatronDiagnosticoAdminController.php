<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class ImgCtlPatronDiagnosticoAdminController extends Controller
{
    public function listAction()
    {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em                 = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $tiposEmpleado      = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $empleados          = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 2, 4, 5, 6, 7))
                                        ->getQuery()->getResult();
        
        $modalidades        = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')
                                            ->obtenerModalidadesRealizablesLocalV2($estabLocal->getId());
        
        $radiologos         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                            ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                            ->getQuery()->getResult();
        
        $tiposResultado     = $em->getRepository('MinsalSimagdBundle:ImgCtlTipoResultado')->findAll();

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'          => $tiposEmpleado,
                        'empleados'             => $empleados,
                        'default_empLogged'            => $sessionUser->getIdEmpleado(),
			'modalidades'           => $modalidades,
			'default_mldRx'    => 13,
			'radiologos'            => $radiologos,
                        'tiposResultado'        => $tiposResultado,
                        'tipoResultDefault'     => 1
                    ));
    }
    
    public function listarPatronesDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);
        
        $em                 = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgCtlPatronDiagnostico')->obtenerPatronesDiagnosticoV2($estabLocal->getId(), $BS_FILTERS_DECODE);

	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico();

            $resultados[$key]['ptrDiag_fechaHoraReg']   = $resultado['ptrDiag_fechaHoraReg']->format('Y-m-d H:i:s A');
            $resultados[$key]['ptrDiag_fechaHoraMod']   = $resultado['ptrDiag_fechaHoraMod'] ? $resultado['ptrDiag_fechaHoraMod']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['allowShow']              = $isUser_allowShow;
            
            $resultados[$key]['allowEdit']              = $isUser_allowEdit;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function crearPatronDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //Nueva instancia
        $patronDiagnostico      = $this->admin->getNewInstance();
//        $patronDiagnostico = new ImgCtlPatronDiagnostico();
        
        $empleado               = $request->request->get('formPtrDiagIdEmpleado');
        $modalidad              = $request->request->get('formPtrDiagIdAreaServicioDiagnostico');
        $radiologo              = $request->request->get('formPtrDiagIdRadiologoDefine');
        $tipoResult             = $request->request->get('formPtrDiagIdTipoResultado');
        $nombre                 = $request->request->get('formPtrDiagNombre');
        $codigo                 = $request->request->get('formPtrDiagCodigo');
        $hallazgos              = $request->request->get('formPtrDiagHallazgos');
        $conclusion             = $request->request->get('formPtrDiagConclusion');
        $recomendaciones        = $request->request->get('formPtrDiagRecomendaciones');
        $indicaciones           = $request->request->get('formPtrDiagIndicacionesGenerales');
        $observaciones          = $request->request->get('formPtrDiagObservaciones');

	$securityContext        = $this->container->get('security.context');
	$sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();

        $em                     = $this->getDoctrine()->getManager();

        //Establecimiento local
        $patronDiagnostico->setIdEstablecimiento($estabLocal);
        
        //Empleado
        $empleadoReference      = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $patronDiagnostico->setIdEmpleadoRegistra($empleadoReference);
        //Modalidad
        $modalidadReference     = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $modalidad);
        $patronDiagnostico->setIdAreaServicioDiagnostico($modalidadReference);
        //Tipo Resultado
        $tipoResultReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlTipoResultado', $tipoResult);
        $patronDiagnostico->setIdTipoResultado($tipoResultReference);
        
        //Radiologo
	if ($radiologo)
	{
	    $radiologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $radiologo);
	    $patronDiagnostico->setIdRadiologoDefine($radiologoReference);
	} else {
	    $patronDiagnostico->setIdRadiologoDefine(NULL);
	}
        
        $patronDiagnostico->setNombre(trim($nombre));
        $patronDiagnostico->setCodigo(trim($codigo));
        $patronDiagnostico->setHallazgos($hallazgos);
        $patronDiagnostico->setConclusion($conclusion);
        $patronDiagnostico->setRecomendaciones($recomendaciones);
        $patronDiagnostico->setIndicacionesGenerales(trim($indicaciones));
        $patronDiagnostico->setObservaciones(trim($observaciones));

        //Crear registro
        try {
            $patronDiagnostico  = $this->admin->create($patronDiagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function editarPatronDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from diagnostico
        $id                     = $request->request->get('formPtrDiagId');
        
        //Objeto
        $patronDiagnostico      = $this->admin->getObject($id);
        
        $empleado 		= $request->request->get('formPtrDiagIdEmpleado');
        $modalidad 		= $request->request->get('formPtrDiagIdAreaServicioDiagnostico');
        $radiologo 		= $request->request->get('formPtrDiagIdRadiologoDefine');
        $tipoResult 		= $request->request->get('formPtrDiagIdTipoResultado');
        $nombre 		= $request->request->get('formPtrDiagNombre');
        $codigo 		= $request->request->get('formPtrDiagCodigo');
        $hallazgos 		= $request->request->get('formPtrDiagHallazgos');
        $conclusion 		= $request->request->get('formPtrDiagConclusion');
        $recomendaciones 	= $request->request->get('formPtrDiagRecomendaciones');
        $indicaciones 		= $request->request->get('formPtrDiagIndicacionesGenerales');
        $observaciones 		= $request->request->get('formPtrDiagObservaciones');
        
        $em = $this->getDoctrine()->getManager();
        
        //Empleado
        $empleadoReference 	= $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $patronDiagnostico->setIdEmpleadoRegistra($empleadoReference);
        //Modalidad
        $modalidadReference 	= $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $modalidad);
        $patronDiagnostico->setIdAreaServicioDiagnostico($modalidadReference);
        //Tipo Resultado
        $tipoResultReference 	= $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlTipoResultado', $tipoResult);
        $patronDiagnostico->setIdTipoResultado($tipoResultReference);
        
        //Radiologo
	if ($radiologo)
	{
	    $radiologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $radiologo);
	    $patronDiagnostico->setIdRadiologoDefine($radiologoReference);
	} else {
	    $patronDiagnostico->setIdRadiologoDefine(NULL);
	}
        
        $patronDiagnostico->setNombre(trim($nombre));
        $patronDiagnostico->setCodigo(trim($codigo));
        $patronDiagnostico->setHallazgos($hallazgos);
        $patronDiagnostico->setConclusion($conclusion);
        $patronDiagnostico->setRecomendaciones($recomendaciones);
        $patronDiagnostico->setIndicacionesGenerales(trim($indicaciones));
        $patronDiagnostico->setObservaciones(trim($observaciones));
        
        //Actualizar registro
        try {
            $patronDiagnostico  = $this->admin->update($patronDiagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function addDiagnosisAsPatternAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
	$status = 'OK';

        //Nueva instancia
        $object_ptrDiag  = $this->admin->getNewInstance();
//        $object_ptrDiag = new ImgCtlPatronDiagnostico();

	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em     = $this->getDoctrine()->getManager();

        //Establecimiento local
        $object_ptrDiag->setIdEstablecimiento($estabLocal);
        
        //Empleado
        $object_ptrDiag->setIdEmpleadoRegistra($sessionUser->getIdEmpleado());
        //Modalidad
        $object_ptrDiag->setIdAreaServicioDiagnostico($em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $request->request->get('form_diagAsPattern_idAreaServicioDiagnostico')));
//        $object_ptrDiag->setIdAreaServicioDiagnostico($em->getReference('Minsal\LaboratorioBundle\Entity\CtlAreaServicioDiagnostico', $request->request->get('form_diagAsPattern_idAreaServicioDiagnostico')));
        //Tipo Resultado
        $object_ptrDiag->setIdTipoResultado($em->getReference('Minsal\SimagdBundle\Entity\ImgCtlTipoResultado', $request->request->get('form_diagAsPattern_idTipoResultado')));
        //Radiologo
        $object_ptrDiag->setIdRadiologoDefine($sessionUser->getIdEmpleado());
        
        $object_ptrDiag->setNombre(trim($request->request->get('form_diagAsPattern_nombre')));
        $object_ptrDiag->setCodigo(trim($request->request->get('form_diagAsPattern_codigo')));
        $object_ptrDiag->setHallazgos(trim($request->request->get('form_diagAsPattern_hallazgos')));
        $object_ptrDiag->setConclusion(trim($request->request->get('form_diagAsPattern_conclusion')));
        $object_ptrDiag->setRecomendaciones(trim($request->request->get('form_diagAsPattern_recomendaciones')));

        //Crear registro
        try {
            $this->admin->create($object_ptrDiag);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response   = new Response();
        $response->setContent(json_encode(
                array(
                    'id' => $object_ptrDiag->getId(),
                    'status' => $status,
                )));
        return $response;
    }

}