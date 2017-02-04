<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxCtlMaterialListViewGenerator;

class ImgCtlMaterialAdminController extends MinsalSimagdBundleGeneralAdminController
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

        $results = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->data($BS_FILTERS_DECODE);

        $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlMaterial();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>NOMBRE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['nombre'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SUBGRUPO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['subgrupo'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (SUBGPO):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo_subgrupo'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>GRUPO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['grupo'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (GPO):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['codigo_grupo'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->dateFormatter($r['fecha_registro']) . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DESCRIPCIÓN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['descripcion'] . '</div></div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" materials-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="materials-context-menu" class="dropdown-menu highlight-success-dropdown-menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="materials_show"><a><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="materials_edit"><a><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="materials_delete"><a><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="materials_create"><a><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                            '<li data-item="materials_addtolocal"><a><span class="glyphicon glyphicon-plus-sign"></span>Agregar a oferta de servicios</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';
            $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" materials-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                    '</div>' .
                '</div>';

            $results[$key]['mtrl_fechaHoraReg']  = $r['mtrl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['mtrl_fechaHoraMod']  = $r['mtrl_fechaHoraMod'] ? $r['mtrl_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $results[$key]['allowShow']          = $isUser_allowShow;

            $results[$key]['allowEdit']          = $isUser_allowEdit;

            $results[$key]['allowAgregarLc']     = ($this->admin->getRoutes()->has('agregarEnMiCatalogo') &&
                    false === $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->existeMaterialEnLocalV2($estabLocal->getId(), $r['mtrl_id']) &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_MATERIAL_ESTABLECIMIENTO_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }

        return $this->renderJson($results);
    }

    public function crearMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em = $this->getDoctrine()->getManager();

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

        return $this->renderJson(array());
    }

    public function editarMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em = $this->getDoctrine()->getManager();

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

        return $this->renderJson(array());
    }

}