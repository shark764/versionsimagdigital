<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\ImgPendienteLectura;

use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxEstudioPendienteLecturaListViewGenerator;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class ImgPendienteLecturaAdminController extends Controller
{
    public function leerAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $estudio = $object->getIdEstudio()->getId();

        $em = $this->getDoctrine()->getManager();

        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        $lectura = $em->getRepository('MinsalSimagdBundle:ImgLectura')->findOneBy(array(
                                                    'idEstudio' => $estudio,
                                                    'idEstablecimiento' => $estabLocal));
        if ($lectura) {
            $this->addFlash('sonata_flash_success', 'Lectura registrada para: <br/> <strong>' .
						$lectura->getIdEstudio()->getIdExpediente()->getIdPaciente() . '</strong>');
            return $this->redirect($this->generateUrl('simagd_lectura_edit', array('id' => $lectura->getId())));
        }

        $this->addFlash('sonata_flash_success', 'Lectura no iniciada para estudio imagenológico');
        return $this->redirect($this->generateUrl('simagd_lectura_create', array('__est' => $estudio)));
    }

    public function registrarEnMiListaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $pndL = $this->admin->getObject($id);
        if (!$pndL) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $estudio = $pndL->getIdEstudio()->getId();

        return $this->redirect($this->generateUrl('simagd_lectura_agregarPendiente', array('__est' => $estudio)));
    }

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

        $radiologos         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                    ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                    ->getQuery()->getResult();
        $transcriptores     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                    ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 4, 5))
                                    ->getQuery()->getResult();

        $tipos              = $em->getRepository('MinsalSimagdBundle:ImgCtlTipoNotaDiagnostico')->findAll();
        $estadosDiag        = $em->getRepository('MinsalSimagdBundle:ImgCtlEstadoDiagnostico')->findAll();

        $modalidades        = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->findBy(array('idAtencion' => '97'));

        /** Patrones para diagnóstico */
        $patronesDiag       = $em->getRepository('MinsalSimagdBundle:ImgCtlPatronDiagnostico')
                                    ->obtenerPatronesDiagnosticoUtilizablesV2($estabLocal->getId())
                                    ->getQuery()->getResult();
        /** Fin --- Patrones para diagnóstico */

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'      => $tiposEmpleado,
                        'radiologos'        => $radiologos,
                        'tiposNota'         => $tipos,
                        'default_empLogged'        => $sessionUser->getIdEmpleado(),
                        'tipoNotaDefault'   => 1,
                        'transcriptores'    => $transcriptores,
                        'estadosDiag'       => $estadosDiag,
                        'estadoDiagDefault' => 2,
                        'modalidades'       => $modalidades,
			'patronesDiag'      => $patronesDiag,
                    ));
    }

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS                 = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE          = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em                         = $this->getDoctrine()->getManager();

    	$securityContext            = $this->container->get('security.context');
    	$sessionUser               = $securityContext->getToken()->getUser();
        $estabLocal                 = $sessionUser->getIdEstablecimiento();

        $results                 = $em->getRepository('MinsalSimagdBundle:ImgLectura')->obtenerPendientesLecturaV2($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowInterpretar    = ($this->admin->getRoutes()->has('leer') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $isUser_allowRegInicial     = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgPendienteLectura();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            // '<div class="container">' .
                            // '<div class=" col-lg-12 col-md-12 col-sm-12">' .
                                '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                                '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ORIGEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['origen'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROCEDENCIA:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['area_atencion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['atencion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['medico'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['triage'] . '</div></div>' .
                                // '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>RADIÓLOGO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['radiologo'] . '</div></div>' .
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

            $results[$key]['pndL_fechaIngresoLista']             = $r['pndL_fechaIngresoLista']->format('Y-m-d H:i:s A');
            $results[$key]['est_fechaEstudio']                   = $r['est_fechaEstudio']->format('Y-m-d H:i:s A');

            $results[$key]['prz_fechaAtendido']                  = $r['prz_fechaAtendido'] ? $r['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaRealizado']                 = $r['prz_fechaRealizado'] ? $r['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaProcesado']                 = $r['prz_fechaProcesado'] ? $r['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaAlmacenado']                = $r['prz_fechaAlmacenado'] ? $r['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';

            $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion'] ? $r['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['solcmpl_fechaSolicitud']             = $r['solcmpl_fechaSolicitud'] ? $r['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';

            $results[$key]['lct_createUrl']                      = $r['lctPdr_id'] ?
                                                                            $this->generateUrl('simagd_lectura_edit',
                                                                                array('id' => $r['lctPdr_id'],
                                                                                      '__est' => $r['est_id'],
                                                                                      '__estPdr' => $r['estPdr_id']
                                                                                )) :
                                                                            $this->generateUrl('simagd_lectura_create',
                                                                                array('__est' => $r['est_id'],
                                                                                      '__xrad' => $r['pndL_anexadoPorRadiologo'] ? TRUE : NULL,
                                                                                      '__xradAnx' => $r['pndL_id_radiologoAnexa'],
                                                                                      '__estPdr' => $r['estPdr_id']
                                                                            ));

            $results[$key]['allowInterpretar']                   = $isUser_allowInterpretar;

            $results[$key]['allowRegInicial']                    = $isUser_allowRegInicial;
        }

        $response = new Response();
        $response->setContent(json_encode($results));
        return $response;
    }

    public function addToUndiagnosedStudiesListAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //Get parameter from estudio
        $estudio        = $request->request->get('__est');
        $this->get('request')->request->set('__est', $estudio ? $estudio : NULL);

        //Get parameter from estudio padre (en caso de ser complementario)
        $estudioPdr     = $request->request->get('__estPdr');
        $this->get('request')->request->set('__estPdr', $estudioPdr ? $estudioPdr : NULL);

        $this->get('request')->request->set('__xrad', TRUE);

        //Nueva instancia
        $pndLectura     = $this->admin->getNewInstance();

        //Crear registro
        try {
            /*$pndLectura = */$this->admin->create($pndLectura);
        } catch (Exception $e) {
            $status     = 'failed';
        }

        $response       = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function addToWorkListAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status     = 'OK';

        /*
         * request
         */
        $id_radX    = $request->request->get('__radx');
        $pndL_rows  = $request->request->get('__ar_rowsAffected');

        $em         = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //    $start      = $request->request->get('start');
        //    $end        = $request->request->get('end');
        //
        //    $cita->setFechaHoraInicio(\DateTime::createFromFormat('Y-m-d H:i', $start));

        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:ImgPendienteLectura')
                        ->addToWorkList($estabLocal->getId(), $id_radX, $sessionUser->getIdEmpleado()->getId(), $pndL_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response   = new Response();
        $response->setContent(json_encode(array('update' => $status)));
        return $response;
    }

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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxEstudioPendienteLecturaListViewGenerator(
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

}