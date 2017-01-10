<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento;

use Minsal\SimagdBundle\Generator\ListViewGenerator\RyxCtlMaterialListViewGenerator;

class ImgCtlMaterialAdminController extends Controller
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxCtlMaterialListViewGenerator(
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

    /**
     * Redirect the user depend on this choice
     *
     * @param object $object
     *
     * @return RedirectResponse
     */
    protected function redirectTo($object)
    {
        $url = false;

        if (null !== $this->get('request')->get('btn_update_and_list')) {
            $url = $this->admin->generateUrl('list');
        }
        if (null !== $this->get('request')->get('btn_create_and_list')) {
            $url = $this->admin->generateUrl('list');
        }

        if (null !== $this->get('request')->get('btn_create_and_create')) {
            $params = array();
            if ($this->admin->hasActiveSubClass()) {
                $params['subclass'] = $this->get('request')->get('subclass');
            }
            $url = $this->admin->generateUrl('create', $params);
        }

        if ($this->getRestMethod() == 'DELETE') {
            $url = $this->admin->generateUrl('list');
        }

        /** Crear/Actualizar y mostrar registro */
        if ((null !== $this->get('request')->get('btn_create_and_show')) ||
                                (null !== $this->get('request')->get('btn_edit_and_show'))) {
    		$url = $this->admin->generateObjectUrl('show', $object);
        }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }

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

        // $em = $this->getDoctrine()->getManager();
        //
        //	//No existe el registro
        //        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccion', 'expl')) {
        //            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        //        }

        return parent::editAction($id);
    }

    public function showAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        // $em = $this->getDoctrine()->getManager();
        //
        //	//No existe el registro
        //        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccion', 'expl')) {
        //            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        //        }

        return parent::showAction($id);
    }

    public function listAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('list'));
    }

    public function listarMaterialesAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em                 = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $results         = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->obtenerMaterialesV2($BS_FILTERS_DECODE);

        $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlMaterial();

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

            $results[$key]['action'] = '<div class="btn-group btn-group-xs"> <button type="button" class="btn btn-default dropdown-toggle example2-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> </div>';

            $results[$key]['mtrl_fechaHoraReg']  = $r['mtrl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['mtrl_fechaHoraMod']  = $r['mtrl_fechaHoraMod'] ? $r['mtrl_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $results[$key]['allowShow']          = $isUser_allowShow;

            $results[$key]['allowEdit']          = $isUser_allowEdit;

            $results[$key]['allowAgregarLc']     = ($this->admin->getRoutes()->has('agregarEnMiCatalogo') &&
                    false === $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->existeMaterialEnLocalV2($estabLocal->getId(), $r['mtrl_id']) &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_MATERIAL_ESTABLECIMIENTO_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }

        $response = new Response();
        $response->setContent(json_encode($results));
        return $response;
    }

    public function crearMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em                 = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Nueva instancia
        $material           = $this->admin->getNewInstance();
        // $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterial();

        $nombre             = $request->request->get('formMtrlNombre');
        $codigo             = $request->request->get('formMtrlCodigo');
        $descripcion        = $request->request->get('formMtrlDescripcion');

        $material->setNombre($nombre);
        $material->setCodigo($codigo);
        $material->setDescripcion($descripcion);

        //Crear registro
        try {
            /*$material       = */$this->admin->create($material);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $cantidadDisponible = $request->request->get('formMtrlCantidadDisponibleLocal');
        $habilitado         = $this->get('request')->request->get('formMtrlHabilitadoLocal') ? TRUE : FALSE;
        $descripcionLocal   = $request->request->get('formMtrlDescripcionLocal');
        $local              = $request->request->get('formMtrlAgregarEnLocal') ? TRUE : FALSE;

        if ($local) {
            /** ImgCtlMaterialEstablecimiento */
            $mtrLocal       = new ImgCtlMaterialEstablecimiento();
            $mtrLocal->setIdMaterial($material);
            $mtrLocal->setIdEstablecimiento($estabLocal);
            if ($cantidadDisponible) {
		$mtrLocal->setCantidadDisponible($cantidadDisponible);
            }
            $mtrLocal->setHabilitado($habilitado);
            $mtrLocal->setDescripcion($descripcionLocal);
            $mtrLocal->setIdUserReg($sessionUser);
            $mtrLocal->setFechaHoraReg(new \DateTime('now'));

	    //Crear registro
	    try {
		$em->persist($mtrLocal);
		$em->flush();
	    } catch (Exception $e) {
		$status = 'failed';
	    }
        }

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function editarMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em             = $this->getDoctrine()->getManager();

        //Get parameter from diagnostico
        $id             = $request->request->get('formMtrlId');

        //Objeto
        $material       = $this->admin->getObject($id);
        // $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterial();

        $nombre         = $request->request->get('formMtrlNombre');
        $codigo         = $request->request->get('formMtrlCodigo');
        $descripcion    = $request->request->get('formMtrlDescripcion');

        $material->setNombre($nombre);
        $material->setCodigo($codigo);
        $material->setDescripcion($descripcion);

        //Actualizar registro
        try {
            /*$material       = */$this->admin->update($material);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

}