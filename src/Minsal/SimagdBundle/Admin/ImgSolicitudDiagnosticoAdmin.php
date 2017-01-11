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

class ImgSolicitudDiagnosticoAdmin extends Admin
{
    protected $baseRouteName = 'simagd_solicitud_diagnostico';
    protected $baseRoutePattern = 'rayos-x-solicitud-diagnostico';
    
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'desc',
        '_sort_by' => 'fechaCreacion'
   );
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        $collection->remove('delete');
        $collection->add('crearSolicitudDiag', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarSolicitudDiag', null, [], ['_method' => 'POST'], ['expose' => true]);
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
    protected function configureFormFields(FormMapper $formMapper)  //CREAR BOTON SOL.DIAG, PARA LLAMAR DESDE CONSULTA DE ESTUDIOS O DE PREINSCRIPCIONES, EN EL MISMO CONTROLLER
    {
        $subject = $this->getSubject();
        
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        
        $sessionUser = $securityContext->getToken()->getUser();
        
        $formMapper
            ->tab('Solicitud')
                ->with('Solicitar diagnóstico', array('class' => 'soldiag-with-solicitud-solicitar-diagnostico col-md-6', 'description' => 'Datos generales de la solicitud'))->end()
                ->with('Solicitar en', array('class' => 'soldiag-with-solicitud-solicitar-en col-md-6', 'description' => 'Destino de la solicitud'))->end()
            ->end()
            ->tab('Detalles')
                ->with('Detalles complementarios', array('class' => 'col-md-6', 'description' => 'Detalles agregados'))->end()
            ->end()
        ;
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $preinscripcion = $this->getRequest()->get('preinscripcion', null);
        if ($subject->getIdSolicitudEstudio() ) { $preinscripcion = $subject->getIdSolicitudEstudio()->getId(); }

        $setLockSolicitarEn = false;

        if ($this->id($subject)) {

            $setLockSolicitarEn = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                        ->existeLecturaPorPreinscripcion($subject->getIdSolicitudEstudio()->getId());

        }
        
        $formMapper
            ->tab('Solicitud')
                ->with('Solicitar diagnóstico')
                    ->add('idSolicitudEstudio', 'sonata_type_model_hidden', array(), array('admin_code' => 'minsal_simagd.admin.img_solicitud_estudio'))
                    ->add('idEstudio', 'sonata_type_model_hidden')
                    ->add('idEmpleado', null, array(
                                                        'label' => 'Solicitante',
                                                        'required' => true,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosPorTipoOperaciones($estabLocal, array(1, 2, 4));
                                                                            },
                                                        'group_by' => 'idTipoEmpleado',
                                                        'help' => 'Médico que solicita el diagnóstico',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('fechaProximaConsulta', 'datetime', array(
                                                        'label' => 'Próxima consulta',
                                                        'help' => 'Formato: << yyyy-MM-dd >>',
                                                        'widget' => 'single_text',
                                                        'format' => 'yyyy-MM-dd',
                                                        'attr' => array('readonly' => 'readonly'),
                    ))
                ->end()
                ->with('Solicitar en')
                    ->add('solicitudRemota', null, array('label' => 'Solicitar a externo'))
                    ->add('idEstablecimientoSolicitado', null, array(
                                                        'label' => 'Se solicita se diagnostique en',
                                                        'required' => true,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er ) use ($preinscripcion ) {
                                                                                if ($preinscripcion !== null) {
                                                                                    return $this->exploracionesSolicitadas($preinscripcion);
                                                                                }
                                                                                else {
                                                                                    return $er->obtenerEstabParaRefDiag( 'idEstablecimientoDiagnosticante');
                                                                                }
                                                                            },
                                                        'group_by' => 'idTipoEstablecimiento',
                                                        'help' => 'Seleccione en dónde desea se diagnostique su estudio',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('justificacion', 'textarea', array(
                                                        'label' => 'Justificación',
                                                        //'required' => false,
                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '2',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Justifique por qué desea diagnóstico del estudio (Añada si desea diagnóstico externo)'),
                    ))
                    ->add('setLockSolicitarEn', 'hidden', array(
                                                    'mapped' => false,
                                                    'data' => $setLockSolicitarEn
                    ))
                ->end()
            ->end()
            ->tab('Detalles')
                ->with('Detalles complementarios')
                    ->add('observaciones', 'textarea', array(
                                                        'label' => 'Observaciones',
                                                        'required' => false,
                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '3',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Digite sus observaciones'),
                    ))
                ->end()
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Solicitud de estudio')
                ->add('idSolicitudEstudio.idAtenAreaModEstab.idEstablecimiento', null, array('label' => 'Preinscrito en', 'route' => array('name' => 'show')))
                ->add('idSolicitudEstudio.idEmpleado', null, array('label' => 'Preinscribió', 'route' => array('name' => 'show')))
                ->add('idSolicitudEstudio.idExpediente.idPaciente', null, array('label' => 'Paciente', 'route' => array('name' => 'show')))
                ->add('idSolicitudEstudio.idAtenAreaModEstab.idAreaModEstab.idAreaAtencion', null, array('label' => 'Procedencia', 'route' => array('name' => 'show')))
                ->add('idSolicitudEstudio.idAtenAreaModEstab.idAtencion', null, array('label' => 'Servicio clínico', 'route' => array('name' => 'show')))
                ->add('idSolicitudEstudio.idAreaServicioDiagnostico', null, array('label' => 'Modalidad', 'route' => array('name' => 'show')))
                ->add('idSolicitudEstudio.fechaCreacion', null, array('label' => 'Registrada', 'pattern' => 'EEEE d \'de\' MMMM, yyyy h:mm:ss a',))
            ->end()
            ->with('Estudio')
                ->add('idEstudio.idProcedimientoRealizado.idTecnologoRealiza', null, array('label' => 'Realizó estudio', 'route' => array('name' => 'show')))
                ->add('idEstudio.idProcedimientoRealizado.idEstadoProcedimientoRealizado', null, array('label' => 'Estado', 'route' => array('name' => 'show')))
                ->add('idEstudio.idProcedimientoRealizado.fechaAlmacenado', null, array('label' => 'Se almacenó', 'pattern' => 'EEEE d \'de\' MMMM, yyyy h:mm:ss a'))
                ->add('idEstudio.idEstablecimiento', null, array('label' => 'Realizado en', 'route' => array('name' => 'show')))
            ->end()
            ->with('Solicitud de diagnóstico')
                ->add('id')
                ->add('idEmpleado', null, array('label' => 'Solicitó', 'route' => array('name' => 'show')))
                ->add('idUserReg.idEmpleado', null, array('label' => 'Usuario que registró', 'route' => array('name' => 'show')))
                ->add('solicitudRemota', null, array('label' => 'Solicitud a externo'))
                ->add('idEstablecimientoSolicitado', null, array('label' => 'Se solicita se diagnostique en', 'route' => array('name' => 'show')))
                ->add('fechaCreacion', null, array('label' => 'Se creó', 'pattern' => 'EEEE d \'de\' MMMM, yyyy h:mm:ss a',))
                ->add('justificacion', null, array('label' => 'Justificación'))
                ->add('fechaProximaConsulta', null, array('label' => 'Próxima consulta', 'pattern' => 'EEEE d \'de\' MMMM, yyyy',))
            ->end()
            ->with('Detalles')
                ->add('observaciones', null, array('label' => 'Observaciones'))
            ->end()
        ;
    }
    
    public function prePersist($sol_diagnostico) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $sol_diagnostico->setIdUserReg($user);
        $sol_diagnostico->setFechaCreacion(new \DateTime('now'));
    }
    
    public function validate(ErrorElement $errorElement, $sol_diagnostico) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        //Solicitud de estudio del estudio
        if (!$sol_diagnostico->getIdSolicitudEstudio()) {
            $errorElement->with('observaciones')
                            ->addViolation('No ha seleccionado la preinscripción, vuelva a la lista y seleccione una para solicitar diagnóstico')
                        ->end();
        }
        //Estudio del paciente
        if (!$sol_diagnostico->getIdEstudio()) {
            $errorElement->with('observaciones')
                            ->addViolation('No ha seleccionado el estudio para el que necesita diagnóstico')
                        ->end();
        }
        
        $errorElement
            ->with('idEmpleado') //Solicitante
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Qué médico solicita el diagnóstico para el estudio?'))
            ->end()
            ->with('idEstablecimientoSolicitado') //Establecimiento que diagnosticará
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Dónde necesita que se diagnostique el estudio?'))
            ->end()
            ->with('justificacion') //Justificación
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                ->assertNotBlank(array('message' => 'Debe justificar por qué solicita diagnóstico (Se recomienda agregar por qué solicita a externo, si es el caso)'))
                ->assertLength(array('min' => 15, 'minMessage' => 'Este campo no puede contener menos de 15 caracteres'))
            ->end()
            ->with('fechaProximaConsulta') //Próxima consulta con solicitante
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                ->assertNotBlank(array('message' => 'Se necesita conocer este dato en el servicio de Imagenología'))
            ->end();
        
        //Diagnóstico remoto
        if ($sol_diagnostico->getSolicitudRemota()) {
            if ($sol_diagnostico->getIdEstablecimientoSolicitado() && $sol_diagnostico->getIdEstablecimientoSolicitado()->getId() == $user->getIdEstablecimiento()->getId()) {
                $errorElement
                    ->with('solicitudRemota')
                        ->assertFalse(array())
                    ->end()
                    ->with('idEstablecimientoSolicitado')
                        ->addViolation('Ha marcado la opción \'Solicitud a externo\' pero no ha cambiado el establecimiento de destino')
                        ->addViolation('Desmarque esta opción si no solicitará diagnóstico externo')
                    ->end();
            }
        }
        else {
            if ($sol_diagnostico->getIdEstablecimientoSolicitado() && $sol_diagnostico->getIdEstablecimientoSolicitado()->getId() != $user->getIdEstablecimiento()->getId()) {
                $errorElement
                    ->with('solicitudRemota')
                        ->assertTrue(array())
                    ->end()
                    ->with('idEstablecimientoSolicitado')
                        ->addViolation('Debe marcar la opción \'Solicitud a externo\' si solicitará diagnóstico a externo')
                    ->end();
            }
        }
        
        //Próxima consulta
        if ($sol_diagnostico->getFechaProximaConsulta()) {
            if (!$sol_diagnostico->getId() && $sol_diagnostico->getFechaProximaConsulta()->format('Y-m-d') < (new \DateTime('now'))->format('Y-m-d')) {
                $errorElement
                    ->with('fechaProximaConsulta')
                        ->addViolation('La fecha suministrada no es válida, la fecha actual es: ' . (new \DateTime('now'))->format('Y-m-d'))
                    ->end();
            }
            if ($sol_diagnostico->getId() && $sol_diagnostico->getFechaProximaConsulta()->format('Y-m-d') < $sol_diagnostico->getFechaCreacion()->format('Y-m-d')) {
                $errorElement->with('fechaProximaConsulta')
                                ->addViolation('La fecha suministrada no es válida, la fecha de solicitud fue: ' . $sol_diagnostico->getFechaCreacion()->format('Y-m-d'))
                            ->end();
            }
        }
    }
    
    public function getNewInstance() {
        $instance = parent::getNewInstance();
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        //Próxima consulta
        $instance->setFechaProximaConsulta((new \DateTime('now'))->modify('+8 day'));
        
        //http://habrahabr.ru/post/143413/
        //http://blog.webdevilopers.net/populate-resp-set-default-values-on-form-resp-object-or-instance-in-sonataadminbundle/
        //Establecimiento solicitado
        //----> x defecto donde esta el paciente, o donde se hizo el estudio
        $estabLocal = $sessionUser->getIdEstablecimiento();
//                                    ->getUser()->getIdEstablecimiento()->getId();
//        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlEstablecimiento');
//        $estabReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $estabLocal);
        $instance->setIdEstablecimientoSolicitado($estabLocal);
        
        //Solicitud de estudio | Estudio
        if ($this->hasRequest()) {
            $preinscripcion = $this->getRequest()->get('preinscripcion', null);
            if ($preinscripcion !== null) {
                $preinscripcionSolicitada = $this->getModelManager()->find('MinsalSimagdBundle:ImgSolicitudEstudio', $preinscripcion);
                $instance->setIdSolicitudEstudio($preinscripcionSolicitada);
                $instance->setIdEmpleado($preinscripcionSolicitada->getIdEmpleado());
                $instance->setFechaProximaConsulta($preinscripcionSolicitada->getFechaProximaConsulta());
            }
            
            $estudio = $this->getRequest()->get('estudio', null);
            if ($estudio !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgEstudioPaciente');
                $estudioReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgEstudioPaciente', $estudio);
                $instance->setIdEstudio($estudioReference);
            }
        }
        
        return $instance;
    }
    
    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);
        
        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();
        
        $query->innerJoin($query->getRootAlias() . '.idSolicitudEstudio', 'prc')
                        ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                        ->andWhere($query->expr()->orx(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimientoSolicitado', ':id_est_diag'),
                            $query->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ))
                        ->setParameter('id_est_diag', $estabLocal)
                        ->setParameter('id_est', $estabLocal);
        
        return $query;
    }
    
    public function exploracionesSolicitadas($preinscripcionRequest)
    {
        $preinscripcionSolicitada = $this->getModelManager()->find('MinsalSimagdBundle:ImgSolicitudEstudio', $preinscripcionRequest);
        
        $explArray = array();
        foreach ($preinscripcionSolicitada->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
            $explArray[] = $solicitudEstudioProyeccion->getIdProyeccionSolicitada()->getId();
        }
        
        return $this->getConfigurationPool()->getContainer()->get('doctrine')
                                ->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')
                                            ->obtenerEstabDiagnosticantes($preinscripcionSolicitada->getIdAreaServicioDiagnostico()->getId(), $explArray, 'query');
    }
    
    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
}
