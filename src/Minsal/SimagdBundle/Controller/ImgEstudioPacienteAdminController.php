<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\Metodos\Funciones;
use Doctrine\DBAL as DBAL;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Exception\ModelManagerException;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxEstudioPorImagenesListViewGenerator;

class ImgEstudioPacienteAdminController extends CRUDController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxEstudioPorImagenesListViewGenerator(
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
     * Redirigir inmediatamente hacia la busqueda de paciente
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function listAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('LIST') /*|| false === $this->admin->isGranted('VIEW')*/) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        //Get parameters
        if (!$this->get('request')->query->get('__exp')) {
            $this->get('request')->query->set('__exp', null);
        }

        $id_expRequest      = $this->get('request')->query->get('__exp');
        
        $em = $this->getDoctrine()->getManager();
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $tiposEmpleado      = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $medicos            = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 2, 4))
                                ->getQuery()->getResult();
        
        $tiposEstab         = $em->getRepository('MinsalSiapsBundle:CtlTipoEstablecimiento')->findAll();
        
        $establecimientos   = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->obtenerEstabParaRefDiag('idEstablecimientoDiagnosticante')
                                                        ->getQuery()->getResult();
        
        $expRequest         = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($id_expRequest ? $id_expRequest : '-1');
        
        $collection_tiposEmpleado  = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        $collection_radiologos     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))->getQuery()->getResult();
        $collection_prioridades    = $em->getRepository('MinsalSimagdBundle:ImgCtlPrioridadAtencion')->obtenerPrioridadesAtencionV2();
        $collection_modalidades    = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $collection_examenes       = $em->getRepository('MinsalSiapsBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $collection_proyecciones   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->findAll();
        $collection_sexos          = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();
        
        /*
         * GROUP_DEPENDENT_ENTITIES
         */
        $GROUP_DEPENDENT_ENTITIES   = array();
        try {
            $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->getRadiologicalProceduresGrouped($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        //Objeto
//         $arrayObj = $this->admin->getObject('91');

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'       => $tiposEmpleado,
                        'medicos'           => $medicos,
                        'tiposEstab'        => $tiposEstab,
                        'establecimientos'  => $establecimientos,
                        'default_empLogged' => $sessionUser->getIdEmpleado(),
                        'defaultEstab'      => $estabLocal,
                        'expRequest'        => $expRequest,/*,
                        'arrayObj3' => $arrayObj->getSimpleObjectPropertiesAsArray()*/
                        'collection_tiposEmpleado'  => $collection_tiposEmpleado,
                        'collection_radiologos'     => $collection_radiologos,
                        'collection_default_empLogged'  => $sessionUser->getIdEmpleado(),
                        'collection_prioridades'    => $collection_prioridades,
                        'collection_modalidades'    => $collection_modalidades,
                        'collection_sexos'          => $collection_sexos,
                        'collection_examenes'       => $collection_examenes,
                        'collection_proyecciones'   => $collection_proyecciones,
                        'collection_default_exmRx'  => 27,
                        'collection_default_mldRx'  => 13,
                        'collection_default_prAtn'  => 3,
                        'GROUP_DEPENDENT_ENTITIES'  => $GROUP_DEPENDENT_ENTITIES,
                    ));
    }
    
    /**
     * 
     * @return type
     */
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
        
        $results             = null;
        
        /*
    	 * NUM. de Expediente en búsqueda mínima.
    	 */
        if (is_array($BS_FILTERS_DECODE) && array_key_exists('xparam', $BS_FILTERS_DECODE))
        {
            if (array_key_exists('explocal_numero', $BS_FILTERS_DECODE['xparam']) && !$BS_FILTERS_DECODE['xparam']['explocal_numero']['value'])
            {
                $limiteResultados   = array_key_exists('limitarResultados', $BS_FILTERS_DECODE['xparam']) ?
                        $BS_FILTERS_DECODE['xparam']['limitarResultados']['value'] : 100;

                $estabAlojado       = array_key_exists('establecimientoAlojado', $BS_FILTERS_DECODE['xparam']) ?
                        $BS_FILTERS_DECODE['xparam']['establecimientoAlojado']['value'] : $estabLocal->getId();

                $fechaNacimiento    = array_key_exists('fechaNacimiento', $BS_FILTERS_DECODE['xparam']) ?
                        \DateTime::createFromFormat('Y-m-d', $BS_FILTERS_DECODE['xparam']['fechaNacimiento']['value']) : null;

                $fechaDesde         = array_key_exists('fechaDesde', $BS_FILTERS_DECODE['xparam']) ?
                                            \DateTime::createFromFormat('Y-m-d H:i A', $BS_FILTERS_DECODE['xparam']['fechaDesde']['value']) : null;

                $fechaHasta         = array_key_exists('fechaHasta', $BS_FILTERS_DECODE['xparam']) ?
                                            \DateTime::createFromFormat('Y-m-d H:i A', $BS_FILTERS_DECODE['xparam']['fechaHasta']['value']) : null;

                $criteria = array();

                if ($fechaNacimiento) {
                    $criteria['fechaNacimiento']    = $fechaNacimiento;
                }

                /*
                 * advance search
                 */
                $BS_FILTERS_DECODE['xparam']['explocal_numero']['value']    = null;
                $results = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')
                                                ->data(
                                                                $estabAlojado,
                                                                $fechaDesde,
                                                                $fechaHasta,
                                                                $criteria,
                                                                $limiteResultados,
                                                                $BS_FILTERS_DECODE
                                                        );
        
        
                // var_dump($results);
                // throw new AccessDeniedException();

            }
            else
            {
                /*
                 * minimum search
                 */
                $results = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')
                                                ->data(
                                                        $estabLocal->getId(),
                                                        null,
                                                        null,
                                                        array(),
                                                        100,
                                                        $BS_FILTERS_DECODE
                                                );
        
        
                // var_dump($results);
                // throw new AccessDeniedException();
            }
        }
                       
    	$isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	
    	$isUser_allowDownload   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('download')) ? TRUE : FALSE;
    	
    	$allowSolCmpl           = ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE') ||
                        $securityContext->isGranted('ROLE_ADMIN')) ? TRUE : FALSE;
    	
    	$PACS_SERVER_CONFIGURED = $isUser_allowDownload !== false ?
				      $em->getRepository('MinsalSimagdBundle:ImgCtlPacsEstablecimiento')->getConfiguredServerPACSConnection($estabLocal->getId())
				      : null;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgEstudioPaciente();

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

            $results[$key]['est_fechaEstudio']                   = $r['est_fechaEstudio']->format('Y-m-d H:i:s A');
            
            $results[$key]['prz_fechaAtendido']                  = $r['prz_fechaAtendido'] ? $r['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaRealizado']                 = $r['prz_fechaRealizado'] ? $r['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaProcesado']                 = $r['prz_fechaProcesado'] ? $r['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaAlmacenado']                = $r['prz_fechaAlmacenado'] ? $r['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';
            
            $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion'] ? $r['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta'] ? $r['prc_fechaProximaConsulta']->format('Y-m-d') : '';
            
            $results[$key]['cit_fechaCreacion']              = $r['cit_fechaCreacion'] ? $r['cit_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaConfirmacion']          = $r['cit_fechaConfirmacion'] ? $r['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaReprogramacion']        = $r['cit_fechaReprogramacion'] ? $r['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaHoraInicio']                = $r['cit_fechaHoraInicio'] ? $r['cit_fechaHoraInicio']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaHoraFin']                   = $r['cit_fechaHoraFin'] ? $r['cit_fechaHoraFin']->format('Y-m-d H:i:s A') : '';
            
            $results[$key]['solcmpl_fechaSolicitud']             = $r['solcmpl_fechaSolicitud'] ? $r['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';
            
            $results[$key]['allowShow']                          = $isUser_allowShow;
            
            $results[$key]['allowDownload']                      = $isUser_allowDownload;

            $results[$key]['est_url_weasis'] = $isUser_allowDownload !== false ?
                                                        ($PACS_SERVER_CONFIGURED !== null && $r['est_estudioUid'] !== null ?
                                                                'http://'
                                                                . trim($PACS_SERVER_CONFIGURED->getIp())
                                                                . ':8081/weasis-pacs-connector/viewer.jnlp?studyUID='
                                                                . trim($r['est_estudioUid'])
                                                        : '') : '';
            $results[$key]['est_url_oviyam2']    = $isUser_allowDownload !== false ?
                                                        ($PACS_SERVER_CONFIGURED !== null && $r['est_estudioUid'] !== null ?
                                                                'http://'
                                                                . trim($PACS_SERVER_CONFIGURED->getIp())
                                                                . ':8081/oviyam2/viewer.html?patientID='
                                                                . trim($r['explocal_numero'])
                                                                . '&studyUID='
                                                                . trim($r['est_estudioUid'])
                                                        : '') : '';
            
            $results[$key]['allowSolCmpl']                       = (false !== $allowSolCmpl && !$r['solcmpl_id']) ? TRUE : FALSE;
            
            $results[$key]['solcmpl_createUrl']                  = $this->generateUrl('simagd_solicitud_estudio_complementario_create',
		    array('__prc' => $r['prc_id'], '__est' => $r['est_id']));
		    
	    /** Anexar por radiólogo */
	    $countLct       = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->countEstudioLecturasRealizadas($r['est_id']);
	    $countPndL      = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->countEstudioPendienteLectura($r['est_id']);
	    $countLctEst    = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->countEstudioLecturaEstudio($r['est_id']);
                    
            $results[$key]['allowAnexarPndL']                    = ($countLct['numReg'] === 0 && $countPndL['numReg'] === 0 && $countLctEst['numReg'] === 0 &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
            
            $results[$key]['study_url_diagnosis']    = $results[$key]['allowAnexarPndL'] !== false ?
                                                                $this->generateUrl('simagd_lectura_create', array(
                                                                        '__est' => $r['est_id'],
                                                                        '__xrad' => TRUE,
                                                                        '__xradAnx' => $sessionUser->getIdEmpleado()->getId(),
                                                                        '__estPdr' => $r['estPdr_id'],
                                                                        '__przLct' => TRUE)
                                                                ) : null;
        }
        
        return $this->renderJson($results);
    }
    
    /**
     * 
     * @return type
     */
    public function getPatientsAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $numeroExp          = $this->get('request')->query->get('query');
        
        $em = $this->getDoctrine()->getManager();
        
        $results = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->getPatients($estabLocal->getId(), $numeroExp);

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgEstudioPaciente();

            $results[$key]['pct_edad']   = $r['pct_fechaNacimiento'] ? $r['pct_fechaNacimiento']->diff((new \DateTime('now'))) : null;
        }
        
        return $this->renderJson($results);
    }

}