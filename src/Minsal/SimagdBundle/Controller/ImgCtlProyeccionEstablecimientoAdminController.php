<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxCtlProyeccionEstablecimientoListViewGenerator;

class ImgCtlProyeccionEstablecimientoAdminController extends MinsalSimagdBundleGeneralAdminController
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

        // $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxCtlProyeccionEstablecimientoListViewGenerator(
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
    }Application\Sonata\UserBundle\Entity\User

    public function createAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return parent::createAction();
    }

    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccionEstablecimiento', 'explrz')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        // No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return parent::editAction($id);
    }

    public function showAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccionEstablecimiento', 'explrz')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        // No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return parent::showAction($id);
    }

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->localData($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento();

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
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (MDL):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo_modalidad'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>EXAMEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['examen'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (EXM):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo_examen'] . '</div></div>' .
                                // '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['fecha_registro'] . '</div></div>' .
                                // '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->dateFormatter($r['fecha_registro']) . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->dateFormatter($r['fecha_registro']) . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DESCRIPCIÓN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['descripcion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>HABILITADO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->booleanFormatter($r['habilitado']) . '</div></div>' .
                            // '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            // $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-show-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Ver detalle..." >' .
            //             // '<a class=" worklist-show-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Ver detalle..." >' .
            //                 // 'Ver' .
            //                 '<i class="glyphicon glyphicon-chevron-down"></i>' .
            //             '</a>' .
            //         '</div>' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-save-form-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Abrir formulario..." >' .
            //             // '<a class=" worklist-save-form-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Abrir formulario..." >' .
            //                 // 'Formulario' .
            //                 '<i class="glyphicon glyphicon-edit"></i>' .
            //             '</a>' .
            //         '</div>' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-save-and-pacs-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Guardar y asociar..." >' .
            //             // '<a class=" worklist-save-and-pacs-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Guardar y asociar..." >' .
            //                 // 'Guardar y asociar' .
            //                 // '<i class="glyphicon glyphicon-check"></i>' .
            //                 '<i class="glyphicon glyphicon-link"></i>' .
            //             '</a>' .
            //         '</div>' .
            //         // '<span class="bs-btn-separator-toolbar"></span>' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-save-action btn-link btn-link-emergency " href="javascript:void(0)" title="Guardar sin asociar..." >' .
            //             // '<a class=" worklist-save-action btn btn-emergency btn-outline btn-xs " href="javascript:void(0)" title="Guardar sin asociar..." >' .
            //                 // 'Guardar' .
            //                 '<i class="glyphicon glyphicon-check"></i>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            $results[$key]['action'] = '<div class="btn-group btn-group-xs"> <button type="button" class="btn btn-black-thrash dropdown-toggle example2-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> </div>';

            $results[$key]['habilitado'] = $formatter->booleanFormatter($r['habilitado']);

            $results[$key]['expl_fechaHoraReg']      = $r['expl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['explrz_fechaHoraReg']    = $r['explrz_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['explrz_fechaHoraMod']    = $r['explrz_fechaHoraMod'] ? $r['explrz_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $results[$key]['allowShow']              = $isUser_allowShow;

            $results[$key]['allowEdit']              = $isUser_allowEdit;
        }

        return $this->renderJson($results);
    }

    public function agregarProyeccionEnLocalAction()
    {
        $proyeccion        = $this->get('request')->request->get('formExplExplrzIdProyeccion');

        $observaciones      = $this->get('request')->request->get('formExplExplrzObservaciones');
        $habilitado         = $this->get('request')->request->get('formExplExplrzHabilitado') ? TRUE : FALSE;

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        /** CtlAreaServicioDiagnostico */
        $areaSrvApy         = $this->get('request')->request->get('formExplExplrzIdAreaServicioDiagnostico');
        /** CtlExamenServicioDiagnostico */
        $exmSrvApy          = $this->get('request')->request->get('formExplExplrzIdExamenServicioDiagnostico');

        //Nueva instancia
        $proyeccionRz      = $this->admin->getNewInstance();

        //Proyección
        $em = $this->getDoctrine()->getManager();
        $proyeccionRef     = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $proyeccion);
        $proyeccionRz->setIdProyeccion($proyeccionRef);

        //Observaciones
        $proyeccionRz->setObservaciones($observaciones);
        //Habilitado
        $proyeccionRz->setHabilitado($habilitado);

        $areaExmEstab       = $em->getRepository('MinsalSiapsBundle:MntAreaExamenEstablecimiento')
                                        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(), 'idAreaServicioDiagnostico' => $areaSrvApy, 'idExamenServicioDiagnostico' => $exmSrvApy));

        if (!$areaExmEstab) {
            /** CtlAreaServicioDiagnostico */
            $areaSrvApyRef      = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $areaSrvApy);
            /** CtlExamenServicioDiagnostico */
            $exmSrvApyRef       = $em->getReference('Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico', $exmSrvApy);

            /** MntAreaExamenEstablecimiento */
            $areaExamenEstab    = new MntAreaExamenEstablecimiento();
            $areaExamenEstab->setIdAreaServicioDiagnostico($areaSrvApyRef);
            $areaExamenEstab->setIdExamenServicioDiagnostico($exmSrvApyRef);
            $areaExamenEstab->setIdEstablecimiento($sessionUser->getIdEstablecimiento());
            $areaExamenEstab->setIdUsuarioReg($sessionUser);
            $areaExamenEstab->setFechaHoraReg(new \DateTime('now'));
            $em->persist($areaExamenEstab);
            $em->flush();

            $proyeccionRz->setIdAreaExamenEstab($areaExamenEstab);
        } else {
            //Area Examen Estab
            $proyeccionRz->setIdAreaExamenEstab($areaExmEstab);
        }

        //Crear registro
        try {
            /*$proyeccionRz      = */$this->admin->create($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function crearProyeccionLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $securityContext        = $this->container->get('security.context');
        $sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();

        //Nueva instancia
        $proyeccionRz          = $this->admin->getNewInstance();
        // $proyeccionRz = new \Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento();

        $habilitado             = $request->request->get('formExplrzHabilitado') ? TRUE : FALSE;
        $observaciones          = $request->request->get('formExplrzObservaciones');

        $area                   = $request->request->get('formExplrzIdAreaServicioDiagnostico');
        $examen                 = $request->request->get('formExplrzIdExamenServicioDiagnostico');
        $proyeccion            = $request->request->get('formExplrzIdProyeccion');

        $em = $this->getDoctrine()->getManager();

        //Proyeccion
        $proyeccionReference   = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $proyeccion);
        $proyeccionRz->setIdProyeccion($proyeccionReference);

        $proyeccionRz->setObservaciones($observaciones);
        $proyeccionRz->setHabilitado($habilitado);

        $areaExmEstab           = $em->getRepository('MinsalSiapsBundle:MntAreaExamenEstablecimiento')
                                            ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
                                                                'idAreaServicioDiagnostico' => $area,
                                                                'idExamenServicioDiagnostico' => $examen
                                                ));
        $proyeccionRz->setIdAreaExamenEstab($areaExmEstab);

        //Crear registro
        try {
            /*$proyeccionRz      = */$this->admin->create($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function editarProyeccionLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $securityContext        = $this->container->get('security.context');
        $sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();

        //Get parameter from proyección
        $id                     = $request->request->get('formExplrzId');

        //Objeto
        $proyeccionRz          = $this->admin->getObject($id);

        $habilitado             = $request->request->get('formExplrzHabilitado') ? TRUE : FALSE;
        $observaciones          = $request->request->get('formExplrzObservaciones');

        $area                   = $request->request->get('formExplrzIdAreaServicioDiagnostico');
        $examen                 = $request->request->get('formExplrzIdExamenServicioDiagnostico');
        $proyeccion            = $request->request->get('formExplrzIdProyeccion');

        $em = $this->getDoctrine()->getManager();

        //Proyeccion
        $proyeccionReference   = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $proyeccion);
        $proyeccionRz->setIdProyeccion($proyeccionReference);

        $proyeccionRz->setObservaciones($observaciones);
        $proyeccionRz->setHabilitado($habilitado);

        $areaExmEstab           = $em->getRepository('MinsalSiapsBundle:MntAreaExamenEstablecimiento')
                                            ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
                                                                'idAreaServicioDiagnostico' => $area,
                                                                'idExamenServicioDiagnostico' => $examen
                                                    ));
        $proyeccionRz->setIdAreaExamenEstab($areaExmEstab);

        //Actualizar registro
        try {
            /*$proyeccionRz      = */$this->admin->update($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function habilitarLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $id = $request->request->get('id');
        $proyeccionRz  = $this->admin->getObject($id);

        $habilitado     = $request->request->get('formExplrzHabilitado');

        $em = $this->getDoctrine()->getManager();

        //Habilitar
        $proyeccionRz->setHabilitado($habilitado);

        //Actualizar Proyección
        try {
            /*$proyeccionRz = */$this->admin->update($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

}