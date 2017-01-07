<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImgSolicitudEstudioComplementarioAdmin extends Admin
{
    protected $baseRouteName = 'simagd_solicitud_estudio_complementario';
    protected $baseRoutePattern = 'rayos-x-solicitud-estudio-complementario';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        $collection->add('listarSolicitudesEstudioComplementario', null, [], [], ['expose' => true]);
        $collection->remove('delete');
        $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('cambiarPrioridadAtencionSolicitud', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        $collection->add('show', 'consultar', [], [], ['expose' => true]);
        $collection->add('crearSolicitudEstudioComplementarioFastFormat', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarSolicitudEstudioComplementarioFastFormat', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_show_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
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
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');

        $sessionUser = $securityContext->getToken()->getUser();

        $formMapper
	    // ->tab('Solicitud', array('class' => 'tab-complementario-rx', 'tab_icon' => 'glyphicon glyphicon-inbox'))
                ->with('Datos generales', array('class' => 'col-md-12', 'description' => ''))->end()
// 	    ->end()
//            ->tab('Datos Generales')
//                ->with('Generales', array('class' => 'diag-with-datos-generales-generales col-md-12', 'description' => 'Información general de la transcripción'))->end()
                ->with('Estudio requerido', array('class' => 'col-md-12', 'description' => ''))->end()
                ->with('Indicaciones del Médico radiólogo', array('class' => 'col-md-12', 'description' => ''))->end()
	    // ->end()
        ;

        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();

        $formMapper
	    // ->tab('Solicitud')
		->with('Datos generales')
		    ->add('idSolicitudEstudio', 'sonata_type_model_hidden', array('attr' => array('style' => 'min-width: 100%; max-width: 100%;')), array('admin_code' => 'minsal_simagd.admin.img_solicitud_estudio'))
		    ->add('idEstablecimientoSolicitado', 'sonata_type_model_hidden', array('attr' => array('style' => 'min-width: 100%; max-width: 100%;')))
		    ->add('idEstudioPadre', 'sonata_type_model_hidden', array('attr' => array('style' => 'min-width: 100%; max-width: 100%;')))
		    ->add('idRadiologoSolicita', null, array(//QUIZA FILTRADOS QUE TENGAN UN 'EES' CON 'AAMS' CON ESTAB_LOCAL
						    'label' => 'Solicita',
						    'required' => true,
						    'query_builder' => function(EntityRepository $er) use ($estabLocal) {
									    return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(4, 5));
									},
						    'group_by' => 'idTipoEmpleado',
						    'empty_value' => '',                                    //ATENCIONES PUEDEN ESTAR EN 2 AREAS, PERO EL EMPLEADO NO
	//                                                        'help' => 'Médico que preinscribe',                     //ACTIVAR CAMBIAR EMPLEADO AL ON CHANGE DE AREA TAMBIEN
						    'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
								    'data-apply-formatter' => 'user',

								    'data-fv-notempty' => 'true',
								    'data-fv-notempty-message' => 'Seleccione un elemento',
						    )
		    ))
		    ->add('idPrioridadAtencion', null, array(//QUIZA FILTRADOS QUE TENGAN UN 'EES' CON 'AAMS' CON ESTAB_LOCAL
						    'label' => 'Prioridad necesitada',
						    'required' => false,
						    'empty_value' => '',
						    'query_builder' => function(EntityRepository $er) use ($estabLocal) {
									    return $er->obtenerPrioridadesAtencionV2('query');
									},
	//                                                        'help' => 'Médico que preinscribe',                     //ACTIVAR CAMBIAR EMPLEADO AL ON CHANGE DE AREA TAMBIEN
						    'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
								    'data-apply-formatter' => 'prAtn',
						    )               //UTILIZAR AMBOS SELECT PARA FILTRAR
		    ))
		    ->add('justificacion', 'textarea', array(
						    'label' => 'Justifique la solicitud',
    //                                                        'help' => '255 carácteres hábiles',
						    'required' => false,
						    'attr' => array('rows' => '3',
								    'style' => 'resize:none',
								    'placeholder' => 'Digite la razón de la solicitud del estudio complementario',

								    'data-fv-stringlength' => 'true',
								    'data-fv-stringlength-min' => '15',
								    'data-fv-stringlength-message' => '15 caracteres mínimo',

								    'data-fv-regexp' => 'true',
								    'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
								    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',

								    'data-fv-callback' => 'true',
								    'data-fv-callback-message' => 'Formulario no puede ser enviado',
								    'data-fv-callback-callback' => 'checkSolcmplParentData',
						    )
		    ))
		->end()
		->with('Estudio requerido') //CONSULTAR LAS QUE SEAN PARA SEXO DEL PACIENTE O NULL = AMBOS
		    ->add('idAreaServicioDiagnostico', null, array(//SI ESTAS QUEDAN CON EL LOCAL, OCURRIRÁ EL ERROR DE UNA MODALIDAD QUE NO EXISTAN EN LOCAL, "ESTE VALOR NO ES VALIDO"
                                                    'label' => 'Modalidad de diagnóstico por imagen',//MEJOR SOLO FILTRARLAS POR '97'
                                                    'required' => true,
//                                                    'class' => 'MinsalSiapsBundle:CtlAreaServicioDiagnostico',   //ESTAS DEBEN SER CON EL REFERIDO POR DEFECTO
//                                                         'property' => 'nombrearea',                             //MISMO TRUCO DE FILTRARLAS EN CLIENTE CON EL Q ESTE DE REFERIDO
                                                    'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                            return $er->obtenerModalidadesRealizablesLocalV2($estabLocal, '97', 'query');
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
//		    ->add('solicitudEstudioComplementarioProyeccion', 'sonata_type_collection', array(
//						    'label' =>'Proyecciones requeridas'),
//    //                                                        'help' => 'Seleccione las proyecciones de la modalidad que preinscribe'),// 'cascade_validation' => true,),
//						    array('edit' => 'inline', 'inline' => 'table'))
                    ->add('solicitudEstudioComplementarioProyeccion', 'entity', array(
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
		->end()
		->with('Indicaciones del Médico radiólogo')
		    ->add('indicacionesEstudio', 'textarea', array(
						    'label' => 'Indicaciones para la realización del estudio',
						    'required' => false,
						    'attr' => array('rows' => '4',
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

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
//        $instance = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario();

        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        //Establecimiento al que se refirirá
        $estabLocal = $sessionUser->getIdEstablecimiento();
        $instance->setIdEstablecimientoSolicitado($estabLocal);

        //Modalidad por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico');
        $modReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', '13');
        $instance->setIdAreaServicioDiagnostico($modReference);

        //Prioridad por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion');
        $prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', '4');
        $instance->setIdPrioridadAtencion($prioridadReference);

        if ( in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY')) ) {
	    $instance->setIdRadiologoSolicita($sessionUser->getIdEmpleado());
	}

        //Extracción de valores de Request
        if ($this->hasRequest()) {
            $solicitud = $this->getRequest()->get('__prc', null);
            if ($solicitud !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgSolicitudEstudio');
                $solicitudReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgSolicitudEstudio', $solicitud);
                $instance->setIdSolicitudEstudio($solicitudReference);
            }

            $estudioP = $this->getRequest()->get('__est', null);
            if ($estudioP !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgEstudioPaciente');
                $estudioPReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgEstudioPaciente', $estudioP);
                $instance->setIdEstudioPadre($estudioPReference);
            }
        }

        return $instance;
    }

    public function prePersist($solEstCmpl) {
//        $solEstCmpl = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario();

        $solEstCmpl->setIdUserReg($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser());
        $solEstCmpl->setFechaSolicitud(new \DateTime('now'));

//        foreach ($solEstCmpl->getSolicitudEstudioComplementarioProyeccion() as $solEstCmplProyeccion)  {
//            $solEstCmplProyeccion->setIdSolicitudEstudioComplementario($solEstCmpl);
//        }

        if (!$solEstCmpl->getIdPrioridadAtencion()) {
	    //Prioridad por defecto
	    $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion');
	    $prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', '4');
	    $solEstCmpl->setIdPrioridadAtencion($prioridadReference);
	}

    }

    public function preUpdate($solEstCmpl) {
//        $solEstCmpl = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario();

//        foreach ($solEstCmpl->getSolicitudEstudioComplementarioProyeccion() as $solEstCmplProyeccion)  {
//            $solEstCmplProyeccion->setIdSolicitudEstudioComplementario($solEstCmpl);
//        }

        if (!$solEstCmpl->getIdPrioridadAtencion()) {
	    //Prioridad por defecto
	    $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion');
	    $prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', '4');
	    $solEstCmpl->setIdPrioridadAtencion($prioridadReference);
	}

    }
}
