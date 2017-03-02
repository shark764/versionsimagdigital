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

class RyxCitaProgramadaAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_cita';
    protected $baseRoutePattern = 'rayos-x-citas';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('getEvents', null, [], [], ['expose' => true]);
        $collection->add('espaciosReservados', null, [], [], ['expose' => true]);
        $collection->add('confirmarCita', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('cancelarCita', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        // $collection->add('citaCancelable', null, [], [], ['expose' => true]);
        // $collection->add('calendario', null, [], [], ['expose' => true]);
        $collection->add('list', 'agenda', [], [], ['expose' => true]);
        $collection->add('nuevaCita', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('actualizarCita', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('getPatients', null, [], [], ['expose' => true]);
        $collection->add('editarCita', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('loadPendingPatients', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->remove('delete');
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('print', 'imprimir-comprobante', [], [], ['expose' => true]);
        $collection->add('generateCalendar', 'generar-calendario', [], [], ['expose' => true]);
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
        
        $formMapper
            ->tab('Programación de cita')
                ->with('Formulario de Citación', array('class' => 'cit-with-programacion-formulario-citacion col-md-6', 'description' => 'Información general de creación de cita'))->end()
                ->with('Programación', array('class' => 'cit-with-programacion-programacion col-md-6', 'description' => 'Programación de cita para paciente preinscrito'))->end()
            ->end()
            ->tab('Incidencias')
                ->with('Incidencias', array('class' => 'cit-with-incidencias-incidencias col-md-6', 'description' => 'Incidencias ocurridas en la programación'))->end()
                ->with('Autorización de estudio', array('class' => 'cit-with-incidencias-autorizacion col-md-6', 'description' => 'Autorización por responsable del paciente'))->end()
            ->end()
        ;
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();

        $setLockProgramacion = $setLockEstado = false;

        if ($this->id($subject)) {

            $setLockProgramacion = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                        ->existeRegistroPorPreinscripcion($subject->getIdSolicitudEstudio()->getId(), 'prz', 'ImgProcedimientoRealizado');

            $setLockEstado = $this->getConfigurationPool()->getContainer()->get('doctrine')
                                            ->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                        ->estudioPreinscritoFueAlmacenado($subject->getIdSolicitudEstudio()->getId());

        }
        
        $formMapper
            ->tab('Programación de cita')
                ->with('Formulario de Citación')
                    ->add('idSolicitudEstudio', 'sonata_type_model_hidden', array(), array('admin_code' => 'minsal_simagd.admin.img_solicitud_estudio'))
                    ->add('idEmpleado', null, array(
                                                        'label' => 'Recepcionista',
                                                        'required' => true,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(1, 2, 6, 7));
                                                                            },
                                                        'help' => 'Encargado de programar esta cita',
                                                        'group_by' => 'idTipoEmpleado',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('idEstadoCita', null, array(
                                                        'label' => 'Estado',
                                                        'required' => true,
//                                                        'empty_value' => '',
                                                        'expanded' => true,
                                                        'multiple' => false,
                                                        'help' => 'Estado en que se encuentra la cita',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
    //                ->add('idEstablecimiento')
                    ->add('idConfiguracionAgenda', 'sonata_type_model_hidden')
                    ->add('setLockEstado', 'hidden', array(
                                                    'mapped' => false,
                                                    'data' => $setLockEstado
                    ))
                ->end()
                ->with('Programación') //AÑADIR CON JQUERY UN LINK A LA PAR QUE ABRA LOS PARAMETROS Y LOS CUPOS
                    ->add('fechaProgramada', 'datetime', array(//FECHA LIMITE, PROXIMA CONSULTA
                                                        'label' => 'Programar para',
                                                        'help' => 'Formato: << yyyy-MM-dd HH:mm A/PM >>',
                                                        'widget' => 'single_text',
                                                        'format' => 'yyyy-MM-dd HH:mm',                                                
                                                        'attr' => array('readonly' => 'readonly'),
                    ))
                    ->add('idTecnologoProgramado', null, array(
                                                        'label' => 'Tecnólogo que atenderá',
                                                        'help' => 'Para modalidades que necesiten esta especificación',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(4, 5));
                                                                            },
                                                        'group_by' => 'idTipoEmpleado',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('setLockProgramacion', 'hidden', array(
                                                    'mapped' => false,
                                                    'data' => $setLockProgramacion
                    ))
                ->end()
            ->end()
            ->tab('Incidencias')
                ->with('Incidencias')
                    ->add('observaciones', 'textarea', array(
                                                        'label' => 'Observaciones',                                                
                                                        'required' => false,
                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '2', 
                                                                        'style' => 'resize:none', 
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Observaciones'),
                    ))
                    ->add('incidencias', 'textarea', array(
                                                        'label' => 'Incidencias ocurridas',                                                
                                                        'required' => false,
                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '2', 
                                                                        'style' => 'resize:none', 
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Incidencias ocurridas en la programación de la cita'),
                    ))
                    ->add('razonAnulada', 'textarea', array(
                                                        'label' => 'Justifique la anulación de la cita',                                                
                                                        'required' => false,
                                                        'help' => '150 carácteres hábiles',
                                                        'attr' => array('rows' => '2', 
                                                                        'style' => 'resize:none', 
                                                                        'maxlength' => '150',
                                                                        'placeholder' => 'Complete este campo en caso de anulación de la cita'),
                    ))
                ->end()
                ->with('Autorización de estudio')
                    ->add('necesitaAutorizacion', null, array('label' => 'Necesita ser autorizada'))
                    ->add('citaAutorizada', null, array('label' => 'Se autoriza'))
                    ->add('idResponsableAutoriza', null, array(
                                                        'label' => 'Responsable por el paciente',
                                                        'help' => 'Seleccione la persona que autoriza realizar el estudio',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('nombreResponsableAutoriza', null, array('label' => 'Nombre de responsable que autorizada'))
                ->end()
            ->end()
        ;
    }
    
    public function prePersist($cita)
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $cita->setIdUserPrg($user);
        $cita->setFechaCreacion(new \DateTime('now'));
        
        if (in_array($cita->getIdEstadoCita()->getCodigo(), array('CNF'))) { $cita->setFechaConfirmacion(new \DateTime('now')); }
        
        if ((!$cita->getColor() || $cita->getColor() == '#ffffff') && $cita->getIdSolicitudEstudio()) {
            
            $areaAtn_id = $cita->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion()->getId();
            if ($areaAtn_id == 2 ) {
                $cita->setColor('#e0533d');
            }
            elseif ($areaAtn_id == 3 ) {
                $cita->setColor('#16677d');
            }
            else {
                $cita->setColor('#183f52');
            }
        }
        if (!$cita->getColor()) {
	       $cita->setColor('#183f52');
        }
    }
    
    public function preUpdate($cita)
    {
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        
        $citaOriginal = $em->getUnitOfWork()->getOriginalEntityData($cita);
        // $fechaProgramadaOriginal = $citaOriginal['fechaProgramada'];
        
        $originalFechaHoraIni = $citaOriginal['fechaHoraInicio'];
        $originalFechaHoraFin = $citaOriginal['fechaHoraFin'];
        
        if ($originalFechaHoraIni != $cita->getFechaHoraInicio()
		|| $originalFechaHoraFin != $cita->getFechaHoraFin()) {    //Cita ha sido reprogramada
            $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
            $cita->setIdUserReprg($user);
            $cita->setReprogramada(true);
            $cita->setFechaHoraInicioAnterior($originalFechaHoraIni);
            $cita->setFechaHoraFinAnterior($originalFechaHoraFin);
            $cita->setFechaReprogramacion(new \DateTime('now'));
        }
        
        //Cita se ha confirmado
        $originalEstadoCita = $citaOriginal['idEstadoCita']->getCodigo();
        $estadoCita = $cita->getIdEstadoCita()->getCodigo();
        if (($estadoCita != $originalEstadoCita) && in_array($estadoCita, array('CNF'))) { $cita->setFechaConfirmacion(new \DateTime('now')); }
        
        if ((!$cita->getColor() || $cita->getColor() == '#ffffff') && $cita->getIdSolicitudEstudio()) {
            
            $areaAtn_id = $cita->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion()->getId();
            if ($areaAtn_id == 2 ) {
                $cita->setColor('#e0533d');
            }
            elseif ($areaAtn_id == 3 ) {
                $cita->setColor('#16677d');
            }
            else {
                $cita->setColor('#183f52');
            }
        }
        if (!$cita->getColor()) {
	       $cita->setColor('#183f52');
        }
    }

    public function validate(ErrorElement $errorElement, $cita)
    {
        $errorElement
            ->with('idEmpleado') //Solicitante
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Qué empleado programa la cita?'))
            ->end()
            ->with('idEstadoCita') //Estado de cita
                ->assertNotBlank(array('message' => 'Seleccione el estado en que se encuentra la cita'))
            ->end()
            ->with('fechaProgramada') //Fecha de cita
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                ->assertNotBlank(array('message' => 'Debe programar una fecha y hora para la cita del paciente'))
            ->end()
            ->with('incidencias') //Incidencias Cita
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false, 
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('observaciones') //Observaciones Cita
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false, 
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('razonAnulada') //Razon Anulada
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false, 
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end();
        
        //Anulación de cita
        if ($cita->getIdEstadoCita() && in_array($cita->getIdEstadoCita()->getId(), array(5, 6))) {
            $errorElement
                ->with('razonAnulada') //Razón de anular la cita
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío si anulará la cita'))
                    ->assertNotBlank(array('message' => 'Debe justificar por qué anula/cancela la cita'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                ->end();
        }
        else {
            $errorElement
                ->with('razonAnulada')
                    ->assertBlank(array('message' => 'No necesita llenar este campo si no anulará la cita'))
                ->end();
        }
        //Solicitud de estudio a la que se da cita
        if (!$cita->getIdSolicitudEstudio()) {
            $errorElement->with('incidencias')
                            ->addViolation('No ha seleccionado la preinscripción, vuelva a la lista y seleccione una para citar')
                        ->end();
        }
        //Establecimiento al que se refirió
        if (!$cita->getIdEstablecimiento()) {
            $errorElement->with('incidencias')
                            ->addViolation('La cita no puede agregarse a este establecimiento, verifique que esté seleccionada una preinscripción')
                        ->end();
        }
        //Parámetros para programar cita
        if (!$cita->getIdParametroCitacion()) {
            $errorElement->with('incidencias')
                            ->addViolation('No se ha podido obtener los parámetros para citar este estudio')
                        ->end();
        }
        
        //Fecha programada debe ser mayor a actual
        if ($cita->getFechaProgramada()) {//si es inserción no puede ser menor a 'hoy'
            if ( !$cita->getId() && $cita->getFechaProgramada() < new \DateTime('now') ) {//actualización, si se puede, pero no menor a fechaCreacion ni a fechaCreacion
                $errorElement->with('fechaProgramada')//para saber si es actualizacion, probar si hay original data
                                ->addViolation('La fecha suministrada no es válida, la fecha y hora actual es: ' 
                                        . (new \DateTime('now'))->format('Y-m-d H:i A'))
                            ->end();
            }
            if ($cita->getId() && $cita->getFechaProgramada() < $cita->getFechaCreacion() ) {//actualización, si se puede, pero no menor a fechaCreacion ni a fechaCreacion
                $errorElement->with('fechaProgramada')//para saber si es actualizacion, probar si hay original data
                                ->addViolation('La fecha suministrada no es válida, la fecha y hora que se creó esta cita es: ' 
                                        . $cita->getFechaCreacion()->format('Y-m-d H:i A'))
                            ->end();
            }
            //Fecha programada debe ser menor a programada con médico
            if ($cita->getIdSolicitudEstudio()) {
                if ($cita->getFechaProgramada()->format('Y-m-d') >= $cita->getIdSolicitudEstudio()->getFechaProximaConsulta()->format('Y-m-d')) {
                    $errorElement->with('fechaProgramada')
                                    ->addViolation('La fecha suministrada sobrepasa a la próxima consulta con médico preinscriptor: ' 
                                            . $cita->getIdSolicitudEstudio()->getFechaProximaConsulta()->format('Y-m-d'))
                                ->end();
                }
            }
        }
        
        //Autorización de estudio
        if ($cita->getCitaAutorizada()) {
            $errorElement
                ->with('necesitaAutorizacion')
                    ->assertTrue(array())
                ->end()
                ->with('idResponsableAutoriza')
                    ->assertNotBlank(array('message' => 'Ha marcado la opción \'Se autoriza\', pero no ha seleccionado el responsable'))
                ->end()
                ->with('nombreResponsableAutoriza') //Nombre del responsable por el paciente
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío si un responsable autoriza el estudio'))
                    ->assertNotBlank(array('message' => 'Debe escribir el nombre del responsable de autorizar el estudio'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                ->end();
        }
        else {
            $errorElement
                ->with('idResponsableAutoriza')
                    ->assertBlank(array('message' => 'No necesita seleccionar el responsable si no está autorizada'))
                ->end()
                ->with('nombreResponsableAutoriza')
                    ->assertNull(array('message' => 'Este campo debería estar vacío'))
                    ->assertBlank(array('message' => 'No necesita escribir el nombre de la persona si no está autorizada'))
                ->end();
        }
    }

    public function getNewInstance()
    {
        // $instance = parent::getNewInstance();
        $instance = $this->getModelManager()->getModelInstance($this->getClass());
        foreach ($this->getExtensions() as $extension) {
            $extension->alterNewInstance($this, $instance);
        }
         
        //Fecha programada
        // $instance->setFechaProgramada((new \DateTime('now'))->modify('+8 day')); //Verificar la próxima consulta -- dependiendo, dejar la default del construct
        
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        
        $sessionUser = $securityContext->getToken()->getUser();
        
        //Solicitud de estudio
        // if ($this->hasRequest()) {
        //     $preinscripcion = $this->getRequest()->get('preinscripcion', null);
        //     if ($preinscripcion !== null) {
        //         $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgSolicitudEstudio');
        //         $preinscripcionReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgSolicitudEstudio', $preinscripcion);
        //         $instance->setIdSolicitudEstudio($preinscripcionReference);
                
        //         $instance->setIdParametroCitacion($this->obtenerParametroCitacionPorExpl($preinscripcion ));
        //     }
        // }
        
        //Establecimiento al que se refirió
        //Debe venir de la preinscripción
        $estabLocal = $sessionUser->getIdEstablecimiento();
       // $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlEstablecimiento');
       // $estabReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $estab);
        $instance->setIdEstablecimiento($estabLocal);
        
        if (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('CIT', 'ACL')) || $securityContext->isGranted('ROLE_ADMIN') ) {
    	    $instance->setIdEmpleado($sessionUser->getIdEmpleado());
    	}
        
        //Estado inicial de la cita
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlEstadoCita');
        $estadoReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoCita', '1');
        $instance->setIdEstadoCita($estadoReference);
        
        return $instance;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_cit')
                        )
                        ->setParameter('id_est_cit', $estabLocal);
        
        return $query;
    }
    
    public function obtenerParametroCitacionPorExpl($preinscripcionRequest)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
    
        $preinscripcionSolicitada = $this->getModelManager()->find('MinsalSimagdBundle:ImgSolicitudEstudio', $preinscripcionRequest);
        
        $explArray = array();
        foreach ($preinscripcionSolicitada->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
            $explArray[] = $solicitudEstudioProyeccion->getIdProyeccionSolicitada()->getId();
        }
        
        return $this->getConfigurationPool()->getContainer()->get('doctrine')
                                ->getRepository('MinsalSimagdBundle:ImgCtlConfiguracionAgenda')
                                            ->obtenerParametroCitacion($sessionUser->getIdEstablecimiento()->getId(),
									$preinscripcionSolicitada->getIdAreaServicioDiagnostico()->getId(),
									$explArray);
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:RyxCitaProgramadaAdmin:cit_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:RyxCitaProgramadaAdmin:cit_agenda.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:RyxCitaProgramadaAdmin:cit_show.html.twig';
                break;
            // case 'calendario':
            //     return 'MinsalSimagdBundle:RyxCitaProgramadaAdmin:cit_calendario.html.twig';
            //     break;
            case 'agenda':
                return 'MinsalSimagdBundle:RyxCitaProgramadaAdmin:cit_agenda.html.twig';
                break;
            case 'print':
                return 'MinsalSimagdBundle:RyxCitaProgramadaAdmin:cit_print.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}