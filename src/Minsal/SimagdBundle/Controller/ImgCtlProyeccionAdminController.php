<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento;
use Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxCtlProyeccionRadiologicaListViewGenerator;

class ImgCtlProyeccionAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxCtlProyeccionRadiologicaListViewGenerator(
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

    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccion', 'expl')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
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
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccion', 'expl')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        return parent::showAction($id);
    }

    public function listAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        $modalidades        = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $examenes           = $em->getRepository('MinsalSiapsBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $proyecciones       = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->findAll();
        $sexos              = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();

        return $this->render($this->admin->getTemplate('list'),
                array(
                    'modalidades'           => $modalidades,
                    'sexos'                 => $sexos,
                    'examenes'              => $examenes,
                    'proyecciones'          => $proyecciones,
                    'default_exmRx'  => 27,
                    'default_mldRx'    => 13
        ));
    }

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em = $this->getDoctrine()->getManager();

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->data($BS_FILTERS_DECODE);

        $isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit       = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlProyeccion();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>NOMBRE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['nombre'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>EXAMEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['examen'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (EXM):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo_examen'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->dateFormatter($r['fecha_registro']) . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DESCRIPCIÓN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['descripcion'] . '</div></div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" radiologicaldiagnosticpatterns-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="radiologicalexaminations-context-menu" class="dropdown-menu highlight-success-dropdown-menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="radiologicalexaminations_show"><a><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="radiologicalexaminations_edit"><a><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="radiologicalexaminations_delete"><a><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="radiologicalexaminations_create"><a><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                            '<li data-item="radiologicalexaminations_addtolocal"><a><span class="glyphicon glyphicon-plus-sign"></span>Agregar a oferta de servicios</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';
            $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" radiologicalexaminations-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                    '</div>' .
                '</div>';

            $results[$key]['expl_fechaHoraReg']  = $r['expl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['expl_fechaHoraMod']  = $r['expl_fechaHoraMod'] ? $r['expl_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $results[$key]['allowShow']          = $isUser_allowShow;

            $results[$key]['allowEdit']          = $isUser_allowEdit;

            $results[$key]['allowAgregarLc']     = ($this->admin->getRoutes()->has('agregarEnMiCatalogo') &&
                    false === $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->existeProyeccionEnLocalV2($estabLocal->getId(), $r['expl_id']) &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_ESTABLECIMIENTO_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }

        return $this->renderJson($results);
    }

    /**
     *
     * @return type
     */
    public function obtenerModalidadesAction()
    {

        $em = $this->getDoctrine()->getManager();

        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        $areaAtn = '97';

        $modalidades = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesImagenologia($areaAtn);

        return $this->render('MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_modalidadesComboBox.html.twig', array('modalidades' => $modalidades->getQuery()->getResult()));
    }

    public function crearProyeccionAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Nueva instancia
        $proyeccion        = $this->admin->getNewInstance();
        // $proyeccion = new \Minsal\SimagdBundle\Entity\ImgCtlProyeccion();

        $nombre             = $request->request->get('formExplNombre');
        $codigo             = $request->request->get('formExplCodigo');
        $examen             = $request->request->get('formExplIdExamenServicioDiagnostico');
        $tiempoSala         = $request->request->get('formExplTiempoOcupacionSala');
        $tiempoMedico       = $request->request->get('formExplTiempoMedico');
        $descripcion        = $request->request->get('formExplDescripcion');
        $observaciones      = $request->request->get('formExplObservaciones');
        $realizable         = $request->request->get('formExplProyeccionRealizable') ? TRUE : FALSE;
        $area               = $request->request->get('formExplIdAreaServicioDiagnostico');

        $em = $this->getDoctrine()->getManager();

        //Examen
        $examenReference    = $em->getReference('Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico', $examen);
        $proyeccion->setIdExamenServicioDiagnostico($examenReference);

        $proyeccion->setNombre($nombre);
        $proyeccion->setCodigo($codigo);
        $proyeccion->setDescripcion($descripcion);
        $proyeccion->setObservaciones($observaciones);
        if ($tiempoMedico) {
            $proyeccion->setTiempoMedico($tiempoMedico);
        }
        if ($tiempoSala) {
            $proyeccion->setTiempoOcupacionSala($tiempoSala);
        }

        //Crear registro
        try {
            /*$proyeccion    = */$this->admin->create($proyeccion);
        } catch (Exception $e) {
            $status = 'failed';
        }

        if ($realizable) {
            /** ImgCtlProyeccionEstablecimiento */
            $pryRealizable     = new ImgCtlProyeccionEstablecimiento();
            $pryRealizable->setIdProyeccion($proyeccion);
            $pryRealizable->setIdUserReg($sessionUser);
            $pryRealizable->setFechaHoraReg(new \DateTime('now'));

	    $habilitado         = $request->request->get('formExplHabilitadoLocal') ? TRUE : FALSE;
	    $observacionesLc    = $request->request->get('formExplObservacionesLocal');

	    $pryRealizable->setHabilitado($habilitado);
	    $pryRealizable->setObservaciones($observacionesLc);

            $areaExmEstab       = $em->getRepository('MinsalSiapsBundle:MntAreaExamenEstablecimiento')
                                                    ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
                                                                        'idAreaServicioDiagnostico' => $area,
                                                                        'idExamenServicioDiagnostico' => $examen));

            if (!$areaExmEstab) {
                /** CtlAreaServicioDiagnostico */
                $areaSrvApyRef      = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $area);
                /** CtlExamenServicioDiagnostico */
                $exmSrvApyRef       = $em->getReference('Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico', $examen);

                /** MntAreaExamenEstablecimiento */
                $areaExamenEstab    = new MntAreaExamenEstablecimiento();
                $areaExamenEstab->setIdAreaServicioDiagnostico($areaSrvApyRef);
                $areaExamenEstab->setIdExamenServicioDiagnostico($exmSrvApyRef);
                $areaExamenEstab->setIdEstablecimiento($estabLocal);
                $areaExamenEstab->setIdUsuarioReg($sessionUser);
                $areaExamenEstab->setFechaHoraReg(new \DateTime('now'));
                $em->persist($areaExamenEstab);
                $em->flush();

                $pryRealizable->setIdAreaExamenEstab($areaExamenEstab);
            } else {
                //Area Examen Estab
                $pryRealizable->setIdAreaExamenEstab($areaExmEstab);
            }

            $em->persist($pryRealizable);
            $em->flush();
        }

        return $this->renderJson(array());
    }

    public function editarProyeccionAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //Get parameter from proyección
        $id                 = $request->request->get('formExplId');

        //Objeto
        $proyeccion        = $this->admin->getObject($id);

        $nombre             = $request->request->get('formExplNombre');
        $codigo             = $request->request->get('formExplCodigo');
        $examen             = $request->request->get('formExplIdExamenServicioDiagnostico');
        $tiempoSala         = $request->request->get('formExplTiempoOcupacionSala');
        $tiempoMedico       = $request->request->get('formExplTiempoMedico');
        $descripcion        = $request->request->get('formExplDescripcion');
        $observaciones      = $request->request->get('formExplObservaciones');

        $em = $this->getDoctrine()->getManager();

        //Examen
        $examenReference    = $em->getReference('Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico', $examen);
        $proyeccion->setIdExamenServicioDiagnostico($examenReference);

        $proyeccion->setNombre($nombre);
        $proyeccion->setCodigo($codigo);
        $proyeccion->setDescripcion($descripcion);
        $proyeccion->setObservaciones($observaciones);
        if ($tiempoMedico) {
            $proyeccion->setTiempoMedico($tiempoMedico);
        }
        if ($tiempoSala) {
            $proyeccion->setTiempoOcupacionSala($tiempoSala);
        }

        //Actualizar registro
        try {
            /*$proyeccion    = */$this->admin->update($proyeccion);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function addToLocalCatalogueAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        /*
         * request
         */
        $id_areaSrvDiag    = $request->request->get('__mldx');
        $pryX_rows  = $request->request->get('__ar_rowsAffected');

        $em = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')
                        ->addToLocalCatalogue($estabLocal->getId(), $id_areaSrvDiag, $sessionUser->getId(), $pryX_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array('update' => $status));
    }

}