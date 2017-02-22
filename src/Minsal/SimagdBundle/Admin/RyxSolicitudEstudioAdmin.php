<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Minsal\SeguimientoBundle\Entity\SecHistorialClinico;
use Minsal\SeguimientoBundle\Entity\SecMotivoConsulta;
use Minsal\SeguimientoBundle\Entity\SecSignosVitales;
use Minsal\SeguimientoBundle\Entity\SecSolicitudestudios;
use Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios;

class RyxSolicitudEstudioAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_solicitud_estudio';
    protected $baseRoutePattern = 'rayos-x-solicitud-estudio';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        $collection->add('citar');
        $collection->add('requiereCita', null, [], [], ['expose' => true]);
        $collection->add('solicitarDiag');
        $collection->add('valorCampoCompuesto', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('extractCamposComponentes', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('cargarDatosPorFiltro', null, [], [], ['expose' => true]);
        // $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        // $collection->remove('delete');
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('cambiarPrioridadAtencionSolicitud', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('obtenerPrioridadesAtencion', null, [], [], ['expose' => true]);
        $collection->add('agregarIndicacionesRadiologo', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('pendingPatients', null, [], [], ['expose' => true]);
        $collection->add('crearSolicitudEstudioFormatoRapido', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarSolicitudEstudioFormatoRapido', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');

        $sessionUser = $securityContext->getToken()->getUser();

        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();

        $codigoTipo = $sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo();

        $aamsEstabCreate= $subject->getIdAtenAreaModEstab();

        $formMapper
            // ->tab('Servicio', array('class' => 'tab-servicio-rx', 'tab_icon' => 'glyphicon glyphicon-user'))
                ->with('Servicio clínico que atiende al paciente', array('class' => 'prc-with-servicio-datos-generales col-md-12', 'description' => ''))->end()
            // ->end()
        ;

        $showFullForm = ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE') || $securityContext->isGranted('ROLE_ADMIN') ||
			($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') && $codigoTipo == 'CIT' &&
					($aamsEstabCreate && $estabLocal == $aamsEstabCreate->getIdEstablecimiento()->getId())) ) ? true : false;

        if ($showFullForm ) {
            $formMapper
            	// ->tab('Servicio')
                    ->with('Datos actuales tomados al paciente', array('class' => 'prc-with-servicio-paciente col-md-12', 'description' => ''))->end()
            	// ->end()
            	// ->tab('Detalles clínicos', array('class' => 'tab-datos-clinicos-rx', 'tab_icon' => 'glyphicon glyphicon-inbox'))
                    ->with('Datos reglamentarios de la solicitud', array('class' => 'prc-with-datos-clinicos-reglamentarios col-md-12', 'description' => ''))->end()
                    ->with('Detalles complementarios e información de contacto', array('class' => 'prc-with-datos-clinicos-detalles-adicionales col-md-12', 'description' => ''))->end()
            	// ->end()
            	// ->tab('Traslado de paciente', array('class' => 'tab-traslado-rx', 'tab_icon' => 'glyphicon glyphicon-home'))
                    ->with('Transferencia del paciente', array('class' => 'prc-with-traslado-referir-paciente col-md-12', 'description' => ''))->end()
                    ->with('Proyecciones del estudio solicitado', array('class' => 'prc-with-traslado-estudio-solicitado col-md-12', 'description' => ''))->end()
                    ->with('Anexar solicitud de diagnóstico radiológico', array('class' => 'prc-with-traslado-solicitar-diagnostico col-md-12', 'description' => ''))->end()
            	// ->end()
            ;
        }

        $setLockDatosGenerales = $setLockDatosPaciente = $setLockRefPaciente = $setLockSolDiagnostico = $setLockExplSolicitadas = false;

        if ($this->id($subject)) {

            $setLockDatosGenerales = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                        ->existeRegistroPorPreinscripcion($subject->getId(), 'cit', 'ImgCita');

            $setLockDatosPaciente = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                        ->existeRegistroPorPreinscripcion($subject->getId(), 'prz', 'ImgProcedimientoRealizado');

            $setLockRefPaciente = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                        ->bloquearTrasladoPaciente($subject->getId());

            $setLockSolDiagnostico = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')
                                                        ->bloquearSolDiagnostico($subject->getId());

            $setLockExplSolicitadas = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                        ->bloquearEstudioSolicitado($subject->getId());

        }

        $hclHidden = $this->getRequest()->get('__hcl', null);

        if ($showFullForm ) {
            $formMapper
                // ->tab('Servicio')
                    ->with('Servicio clínico que atiende al paciente')
                        ->add('idAtenAreaModEstab', 'sonata_type_model_hidden')/**/
                        ->add('idHistorialClinico', 'hidden', array(
                                                        'mapped' => false,
                                                        'data' => $hclHidden
                        ))
                        ->add('idAreaAtencion', 'entity', array(//SI EXISTE HISTORIAL CLINICO, DISABLE ALL OPTIONS, EXCEPT 'aams' EN SELECTS2
                                                        'label' => 'Procedencia',//http://ivaynberg.github.io/select2/
                                                        'required' => false,
                                                        'mapped' => false,
                                                        'class' => 'MinsalSiapsBundle:CtlAreaAtencion',
//                                                         'property' => 'nombre',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->createQueryBuilder('ar')
                                                                                            ->innerJoin('MinsalSiapsBundle:MntAreaModEstab', 'ams',
                                                                                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                                                                                    'ar.id = ams.idAreaAtencion')
                                                                                            ->where('ams.idEstablecimiento = :id_est')
                                                                                            ->setParameter('id_est', $estabLocal)
                                                                                            ->orderBy('ar.nombre')
                                                                                            ->distinct();
//                                                                                return $er->obtenerAreasAtencionParaPreinscribir($estabLocal);
                                                                            },
                                                        'empty_value' => '',
//                                                        'help' => 'Area de atención de la que procede',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                        ))
                        ->add('idAtencion', 'entity', array(//QUIZA FILTRADOS QUE AL MENOS TENGAN UN 'AAMS' CON ESTAB_LOCAL
                                                        'label' => 'Servicio clínico',
                                                        'required' => false, //PONER TODOS LOS QUE DEBEN SER TRUE/FALSE **************************
                                                        'mapped' => false,
                                                        'class' => 'MinsalSiapsBundle:CtlAtencion',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->createQueryBuilder('atn')
                                                                                            ->innerJoin('MinsalSiapsBundle:MntAtenAreaModEstab', 'aams',
                                                                                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                                                                                    'atn.id = aams.idAtencion')
                                                                                            ->where('aams.idEstablecimiento = :id_est')
                                                                                            ->setParameter('id_est', $estabLocal)
                                                                                            ->orderBy('atn.nombre')
                                                                                            ->distinct();
//                                                                                return $er->obtenerAtencionesParaPreinscribir($estabLocal);
                                                                            },
                                                        'group_by' => 'idTipoAtencion',
//                                                         'property' => 'nombre',
                                                        'empty_value' => '', //REVISAR TODOS LOS ADMIN PARA QUE QUEDEN BIEN LOS REQUIRED, SIZE, ETC
//                                                        'help' => 'Servicio de atención clínica que refiere',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                        ))
//                        ->add('idAreaModEstab', 'entity', array(
//                                                        'label' => 'Procedencia',
//                                                        'required' => false,
//                                                        'mapped' => false,
//                                                        'class' => 'MinsalSiapsBundle:MntAreaModEstab',
//                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
//                                                                                return $er->createQueryBuilder('ams')
//                                                                                            ->where('ams.idEstablecimiento = :id_est')
//                                                                                            ->setParameter('id_est', $estabLocal)
//                                                                                            ->orderBy('ams.idAreaAtencion', 'asc')
//                                                                                            ->addOrderBy('ams.idModalidadEstab', 'asc')
//                                                                                            ->distinct();
//                                                                            },
//                                                        'group_by' => 'idModalidadEstab',
//                                                        'empty_value' => '',
//                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
//									'data-fv-notempty' => 'true',
//									'data-fv-notempty-message' => 'Seleccione un elemento',
//							)
//                        ))
//                        ->add('idAtenAreaModEstab', null, array(
//                                                        'label' => 'Servicio clínico',
//                                                        'required' => true,
//                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
//                                                                                return $er->createQueryBuilder('aams')
//                                                                                            ->where('aams.idEstablecimiento = :id_est')
//                                                                                            ->setParameter('id_est', $estabLocal)
//                                                                                            ->orderBy('aams.idAreaModEstab', 'asc')
//                                                                                            ->addOrderBy('aams.idAtencion', 'asc')
//                                                                                            ->distinct();
//                                                                            },
//                                                        'group_by' => 'idAtencion.idTipoAtencion',
//                                                        'empty_value' => '',
//							'property' => 'nombreConsulta',
//                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
//									'data-fv-notempty' => 'true',
//									'data-fv-notempty-message' => 'Seleccione un elemento',
//							)
//                        ))
                        ->add('idEmpleado', null, array(//QUIZA FILTRADOS QUE TENGAN UN 'EES' CON 'AAMS' CON ESTAB_LOCAL
                                                        'label' => 'Solicita',
                                                        'required' => true,
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosPorTipoOperaciones($estabLocal, array(1, 2, 4));
                                                                            },
                                                        'group_by' => 'idTipoEmpleado',
                                                        'empty_value' => '',                                    //ATENCIONES PUEDEN ESTAR EN 2 AREAS, PERO EL EMPLEADO NO
//                                                        'help' => 'Médico que preinscribe',                     //ACTIVAR CAMBIAR EMPLEADO AL ON CHANGE DE AREA TAMBIEN
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'user',
									'data-apply-formatter-mode' => $setLockDatosPaciente ? 'disabled' : 'enabled',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                        ))
                        ->add('fechaProximaConsulta', 'datetime', array(
                                                        'label' => 'Próxima consulta',
//                                                        'help' => 'Formato: << yyyy-MM-dd >>',
                                                        'widget' => 'single_text',
                                                        'format' => 'yyyy-MM-dd',
                                                        'attr' => array('readonly' => 'readonly',
                                                                        'placeholder' => 'YYYY-MM-DD',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Este campo es requerido',

									'data-fv-date' => 'true',
									'data-fv-date-format' => 'YYYY-MM-DD',
									'data-fv-date-message' => 'Fecha no válida',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Fecha no permitida',
									'data-fv-callback-callback' => 'checkValidFechaProximaConsulta',
							)
                        ))
                        ->add('idPrioridadAtencion', null, array(
                                                        'label' => 'Prioridad requerida',
                                                        'required' => false,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerPrioridadesAtencionV2('query');
                                                                            },
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'prAtn',
							)
                        ))
                    // ->end()
                    // ->with('Datos actuales tomados al paciente')
                        ->add('idExpediente', 'sonata_type_model_hidden')
    //                    ->add('idExpediente', null, array( // *********************** CONSULTAR PACIENTES CON EXPEDIENTE EN ESTE ESTABLECIMIENTO, SINO PUEDEN APARECER REPETIDOS
    //                                                    'label' => 'Paciente',     //  ************** EXPEDIENTE -> ESTABLECIMIENTO, SOLO PACIENTES Q ESTEN REGISTRADOS AQUI
    //                                                    'required' => true,
    //                                                    'empty_value' => '',
    //                                                    'query_builder' => function(EntityRepository $er) use ($estabLocal) {
    //                                                                            return $er->obtenerExpedientesParaPreinscribir($estabLocal);
    //                                                                        },
    //                                                    'attr' => array('style' => 'min-width: 100%; max-width: 100%;') //PARA HACER MAS PEQUEÑOS LOS SELECT
    //                    ))
                        ->add('pacienteAmbulatorio', null, array('label' => 'Es ambulatorio'))
                        ->add('numeroSala', null, array(
                                                        'label' => 'Sala',
                                                        'attr' => array('min' => '0',
                                                                        'max' => '32767',
                                                                        'placeholder' => 'N° de sala',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-question-sign',

									'data-fv-integer' => 'true',
									'data-fv-integer-message' => 'El valor no es un entero',

									'data-fv-greaterthan-inclusive' => 'true',
									'data-fv-greaterthan-value' => '0',
									'data-fv-greaterthan-message' => 'Debe ser mayor o igual a 0',

									'data-fv-lessthan-inclusive' => 'true',
									'data-fv-lessthan-value' => '32767',
									'data-fv-lessthan-message' => 'Debe ser menor o igual a 32767',
							)
                        ))
                        ->add('numeroCama', null, array(
                                                        'label' => 'Cama',
                                                        'attr' => array('min' => '0',
                                                                        'max' => '32767',
                                                                        'placeholder' => 'N° de cama',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-question-sign',

									'data-fv-integer' => 'true',
									'data-fv-integer-message' => 'El valor no es un entero',

									'data-fv-greaterthan-inclusive' => 'true',
									'data-fv-greaterthan-value' => '0',
									'data-fv-greaterthan-message' => 'Debe ser mayor o igual a 0',

									'data-fv-lessthan-inclusive' => 'true',
									'data-fv-lessthan-value' => '32767',
									'data-fv-lessthan-message' => 'Debe ser menor o igual a 32767',
							)
                        ))
                        ->add('pacienteDesconocido', null, array('label' => 'Es desconocido'))
                        ->add('pesoActualKg', null, array(
                                                        'label' => 'Peso actual (kg)',
                                                        'attr' => array('placeholder' => 'Peso en kg.',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

									'data-fv-numeric' => 'true',
									'data-fv-numeric-message' => 'El valor no es un número válido',
									'data-fv-numeric-thousandsSeparator' => '',
									'data-fv-numeric-decimalSeparator' => '.',

									'min' => '2.27',
                                                                        'max' => '226.80',
									'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
							)
                        ))
                        ->add('pesoActualLb', null, array(
                                                        'label' => 'Peso actual (lb)',
                                                        'attr' => array('placeholder' => 'Peso en lb.',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

									'data-fv-numeric' => 'true',
									'data-fv-numeric-message' => 'El valor no es un número válido',
									'data-fv-numeric-thousandsSeparator' => '',
									'data-fv-numeric-decimalSeparator' => '.',

									'min' => '5',
                                                                        'max' => '500',
									'data-fv-between-message' => 'Peso en lb debe ser entre 5lb y 500lb',
							)
                        ))
                        ->add('tallaPaciente', null, array(
                                                        'label' => 'Talla actual (m)',
                                                        'attr' => array('placeholder' => 'Talla en m.',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

									'data-fv-numeric' => 'true',
									'data-fv-numeric-message' => 'El valor no es un número válido',
									'data-fv-numeric-thousandsSeparator' => '',
									'data-fv-numeric-decimalSeparator' => '.',

									'min' => '0.20',
                                                                        'max' => '3',
									'data-fv-between-message' => 'Talla en m debe ser entre 20cm (0.20m) y 3m',
							)
                        ))
                        ->add('setLockDatosPaciente', 'hidden', array(
                                                        'mapped' => false,
                                                        'data' => $setLockDatosPaciente
                        ))
                    ->end()
                // ->end()
                // ->tab('Detalles clínicos')
                    ->with('Datos reglamentarios de la solicitud')
                        ->add('datosClinicos', 'textarea', array(
                                                        'label' => 'Datos clínicos',
                                                        'required' => true,
//                                                        'help' => '150 carácteres hábiles',
                                                        'attr' => array('rows' => '1',
    //                                                                    'style' => 'resize:none', //ESTO DEBERIA IR EN CSS
                                                                        'style' => 'min-width: 100%; max-width: 100%; resize:none;', //PARA HACER MAS PEQUEÑOS LOS INPUT, REVISAR
                                                                        'maxlength' => '150',
                                                                        'placeholder' => 'Escriba los datos clínicos',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Este campo es requerido',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '150',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('hipotesisDiagnostica', 'textarea', array(
                                                        'label' => 'Hipótesis diagnóstica del médico',
                                                        'required' => true,
//                                                        'help' => '100 carácteres hábiles',
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '100',
                                                                        'placeholder' => 'Escriba la hipótesis diagóstica del paciente',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Este campo es requerido',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '10',
									'data-fv-stringlength-max' => '100',
									'data-fv-stringlength-message' => '10 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('investigando', 'textarea', array(
                                                        'label' => 'Investigando',
                                                        'required' => true,
//                                                        'help' => '150 carácteres hábiles',
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '150',
                                                                        'placeholder' => 'Escriba que desea investigar con el estudio',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Este campo es requerido',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '150',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('justificacionMedica', 'textarea', array(
                                                        'label' => 'Justificación médica de la solicitud',
                                                        'required' => true,
//                                                        'help' => '150 carácteres hábiles',
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '150',
                                                                        'placeholder' => 'Escriba la justificación médica de la solicitud',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Este campo es requerido',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '150',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                    ->end()
                    ->with('Detalles complementarios e información de contacto')
                        ->add('consultaPor', 'textarea', array(
                                                        'label' => 'Consulta por',
//                                                        'help' => '255 carácteres hábiles',
                                                        'required' => false,
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Escriba el motivo de consulta',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '10',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '10 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('estadoClinico', null, array(
                                                        'label' => 'Estado clínico del paciente',
                                                        'attr' => array('maxlength' => '50',
                                                                        'placeholder' => 'Estado de salud en que se encuentra el paciente',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '5',
									'data-fv-stringlength-max' => '50',
									'data-fv-stringlength-message' => '5 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('antecedentesClinicosRelevantes', 'textarea', array(
                                                        'label' => 'Antecedentes clínicos relevantes',
                                                        'required' => false,
                                                        'attr' => array('rows' => '3',
                                                                        'style' => 'resize:none',
//                                                                         'placeholder' => 'Escriba antecedentes clínicos relevantes del paciente',
									'class' => 'summernote',

									/*'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '10',
									'data-fv-stringlength-message' => '10 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',*/
							)
                        ))
                        ->add('idContactoPaciente', null, array(
                                                        'label' => 'En caso de emergencia, contactar a',
    //                                                        'help' => 'Referir a servicio local, o hacia otro establecimiento',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                        ))
                        ->add('nombreContacto', null, array(
                                                        'label' => 'Nombre del Contacto',
                                                        'attr' => array('maxlength' => '75',
                                                                        'placeholder' => 'Contactar a esta persona',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '75',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ,\.\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('idFormaContacto', null, array(
                                                        'label' => 'Forma de contacto',
    //                                                        'help' => 'Referir a servicio local, o hacia otro establecimiento',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                        ))
                        ->add('contacto', null, array(
                                                        'label' => 'Dato de Contacto',
                                                        'attr' => array('maxlength' => '75',
                                                                        'placeholder' => 'Contactar paciente usando este dato',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-phone-alt',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '5',
									'data-fv-stringlength-max' => '75',
									'data-fv-stringlength-message' => '5 caracteres mínimo',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Dato introducido no es válido',
									'data-fv-callback-callback' => 'checkValidInfoContacto',
							)
                        ))
                    ->end()
                // ->end()
                // ->tab('Traslado de paciente')
                    ->with('Transferencia del paciente') //SI SE MARCA, HABILITAR EL SELECT, SI DESMARCA, DESHABILITAR Y COLOCAR EL ESTABLECIMIENTO DE NUEVO AL PREDEFINIDO = SERVICIO LOCAL
                        ->add('referirPaciente', null, array('label' => 'Referir a externo'))
                        ->add('idEstablecimientoReferido', null, array(//FILTRADOS QUE EXISTA AL MENOS UN 'MR' HABILITADO=TRUE
                                                        'label' => 'Referir paciente hacia',
                                                        'required' => true,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er ) {
                                                                                return $er->obtenerEstabParaRefDiag('idEstablecimientoReferido');
                                                                            },
                                                        'group_by' => 'idTipoEstablecimiento',
//                                                        'help' => 'Referir a servicio local, o hacia otro establecimiento',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'std',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Elemento no es válido, por favor cámbielo',
									'data-fv-callback-callback' => 'checkValidReferido',
							)
                        ))
                        ->add('justificacionReferencia', 'textarea', array(
                                                        'label' => 'Justifique la referencia',
//                                                        'help' => '255 carácteres hábiles',
                                                        'required' => false,
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Justifique por qué se necesita referir al paciente (No llene este campo si refiere a servicio local de diagnóstico por imagen)',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('setLockRefPaciente', 'hidden', array(
                                                        'mapped' => false,
                                                        'data' => $setLockRefPaciente
                        ))
                    ->end()
                    ->with('Proyecciones del estudio solicitado') //CONSULTAR LAS QUE SEAN PARA SEXO DEL PACIENTE O NULL = AMBOS
                        ->add('idAreaServicioDiagnostico', null, array(//SI ESTAS QUEDAN CON EL LOCAL, OCURRIRÁ EL ERROR DE UNA MODALIDAD QUE NO EXISTAN EN LOCAL, "ESTE VALOR NO ES VALIDO"
                                                        'label' => 'Modalidad de diagnóstico por imagen',//MEJOR SOLO FILTRARLAS POR '97'
                                                        'required' => true,
    //                                                    'class' => 'MinsalSimagdBundle:CtlAreaServicioDiagnostico',   //ESTAS DEBEN SER CON EL REFERIDO POR DEFECTO
//                                                         'property' => 'nombrearea',                             //MISMO TRUCO DE FILTRARLAS EN CLIENTE CON EL Q ESTE DE REFERIDO
                                                        'query_builder' => function(EntityRepository $er ) {
                                                                                return $er->obtenerModalidadesParaPreinscribir('97');
                                                                            },
                                                        'group_by' => 'idAtencion',
                                                        'empty_value' => '', //REVISAR SI ES NECESARIO Q SEA REQUIRED TRUE
//                                                        'help' => 'Realizables en el establecimiento al que refiere',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
									'data-apply-formatter' => 'mld',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Debe seleccionar al menos una proyección',
									'data-fv-callback-callback' => 'checkProyeccionesModalidad',
							)
                        ))
//                        ->add('solicitudEstudioProyeccion', 'sonata_type_collection', array(
//                                                        'label' =>'Proyecciones requeridas'),
////                                                        'help' => 'Seleccione las proyecciones de la modalidad que preinscribe'),// 'cascade_validation' => true,),
//                                                        array('edit' => 'inline', 'inline' => 'table'))
                        ->add('solicitudEstudioProyeccion', 'entity', array(
                                                        'label' => 'Proyecciones requeridas',
                                                        'required' => false,
                                                        'empty_value' => '',
                                                        'expanded' => false,
                                                        'multiple' => true,
                                                        'class' => 'MinsalSimagdBundle:ImgCtlProyeccion',
                                                        'group_by' => 'idExamenServicioDiagnostico',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                            return $er->createQueryBuilder('expl')
                                                                                        ->orderBy('expl.idExamenServicioDiagnostico')
                                                                                        ->addOrderBy('expl.codigo')
                                                                                        ->addOrderBy('expl.nombre')
                                                                                        ->distinct();
                                                        },
                                                        'help' => 'Puede agregar varias proyecciones',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'pry',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Este campo es requerido',
							)
                        ))
                        ->add('setLockExplSolicitadas', 'hidden', array(
                                                        'mapped' => false,
                                                        'data' => $setLockExplSolicitadas
                        ))
                    ->end()
                    ->with('Anexar solicitud de diagnóstico radiológico')
                        ->add('requiereDiagnostico', null, array('label' => 'Estudio requiere diagnóstico radiológico'))
                        ->add('idEstablecimientoDiagnosticante', null, array(//QUIZA FILTRADOS QUE TENGAN UN 'MR' CON LCT=TRUE
                                                        'label' => 'Se solicita se diagnostique en',
                                                        'query_builder' => function(EntityRepository $er ) {
                                                                                return $er->obtenerEstabParaRefDiag('idEstablecimientoDiagnosticante');
                                                                            },
                                                        'group_by' => 'idTipoEstablecimiento',
//                                                        'help' => 'Si no marca diagnóstico este campo no se utilizará',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'std',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Elemento no es válido, por favor cámbielo',
									'data-fv-callback-callback' => 'checkValidDiagnosticante',
							)
                        ))
                        ->add('justificacionDiagnostico', 'textarea', array(
                                                        'label' => 'Justifique por qué requiere diagnóstico radiológico',
//                                                        'help' => '255 carácteres hábiles',
                                                        'required' => false,
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Requerido si solicita diagnóstico, caso contrario deje vacío este campo',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                        ))
                        ->add('setLockSolDiagnostico', 'hidden', array(
                                                        'mapped' => false,
                                                        'data' => $setLockSolDiagnostico
                        ))
                        // ->add('solicitudEstudioMamografia')
			// ->add('solicitudEstudioMamografia', 'sonata_type_collection', array(
   //                                      'label' =>'Detalle de Solicitud de Estudio de Mamografía',
   //                                      'label_attr' => array('class' => 'label_form_sm'),
   //                                      'help' => 'Favor sírvase de completar este formulario para que el estudio que solicita se realice con éxito'
   //                                      // 'cascade_validation' => true,),
   //              ), array('edit' => 'inline'/*, 'inline' => 'table'*/))
                    ->end()
                // ->end()
            ;
        }

        $estabRef = $subject->getIdEstablecimientoReferido();

        if ( ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_EDIT')
                && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT') && $codigoTipo == 'CIT' &&
                    ($estabRef && $estabLocal == $estabRef->getId())) || $securityContext->isGranted('ROLE_ADMIN') ) {
            $formMapper
                // ->tab('Servicio')
                    ->with('Servicio clínico que atiende al paciente')
                        ->add('requiereCita', null, array('label' => 'Requiere cita en Servicio de Imagenología'))
                        ->add('setLockDatosGenerales', 'hidden', array(
                                                        'mapped' => false,
                                                        'data' => $setLockDatosGenerales
                        ))
                    ->end()
                // ->end()
            ;
        }

        /*
         * Indicaciones por radiólogo
         */
        if ( ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') ||
	      $securityContext->isGranted('ROLE_ADMIN')) && ($estabRef && $estabLocal == $estabRef->getId()) ) {
            $formMapper
                // ->tab('Servicio')
                    ->with('Datos actuales tomados al paciente')
                        ->add('idRadiologoAgregaIndicaciones', null, array(
                                                        'label' => 'Médico radiólogo',
                                                        'required' => false,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(4, 5));
                                                                            },
                                                        'group_by' => 'idTipoEmpleado',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'user',

									/*'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',*/
							)
                        ))
			->add('indicacionesMedicoRadiologo', 'textarea', array(
							'label' => 'Indicaciones del Médico radiólogo para el estudio',
							'required' => false,
							'attr' => array('rows' => '3',
									'style' => 'resize:none',
	//                                                                         'placeholder' => 'Escriba antecedentes clínicos relevantes del paciente',
									'class' => 'summernote',

									/*'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '10',
									'data-fv-stringlength-message' => '10 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',*/
							)
			))
                    ->end()
                // ->end()
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
//            ->with('Formulario de Solicitud de Estudio')->end()
            ->with('Servicio clínico que atiende al paciente')
                ->add('id')
                ->add('idEmpleado', null, array('label' => 'Preinscribió', 'route' => array('name' => 'show')))
                ->add('idUserReg.idEmpleado', null, array('label' => 'Usuario que registró', 'route' => array('name' => 'show')))
                ->add('idUserMod.idEmpleado', null, array('label' => 'Último usuario que editó', 'route' => array('name' => 'show')))
                ->add('idAtenAreaModEstab.idAreaModEstab.idAreaAtencion', null, array('label' => 'Procedencia', 'route' => array('name' => 'show')))
                ->add('idAtenAreaModEstab.idAtencion', null, array('label' => 'Servicio clínico', 'route' => array('name' => 'show')))
                ->add('idAtenAreaModEstab.idEstablecimiento', null, array('label' => 'Creada en', 'route' => array('name' => 'show')))
                ->add('fechaCreacion', null, array('label' => 'Registrada', 'pattern' => 'EEEE d \'de\' MMMM, yyyy h:mm:ss a',))
            ->end()
            ->with('Paciente preinscrito')
                ->add('idExpediente.idPaciente', null, array('label' => 'Paciente', 'route' => array('name' => 'show')))
                ->add('pacienteAmbulatorio', null, array('label' => 'Paciente Ambulatorio'))
                ->add('numeroSala', null, array('label' => 'Sala'))
                ->add('numeroCama', null, array('label' => 'Cama'))
                ->add('pacienteDesconocido', null, array('label' => 'Paciente desconocido'))
                ->add('pesoActualLb', null, array('label' => 'Peso actual en libras'))
                ->add('pesoActualKg', null, array('label' => 'Peso actual en kilogramos'))
                ->add('tallaPaciente', null, array('label' => 'Talla actual'))
            ->end()
            ->with('Información de Contacto')
                ->add('idContactoPaciente', null, array('label' => 'En caso de emergencia, contactar a'))
                ->add('nombreContacto', null, array('label' => 'Nombre del Contacto'))
                ->add('idFormaContacto', null, array('label' => 'Forma de contacto'))
                ->add('contacto', null, array('label' => 'Dato de Contacto'))
            ->end()
            ->with('Detalles clínicos')
                ->add('datosClinicos', null, array('label' => 'Datos clínicos'))
                ->add('consultaPor', null, array('label' => 'Consulta por'))
                ->add('estadoClinico', null, array('label' => 'Estado clínico'))
                ->add('hipotesisDiagnostica', null, array('label' => 'Hipótesis diagnóstica'))
                ->add('investigando', null, array('label' => 'Investigar'))
                ->add('antecedentesClinicosRelevantes', null, array('label' => 'Antecedentes clínicos relevantes'))
                ->add('justificacionMedica', null, array('label' => 'Justificación médica'))
            ->end()
            ->with('Referir al paciente')
                ->add('referirPaciente', null, array('label' => 'Referido a externo'))
                ->add('idEstablecimientoReferido', null, array('label' => 'Paciente referido hacia', 'route' => array('name' => 'show')))
                ->add('justificacionReferencia', null, array('label' => 'Justificación de referencia'))
            ->end()
            ->with('Proyecciones Solicitadas')
                ->add('idAreaServicioDiagnostico', null, array('label' => 'Modalidad de diagnóstico por imagen', 'route' => array('name' => 'show')))
                ->add('solicitudEstudioProyeccion', 'sonata_type_collection', array('label' => 'Proyección', 'route' => array('name' => 'show'),
                                                                                'template' => 'MinsalSimagdBundle:RyxSolicitudEstudioAdmin:prc_explSol_show.html.twig'
                                                                            ),
                                                                            array('edit' => 'inline', 'inline' => 'table'))
            ->end()
            ->with('Solicitud de diagnóstico')
                ->add('requiereDiagnostico', null, array('label' => 'Estudio requiere diagnóstico radiológico'))
                ->add('idEstablecimientoDiagnosticante', null, array('label' => 'Diagnóstico solicitado en', 'route' => array('name' => 'show')))
                ->add('justificacionDiagnostico', null, array('label' => 'Justificación de diagnóstico'))
            ->end()
            ->with('Otros detalles')
                ->add('fechaProximaConsulta', null, array('label' => 'Próxima consulta', 'pattern' => 'EEEE d \'de\' MMMM, yyyy',))
                ->add('requiereCita', null, array('label' => 'Se dará cita de Imagenología'))
            ->end()
        ;
    }

    public function prePersist($preinscripcion)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $preinscripcion->setIdUserReg($sessionUser);
        $preinscripcion->setFechaCreacion(new \DateTime('now'));

//        if ($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() != 'CIT') {
//	    foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
//		$solicitudEstudioProyeccion->setIdSolicitudEstudio($preinscripcion);
//	    }
//        }

        if (!$preinscripcion->getIdPrioridadAtencion()) {
	    $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion');
	    $prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', '4');
	    $preinscripcion->setIdPrioridadAtencion($prioridadReference);
        }
    }

    public function preUpdate($preinscripcion)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $preinscripcion->setIdUserMod($sessionUser);

//        if ($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() != 'CIT') {
//	    foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
//		$solicitudEstudioProyeccion->setIdSolicitudEstudio($preinscripcion);
//	    }
//// 	    $preinscripcion->setSolicitudEstudioProyeccion($preinscripcion->getSolicitudEstudioProyeccion());
//        }

        if (!$preinscripcion->getIdPrioridadAtencion()) {
	    $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion');
	    $prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', '4');
	    $preinscripcion->setIdPrioridadAtencion($prioridadReference);
        }

    }

    public function validate(ErrorElement $errorElement, $preinscripcion)
    {
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');

        $sessionUser = $securityContext->getToken()->getUser();

        if ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE') || $securityContext->isGranted('ROLE_ADMIN') ) {

            $errorElement
                ->with('idAreaServicioDiagnostico') //Modalidad --> AreaServicioApoyo
                    ->assertNotBlank(array('message' => '¿Qué modalidad desea preinscribir?'))
                ->end()
                ->with('idExpediente') //Expediente
                    ->assertNotBlank(array('message' => 'No ha seleccionado el paciente que se referirá'))
                ->end()
                ->with('idEmpleado') //Preinscriptor del estudio
                    ->assertNotNull(array('message' => 'No ha seleccionado preinscriptor'))
                    ->assertNotBlank(array('message' => '¿Quién es el médico que solicita el estudio imagenológico?'))
                ->end()
                ->with('idEstablecimientoReferido') //Dónde será referido
                    ->assertNotBlank(array('message' => '¿Hacia dónde se referirá al paciente?'))
                ->end()
                ->with('datosClinicos') //Datos clínicos
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                    ->assertNotBlank(array('message' => 'Introduzca los datos clínicos de la preinscripción'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
                ->with('hipotesisDiagnostica') //Hipótesis diagnóstica
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                    ->assertNotBlank(array('message' => 'Introduzca su hipótesis diagnóstica'))
                    ->assertLength(array('min' => 10, 'minMessage' => 'Este campo al menos debe contener 10 caracteres'))
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
                ->with('investigando') //Investigación
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                    ->assertNotBlank(array('message' => '¿Qué desea investigar con el estudio que solicita?'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
                ->with('justificacionMedica') //Justificación médica de la preinscripción
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                    ->assertNotBlank(array('message' => 'Debe justificar por qué refiere el paciente hacia el servicio de Imagenología'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
                ->with('consultaPor') //Consulta Por
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
                ->with('estadoClinico') //Estado Clinico
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
//                 ->with('antecedentesClinicosRelevantes') //Antecedentes Clinicos Relevantes
//                     ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
//                                         'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
//                 ->end()
                ->with('justificacionReferencia') //Justificacion Referencia
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
                ->with('justificacionDiagnostico') //Justificacion Diagnostico
                    ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                        'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
                ->end()
                ->with('fechaProximaConsulta') //Próxima consulta con preinscriptor
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                    ->assertNotBlank(array('message' => 'Se necesita conocer este dato en el servicio de Imagenología'))
                ->end()
                ->with('pesoActualLb')
                    ->assertRange(array('min' => 5, 'minMessage' => 'El peso no puede ser menor a 5lb',
                                        'max' => 500, 'maxMessage' => 'El peso no puede ser mayor a 500lb'))
                ->end()
                ->with('pesoActualKg')
                    ->assertRange(array('min' => 2.27, 'minMessage' => 'El peso no puede ser menor a 2.27kg',
                                        'max' => 226.8, 'maxMessage' => 'El peso no puede ser mayor a 226.8kg'))
                ->end()
                ->with('tallaPaciente')
                    ->assertRange(array('min' => 0.20, 'minMessage' => 'La talla no puede ser menor a 20cm',
                                        'max' => 3, 'maxMessage' => 'La talla no puede ser mayor a 3m'))
                ->end()
                ->with('numeroCama')
                    ->assertRange(array('min' => 1, 'minMessage' => 'El número de cama no puede ser menor a 1'))
                ->end()
                ->with('numeroSala')
                    ->assertRange(array('min' => 1, 'minMessage' => 'El número de sala no puede ser menor a 1'))
                ->end();

            //AtenAreaModEstab
            if (!$preinscripcion->getIdAtenAreaModEstab()) {
                $errorElement
                    ->with('idAreaAtencion')
                        ->addViolation('No puede determinarse la procedencia de esta preinscripción')
                    ->end()
                    ->with('idAtencion')
                        ->addViolation('No puede determinarse la procedencia de esta preinscripción')
                    ->end();
            }

            //Area de Atención --> AtenAreaModEstab
            if (is_null($this->getForm()->get('idAreaAtencion')->getData())) { $errorElement->with ('idAreaAtencion')
                                                                            ->addViolation ('¿De qué área proviene el paciente?')->end(); }
            //Atención --> AtenAreaModEstab
            if (is_null($this->getForm()->get('idAtencion')->getData())) { $errorElement->with ('idAtencion')
                                                                            ->addViolation ('¿Qué servicio de atención refiere?')->end(); }

            //Procedencia de la preinscripción
            $areaAtnForm = $this->getForm()->get('idAreaAtencion')->getData();
            $histClForm = $this->getForm()->get('idHistorialClinico')->getData();
            $solEstudio = $preinscripcion->getIdSolicitudestudios();
            if (!$solEstudio) {
                if ($areaAtnForm && in_array($areaAtnForm->getId(), array(2, 3))) {
                    if ($histClForm) {
                        $errorElement
                            ->with('idAreaAtencion')
                                ->addViolation('La preinscripción proviene de consulta externa')
                            ->end();
                    }
                }
                else {
                    if (!$histClForm) {
                        $errorElement
                            ->with('idAreaAtencion')
                                ->addViolation('La preinscripción no proviene de consulta externa')
                            ->end();
                    }
                }
            }
            else {
                if (strtoupper($solEstudio->getIdHistorialClinico()->getPiloto()) == 'V') {
                    if ($areaAtnForm && in_array($areaAtnForm->getId(), array(1))) {
                        $errorElement
                            ->with('idAreaAtencion')
                                ->addViolation('La preinscripción no proviene de consulta externa')
                            ->end();
                    }
                }
                else {
                    if ($areaAtnForm && in_array($areaAtnForm->getId(), array(2, 3))) {
                        $errorElement
                            ->with('idAreaAtencion')
                                ->addViolation('La preinscripción proviene de consulta externa')
                            ->end();
                    }
                }
            }

            //Referir paciente
            if ($preinscripcion->getIdEstablecimientoReferido()) {
                if ($preinscripcion->getIdEstablecimientoReferido()->getId() != $sessionUser->getIdEstablecimiento()->getId()) {
                    $errorElement
                        ->with('referirPaciente')
                            ->assertNotBlank(array('message' => 'Si será referido a externo, por favor marque esta opción'))
                        ->end()
                        ->with('justificacionReferencia')
                            ->assertNotBlank(array('message' => 'Debe justificar por qué se refiere el paciente hacia: '
                                . $preinscripcion->getIdEstablecimientoReferido()))
                            ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                        ->end();
                    if (!$preinscripcion->getReferirPaciente()) {
                        $errorElement
                            ->with('idEstablecimientoReferido')
                                ->addViolation('Si será referido a externo, por favor marque la opción \'Referir a externo\'')
                            ->end()
                            ->with('justificacionReferencia')
                                ->assertBlank(array('message' => 'No necesita llenar este campo si no se referirá a externo'))
                            ->end();
                    }
                }
                else {
                    if ($preinscripcion->getReferirPaciente()) {
                        $errorElement
                            ->with('idEstablecimientoReferido')
                                ->addViolation('Ha marcado la opción \'Referir a externo\', pero no ha cambiado el establecimiento de destino')
                                ->addViolation('Si no se referirá al paciente a externo, por favor desmarque la opción')
                            ->end()
                            ->with('referirPaciente')
                                ->addViolation('Desmarque esta opción')
                            ->end();
                    }
                    $errorElement
                        ->with('justificacionReferencia')
                            ->assertBlank(array('message' => 'No necesita llenar este campo si no se referirá a externo'))
                        ->end();
                }
            }
            else {
                if ($preinscripcion->getReferirPaciente()) {
                    $errorElement
                        ->with('idEstablecimientoReferido') //Dónde será referido
                            ->assertNotBlank(array('message' => 'Ha marcado la opción \'Referir a externo\', pero no ha seleccionado el establecimiento de destino'))
                        ->end()
                        ->with('referirPaciente')
                            ->addViolation('Seleccione un destino')
                        ->end();
                }
                $errorElement
                    ->with('justificacionReferencia')
                        ->assertBlank(array('message' => 'No necesita llenar este campo si no se referirá a externo'))
                    ->end();
            }

            //Solicitar diagnóstico
            if ($preinscripcion->getIdEstablecimientoDiagnosticante()) {
                $errorElement
                    ->with('requiereDiagnostico')
                        ->assertNotBlank(array('message' => 'Si solicita diagnóstico, por favor marque esta opción'))
                    ->end()
                    ->with('justificacionDiagnostico')
                        ->assertNotBlank(array('message' => 'Debe justificar por qué necesita que se diagnóstique el estudio en: '
                            . $preinscripcion->getIdEstablecimientoDiagnosticante()))
                        ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                    ->end();
                if (!$preinscripcion->getRequiereDiagnostico()) {
                    $errorElement
                        ->with('idEstablecimientoDiagnosticante')
                            ->addViolation('Si solicita se diagnóstique el estudio, por favor marque la opción \'Requiere diagnóstico\'')
                        ->end()
                        ->with('justificacionDiagnostico')
                            ->assertBlank(array('message' => 'No necesita llenar este campo si no solicitará diagnóstico'))
                        ->end();
                }
            }
            else {
                if ($preinscripcion->getRequiereDiagnostico()) {
                    $errorElement
                        ->with('idEstablecimientoDiagnosticante')
                            ->assertNotBlank(array('message' => 'Ha marcado la opción \'Requiere diagnóstico\', pero no ha seleccionado el establecimiento de destino'))
                        ->end()
                        ->with('requiereDiagnostico')
                            ->addViolation('Seleccione un destino')
                        ->end();
                }
                $errorElement
                    ->with('justificacionDiagnostico')
                        ->assertBlank(array('message' => 'No necesita llenar este campo si no solicitará diagnóstico'))
                    ->end();
            }

            //Fecha de próxima consulta debe ser mayor a actual
            if ($preinscripcion->getFechaProximaConsulta()) {
                if (!$preinscripcion->getId() && $preinscripcion->getFechaProximaConsulta()->format('Y-m-d') < (new \DateTime('now'))->format('Y-m-d')) {
                    $errorElement->with('fechaProximaConsulta')
                                    ->addViolation('La fecha suministrada no es válida, la fecha actual es: ' . (new \DateTime('now'))->format('Y-m-d'))
                                ->end();
                }
                if ($preinscripcion->getId() && $preinscripcion->getFechaProximaConsulta()->format('Y-m-d') < $preinscripcion->getFechaCreacion()->format('Y-m-d')) {
                    $errorElement->with('fechaProximaConsulta')
                                    ->addViolation('La fecha suministrada no es válida, la fecha de preinscripción fue: ' . $preinscripcion->getFechaCreacion()->format('Y-m-d'))
                                ->end();
                }
            }

            // ***************** Proyecciones seleccionadas --> solicitudEstudioProyeccion incrustada ******************
            $count = 0; // proyecciones agregadas
            foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
                $count++;  //Se encuentra mas de una vez, aumentar contador de repeticiones
            }
            if ($count <= 0)  {
                $errorElement->with('solicitudEstudioProyeccion')
                                ->addViolation('Debe seleccionar las proyecciones requeridas')
                            ->end();
            }
        }

    }

    public function postPersist2($preinscripcion)
    {
//        $messageReg = '';
        $errorReg = false;

        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $historialClinico = $this->getForm()->get('idHistorialClinico')->getData() ?
                $this->getModelManager()->find('MinsalSeguimientoBundle:SecHistorialClinico', $this->getForm()->get('idHistorialClinico')->getData() ) : null;

        $atenAreaEstab = $preinscripcion->getIdAtenAreaModEstab();

        if (!$historialClinico && in_array($atenAreaEstab->getIdAreaModEstab()->getIdAreaAtencion()->getId(), array(2, 3))) {
                        //********** No existe el historial, insertar uno con piloto "V" ***********
            /** SecHistorialClinico */
            $historialClinicoV = new SecHistorialClinico();
            $historialClinicoV->setDatosclinicos(trim($preinscripcion->getDatosclinicos()));
            $historialClinicoV->setFechaconsulta(new \DateTime('now'));
            $historialClinicoV->setIdsubservicio($atenAreaEstab);
            $historialClinicoV->setIdusuarioreg($sessionUser);
            $historialClinicoV->setFechahorareg(new \DateTime('now'));
            $historialClinicoV->setPiloto('V');
//            $historialClinicoV->setIpaddress('');   //Hace falta ver como sacar esta IP ------>
            $historialClinicoV->setIdestablecimiento($sessionUser->getIdEstablecimiento());
            $historialClinicoV->setIdNumeroExpediente($preinscripcion->getIdExpediente());
            $historialClinicoV->setIdEmpleado($preinscripcion->getIdEmpleado());
            $this->getModelManager()->create($historialClinicoV);

            /** SecMotivoConsulta */
            $hojaContinuacion = new SecMotivoConsulta();
            $hojaContinuacion->setIdhistorialclinico($historialClinicoV);
            $hojaContinuacion->setMotivoconsulta($preinscripcion->getConsultaPor() ? trim($preinscripcion->getConsultaPor()) : 'Otros motivos');
            $hojaContinuacion->setEvolucionpaciente($preinscripcion->getAntecedentesClinicosRelevantes() ?
                                                                trim($preinscripcion->getAntecedentesClinicosRelevantes()) : 'Sin evolución');
            $this->getModelManager()->create($hojaContinuacion);

            /** SecSignosVitales */
            $examenFisico = new SecSignosVitales();
            $examenFisico->setIdhistorialclinico($historialClinicoV);
            if ($preinscripcion->getPesoActualLb()) { $examenFisico->setPeso(round($preinscripcion->getPesoActualLb())); }
            $examenFisico->setTalla($preinscripcion->getTallaPaciente());
            $this->getModelManager()->create($examenFisico);

            //Asignar Historial Clínico
            $historialClinico = $historialClinicoV;

            $messageReg = 'Historia clínica generada implícitamente a partir de preinscripción.';
            $this->getRequest()->getSession()->getFlashBag()->add("warning", $messageReg);
        }

        /** SecSolicitudestudios */
        //Obtener el id del servicio de apoyo de Imagenología
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAtencion');
        $imagenologiaReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAtencion', '97');

        //Obtener estado exclusivo para Imagenología
        $estadoImg = $this->getModelManager()->findOneBy('MinsalSimagdBundle:CtlEstadoServicioDiagnostico',
                                                        array('idestado' => 'PR', 'idAtencion' => '97'));

        $solicitudEstudios = new SecSolicitudestudios();
        $solicitudEstudios->setIdHistorialClinico($historialClinico);
        $solicitudEstudios->setFechaSolicitud(new \DateTime('now'));
        $solicitudEstudios->setIdusuarioreg($sessionUser);
        $solicitudEstudios->setFechahorareg(new \DateTime('now'));
        $solicitudEstudios->setIdAtencion($imagenologiaReference);
        $solicitudEstudios->setCama($preinscripcion->getNumeroCama());
        $solicitudEstudios->setIdEstablecimiento($sessionUser->getIdEstablecimiento());
        $solicitudEstudios->setIdExpediente($preinscripcion->getIdExpediente());
        $solicitudEstudios->setEstado($estadoImg);  //ESTADO EXCLUSIVO PARA REGISTROS DE IMAGENOLOGIA
        $this->getModelManager()->create($solicitudEstudios);

        /** Preinscripcion */
        //Insertar clave de SecSolicitudestudios
        $preinscripcion->setIdSolicitudestudios($solicitudEstudios);
        $this->getModelManager()->update($preinscripcion);

        /** SecDetallesolicitudestudios */
        $this->ingresarDetallesSolicitud($preinscripcion);

        $messageReg = 'Solicitud de estudio imagenológico ha sido agregada a Historia clínica.';
        $this->getRequest()->getSession()->getFlashBag()->add("success", $messageReg);
    }

    public function postUpdate2($preinscripcion)
    {
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');

        if ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE') || $securityContext->isGranted('ROLE_ADMIN') ) {
            /** SecDetallesolicitudestudios */
            $this->ingresarDetallesSolicitud($preinscripcion);
        }
    }

    public function getNewInstance()
    {
        // $instance = parent::getNewInstance();
        $instance = $this->getModelManager()->getModelInstance($this->getClass());
        foreach ($this->getExtensions() as $extension)
        {
            $extension->alterNewInstance($this, $instance);
        }
        
        /*
         * ADD FORM FOR MAMOGRAFY STUDY
         */
//        $instance = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio();
        /*$form_mamografia = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioMamografia();
        $instance->addSolicitudEstudioMamografium($form_mamografia);*/
        /*
         * END
         */

        //Estado clínico
        $instance->setEstadoClinico('Paciente con signos vitales estables');

        //Próxima consulta
        $instance->setFechaProximaConsulta((new \DateTime('now'))->modify('+8 day'));

        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        //Área de atención por defecto
        //SACAR ESTO DE LO NORMAL, C.EXT, MEDICINA
        //SACAR UN ATEN_AREA DEL EMPLEADO_ESP_ESTAB
        //SI USER->EMPLEADO = MEDICO, PONERLO, HACER LO MISMO EN JQUERY
        //SACAR ESTO DEL USER --> ID_EMPLEADO Y ID_ESTAB, CON ESE SACAR EL ID_ATEN_AREA_MOD_ESTAB X DEFECTO
        //$em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAreaAtencion');
        //$estadoReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaAtencion', '1');
        //$instance->setIdEstadoCita($estadoReference);

        //Establecimiento al que se refirirá
        $estabLocal = $sessionUser->getIdEstablecimiento();
//        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlEstablecimiento');
//        $estabReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $estabLocal);
        $instance->setIdEstablecimientoReferido($estabLocal);

        //Modalidad por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico');
        $modReference = $em->getReference('Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico', '13');
        $instance->setIdAreaServicioDiagnostico($modReference);

        //Extracción de valores de Historial Clínico
        if ($this->hasRequest()) {
            $expediente = $this->getRequest()->get('__exp', null);
            if ($expediente !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\MntExpediente');
                $expedienteReference = $em->getReference('Minsal\SiapsBundle\Entity\MntExpediente', $expediente);
                $instance->setIdExpediente($expedienteReference);
            }

            $historialClinico = $this->getRequest()->get('__hcl', null);
            if ($historialClinico !== null) {
                $historialClinicoR = $this->getModelManager()->find('MinsalSeguimientoBundle:SecHistorialClinico', $historialClinico);
                if ($historialClinicoR) {
                    $instance->setDatosClinicos($historialClinicoR->getDatosclinicos() ? trim($historialClinicoR->getDatosclinicos()) : '');
                    $instance->setIdAtenAreaModEstab($historialClinicoR->getIdsubservicio());
                    $instance->setIdEmpleado($historialClinicoR->getIdEmpleado());
                    if ($historialClinicoR->getIdNumeroExpediente()) { $instance->setIdExpediente($historialClinicoR->getIdNumeroExpediente()); }

                    $hojaContinuacion = $this->getModelManager()->findOneBy('MinsalSeguimientoBundle:SecMotivoConsulta',
                                                                        array('idhistorialclinico' => $historialClinicoR->getId()));
                    if ($hojaContinuacion) {
                        $instance->setConsultaPor($hojaContinuacion->getMotivoconsulta() ? trim($hojaContinuacion->getMotivoconsulta()) : '');
                    }

                    $examenFisico = $this->getModelManager()->findOneBy('MinsalSeguimientoBundle:SecSignosVitales',
                                                                        array('idhistorialclinico' => $historialClinicoR->getId()));
                    if ($examenFisico) {
                        if ($examenFisico->getPeso()) { $instance->setPesoActualLb(number_format(floatval($examenFisico->getPeso()), 2)); }
                        if ($instance->getPesoActualLb()) { $instance->setPesoActualKg(round($instance->getPesoActualLb() / 2.20462262, 2)); }
                        if ($examenFisico->getTalla()) { $instance->setTallaPaciente(round($examenFisico->getTalla(), 2)); }
                    }
                }
            }
            else {
		$especialidadSession = $this->getConfigurationPool()->getContainer()->get('session')->get('_idEmpEspecialidadEstab');
		if ($especialidadSession) {
		    //Valores para area, atencion y empleado desde session
		    $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\MntAtenAreaModEstab');
		    $sessionEmpEspEstabReference = $em->getReference('Minsal\SiapsBundle\Entity\MntAtenAreaModEstab', $especialidadSession);
    //                $sessionEmpEspecialidadEstab = $this->getModelManager()->find('MinsalSiapsBundle:MntAtenAreaModEstab', $especialidadSession);
		    $instance->setIdAtenAreaModEstab($sessionEmpEspEstabReference);
		}
                if ($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() == 'MED' ) { $instance->setIdEmpleado($sessionUser->getIdEmpleado()); }
            }
        }

        if ($instance->getIdExpediente()) {

	    $infoContacto = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                	->getRepository($this->getClass() )
						->obtenerInformacionContactoReciente($instance->getIdExpediente()->getIdPaciente()->getId());

	    if ($infoContacto) {
		$instance->setNombreContacto($infoContacto['nmCt']);
		$instance->setContacto($infoContacto['cnt']);

                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlFormaContacto');
                $formaContactoRef = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlFormaContacto', $infoContacto['idFrmCt']);
		$instance->setIdFormaContacto($formaContactoRef);

                $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlParentesco');
                $contactoPacienteRef = $em->getReference('Minsal\SiapsBundle\Entity\CtlParentesco', $infoContacto['idCtPct']);
		$instance->setIdContactoPaciente($contactoPacienteRef);
	    }

	    /** Peso y talla reciente */
	    $datosPctRecientes = $this->getConfigurationPool()->getContainer()->get('doctrine')
					    ->getRepository($this->getClass())
					    ->obtenerDatosRecientesPacienteV2($instance->getIdExpediente()->getIdPaciente()->getId());
	    if ($datosPctRecientes)
	    {
		if (!$instance->getPesoActualLb()) {
		    $instance->setPesoActualLb($datosPctRecientes['pesoLb']);
		}
		if (!$instance->getPesoActualKg()) {
		    $instance->setPesoActualKg($datosPctRecientes['pesoKg']);
		}
		if (!$instance->getTallaPaciente()) {
		    $instance->setTallaPaciente($datosPctRecientes['talla']);
		}
	    }
	}

	/** Prioridad por defecto */
	$em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion');
	$prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', '4');
	$instance->setIdPrioridadAtencion($prioridadReference);

        return $instance;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();

        $query->innerJoin($query->getRootAlias() . '.idAtenAreaModEstab', 'aams')
                        ->andWhere($query->expr()->orx(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimientoReferido', ':id_est_ref'),
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimientoDiagnosticante', ':id_est_diag'),
                            $query->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ))
                        ->setParameter('id_est_ref', $estabLocal)
                        ->setParameter('id_est_diag', $estabLocal)
                        ->setParameter('id_est', $estabLocal);

        return $query;
    }

    public function ingresarDetallesSolicitud($preinscripcion)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $mrPorExplArray = array();  //Array de ids de MntAreaExamenEstablecimiento a partir de las proyecciones
        foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
            $areaExmEstab = $this->getModelManager()->findOneBy('MinsalSimagdBundle:MntAreaExamenEstablecimiento',
                                            array('idEstablecimiento' => $preinscripcion->getIdEstablecimientoReferido()->getId(),
                                                'idExamenServicioDiagnostico' => $solicitudEstudioProyeccion->getIdExamenServicioDiagnostico()->getId(),
                                                'idAreaServicioDiagnostico' => $preinscripcion->getIdAreaServicioDiagnostico()->getId()));
            $mrPorExplArray[] = $areaExmEstab->getId(); //Llenando array con el id de MntAreaExamenEstablecimiento extraido
        }
        $mrPorExplUArray = array_unique($mrPorExplArray);   //Remover duplicados (Caso de proyecciones hijas de la misma combinación de área y examen)

        $detallesSolEst = $this->getModelManager()->findBy('MinsalSeguimientoBundle:SecDetallesolicitudestudios',
                                            array('idsolicitudestudio' => $preinscripcion->getIdSolicitudestudios()->getId()));
        $mrPorDetSolArray = array();    //Array de ids de MntAreaExamenEstablecimiento a partir de los detalles
        foreach ($detallesSolEst as $detalleSol) {
            $mrPorDetSolArray[] = $detalleSol->getIdexamen()->getId();  //Llenando el array con los ids
        }

        $mrInsertadosArray = array_intersect($mrPorExplUArray, $mrPorDetSolArray);  //Extraer los ids que ya se encuentran insertados

        $mrNoInsertadosPorExplArray = array_diff($mrPorExplUArray, $mrInsertadosArray); //Extraer ids pendientes por insertar

        $mrSobrantesPorDetSolArray = array_diff($mrPorDetSolArray, $mrInsertadosArray); //Extraer ids a partir de detalles para remover

        foreach ($detallesSolEst as $detalleSol)  {
            if (in_array($detalleSol->getIdexamen()->getId(), $mrSobrantesPorDetSolArray)) {
                $this->getModelManager()->delete($detalleSol);  //Remover los detalles cuyo idExamen ya no será utilizado
            }
        }

        $estadoImg = $preinscripcion->getIdSolicitudestudios()->getEstado();
        //Insertar nuevos detalles con idExamen pendientes
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento');
        foreach ($mrNoInsertadosPorExplArray as $mrPorInsertar) {
            $areaExmEstabReference = $em->getReference('Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento', $mrPorInsertar);

            $detalleSolicitud = new SecDetallesolicitudestudios();
            $detalleSolicitud->setIdsolicitudestudio($preinscripcion->getIdSolicitudestudios());
            //$detalleSolicitud->setIndicacion($preinscripcion->); //AQUI CONCATENAR LAS "OTRAS ESPECIFICACIONES" DE LAS EXPLORACIONES HIJAS DEL 'mr'
            //$detalleSolicitud->setObservacion();  //ESTO QUIZA ACTUALIZARLO CON EL 'prz'
            $detalleSolicitud->setIdexamen($areaExmEstabReference);
            $detalleSolicitud->setIdestablecimiento($sessionUser->getIdEstablecimiento());
            $detalleSolicitud->setIdempleado($preinscripcion->getIdEmpleado());
            $detalleSolicitud->setIdusuarioreg($sessionUser);
            $detalleSolicitud->setFechahorareg(new \DateTime('now'));
            $detalleSolicitud->setEstadodetalle($estadoImg);
            $this->getModelManager()->create($detalleSolicitud);
        }

    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:RyxSolicitudEstudioAdmin:prc_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:RyxSolicitudEstudioAdmin:prc_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:RyxSolicitudEstudioAdmin:prc_show_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('MinsalSimagdBundle::simagd_form_admin_fields.html.twig'),
            array('MinsalSimagdBundle:RyxSolicitudEstudioAdmin:prc_admin_fields.html.twig')
       );
    }

}