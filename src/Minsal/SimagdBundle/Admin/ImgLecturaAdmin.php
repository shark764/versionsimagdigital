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

use Minsal\SimagdBundle\Entity\ImgDiagnostico;

class ImgLecturaAdmin extends Admin
{
    protected $baseRouteName    = 'simagd_lectura';
    protected $baseRoutePattern = 'rayos-x-lectura';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('delete');
        $collection->add('agregarPendiente', null, [], [], ['expose' => true]);
        $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        $collection->add('proximaConsulta', null, [], [], ['expose' => true]);
        $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');

        $sessionUser = $securityContext->getToken()->getUser();

        $formMapper
//             ->tab('Interpretación', array('class' => 'tab-lectura-rx', 'tab_icon' => 'glyphicon glyphicon-adjust'))
                ->with('Datos generales', array('class' => 'lct-with-lectura-generales col-md-12', 'description' => ''))->end()
//             ->end()
//             ->tab('Estudios', array('class' => 'tab-estudios-rx', 'tab_icon' => 'glyphicon glyphicon-eye-close'))
                ->with('Estudios que componen lectura', array('class' => 'col-md-12', 'description' => ''))->end()
//             ->end()
//             ->tab('Transcripción', array('class' => 'tab-transcripcion-rx', 'tab_icon' => 'glyphicon glyphicon-headphones'))
                ->with('Diagnóstico radiológico', array('class' => 'col-md-12 add-dropdown-menu-diagnosis', 'description' => ''))->end()
//             ->end()
        ;

        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();

        $setLockEstado = false;

        $lctId = null;

        if ($this->id($subject)) {
            $setLockEstado = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgLectura')
                                                        ->lecturaFueTranscrita($subject->getId());

            $lctId = $this->id($subject);

        }

        $pctId = null;
        if ($subject->getIdEstudio()) {
            $pctId = $subject->getIdEstudio()->getIdExpediente()->getIdPaciente()->getId();
        }

        $formMapper
//             ->tab('Interpretación')
                ->with('Datos generales')
//                  ->add('idEstablecimiento')
                    ->add('idEstudio', 'sonata_type_model_hidden')
                    ->add('idEmpleado', null, array(
                                                        'label' => 'Interpreta',
                                                        'required' => true,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(4, 5));
                                                                            },
                                                        'group_by' => 'idTipoEmpleado',
//                                                        'help' => 'Radiólogo que da lectura al estudio',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'user',
									'data-apply-formatter-mode' => 'enabled',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                    ))
                    ->add('idTipoResultado', null, array(
                                                        'label' => 'Tipo de resultado',
                                                        'required' => true,
                                                        'empty_value' => '',
                                                        'choices' => $this->getConfigurationPool()->getContainer()->get('Doctrine')
                                                                                            ->getRepository('MinsalSimagdBundle:ImgLectura')
                                                                                                                ->obtenerTiposResultadoList(),
//                                                        'help' => 'Seleccione un tipo',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                    ))
                    ->add('idEstadoLectura', null, array(
                                                        'label' => 'Estado',
                                                        'required' => true,
                                                        'empty_value' => '',
//                                                        'expanded' => true,
//                                                        'multiple' => false,
//                                                        'help' => 'Estado en que se registra',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-select2-formatter' => 'interpretationStatus',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                    ))
                    ->add('setLockEstado', 'hidden', array(
							'mapped' => false,
							'data' => $setLockEstado
                    ))
                    ->add('idRadiologoDesignadoAprobacion', null, array(
                                                        'label' => 'Será aprobado por',
                                                        'required' => false,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(4, 5));
                                                                            },
                                                        'group_by' => 'idTipoEmpleado',
//                                                        'help' => 'Radiólogo que da lectura al estudio',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'user',
									'data-apply-formatter-mode' => 'enabled',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

									/*'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',*/
							)
                    ))
                    ->add('correlativo', null, array(
                                                        'label' => 'Correlativo',
//                                                        'help' => 'Autogenerado: ##########',
							'attr' => array('maxlength' => '10',
									/*'readonly' => 'readonly',*/
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '2',
									'data-fv-stringlength-max' => '10',
									'data-fv-stringlength-message' => '2 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-Z0-9_-]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))//CORRELATIVO DEBE AUTOGENERARSE Y DEBE APARECERLE AL MEDICO PARA QUE ETIQUETE
                    ->add('idPatronAsociado', null, array(
							'label' => 'Utilizar patrón',
							'required' => false,
							'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerPatronesDiagnosticoUtilizablesV2($estabLocal);
                                                                            },
                                                        'group_by' => 'idAreaServicioDiagnostico',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'patternDiag',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-8 col-md-8 col-sm-8',
							)
                    ))
                    ->add('indicaciones', 'textarea', array(
                                                        'label' => 'Indicaciones',
                                                        'required' => false,
//                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Digite indicaciones para la transcripción',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-8 col-md-8 col-sm-8',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))
                    ->add('observaciones', 'textarea', array(
                                                        'label' => 'Observaciones',
                                                        'required' => false,
//                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '1',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Digite sus observaciones, utilice este campo en caso de rechazo de lectura',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-8 col-md-8 col-sm-8',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Necesita llenar este campo',
									'data-fv-callback-callback' => 'checkEstadoLectura',
							)
                    ))
                ->end()
//             ->end()
//             ->tab('Estudios')
                ->with('Estudios que componen lectura')
                    ->add('estudiosLectura', 'entity', array(
                                                        'label' => 'Estudios realizados',
                                                        'required' => false,
//                                                        'empty_value' => '',
                                                        'expanded' => true,
                                                        'multiple' => true,
                                                        'class' => 'MinsalSimagdBundle:ImgEstudioPaciente',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal, $lctId, $pctId) {
                                                                                return $er->obtenerEstudiosSinLectura($estabLocal, $lctId, $pctId);
                                                                            },
//                                                        'help' => 'Estado en que se registra',
//                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                ->end()
//             ->end()
//             ->tab('Transcripción')
                ->with('Diagnóstico radiológico')
                    ->add('activarTranscripcion', 'checkbox', array(
							'label' => 'Guardar transcripción adjunta',
							'required' => false,
							'mapped' => false,
                                                        'attr' => array('data-apply-bootstrap-switch' => 'true',
									'data-on-text' => 'I',
									'data-off-text' => 'O',
							)
                    ))
                    ->add('idPatronAplicado', 'entity', array(
							'label' => 'Aplicar patrón',
							'mapped' => false,
							'required' => false,
							'empty_value' => '',
                                                        'class' => 'MinsalSimagdBundle:ImgCtlPatronDiagnostico',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerPatronesDiagnosticoUtilizablesV2($estabLocal);
                                                                            },
//                                                         'property' => 'nombre',
                                                        'group_by' => 'idAreaServicioDiagnostico',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-mapped-form' => 'diag',
									'data-apply-formatter' => 'patternDiag',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-8 col-md-8 col-sm-8',
							)
                    ))
                    ->add('hallazgos', 'textarea', array(
							'label' => 'Hallazgos',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '7',
									'style' => 'resize:none',
// 									'placeholder' => 'Hallazgos encontrados en el estudio',
									'data-mapped-form' => 'diag',
									'class' => 'summernote',

									/*'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-message' => '15 caracteres mínimo',*/
							)
                    ))
                    ->add('conclusion', 'textarea', array(
							'label' => 'Conclusión',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '4',
									'style' => 'resize:none',
// 									'placeholder' => 'Conclusión del diagnóstico radiológico del estudio',
									'data-mapped-form' => 'diag',
									'class' => 'summernote'

									/*'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-message' => '15 caracteres mínimo',*/
							)
                    ))
                    ->add('recomendaciones', 'textarea', array(
							'label' => 'Recomendaciones',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '5',
// 									'maxlength' => '255',
									'style' => 'resize:none',
// 									'placeholder' => 'Recomendaciones al paciente y al médico referente',
									'data-mapped-form' => 'diag',
									'class' => 'summernote'

									/*'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',*/
							)
                    ))
                    ->add('diagnostico', 'textarea', array(
							'label' => false,
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '25',
// 									'maxlength' => '255',
									'style' => 'resize:none',
// 									'placeholder' => 'Recomendaciones al paciente y al médico referente',
									'data-mapped-form' => 'diag',
									'class' => 'summernote',
                                    'data-add-form-group-col' => 'true',
                                    'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',

									/*'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',*/
							)
                    ))
                    ->add('idEstadoDiagnostico', 'entity', array(
							'label' => 'Estado',
							'mapped' => false,
							'required' => false,
							'empty_value' => '',
                                                        'class' => 'MinsalSimagdBundle:ImgCtlEstadoDiagnostico',
//                                                         'property' => 'nombreEstado',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-select2-formatter' => 'diagnosticStatus',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-8 col-md-8 col-sm-8',

									'data-mapped-form' => 'diag',
									'data-add-validation' => 'formValidation',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                    ))
                    ->add('incidencias', 'textarea', array(
							'label' => 'Incidencias ocurridas',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '3',
									'maxlength' => '255',
									'style' => 'resize:none',
									'placeholder' => 'Incidencias ocurridas durante la transcripción',
									'data-mapped-form' => 'diag',
									'data-add-validation' => 'formValidation',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-8 col-md-8 col-sm-8',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))
                    ->add('observaciones', 'textarea', array(
							'label' => 'Observaciones',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '2',
									'maxlength' => '255',
									'style' => 'resize:none',
									'placeholder' => 'Puede agregar sus Observaciones',
									'data-mapped-form' => 'diag',
									'data-add-validation' => 'formValidation',
                                                                        'data-add-form-group-col' => 'true',
                                                                        'data-add-form-group-col-class' => 'col-lg-8 col-md-8 col-sm-8',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))
                ->end()
//             ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }

    public function prePersist($lectura)
    {
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
        $estabLocal = $sessionUser->getIdEstablecimiento();

        $lectura->setIdUserReg($sessionUser);
        $lectura->setFechaLectura(new \DateTime('now'));

        if ( in_array($lectura->getIdEstadoLectura()->getCodigo(), array('LDO'))) {
	    if (!$lectura->getCorrelativo()) {
		$lectura->setCorrelativo($this->generarCorrelativoInterpretacion($lectura ));

		if ($lectura->getCorrelativo()) {
		    $messageReg = 'Código generado para etiquetar grabación: <br/>' . $lectura->getCorrelativo();
		    $this->getRequest()->getSession()->getFlashBag()->add("warning", $messageReg);
		}
	    }
        }
        if ($lectura->getCorrelativo()) { $lectura->setCorrelativo(strtoupper($lectura->getCorrelativo())); }

        if ($lectura->getIdEstudio()) {
	    $exists = false;
	    $estudioS = $lectura->getIdEstudio();
	    foreach ($lectura->getEstudiosLectura() as $estudioL) {
		if ($estudioL->getId() == $estudioS->getId() && $estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudio() &&
			!$estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudioComplementario()) {
		    $exists = true;
		}
	    }
	    if ($exists === false) {
		$lectura->setIdEstudio(NULL);
	    }
        }

        if (!$lectura->getIdEstudio()) {
	    $setted = false;
            foreach ($lectura->getEstudiosLectura() as $estudioL) {
		if ($setted === false && $estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudio() &&
			!$estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudioComplementario()) {
		    $lectura->setIdEstudio($estudioL);
		    $setted = true;
		}
            }
        }

        if ($lectura->getIdEstudio()) {
	    $preinscripcion = $lectura->getIdEstudio()->getIdProcedimientoRealizado()->getIdSolicitudEstudio();
	    $complementario = $lectura->getIdEstudio()->getIdProcedimientoRealizado()->getIdSolicitudEstudioComplementario();
	    if ($preinscripcion) {
		$estabOrigen = $preinscripcion->getIdAtenAreaModEstab()->getIdEstablecimiento();
		if ($estabOrigen->getId() != $lectura->getIdEstablecimiento()->getId()) {
		    $lectura->setLecturaRemota( TRUE);
		}
	    }
	    if (!$preinscripcion && $complementario) {
		if ($complementario->getIdSolicitudEstudio()) {
		    $estabOrigen = $complementario->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdEstablecimiento();
		    if ($estabOrigen->getId() != $lectura->getIdEstablecimiento()->getId()) {
			$lectura->setLecturaRemota( TRUE);
		    }
		}
	    }

	    /** Expediente local */
	    $expLocal = $this->getModelManager()->findOneBy('MinsalSiapsBundle:MntExpediente',
				array(
				    'idPaciente' => $lectura->getIdEstudio()->getIdExpediente()->getIdPaciente()->getId(),
				    'idEstablecimiento' => $estabLocal->getId()
				));
	    $lectura->setIdExpediente($expLocal);
	}

        if (!$lectura->getIdRadiologoDesignadoAprobacion()) {
	    if ( in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) {
		$lectura->setIdRadiologoDesignadoAprobacion($sessionUser->getIdEmpleado());
	    }
        }

        /** Diagnóstico incrustado */
        if ($this->hasSubject())
        {
	    if ($this->getForm()->get('activarTranscripcion')->getData())
	    {
		/** ImgDiagnostico */
		$diagMapped = new ImgDiagnostico();

		$diagMapped->setIdLectura($lectura);
		$diagMapped->setIdUserReg($sessionUser);
		$diagMapped->setFechaRegistro(new \DateTime('now'));
		$diagMapped->setFechaTranscrito(new \DateTime('now'));

		if (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ACL', 'MED', 'TRY')))
		{
		    $diagMapped->setIdEmpleado($sessionUser->getIdEmpleado());
		}

		$diagMapped->setIdPatronAplicado($this->getForm()->get('idPatronAplicado')->getData());
		if (!$diagMapped->getIdPatronAplicado())
		{
		    $diagMapped->setIdPatronAplicado($lectura->getIdPatronAsociado());
		}

		$diagMapped->setIdEstadoDiagnostico($this->getForm()->get('idEstadoDiagnostico')->getData());
		$diagMapped->setHallazgos($this->getForm()->get('hallazgos')->getData());
		$diagMapped->setConclusion($this->getForm()->get('conclusion')->getData());
		$diagMapped->setRecomendaciones($this->getForm()->get('recomendaciones')->getData());
		$diagMapped->setIncidencias($this->getForm()->get('incidencias')->getData());
		$diagMapped->setIncidencias($this->getForm()->get('observaciones')->getData());

		if ($diagMapped->getIdEstadoDiagnostico() && in_array($diagMapped->getIdEstadoDiagnostico()->getCodigo(), array('APR')))
		{
		    $diagMapped->setFechaAprobado(new \DateTime('now'));
		    $diagMapped->setIdRadiologoAprueba($sessionUser->getIdEmpleado());
		}

		/** Asignar transcripción inmediata */
		$lectura->addLecturaDiagnostico($diagMapped);
	    }
        }
        /** --Fin Diagnóstico */
    }

    public function preUpdate($lectura)
    {
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
        $estabLocal = $sessionUser->getIdEstablecimiento();

        $em = $this->getModelManager()->getEntityManager($this->getClass());
        $lecturaOriginal = $em->getUnitOfWork()->getOriginalEntityData($lectura);
        $estadoOriginal = $lecturaOriginal['idEstadoLectura']->getCodigo();

        $estadoLectura = $lectura->getIdEstadoLectura()->getCodigo();

	if ( ($estadoLectura != $estadoOriginal) && in_array($estadoLectura, array('LDO'))
				&& !$lectura->getCorrelativo()) {

	    $lectura->setCorrelativo($this->generarCorrelativoInterpretacion($lectura ));

	    if ($lectura->getCorrelativo()) {
		$messageReg = 'Código generado para etiquetar grabación: <br/>' . $lectura->getCorrelativo();
		$this->getRequest()->getSession()->getFlashBag()->add("warning", $messageReg);
	    }
        }
        if ($lectura->getCorrelativo()) { $lectura->setCorrelativo(strtoupper($lectura->getCorrelativo())); }

        if ($lectura->getIdEstudio()) {
	    $exists = false;
	    $estudioS = $lectura->getIdEstudio();
	    foreach ($lectura->getEstudiosLectura() as $estudioL) {
		if ($estudioL->getId() == $estudioS->getId() && $estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudio() &&
			!$estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudioComplementario()) {
		    $exists = true;
		}
	    }
	    if ($exists === false) {
		$lectura->setIdEstudio(NULL);
	    }
        }

        if (!$lectura->getIdEstudio()) {
	    $setted = false;
            foreach ($lectura->getEstudiosLectura() as $estudioL) {
		if ($setted === false && $estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudio() &&
			!$estudioL->getIdProcedimientoRealizado()->getIdSolicitudEstudioComplementario()) {
		    $lectura->setIdEstudio($estudioL);
		    $setted = true;
		}
            }
        }

        if ($lectura->getIdEstudio()) {
	    $preinscripcion = $lectura->getIdEstudio()->getIdProcedimientoRealizado()->getIdSolicitudEstudio();
	    $complementario = $lectura->getIdEstudio()->getIdProcedimientoRealizado()->getIdSolicitudEstudioComplementario();
	    if ($preinscripcion) {
		$estabOrigen = $preinscripcion->getIdAtenAreaModEstab()->getIdEstablecimiento();
		if ($estabOrigen->getId() != $lectura->getIdEstablecimiento()->getId()) {
		    $lectura->setLecturaRemota( TRUE);
		}
	    }
	    if (!$preinscripcion && $complementario) {
		if ($complementario->getIdSolicitudEstudio()) {
		    $estabOrigen = $complementario->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdEstablecimiento();
		    if ($estabOrigen->getId() != $lectura->getIdEstablecimiento()->getId()) {
			$lectura->setLecturaRemota( TRUE);
		    }
		}
	    }
	}

        if (!$lectura->getIdRadiologoDesignadoAprobacion()) {
	    if ( in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) {
		$lectura->setIdRadiologoDesignadoAprobacion($sessionUser->getIdEmpleado());
	    }
        }

        /** Editar diagnóstico incrustado */
        if ($this->hasSubject())
        {
	    if ($this->getForm()->get('activarTranscripcion')->getData())
	    {
		$count_diagMapped = 0; /* contador de diagnósticos incrustados */
		foreach ($lectura->getLecturaDiagnostico() as $diagMapped)
		{
		    /** ImgDiagnostico */
		    $diagMapped->setIdUserMod($sessionUser);

		    $diagMapped->setIdPatronAplicado($this->getForm()->get('idPatronAplicado')->getData());
		    if (!$diagMapped->getIdPatronAplicado())
		    {
			$diagMapped->setIdPatronAplicado($lectura->getIdPatronAsociado());
		    }

		    $statusOld	= $diagMapped->getIdEstadoDiagnostico();
		    $statusNew	= $this->getForm()->get('idEstadoDiagnostico')->getData();

		    if ($statusNew && in_array($statusNew->getCodigo(), array('APR')) && $statusOld->getCodigo() != $statusNew->getCodigo())
		    {
			$diagMapped->setFechaAprobado(new \DateTime('now'));
			$diagMapped->setIdRadiologoAprueba($sessionUser->getIdEmpleado());
		    }
		    $diagMapped->setIdEstadoDiagnostico($statusNew);

		    $diagMapped->setHallazgos($this->getForm()->get('hallazgos')->getData());
		    $diagMapped->setConclusion($this->getForm()->get('conclusion')->getData());
		    $diagMapped->setRecomendaciones($this->getForm()->get('recomendaciones')->getData());
		    $diagMapped->setIncidencias($this->getForm()->get('incidencias')->getData());
		    $diagMapped->setIncidencias($this->getForm()->get('observaciones')->getData());

		    $count_diagMapped++;
		}

		if ($count_diagMapped === 0)
		{
		    /** ImgDiagnostico */
		    $diagMapped = new ImgDiagnostico();

		    $diagMapped->setIdLectura($lectura);
		    $diagMapped->setIdUserReg($sessionUser);
		    $diagMapped->setFechaRegistro(new \DateTime('now'));
		    $diagMapped->setFechaTranscrito(new \DateTime('now'));

		    if (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ACL', 'MED', 'TRY')))
		    {
			$diagMapped->setIdEmpleado($sessionUser->getIdEmpleado());
		    }

		    $diagMapped->setIdPatronAplicado($this->getForm()->get('idPatronAplicado')->getData());
		    if (!$diagMapped->getIdPatronAplicado())
		    {
			$diagMapped->setIdPatronAplicado($lectura->getIdPatronAsociado());
		    }

		    $diagMapped->setIdEstadoDiagnostico($this->getForm()->get('idEstadoDiagnostico')->getData());
		    $diagMapped->setHallazgos($this->getForm()->get('hallazgos')->getData());
		    $diagMapped->setConclusion($this->getForm()->get('conclusion')->getData());
		    $diagMapped->setRecomendaciones($this->getForm()->get('recomendaciones')->getData());
		    $diagMapped->setIncidencias($this->getForm()->get('incidencias')->getData());
		    $diagMapped->setIncidencias($this->getForm()->get('observaciones')->getData());

		    if ($diagMapped->getIdEstadoDiagnostico() && in_array($diagMapped->getIdEstadoDiagnostico()->getCodigo(), array('APR')))
		    {
			$diagMapped->setFechaAprobado(new \DateTime('now'));
			$diagMapped->setIdRadiologoAprueba($sessionUser->getIdEmpleado());
		    }

		    /** Asignar transcripción inmediata */
		    $lectura->addLecturaDiagnostico($diagMapped);
		}
	    }
        }
        /** --Fin Diagnóstico */
    }

    public function validate(ErrorElement $errorElement, $lectura) {
        $errorElement
            ->with('idEmpleado') //Intérprete
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Quién es el Médico Radiólogo que ha dado lectura?'))
            ->end()
             ->with('idTipoResultado') //Tipo de resultado
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Qué tipo de resultado encontró en el estudio?'))
            ->end()
            ->with('idEstadoLectura') //Estado de la lectura
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿En qué estado se encuentra el registro de la lectura radiológica?'))
            ->end();

        //Estudio del paciente
        if (!$lectura->getIdEstudio()) {
            $errorElement->with('observaciones')
                            ->addViolation('No se ha seleccionado el estudio al que se dará lectura')
                        ->end();
        }
        //Establecimiento al que se solicitó lectura
        if (!$lectura->getIdEstablecimiento()) {
            $errorElement->with('observaciones')
                            ->addViolation('La lectura no puede registrarse en este establecimiento, verifique que exista el estudio')
                        ->end();
        }

        if ($lectura->getIdEstadoLectura() && in_array($lectura->getIdEstadoLectura()->getCodigo(), array('DCT', 'RZD'))) {
            $errorElement
                ->with('observaciones') //Causa de rechazo
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío si ha rechazado dar lectura'))
                    ->assertNotBlank(array('message' => 'Debe escribir la causa de rechazo|descarto del estudio para lectura radiológica'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                ->end();
        }

	if ($this->getForm()->get('activarTranscripcion')->getData())
	{
	    if (is_null($this->getForm()->get('idEstadoDiagnostico')->getData()))
	    {
		$errorElement->with ('idEstadoDiagnostico')
		    ->addViolation ('Seleccione un estado para la transcripción de resultados')->end();
	    }
	}
    }

    public function getNewInstance() {
        $instance = parent::getNewInstance();
//        $instance = new \Minsal\SimagdBundle\Entity\ImgLectura();

        //Estado inicial de la lectura
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlEstadoLectura');
        $estadoReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoLectura', '2');
        $instance->setIdEstadoLectura($estadoReference);

        //Tipo de Resultado
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlTipoResultado');
        $tipoResultReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlTipoResultado', '1');
        $instance->setIdTipoResultado($tipoResultReference);

        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        if ( in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) {
	    $instance->setIdEmpleado($sessionUser->getIdEmpleado());
            /** Aprobación de lectura radiológica */
	    $instance->setIdRadiologoDesignadoAprobacion($sessionUser->getIdEmpleado());
	}

        //Establecimiento al que se solicitó el diagnóstico
        // ---> debe venir desde la preinscripción, o desde la solicitud.... debe ser el q aparece en la lista de trabajo
        $estabLocal = $sessionUser->getIdEstablecimiento();
//                                    ->getUser()->getIdEstablecimiento()->getId();
//        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlEstablecimiento');
//        $estabReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $estabLocal);
        $instance->setIdEstablecimiento($estabLocal);

        //Estudio padre
        if ($this->hasRequest()) {
            $estudio 		= $this->getRequest()->get('__est', null);
            $estudioPdr 	= $this->getRequest()->get('__estPdr', null);
            if ($estudio !== null) {
		if ($estudioPdr === null) {
		    $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgEstudioPaciente');
		    $estudioReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgEstudioPaciente', $estudio);
		    $instance->setIdEstudio($estudioReference);

		    $instance->addEstudiosLectura($estudioReference);
		} else {
		    $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgEstudioPaciente');
		    $estudioPdrReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgEstudioPaciente', $estudioPdr);
		    $instance->setIdEstudio($estudioPdrReference);
		    $instance->addEstudiosLectura($estudioPdrReference);

		    $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgEstudioPaciente');
		    $estudioReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgEstudioPaciente', $estudio);
		    $instance->addEstudiosLectura($estudioReference);
		}
            }

            //Lectura solicitada por radiólogo
            $solicitudPorRadiologo = $this->getRequest()->get('__xrad', false);
            if ($solicitudPorRadiologo !== false) {
                $instance->setSolicitadaPorRadiologo(TRUE);

		$radiologoAnexa = $this->getRequest()->get('__xradAnx', null);
		if ($radiologoAnexa !== null) {
		    $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\MntEmpleado');
		    $radAnxReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $radiologoAnexa);
		    $instance->setIdRadiologoSolicita($radAnxReference);
		}

		if (!$instance->getIdRadiologoSolicita()) {
		    if ( in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) {
			/** Solicitud de lectura radiológica por radiólogo y no por médico */
			$instance->setIdRadiologoSolicita($sessionUser->getIdEmpleado());
		    }
                }
            }
        }

        return $instance;
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();

        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_diag')
                        )
                        ->setParameter('id_est_diag', $estabLocal);

        return $query;
    }

    public function generarCorrelativoInterpretacion($lectura)
    {
	$estabLocal = $lectura->getIdEstablecimiento();

	$modalidadSolicitada = $lectura->getIdEstudio()->getIdProcedimientoRealizado()
								->getIdSolicitudEstudio()->getIdAreaServicioDiagnostico();


        $codigoModalidad = $modalidadSolicitada->getImgCodigo() ? substr($modalidadSolicitada->getImgCodigo(), 0, 2 ) : 'NA';

	$mayor = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                ->getRepository($this->getClass() )
						->obtenerUltimoCorrelativo($estabLocal->getId(), $modalidadSolicitada->getId());

	//Substraer los ultimos 6 digitos, parse Int y sumar 1
	$valor = $mayor ? substr($mayor['maxCod'], -8 ) : '0';
	$intValor = (int) $valor;
	$intValor++;

// 	$correlativo = 'AA';	//Código prefijo
	$correlativo = $codigoModalidad;
	$correlativo .= str_pad( (string) $intValor, 8, '0', STR_PAD_LEFT);

        return strtoupper($correlativo);
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgLecturaAdmin:lct_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgLecturaAdmin:lct_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgLecturaAdmin:lct_show.html.twig';
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
            array('MinsalSimagdBundle:ImgLecturaAdmin:lct_estudiosLectura_theme.html.twig')
       );
    }

}