<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class ImgCtlPreparacionEstudioAdminController extends Controller
{
    public function listAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $tiposEmpleado = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();

        $empleados = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 2, 4, 5, 6, 7))
                                ->getQuery()->getResult();

        $modalidades = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')
                ->obtenerModalidadesRealizablesLocalV2($estabLocal->getId());

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado' => $tiposEmpleado,
                        'empleados' => $empleados,
                        'default_empLogged' => $sessionUser->getIdEmpleado(),
			'modalidades' => $modalidades,
			'default_mldRx' => 1,
                   ));
    }

    public function generateDataAction()
    {
        $em = $this->getDoctrine()->getManager();

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $resultados = $em->getRepository('MinsalSimagdBundle:ImgCtlPreparacionEstudio')->obtenerPreparacionEstudiosV2($estabLocal->getId(), $BS_FILTERS_DECODE);

	$isUser_allowShow = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlPreparacionEstudio();

            $resultados[$key]['indCit_fechaHoraReg'] = $resultado['indCit_fechaHoraReg']->format('Y-m-d H:i:s A');
            $resultados[$key]['indCit_fechaHoraMod'] = $resultado['indCit_fechaHoraMod'] ? $resultado['indCit_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $resultados[$key]['allowShow'] = $isUser_allowShow;

            $resultados[$key]['allowEdit'] = $isUser_allowEdit;
        }

        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    public function crearIndicacionCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //Nueva instancia
        $indicacionesCita = $this->admin->getNewInstance();
        // $indicacionesCita = new ImgCtlPreparacionEstudio();

        $empleado 		= $request->request->get('formIndCitIdEmpleado');
        $modalidad 		= $request->request->get('formIndCitIdAreaServicioDiagnosticoAplica');
        $indicaciones 		= $request->request->get('formIndCitPreparacionEstudio');
        $recomendaciones 	= $request->request->get('formIndCitRecomendaciones');
        $observaciones 		= $request->request->get('formIndCitObservaciones');

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        //Establecimiento local
        $indicacionesCita->setIdEstablecimiento($estabLocal);

        //Empleado
        $empleadoReference 	= $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $indicacionesCita->setIdEmpleadoRegistra($empleadoReference);
        //Modalidad
        $modalidadReference 	= $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $modalidad);
        $indicacionesCita->setIdAreaServicioDiagnosticoAplica($modalidadReference);
        
        $indicacionesCita->setPreparacionEstudio($indicaciones);
        $indicacionesCita->setRecomendaciones($recomendaciones);
        $indicacionesCita->setObservaciones(trim($observaciones));

        //Crear registro
        try {
            $indicacionesCita = $this->admin->create($indicacionesCita);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function editarIndicacionCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //Get parameter from diagnostico
        $id = $request->request->get('formIndCitId');

        //Objeto
        $indicacionesCita = $this->admin->getObject($id);

        $empleado 		= $request->request->get('formIndCitIdEmpleado');
        $modalidad 		= $request->request->get('formIndCitIdAreaServicioDiagnosticoAplica');
        $indicaciones 		= $request->request->get('formIndCitPreparacionEstudio');
        $recomendaciones 	= $request->request->get('formIndCitRecomendaciones');
        $observaciones 		= $request->request->get('formIndCitObservaciones');

        $em = $this->getDoctrine()->getManager();

        //Empleado
        $empleadoReference 	= $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $indicacionesCita->setIdEmpleadoRegistra($empleadoReference);
        //Modalidad
        $modalidadReference 	= $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $modalidad);
        $indicacionesCita->setIdAreaServicioDiagnosticoAplica($modalidadReference);
        
        $indicacionesCita->setPreparacionEstudio($indicaciones);
        $indicacionesCita->setRecomendaciones($recomendaciones);
        $indicacionesCita->setObservaciones(trim($observaciones));

        //Actualizar registro
        try {
            $indicacionesCita = $this->admin->update($indicacionesCita);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

}