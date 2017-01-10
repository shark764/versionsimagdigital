<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxCtlPatronDiagnosticoListViewGenerator;

class ImgCtlPatronDiagnosticoAdminController extends Controller
{
    /**
     * TABLE GENERATOR
     *
     * @param Request $request
     *
     * @return Response
     */
    public function generateTableAction(Request $request)
    {
        $request->isXmlHttpRequest();
        $__REQUEST__type = $request->request->get('type', 'list');

        $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxCtlPatronDiagnosticoListViewGenerator(
                $this->container,
                $this->admin->getRouteGenerator(),
                $this->admin->getClass(),
                $__REQUEST__type
        );
        //////// --|
        $options = $ENTITY_LIST_VIEW_GENERATOR_->getTable();

        return $this->renderJson(array(
            'result'    => 'ok',
            'options'   => $options
        ));
    }

    public function listAction()
    {
        // Acceso denegado
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

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em                 = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $results         = $em->getRepository('MinsalSimagdBundle:ImgCtlPatronDiagnostico')->obtenerPatronesDiagnosticoV2($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            // '<div class="container">' .
                            // '<div class=" col-lg-12 col-md-12 col-sm-12">' .
                                // '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                                // '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>NOMBRE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['nombre'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SUBGRUPO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['subgrupo'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (SUBGPO):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo_subgrupo'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>GRUPO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['grupo'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (GPO):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo_grupo'] . '</div></div>' .
                                // '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['fecha_registro'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . \DateTime::createFromFormat('Y-m-d H:i:s', $r['fecha_registro'])->format('Y-m-d H:i:s A') . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DESCRIPCIÓN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['descripcion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>HABILITADO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->booleanFormatter($r['habilitado']) . '</div></div>' .
                            // '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-show-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Ver detalle..." >' .
                        // '<a class=" worklist-show-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Ver detalle..." >' .
                            // 'Ver' .
                            '<i class="glyphicon glyphicon-chevron-down"></i>' .
                        '</a>' .
                    '</div>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-form-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Abrir formulario..." >' .
                        // '<a class=" worklist-save-form-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Abrir formulario..." >' .
                            // 'Formulario' .
                            '<i class="glyphicon glyphicon-edit"></i>' .
                        '</a>' .
                    '</div>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-and-pacs-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Guardar y asociar..." >' .
                        // '<a class=" worklist-save-and-pacs-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Guardar y asociar..." >' .
                            // 'Guardar y asociar' .
                            // '<i class="glyphicon glyphicon-check"></i>' .
                            '<i class="glyphicon glyphicon-link"></i>' .
                        '</a>' .
                    '</div>' .
                    // '<span class="bs-btn-separator-toolbar"></span>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-action btn-link btn-link-emergency " href="javascript:void(0)" title="Guardar sin asociar..." >' .
                        // '<a class=" worklist-save-action btn btn-emergency btn-outline btn-xs " href="javascript:void(0)" title="Guardar sin asociar..." >' .
                            // 'Guardar' .
                            '<i class="glyphicon glyphicon-check"></i>' .
                        '</a>' .
                    '</div>' .
                '</div>';

            $results[$key]['ptrDiag_fechaHoraReg']   = $r['ptrDiag_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['ptrDiag_fechaHoraMod']   = $r['ptrDiag_fechaHoraMod'] ? $r['ptrDiag_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $results[$key]['allowShow']              = $isUser_allowShow;

            $results[$key]['allowEdit']              = $isUser_allowEdit;
        }

        $response = new Response();
        $response->setContent(json_encode($results));
        return $response;
    }

    public function crearPatronDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //Nueva instancia
        $patronDiagnostico      = $this->admin->getNewInstance();
        // $patronDiagnostico = new ImgCtlPatronDiagnostico();

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

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
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
            /*$patronDiagnostico  = */$this->admin->create($patronDiagnostico);
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
            /*$patronDiagnostico  = */$this->admin->update($patronDiagnostico);
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
        // $object_ptrDiag = new ImgCtlPatronDiagnostico();

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
        // $object_ptrDiag->setIdAreaServicioDiagnostico($em->getReference('Minsal\LaboratorioBundle\Entity\CtlAreaServicioDiagnostico', $request->request->get('form_diagAsPattern_idAreaServicioDiagnostico')));
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