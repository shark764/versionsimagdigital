/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * el Boton agregar emergencia, debe llamar a un modal que agregue un mini form de img_solicitud_estudio, con lo basico, en este el expediente aun no existe posiblemente, por lo q se
 * hara con uno ficticio
 * 
 * Este mismo form es el q se llenara cuando haya una emergencia desde servicio de emergencias
 */

/*
 * para casos de referidos sera otro modal parecido con los estab de los que refieren, bm, isss, etc
 * sera tambien un mini form especial de img_solicitud_estudio
 */

/*
 * en los typeahead, debe estar los botones, crear solicitud, solicitud rapida
 *
 * se necesita typeahead en form de lectura y prz
 */

/*
 * ******************************************************************************
 * EVENTS SORTABLE AND DRAGGABLE
 * ******************************************************************************
 * http://www.webdeveloper.com/forum/showthread.php?310265-JQuery-Sortable-over-Bootstrap-rows
 * http://www.bootply.com/nNMron0Him
 * http://www.bootply.com/dUQiGMggWO
 * http://jsfiddle.net/myimedia/Sm4EK/
 * http://www.bootply.com/AbpZnertbs
 * http://www.bootply.com/dUQiGMggWO#
 */


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
use Minsal\SimagdBundle\Entity\SecHojacontinuacion;
use Minsal\SimagdBundle\Entity\SecExamenfisico;
use Minsal\SimagdBundle\Entity\SecSolicitudestudios;
use Minsal\SimagdBundle\Entity\SecDetallesolicitudestudios;

class ImgSolicitudEstudioAdmin extends Admin
{
    protected $baseRouteName = 'simagd_solicitud_estudio';
    protected $baseRoutePattern = 'preinscripcion';
    
    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('citar');
        $collection->add('solicitarDiag');
        $collection->add('valorCampoCompuesto', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('extractCamposComponentes', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('cargarDatosPorFiltro', null, [], ['_method' => 'POST'], ['expose' => true]);
    }
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idExpediente', null, array('label' => 'Paciente'))
            ->add('idEmpleado', null, array('label' => 'Creada por'))
            ->add('idEstablecimientoReferido', null, array('label' => 'Referido a'))
            ->add('idAreaServicioDiagnostico', null, array('label' => 'Modalidad'), null, array('expanded' => false, 'multiple' => true))
            ->add('idEstablecimientoDiagnosticante', null, array('label' => 'Diagnosticar en'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, array('route' => array('name' => 'show')))
            ->addIdentifier('idExpediente.idPaciente', null, array('label' => 'Paciente', 'route' => array('name' => 'show')))
            ->addIdentifier('idEstablecimientoReferido', null, array('label' => 'Referido a', 'route' => array('name' => 'show')))
            ->addIdentifier('idAreaServicioDiagnostico', null, array('label' => 'Modalidad', 'route' => array('name' => 'show')))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'citar' => array('template' => 'MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_citar_action.html.twig'),
                    'solicitarDiag' => array('template' => 'MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_solicitarDiag_action.html.twig')
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Solicitud de estudio')
                ->with('Datos generales', array('class' => 'col-md-6', 'description' => 'Esta sección contiene datos generales de la preinscripción'))->end()
                ->with('Paciente que preinscribe', array('class' => 'col-md-6'))->end()
            ->end()
            ->tab('Detalles clínicos')
                ->with('Detalles clínicos', array('class' => 'col-md-6'))->end()
            ->end()
            ->tab('Configuración')
                ->with('Referir paciente', array('class' => 'col-md-6'))->end()
                ->with('Estudio solicitado', array('class' => 'col-md-12'))->end()
                ->with('Solicitar diagnóstico', array('class' => 'col-md-6'))->end()
            ->end()
            ->tab('Otros detalles')
                ->with('Detalles complementarios', array('class' => 'col-md-6'))->end()
            ->end()
        ;
        
        $estab2 = '26';
        
        $formMapper
            ->tab('Solicitud de estudio')
                ->with('Datos generales')
                    ->add('idAreaAtencion', 'entity', array(
                                                    'label' => 'Procedencia',
                                                    'required' => false,
                                                    'mapped' => false,
                                                    'class' => 'MinsalSiapsBundle:CtlAreaAtencion',
                                                    'property' => 'nombre',
                                                    'query_builder' => function(EntityRepository $er ) use ( $estab2 ) {
                                                                            return $er->createQueryBuilder('ar')
                                                                                            ->innerJoin('MinsalSiapsBundle:MntAreaModEstab', 'ams', 
                                                                                                    \Doctrine\ORM\Query\Expr\Join::WITH, 
                                                                                                    'ar.id = ams.idAreaAtencion')
                                                                                            ->where('ams.idEstablecimiento = :id_est')
                                                                                            ->setParameter('id_est', $estab2)
                                                                                            ->orderBy('ar.nombre')
                                                                                            ->distinct();
                                                                        },
                                                    'empty_value' => '',
                                                    'help' => 'Area de atención de la que procede',
                                                    'attr' => array('style' => 'width: auto')
                    ))
                    ->add('idAtencion', 'entity', array(
                                                    'label' => 'Servicio clínico',
                                                    'required' => false, //PONER TODOS LOS QUE DEBEN SER TRUE/FALSE **************************
                                                    'mapped' => false,
                                                    'class' => 'MinsalSiapsBundle:CtlAtencion',
                                                    'property' => 'nombre',
                                                    'empty_value' => '', //REVISAR TODOS LOS ADMIN PARA QUE QUEDEN BIEN LOS REQUIRED, SIZE, ETC
                                                    'help' => 'Servicio de atención clínica que refiere',
                                                    'attr' => array('style' => 'width: auto')
                    ))
                    ->add('idEmpleado', null, array(
                                                    'label' => 'Preinscribe',
                                                    'required' => true,
                                                    //'class' => 'MinsalSimagdBundle:MntEmpleado',
                                                    'empty_value' => '',                                    //ATENCIONES PUEDEN ESTAR EN 2 AREAS, PERO EL EMPLEADO NO
                                                    'help' => 'Médico que preinscribe',                     //ACTIVAR CAMBIAR EMPLEADO AL ON CHANGE DE AREA TAMBIEN
                                                    'attr' => array('style' => 'width: auto')               //UTILIZAR AMBOS SELECT PARA FILTRAR
                    ))
                    ->add('idAtenAreaModEstab', 'sonata_type_model_hidden')
                    ->add('idHistorialClinico', 'sonata_type_model_hidden', array(
                                                    'mapped' => false,
                                                    'class' => 'MinsalSeguimientoBundle:SecHistorialClinico'
                    ))
                ->end()
                ->with('Paciente que preinscribe')
                    ->add('idExpediente', null, array( // *********************** CONSULTAR PACIENTES CON EXPEDIENTE EN ESTE ESTABLECIMIENTO, SINO PUEDEN APARECER REPETIDOS
                                                    'label' => 'Paciente',     //  ************** EXPEDIENTE -> ESTABLECIMIENTO, SOLO PACIENTES Q ESTEN REGISTRADOS AQUI
                                                    'required' => true,
                                                    'empty_value' => '',
                                                    'attr' => array('class' => 'inputPrueba') //PARA HACER MAS PEQUEÑOS LOS SELECT
                    ))
                    ->add('pacienteAmbulatorio', null, array('label' => 'Paciente Ambulatorio'))
                    ->add('numeroSala', null, array('label' => 'Sala'))
                    ->add('numeroCama', null, array('label' => 'Cama'))
                    ->add('pacienteDesconocido', null, array('label' => 'Paciente desconocido'))
                    ->add('pesoActualLb', null, array('label' => 'Peso actual ( lb )'))
                    ->add('pesoActualKg', null, array('label' => 'Peso actual ( kg )'))
                    ->add('tallaPaciente', null, array('label' => 'Talla actual ( m )'))
                ->end()
            ->end()
            ->tab('Detalles clínicos')
                ->with('Detalles clínicos')
                    ->add('datosClinicos', 'textarea', array(
                                                    'label' => 'Datos clínicos',
                                                    'help' => '150 carácteres hábiles',
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none', //ESTO DEBERIA IR EN CSS
                                                                    'class' => 'inputPrueba', //PARA HACER MAS PEQUEÑOS LOS INPUT, REVISAR
                                                                    'maxlength' => '150',
                                                                    'placeholder' => 'Escriba los datos clínicos'),
                    ))
                    ->add('consultaPor', 'textarea', array(
                                                    'label' => 'Consulta por',
                                                    'help' => '255 carácteres hábiles',
                                                    'required' => false,
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none',
                                                                    'maxlength' => '255',
                                                                    'placeholder' => 'Escriba el motivo de consulta'),
                    ))
                    ->add('estadoClinico', null, array(
                                                    'label' => 'Estado clínico',
                                                    'attr' => array('maxlength' => '50',
                                                                    'placeholder' => 'Estado de salud en que se encuentra el paciente'),
                    ))
                    ->add('hipotesisDiagnostica', 'textarea', array(
                                                    'label' => 'Hipótesis diagnóstica',
                                                    'help' => '100 carácteres hábiles',
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none',
                                                                    'maxlength' => '100',
                                                                    'placeholder' => 'Escriba la hipótesis diagóstica del paciente'),
                    ))
                    ->add('investigando', 'textarea', array(
                                                    'label' => 'investigando',
                                                    'help' => '150 carácteres hábiles',
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none',
                                                                    'maxlength' => '150',
                                                                    'placeholder' => 'Escriba que desea investigando con el estudio'),
                    ))
                    ->add('antecedentesClinicosRelevantes', 'textarea', array(
                                                    'label' => 'Antecedentes clínicos relevantes',
                                                    'required' => false,
                                                    'attr' => array('rows' => '4',
                                                                    'style' => 'resize:none',
                                                                    'placeholder' => 'Escriba antecedentes clínicos relevantes del paciente'),
                    ))
                    ->add('justificacionMedica', 'textarea', array(
                                                    'label' => 'Justificación médica',
                                                    'help' => '150 carácteres hábiles',
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none',
                                                                    'maxlength' => '150',
                                                                    'placeholder' => 'Escriba la justificación médica de la solicitud'),
                    ))
                ->end()
            ->end()
            ->tab('Configuración')
                ->with('Referir paciente') //SI SE MARCA, HABILITAR EL SELECT, SI DESMARCA, DESHABILITAR Y COLOCAR EL ESTABLECIMIENTO DE NUEVO AL PREDEFINIDO = SERVICIO LOCAL
                    ->add('referirPaciente', null, array('label' => 'Referir a externo'))
                    ->add('idEstablecimientoReferido', null, array(
                                                    'label' => 'Referir paciente hacia',
                                                    'required' => true,
                                                    'empty_value' => '',
                                                    'help' => 'Referir a servicio local, o hacia otro establecimiento',
                                                    'attr' => array('class' => 'inputPrueba') //PARA HACER MAS PEQUEÑOS LOS SELECT
                    ))
                    ->add('justificacionReferencia', 'textarea', array(
                                                    'label' => 'Justifique la referencia',
                                                    'help' => '255 carácteres hábiles',
                                                    'required' => false,
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none',
                                                                    'maxlength' => '255',
                                                                    'placeholder' => 'Escriba por qué se necesita referir al paciente'),
                    ))
                ->end()
                ->with('Estudio solicitado') //CONSULTAR LAS QUE SEAN PARA SEXO DEL PACIENTE O NULL = AMBOS
                    ->add('idAreaServicioDiagnostico', null, array(
                                                    'label' => 'Modalidad',
                                                    'required' => true,
                                                    'class' => 'MinsalSiapsBundle:CtlAreaServicioDiagnostico',   //ESTAS DEBEN SER CON EL REFERIDO POR DEFECTO
                                                    'property' => 'nombrearea',                             //MISMO TRUCO DE FILTRARLAS EN CLIENTE CON EL Q ESTE DE REFERIDO
                                                    'query_builder' => function(EntityRepository $er ) use ( $estab2 ) {
                                                                            return $er->createQueryBuilder('m')
                                                                                            ->innerJoin('MinsalSimagdBundle:MntAreaExamenEstablecimiento', 'mr', 
                                                                                                    \Doctrine\ORM\Query\Expr\Join::WITH, 
                                                                                                    'm.id = mr.idAreaServicioDiagnostico')
                                                                                            ->where('mr.idEstablecimiento = :id_est')
                                                                                            ->setParameter('id_est', $estab2)
                                                                                            ->orderBy('m.nombrearea')
                                                                                            ->distinct();
                                                                        },
                                                    'empty_value' => '', //REVISAR SI ES NECESARIO Q SEA REQUIRED TRUE
                                                    'help' => 'Realizables en el establecimiento al que refiere',
                                                    'attr' => array('class' => 'inputPrueba'),
                    ))
                    ->add('solicitudEstudioProyeccion', 'sonata_type_collection', array(
                                                    'label' =>'Proyecciones solicitadas', 
                                                    'help' => 'Seleccione las exploraciones de la modalidad que preinscribe'),// 'cascade_validation' => true,),
                                                    array('edit' => 'inline', 'inline' => 'table'))
                ->end()
                ->with('Solicitar diagnóstico')
                    ->add('requiereDiagnostico', null, array('label' => 'Estudio requiere diagnóstico radiológico'))
                    ->add('idEstablecimientoDiagnosticante', null, array(
                                                    'label' => 'Se solicita se diagnostique en',
                                                    'help' => 'Si no marca diagnóstico este campo no se utilizará',
                                                    'attr' => array('style' => 'width: auto')
                    ))
                    ->add('justificacionDiagnostico', 'textarea', array(
                                                    'label' => 'Justifique por qué requiere diagnóstico',
                                                    'help' => '255 carácteres hábiles',
                                                    'required' => false,
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none',
                                                                    'maxlength' => '255',
                                                                    'placeholder' => 'Requerido si solicita diagnóstico, caso contrario deje vacío este campo'),
                    ))
                ->end()
            ->end()
            ->tab('Otros detalles')
                ->with('Detalles complementarios')
                    ->add('fechaProximaConsulta', 'datetime', array(
                                                    'label' => 'Próxima consulta',
                                                    'help' => 'Formato: << yyyy-MM-dd >>',
                                                    'widget' => 'single_text',
                                                    'format' => 'yyyy-MM-dd',
                                                    'attr' => array('readonly' => 'readonly'),
                    ))
                    ->add('requiereCita', null, array('label' => 'Solicitud de estudio requiere cita de Imagenología'))
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
            ->with('Formulario de Solicitud de Estudio')->end()
            ->with('Datos generales')
                ->add('id')
                ->add('idEmpleado', null, array('label' => 'Preinscribió', 'route' => array('name' => 'show')))
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
            ->with('Detalles clínicos')
                ->add('datosClinicos', null, array('label' => 'Datos clínicos'))
                ->add('consultaPor', null, array('label' => 'Consulta por'))
                ->add('estadoClinico', null, array('label' => 'Estado clínico'))
                ->add('hipotesisDiagnostica', null, array('label' => 'Hipótesis diagnóstica'))
                ->add('investigando', null, array('label' => 'investigando'))
                ->add('antecedentesClinicosRelevantes', null, array('label' => 'Antecedentes clínicos relevantes'))
                ->add('justificacionMedica', null, array('label' => 'Justificación médica'))
            ->end()
            ->with('Referir al paciente')
                ->add('referirPaciente', null, array('label' => 'Referido'))
                ->add('idEstablecimientoReferido', null, array('label' => 'Paciente referido hacia', 'route' => array('name' => 'show')))
                ->add('justificacionReferencia', null, array('label' => 'Justificación de referencia'))                
            ->end()
            ->with('Proyecciones Solicitadas')
                ->add('idAreaServicioDiagnostico', null, array('label' => 'Modalidad', 'route' => array('name' => 'show')))
                ->add('solicitudEstudioProyeccion', 'sonata_type_collection', array('label' => 'Proyección', 'route' => array('name' => 'show')),
                                                                            array('edit' => 'inline', 'inline' => 'table'))
            ->end()
            ->with('Solicitud de diagnóstico')
                ->add('requiereDiagnostico', null, array('label' => 'Estudio requiere diagnóstico radiológico'))
                ->add('idEstablecimientoDiagnosticante', null, array('label' => 'Diagnóstico solicitado en', 'route' => array('name' => 'show')))
                ->add('justificacionDiagnostico', null, array('label' => 'Justificación de diagnóstico'))
            ->end()
            ->with('Otros detalles')
                ->add('fechaProximaConsulta', null, array('label' => 'Próxima consulta', 'pattern' => 'EEEE d \'de\' MMMM, yyyy',))
                ->add('requiereCita', null, array('label' => 'Requiere cita de Imagenología'))
            ->end()
        ;
    }
    
    public function prePersist($preinscripcion) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $preinscripcion->setIdUserReg($user);
        $preinscripcion->setFechaCreacion(new \DateTime('now'));
        
        foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
            $solicitudEstudioProyeccion->setIdSolicitudEstudio($preinscripcion);
        }
        
    }
    
    public function preUpdate($preinscripcion) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $preinscripcion->setIdUserMod($user);
        
        foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
            $solicitudEstudioProyeccion->setIdSolicitudEstudio($preinscripcion);
        }
        $preinscripcion->setSolicitudEstudioProyeccion($preinscripcion->getSolicitudEstudioProyeccion());
        
    }
    
    public function validate(ErrorElement $errorElement, $preinscripcion) {
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
            ->end()
            ->with('hipotesisDiagnostica') //Hipótesis diagnóstica
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                ->assertNotBlank(array('message' => 'Introduzca su hipótesis diagnóstica'))
                ->assertLength(array('min' => 10, 'minMessage' => 'Este campo al menos debe contener 10 caracteres'))
            ->end()
            ->with('investigando') //Investigación
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                ->assertNotBlank(array('message' => '¿Qué desea investigando con el estudio que solicita?'))
                ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
            ->end()
            ->with('justificacionMedica') //Justificación médica de la preinscripción
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                ->assertNotBlank(array('message' => 'Debe justificar por qué refiere el paciente hacia el servicio de Imagenología'))
                ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
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
        if(!$preinscripcion->getIdAtenAreaModEstab()) {
            $errorElement
                ->with('idAreaAtencion')
                    ->addViolation('No puede determinarse la procedencia de esta preinscripción')
                ->end()
                ->with('idAtencion')
                    ->addViolation('No puede determinarse la procedencia de esta preinscripción')
                ->end();
        }
        
        //Area de Atención --> AtenAreaModEstab
        if(is_null($this->getForm()->get('idAreaAtencion')->getData())) { $errorElement->with ('idAreaAtencion')
                                                                        ->addViolation ('¿De qué área proviene el paciente?')->end(); }
        //Atención --> AtenAreaModEstab
        if(is_null($this->getForm()->get('idAtencion')->getData())) { $errorElement->with ('idAtencion')
                                                                        ->addViolation ('¿Qué servicio de atención refiere?')->end(); }

        //Referir paciente
        if($preinscripcion->getIdEstablecimientoReferido()) {
            if($preinscripcion->getIdEstablecimientoReferido()->getId() != '26') {
                $errorElement
                    ->with('referirPaciente')
                        ->assertNotBlank(array('message' => 'Si será referido a externo, por favor marque esta opción'))
                    ->end()
                    ->with('justificacionReferencia')
                        ->assertNotBlank(array('message' => 'Debe justificar por qué se refiere el paciente hacia: '
                            . $preinscripcion->getIdEstablecimientoReferido()))
                        ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                    ->end();
                if(!$preinscripcion->getReferirPaciente()) {
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
                if($preinscripcion->getReferirPaciente()) {
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
            if($preinscripcion->getReferirPaciente()) {
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
        if($preinscripcion->getIdEstablecimientoDiagnosticante()) {
            $errorElement
                ->with('requiereDiagnostico')
                    ->assertNotBlank(array('message' => 'Si solicita diagnóstico, por favor marque esta opción'))
                ->end()
                ->with('justificacionDiagnostico')
                    ->assertNotBlank(array('message' => 'Debe justificar por qué necesita que se diagnóstique el estudio en: '
                        . $preinscripcion->getIdEstablecimientoDiagnosticante()))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                ->end();
            if(!$preinscripcion->getRequiereDiagnostico()) {
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
            if($preinscripcion->getRequiereDiagnostico()) {
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
        if($preinscripcion->getFechaProximaConsulta()) {
            if(($preinscripcion->getFechaProximaConsulta()->format('Y-m-d') < (new \DateTime('now'))->format('Y-m-d'))) {
                $errorElement->with('fechaProximaConsulta')
                                ->addViolation('La fecha suministrada no es válida, la fecha actual es: ' . (new \DateTime('now'))->format('Y-m-d'))
                            ->end();
            }
        }
        
        // ***************** Proyecciones seleccionadas --> solicitudEstudioProyeccion incrustada ******************
        $repite = $vacios = 0;  //Controla si se repite al menos una exploracion
        $elementRepite = null;  //Que exploracion se repite
        foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $solicitudEstudioProyeccion)  {
            $count = 0;  //Controla cuantas veces se ha seleccionado la proyección recorrida por el foreach
            $unique = $solicitudEstudioProyeccion->getIdProyeccionSolicitada();  //Id de la proyección a buscar
            if(!$unique) { $vacios++; }
            foreach ($preinscripcion->getSolicitudEstudioProyeccion() as $uniqueSolicitudEstudioProyeccion)  {
                if($unique && $unique == $uniqueSolicitudEstudioProyeccion->getIdProyeccionSolicitada()) { $count++; }  //Se encuentra, aumentar contador de coincidencias
            }
            if($count > 1)  {
                $repite++;  //Se encuentra mas de una vez, aumentar contador de repeticiones
                $elementRepite = $solicitudEstudioProyeccion->getIdProyeccionSolicitada()->getNombre();  //Guardar la Proyección que se repite
            }
        }
        if($repite > 0)  {
            $errorElement->with('idAreaServicioDiagnostico')  //Se repite al menos 1, marcar la modalidad padre de las exploraciones
                            ->addViolation('Intenta seleccionar: <<' . $elementRepite . '>> mas de una vez')  //Mensaje con la proyección que se repite
                        ->end();
        }
        if($vacios > 0)  {
            $errorElement->with('idAreaServicioDiagnostico')  //Existen elementos agregados sin proyección
                            ->addViolation('Ha agregado ' . $vacios . ' elementos sin proyección seleccionada')  //Mensaje con el número de vacíos
                        ->end();
        }
        
    }
    
    public function postPersist($preinscripcion) {
//        $messageReg = '';
        $errorReg = false;
        
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        $historialClinico = $this->getForm()->get('idHistorialClinico')->getData() ? 
                                                        $this->getForm()->get('idHistorialClinico')->getData() : null;
        
        $atenAreaEstab = $preinscripcion->getIdAtenAreaModEstab();
        
        if(!$historialClinico && in_array($atenAreaEstab->getIdAreaModEstab()->getIdAreaAtencion()->getId(), array(2, 3))) {
                        //********** No existe el historial, insertar uno con piloto "V" ***********
            /** SecHistorialClinico */
            $historialClinicoV = new SecHistorialClinico();
            $historialClinicoV->setDatosclinicos(trim($preinscripcion->getDatosclinicos()));
            $historialClinicoV->setFechaconsulta(new \DateTime('now'));
            $historialClinicoV->setIdsubservicio($atenAreaEstab);
            $historialClinicoV->setIdusuarioreg($user);
            $historialClinicoV->setFechahorareg(new \DateTime('now'));
            $historialClinicoV->setPiloto('V');
//            $historialClinicoV->setIpaddress('');   //Hace falta ver como sacar esta IP ------>
            $historialClinicoV->setIdestablecimiento($atenAreaEstab->getIdEstablecimiento());
            $historialClinicoV->setIdNumeroExpediente($preinscripcion->getIdExpediente());
            $historialClinicoV->setIdEmpleado($preinscripcion->getIdEmpleado());
            $this->getModelManager()->create($historialClinicoV);
            
            /** SecHojacontinuacion */
            $hojaContinuacion = new SecHojacontinuacion();
            $hojaContinuacion->setIdhistorialclinico($historialClinicoV);
            $hojaContinuacion->setMotivoconsulta($preinscripcion->getConsultaPor() ? trim($preinscripcion->getConsultaPor()) : 'Otros motivos');
            $hojaContinuacion->setEvolucionpaciente($preinscripcion->getAntecedentesClinicosRelevantes() ?
                                                                trim($preinscripcion->getAntecedentesClinicosRelevantes()) : 'Sin evolución');
            $this->getModelManager()->create($hojaContinuacion);
            
            /** SecExamenfisico */
            $examenFisico = new SecExamenfisico();
            $examenFisico->setIdhistorialclinico($historialClinicoV);
            if($preinscripcion->getPesoActualLb()) { $examenFisico->setPeso(round($preinscripcion->getPesoActualLb())); }
            $examenFisico->setTalla($preinscripcion->getTallaPaciente());
            $this->getModelManager()->create($examenFisico);
            
            //Asignar Historial Clínico
            $historialClinico = $historialClinicoV;
            
            $messageReg = 'La acción realizada generó la creación implicita de un registro de Historial Clínico virtual.';
            $this->getRequest()->getSession()->getFlashBag()->add("warning", $messageReg);
        }
        
        /** SecSolicitudestudios */
        //Obtener el id del servicio de apoyo de Imagenología
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAtencion');
        $imagenologiaReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAtencion', '97');

        //Obtener estado exclusivo para Imagenología
        $estadoImg = $this->getModelManager()->findOneBy('MinsalSiapsBundle:CtlEstadoServicioApoyo', 
                                                        array('idestado' => 'PR', 'idAtencion' => '97'));

        $solicitudEstudios = new SecSolicitudestudios();
        $solicitudEstudios->setIdHistorialClinico($historialClinico);
        $solicitudEstudios->setFechaSolicitud(new \DateTime('now'));
        $solicitudEstudios->setIdusuarioreg($user);
        $solicitudEstudios->setFechahorareg(new \DateTime('now'));
        $solicitudEstudios->setIdAtencion($imagenologiaReference);
        $solicitudEstudios->setCama($preinscripcion->getNumeroCama());
        $solicitudEstudios->setIdEstablecimiento($atenAreaEstab->getIdEstablecimiento());
        $solicitudEstudios->setIdExpediente($preinscripcion->getIdExpediente());
        $solicitudEstudios->setEstado($estadoImg);  //ESTADO EXCLUSIVO PARA REGISTROS DE IMAGENOLOGIA
        $this->getModelManager()->create($solicitudEstudios);

        /** Preinscripcion */
        //Insertar clave de SecSolicitudestudios
        $preinscripcion->setIdSolicitudestudios($solicitudEstudios);
        $this->getModelManager()->update($preinscripcion);
        
        $messageReg = 'La solicitud de estudio imagenológico se insertó con éxito.';
        $this->getRequest()->getSession()->getFlashBag()->add("success", $messageReg);
    }
    
    public function postUpdate($preinscripcion) {
        
    }

    public function getNewInstance() {
        $instance = parent::getNewInstance();
        
        //Estado clínico
        $instance->setEstadoClinico('Paciente con signos vitales estables');
        
        //Próxima consulta
        $instance->setFechaProximaConsulta((new \DateTime('now'))->modify('+8 day'));
        
        //Área de atención por defecto
        //SACAR ESTO DE LO NORMAL, C.EXT, MEDICINA
        //SACAR UN ATEN_AREA DEL EMPLEADO_ESP_ESTAB
        //SI USER->EMPLEADO = MEDICO, PONERLO, HACER LO MISMO EN JQUERY
        //SACAR ESTO DEL USER --> ID_EMPLEADO Y ID_ESTAB, CON ESE SACAR EL ID_ATEN_AREA_MOD_ESTAB X DEFECTO
        //$em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\CtlAreaAtencion');
        //$estadoReference = $em->getReference('Minsal\SimagdBundle\Entity\CtlAreaAtencion', '1');
        //$instance->setIdEstadoCita($estadoReference);
        
        //Establecimiento al que se refirió
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlEstablecimiento');
        $estabReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', '26');
        $instance->setIdEstablecimientoReferido($estabReference);
        
        //Modalidad por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico');
        $modReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', '1');
        $instance->setIdAreaServicioDiagnostico($modReference);
        
        //Extracción de valores de Historial Clínico
        if ($this->hasRequest()) {
            $expediente = $this->getRequest()->get('expediente', null);
            if ($expediente !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\MntExpediente');
                $expedienteReference = $em->getReference('Minsal\SiapsBundle\Entity\MntExpediente', $expediente);
                $instance->setIdExpediente($expedienteReference);
            }
            
            $historialClinico = $this->getRequest()->get('historialClinico', null);
            if ($historialClinico !== null) {
                $historialClinicoR = $this->getModelManager()->find('MinsalSeguimientoBundle:SecHistorialClinico', $historialClinico);
                if($historialClinicoR) {
                    $instance->setDatosClinicos($historialClinicoR->getDatosclinicos() ? trim($historialClinicoR->getDatosclinicos()) : '');
                    $instance->setIdAtenAreaModEstab($historialClinicoR->getIdsubservicio());
                    $instance->setIdEmpleado($historialClinicoR->getIdEmpleado());
                    if($historialClinicoR->getIdNumeroExpediente()) { $instance->setIdExpediente($historialClinicoR->getIdNumeroExpediente()); }

                    $hojaContinuacion = $this->getModelManager()->findOneBy('MinsalSimagdBundle:SecHojacontinuacion', 
                                                                        array('idhistorialclinico' => $historialClinicoR->getId()));
                    if($hojaContinuacion) {
                        $instance->setConsultaPor($hojaContinuacion->getMotivoconsulta() ? trim($hojaContinuacion->getMotivoconsulta()) : '');
                    }
                    
                    $examenFisico = $this->getModelManager()->findOneBy('MinsalSimagdBundle:SecExamenfisico', 
                                                                        array('idhistorialclinico' => $historialClinicoR->getId()));
                    if($examenFisico) {
                        if($examenFisico->getPeso()) { $instance->setPesoActualLb(number_format(floatval($examenFisico->getPeso()), 2)); }
                        if($instance->getPesoActualLb()) { $instance->setPesoActualKg(round($instance->getPesoActualLb() / 2.20462262, 2)); }
                        if($examenFisico->getTalla()) { $instance->setTallaPaciente(round($examenFisico->getTalla(), 2)); }
                    }
                }
            }
        }
        
        return $instance;
    }
    
    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);
//        $query->andWhere(
//            $query->expr()->eq($query->getRootAlias() . '.idEstablecimientoReferido', ':id_est_ref')
//        );
//        $query->setParameter('id_est_ref', '26');
//        $query->andWhere(
//            $query->expr()->eq($query->getRootAlias() . '.idAtenAreaModEstab', ':id_atn')
//        );
//        $query->setParameter('id_atn', '11');
        
        $query->innerJoin('MinsalSiapsBundle:MntAtenAreaModEstab', 'aams',
                            \Doctrine\ORM\Query\Expr\Join::WITH,
                            'aams.id = ' . $query->getRootAlias() . '.idAtenAreaModEstab');
        $query->andWhere($query->expr()->orx(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimientoReferido', ':id_est_ref'),
                            $query->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ))
                        ->setParameter('id_est_ref', '26')
                        ->setParameter('id_est', '26');
        
        return $query;
    }
    
}