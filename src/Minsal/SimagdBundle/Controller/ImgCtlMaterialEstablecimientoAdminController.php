<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Generator\ListViewGenerator\RyxCtlMaterialEstablecimientoListViewGenerator;

class ImgCtlMaterialEstablecimientoAdminController extends Controller
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
    
    public function listarMaterialesLocalesAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $em                 = $this->getDoctrine()->getManager();

	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->obtenerMaterialesLocalesV2($estabLocal->getId(), $BS_FILTERS_DECODE);

	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

            $resultados[$key]['mtrl_fechaHoraReg']  = $resultado['mtrl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $resultados[$key]['mtrLc_fechaHoraReg'] = $resultado['mtrLc_fechaHoraReg']->format('Y-m-d H:i:s A');
            $resultados[$key]['mtrLc_fechaHoraMod'] = $resultado['mtrLc_fechaHoraMod'] ? $resultado['mtrLc_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $resultados[$key]['allowShow']          = $isUser_allowShow;

            $resultados[$key]['allowEdit']          = $isUser_allowEdit;
        }

        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    public function agregarMaterialEnLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em                 = $this->getDoctrine()->getManager();

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
//        $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

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

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function crearMaterialLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em                 = $this->getDoctrine()->getManager();

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
//        $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

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

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function editarMaterialLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em                 = $this->getDoctrine()->getManager();

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
//        $materialLc = new \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento();

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

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function obtenerMaterialesNoAgregadosAction()
    {
        $em                 = $this->getDoctrine()->getManager();

	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')
				    ->obtenerMaterialesNoAgregados($estabLocal->getId());

        $response           = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    public function habilitarMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $id             = $request->request->get('id');
        $materialLc     = $this->admin->getObject($id);

        $habilitado     = $request->request->get('formMtrLcHabilitado');

        $em             = $this->getDoctrine()->getManager();

        //Habilitar
        $materialLc->setHabilitado($habilitado);

        //Actualizar Material
        try {
            /*$materialLc = */$this->admin->update($materialLc);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response       = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

}
