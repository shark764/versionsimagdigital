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

class ImgDiagnosticoAdmin extends Admin {

    protected $baseRouteName    = 'simagd_diagnostico';
    protected $baseRoutePattern = 'rayos-x-diagnostico';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        $collection->add('nota');
        $collection->add('addPendingToWorkList', null, [], [], ['expose' => true]);
        // $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        // $collection->remove('delete');
        $collection->add('transcribirDiagnostico', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarDiagnostico', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('approveTranscribedDiagnosis', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                        ->getUser()->getIdEstablecimiento()->getId();

        $datagridMapper
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAtenAreaModEstab.idEstablecimiento', null, array('label' => 'Proveniente de'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerEstabSolicitadosRefDiag($estabLocal, 'idEstablecimiento', 'aams');
                                                                                                },
                                                                            'group_by' => 'idTipoEstablecimiento',
            ))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idExpediente.idPaciente', null, array('label' => 'Paciente'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerPacientesPreinscritos($estabLocal);
                                                                                                },
                                                                            'group_by' => 'primerApellido',
            ))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAreaServicioDiagnostico', null, array('label' => 'Modalidad'), null, array(
                                                                            'expanded' => false,
                                                                            'multiple' => true,
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerModalidadesSolicitadasPreinscripcion($estabLocal);
                                                                                                },
                                                                            'group_by' => 'idAtencion',
            ))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idTecnologoRealiza', null, array('label' => 'Realizó'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerTecnologosExaminantes($estabLocal);
                                                                                                },/** VERIFICAR TODOS ESTOS METODOS, PARA PODER USARLOS VARIAS VECES */
                                                                            'group_by' => 'idTipoEmpleado',
            ))/** A ESTE METODO LE HACE FALTA VALIDAR Q TAMBIEN 'stdiag' SEA AQUI */
            ->add('idLectura.idEmpleado', null, array('label' => 'Interpretó'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerRadiologosInterpretes($estabLocal);
                                                                                                },/** Cambiar método */
                                                                            'group_by' => 'idTipoEmpleado',
            ))
            ->add('idEstadoDiagnostico', null, array('label' => 'Estado'))
            ->add('idEmpleado', null, array('label' => 'Transcribió'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerTranscriptoresDiagnosticos($estabLocal);
                                                                                                },/** Cambiar método */
                                                                            'group_by' => 'idTipoEmpleado',
            ))
//            ->add('fechaTranscrito', null, array('label' => 'Transcrito en'))//http://stackoverflow.com/questions/19592923/symfony2-and-sonata-admin-bundle-filter-timestamp-displayed-as-date
//            ->add('fechaCorregido', null, array('label' => 'Corregido en'))//http://taskodelic.com/sonata-admin-bundle-date-picker-range-filter/
//            ->add('fechaAprobado', null, array('label' => 'Aprobado en'))//http://validity.thatscaptaintoyou.com/
            ->add('idLectura.correlativo', null, array('label' => 'Correlativo'))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        
        $sessionUser = $securityContext->getToken()->getUser();
        
        $formMapper
            ->tab('Transcripción de resultados')
                ->with('Diagnóstico', array('class' => 'col-md-12', 'description' => 'Transcripción de lectura radiológica'))->end()
            ->end()
            ->tab('Datos Generales')
                ->with('Generales', array('class' => 'diag-with-datos-generales-generales col-md-6', 'description' => 'Información general de la transcripción'))->end()
                ->with('Detalles e incidencias', array('class' => 'col-md-6', 'description' => 'Detalles complementarios e incidencias ocurridas'))->end()
            ->end()
        ;
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $formMapper
            ->tab('Transcripción de resultados')
                ->with('Diagnóstico')
                    ->add('hallazgos', 'textarea', array(
							'label' => 'Hallazgos',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '7',
									'style' => 'resize:none',
									'placeholder' => 'Hallazgos encontrados en el estudio',
									
									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-message' => '15 caracteres mínimo',
							)
                    ))
                    ->add('conclusion', 'textarea', array(
							'label' => 'Conclusión',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '4',
									'style' => 'resize:none',
									'placeholder' => 'Conclusión del diagnóstico radiológico del estudio',
									
									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-message' => '15 caracteres mínimo',
							)
                    ))
                    ->add('recomendaciones', 'textarea', array(
							'label' => 'Recomendaciones',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '5',
									'maxlength' => '255',
									'style' => 'resize:none',
									'placeholder' => 'Recomendaciones al paciente y al médico referente',
									
									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',
							)
                    ))
                    ->add('idEstadoDiagnostico', null, array(
							'label' => 'Estado',
							'mapped' => false,
							'required' => false,
							'empty_value' => '',
							'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('incidencias', 'textarea', array(
							'label' => 'Incidencias ocurridas',
							'mapped' => false,
							'required' => false,
							'attr' => array('rows' => '3',
									'maxlength' => '255',
									'style' => 'resize:none',
									'placeholder' => 'Incidencias ocurridas durante la transcripción',
									
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
            ->end()
            ->tab('Datos Generales')
                ->with('Generales')
                    ->add('idLectura', 'sonata_type_model_hidden')
                    ->add('idEmpleado', null, array(
							'label' => 'Transcribe',
							'mapped' => false,
							'required' => false,
							'empty_value' => '',
							'query_builder' => function(EntityRepository $er) use ($estabLocal) {
										return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(1, 4, 5));
									    },
							'group_by' => 'idTipoEmpleado',
							'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                ->end()
                ->with('Detalles e incidencias')
                    ->add('errores', 'textarea', array(
							'label' => 'Errores encontrados',
							'required' => false,
							'attr' => array('rows' => '5',
//                                                                            'class'=>'ckeditor',
									'style' => 'resize:none',
									'placeholder' => 'Errores encontrados en la transcripción'),
                    ))
                ->end()
            ->end()
        ;
    }
    
    public function prePersist($diagnostico) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $diagnostico->setIdUserReg($user);
        $diagnostico->setFechaRegistro(new \DateTime('now'));
        $diagnostico = $this->fechaHoraPorEstado($diagnostico);
        
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
	
        $estabLocal = $sessionUser->getIdEstablecimiento();
        
        if ( in_array($diagnostico->getIdEstadoDiagnostico()->getCodigo(), array('APR')) &&
	    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') || $securityContext->isGranted('ROLE_ADMIN')))
        {
	    $diagnostico->setIdRadiologoAprueba($user->getIdEmpleado());
        } else {
	    $diagnostico->setIdRadiologoAprueba($diagnostico->getIdLectura()->getIdRadiologoDesignadoAprobacion()
		? $diagnostico->getIdLectura()->getIdRadiologoDesignadoAprobacion() : $diagnostico->getIdLectura()->getIdEmpleado());
        }
    }
    
    public function preUpdate($diagnostico) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $diagnostico->setIdUserMod($user);
        $diagnostico = $this->fechaHoraPorEstado($diagnostico);
        
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
	
        $estabLocal = $sessionUser->getIdEstablecimiento();
        
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        
        $diagnosticoOriginal = $em->getUnitOfWork()->getOriginalEntityData($diagnostico);
        
        if ( in_array($diagnostico->getIdEstadoDiagnostico()->getCodigo(), array('APR')) &&
	    ($diagnostico->getIdEstadoDiagnostico()->getCodigo() != $diagnosticoOriginal['idEstadoDiagnostico']->getCodigo() ) &&
	    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') || $securityContext->isGranted('ROLE_ADMIN')))
        {
	    $diagnostico->setIdRadiologoAprueba($user->getIdEmpleado());
        }
    }
    
    protected function fechaHoraPorEstado($diagnostico) {
        $estado = $diagnostico->getIdEstadoDiagnostico()->getCodigo();
        
        switch ($estado) {
            case 'TRC':
                $diagnostico->setFechaTranscrito(new \DateTime('now'));
                break;
            case 'CRG':
                $diagnostico->setFechaCorregido(new \DateTime('now'));
                break;
            case 'APR':
                $diagnostico->setFechaAprobado(new \DateTime('now'));
                break;
            default:
                break;
        }
        return $diagnostico;
    }
    
    public function validate(ErrorElement $errorElement, $diagnostico) {
        $errorElement
            ->with('idEmpleado') //Transcriptor: médico o transcriptor
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Quién es el Médico|Transcriptor que  transcribe el diagnóstico?'))
            ->end()
            ->with('idEstadoDiagnostico') //Estado del diagnóstico
                ->assertNotBlank(array('message' => 'Seleccione el estado en que se encuentra el diagnóstico?'))
            ->end();
        
        //Lectura que se transcribe
        if (!$diagnostico->getIdLectura()) {
            $errorElement->with('incidencias')
                            ->addViolation('No ha seleccionado la lectura que se transcribe, vuelva a la lista y seleccione una para transcribir')
                        ->end();
        }
        //Impugnación de transcripción
        if ($diagnostico->getIdEstadoDiagnostico() && in_array($diagnostico->getIdEstadoDiagnostico()->getId(), array(4))) {
            $errorElement
                ->with('errores') //Errores encontrados
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío si ha impugnado la transcripción'))
                    ->assertNotBlank(array('message' => 'Debe escribir qué errores encontró en la transcripción para que puedan ser corregidos'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                ->end();
        } else {
            $errorElement
                ->with('errores')
                    ->assertBlank(array('message' => 'No debe llenar este campo si no ha impugnado la transcripción'))
                ->end();
        }
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance(); //estab proveniente de idEstabDiagnosticante || pendL
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        if (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ACL', 'MED', 'TRY'))) {
	    $instance->setIdEmpleado($sessionUser->getIdEmpleado());
	}
        
        //Estado inicial del diagnóstico
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico');
        $estadoReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico', '2');
        $instance->setIdEstadoDiagnostico($estadoReference);
        
        //Lectura padre
        if ($this->hasRequest()) {
            $lectura = $this->getRequest()->get('__lct', null);
            if ($lectura !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgLectura');
                $lecturaReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgLectura', $lectura);
                $instance->setIdLectura($lecturaReference);
            }
        }
        
        return $instance;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();
        
        $query->innerJoin($query->getRootAlias() . '.idLectura', 'lctr')
                        ->andWhere('lctr.idEstablecimiento = :id_est_diag')
                        ->setParameter('id_est_diag', $estabLocal);
        
        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:RyxDiagnosticoRadiologicoAdmin:diag_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:RyxDiagnosticoRadiologicoAdmin:diag_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:RyxDiagnosticoRadiologicoAdmin:diag_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}