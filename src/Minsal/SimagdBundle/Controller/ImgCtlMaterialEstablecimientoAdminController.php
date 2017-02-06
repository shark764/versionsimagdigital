<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxCtlMaterialEstablecimientoListViewGenerator;

class ImgCtlMaterialEstablecimientoAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxCtlMaterialEstablecimientoListViewGenerator(
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

        $results = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->localData($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

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
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>HABILITADO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->booleanFormatter($r['habilitado']) . '</div></div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" localmaterials-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="localmaterials-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="localmaterials_show"><a class=" localmaterials_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="localmaterials_edit"><a class=" localmaterials_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="localmaterials_delete"><a class=" localmaterials_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="localmaterials_create"><a class=" localmaterials_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';
            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" localmaterials-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            $results[$key]['habilitado'] = $formatter->booleanFormatter($r['habilitado']);

            $results[$key]['mtrl_fechaHoraReg']  = $r['mtrl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['mtrLc_fechaHoraReg'] = $r['mtrLc_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['mtrLc_fechaHoraMod'] = $r['mtrLc_fechaHoraMod'] ? $r['mtrLc_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $results[$key]['allowShow']          = $isUser_allowShow;

            $results[$key]['allowEdit']          = $isUser_allowEdit;
        }

        return $this->renderJson($results);
    }

    public function agregarMaterialEnLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Get parameter from material
        $material           = $request->request->get('formMtrlMtrLcIdMaterial');

        $cantidadDisponible = $request->request->get('formMtrlMtrLcCantidadDisponible');
        $habilitado         = $this->get('request')->request->get('formMtrlMtrLcHabilitado') ? TRUE : FALSE;
        $descripcion        = $request->request->get('formMtrlMtrLcDescripcion');

        //Nueva instancia
        $materialLc         = $this->admin->getNewInstance();
        // $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

        //material
        $materialRef        = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlMaterial', $material);
        $materialLc->setIdMaterial($materialRef);

    	$materialLc->setIdEstablecimiento($estabLocal);
    	$materialLc->setCantidadDisponible($cantidadDisponible ? $cantidadDisponible : 0);
        //Habilitado
        $materialLc->setHabilitado($habilitado);
        $materialLc->setDescripcion($descripcion);

        //Crear registro
        try {
            /*$materialLc     = */$this->admin->create($materialLc);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function crearMaterialLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Get parameter from material
        $material           = $request->request->get('formMtrLcIdMaterial');

        $cantidadDisponible = $request->request->get('formMtrLcCantidadDisponible');
        $habilitado         = $this->get('request')->request->get('formMtrLcHabilitado') ? TRUE : FALSE;
        $descripcion        = $request->request->get('formMtrLcDescripcion');

        //Nueva instancia
        $materialLc         = $this->admin->getNewInstance();
        // $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

        //material
        $materialRef        = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlMaterial', $material);
        $materialLc->setIdMaterial($materialRef);

    	$materialLc->setIdEstablecimiento($estabLocal);
    	$materialLc->setCantidadDisponible($cantidadDisponible ? $cantidadDisponible : 0);
        //Habilitado
        $materialLc->setHabilitado($habilitado);
        $materialLc->setDescripcion($descripcion);

        //Crear registro
        try {
            /*$materialLc     = */$this->admin->create($materialLc);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function editarMaterialLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Get parameter from diagnostico
        $id                 = $request->request->get('formMtrLcIdMaterialEstablecimiento');

        //Get parameter from material
        $material           = $request->request->get('formMtrLcIdMaterial');

        $cantidadDisponible = $request->request->get('formMtrLcCantidadDisponible');
        $habilitado         = $this->get('request')->request->get('formMtrLcHabilitado') ? TRUE : FALSE;
        $descripcion        = $request->request->get('formMtrLcDescripcion');

        //Objeto
        $materialLc         = $this->admin->getObject($id);
        // $materialLc = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

        //material
        $materialRef        = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlMaterial', $material);
        $materialLc->setIdMaterial($materialRef);

    	$materialLc->setIdEstablecimiento($estabLocal);
    	$materialLc->setCantidadDisponible($cantidadDisponible ? $cantidadDisponible : 0);
    	$materialLc->setDescripcion($descripcion);
        //Habilitado
        $materialLc->setHabilitado($habilitado);

        //Actualizar registro
        try {
            /*$materialLc     = */$this->admin->update($materialLc);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function getNonAggregatedMaterialsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')
				    ->getNonAggregatedMaterials($estabLocal->getId());

        return $this->renderJson($results);
    }

    public function habilitarMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $id = $request->request->get('id');
        $materialLc     = $this->admin->getObject($id);

        $habilitado     = $request->request->get('formMtrLcHabilitado');

        $em = $this->getDoctrine()->getManager();

        //Habilitar
        $materialLc->setHabilitado($habilitado);

        //Actualizar Material
        try {
            /*$materialLc = */$this->admin->update($materialLc);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

}