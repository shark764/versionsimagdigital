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

use Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento;
use Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento;

class ImgCtlProyeccionAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_proyeccion';            //SUSTITUIR METODO GET NEW INSTANCE CON EL ESTABLECIMIENTO YA SETEADO
    protected $baseRoutePattern = 'rayos-x-proyecciones';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->remove('delete');
        $collection->add('agregarEnMiCatalogo', null, [], [], ['expose' => true]);
        $collection->add('obtenerModalidades', null, [], [], ['expose' => true]);
        $collection->add('crearProyeccion', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarProyeccion', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('addToLocalCatalogue', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idExamenServicioDiagnostico', null, array('label' => 'Examen'), null, array('expanded' => false, 'multiple' => true))
            ->add('idExamenServicioDiagnostico.idsexo', null, array('label' => 'Aplica al sexo'))
            ->add('codigo', null, array('label' => 'Código'))
            ->add('tiempoOcupacionSala', null, array('label' => 'Tiempo en sala ( min )'))
            ->add('tiempoMedico', null, array('label' => 'Tiempo de médico  ( min )'))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        //DEJAR AQUI ESTE MAPPED FALSE EN CASO QUE DESEE REGISTRAR LA EXPL Y AGREGARLA DE UN AVE A
        //SU CATALOGO, ES DECIR INGRESAR UN 'EXPLRZ' EN EL POSTPERSIST
        //SE NECESITARA ENTONCES UN CHECKBOX MAPPED FALSE 'AGREGARLA A CATALOGO LOCAL'
        //SE DEBE VALIDAR Q CUANDO SEA 'EDIT' NO VUELVA A INSERTARSE
        //COMO SE ESTA ACTUALIZANDO LA EXPL SE PODRIA HACER UN FIND A VER SI YA ESTA INSERTADO UN EXPLRZ
        //YA QUE EL EXPLRZ SE ACTUALIZA EN SU PROPIO ADMIN
        //SI NO EXISTE NINUN 'MR' CON EL AREA, EXM Y ESTAB.... AGREGARLO TAMBIEN
        //PANTALLA DE CONFIRMACION O DIALOG, SI SE PUEDE, PIDIENDO SI 'HABL' Y 'LECT'
        //VALIDAR BIEN TODOS ESTOS CASOS, EL SEXO, HABL, LECT, EXPLRZ HABL, ATN, ETC
        //EN EL SUBJECT LO DE IS NEW() PARA QUE LO DE AGREGAR AL CATALOGO SOLO APAREZCA UNA VEZ,
        //ES DECIR EL BOTON APAREZCA EN TRUE SOLO CUANDO SE INSERTE

        $formMapper
            ->tab('Proyección')
                ->with('Datos Generales', array('class' => 'col-md-6', 'description' => 'Esta sección contiene las generalidades de la nueva Proyección'))->end()
            ->end()
            ->tab('Detalles')
                ->with('Detalles', array('class' => 'col-md-6', 'description' => 'Sección para ingresar detalles complementarios de la proyección'))->end()
            ->end()
            ->tab('Catálogo Local')
                ->with('Realizable', array('class' => 'col-md-6', 'description' => 'Puede agregar esta nueva proyección a su Catálogo local'))->end()
            ->end()
        ;

        $imgAtn = '97';
        $subject = $this->getSubject();
        $explEditable = false;

        if ($this->id($subject)) {
	    $existsExplrz = $this->getModelManager()->findBy('MinsalSimagdBundle:ImgCtlProyeccionEstablecimiento',
                                            array('idProyeccion' => $subject->getId()));
	    if ( !$existsExplrz ) { $explEditable = true; }
	}
	else {
	    $explEditable = true;
	}

        $formMapper
            ->tab('Proyección')
                ->with('Datos Generales')
                    ->add('nombre', null, array(
                                                            'label' => 'Nombre',
                                                            'help' => 'Nombre con que se identifica a la proyección imagenológica',
                                                            'attr' => array('maxlength' => '100',
                                                                            'placeholder' => 'Nombre de la proyección'),
                    ))
                    ->add('codigo', null, array(
                                                            'label' => 'Código',
                                                            'help' => 'Código único para la proyección',
                                                            'attr' => array('maxlength' => '10',
                                                                            'placeholder' => 'Código de la proyección'),
                    ))
                ->end()
            ->end()
            ->tab('Detalles')
                ->with('Detalles')
                    ->add('tiempoOcupacionSala', null, array('label' => 'Tiempo ocupado en sala  ( min )')) //PONER ESTOS EN HELP PARA DESCRIBIR PARA Q SON
                    ->add('tiempoMedico', null, array('label' => 'Tiempo de médico  ( min )')) //VER ESTOS NOMBRES EN EL SERAM
                    ->add('descripcion', 'textarea', array(
                                                            'label' => 'Descripción',
                                                            'required' => false,
                                                            'attr' => array('rows' => '2',
                                                                            'style' => 'resize:none',
                                                                            'placeholder' => 'Describa en qué consiste la proyección imagenológica'),
                    ))
                    ->add('observaciones', 'textarea', array(
                                                            'label' => 'Observaciones',
                                                            'required' => false,
                                                            'help' => '255 carácteres hábiles',
                                                            'attr' => array('rows' => '2',
                                                                            'style' => 'resize:none',
                                                                            'maxlength' => '255',
                                                                            'placeholder' => 'Observaciones'),
                    ))
                ->end()
            ->end()
            ->tab('Catálogo Local')
                ->with('Realizable')
                    ->add('exploracionRealizable', 'checkbox', array(
                                                            'label' => 'Agregar en catálogo local',
                                                            'required' => false,
                                                            'mapped' => false,
                                                            'data' => $subject->getIdExamenServicioDiagnostico() ? false : true,
                    ))
                    ->add('idAreaServicioDiagnostico', 'entity', array(
                                                            'label' => 'Modalidad',
                                                            'required' => false,
                                                            'mapped' => false,
                                                            'class' => 'MinsalSiapsBundle:CtlAreaServicioDiagnostico',
                                                            'query_builder' => function(EntityRepository $er ) use ($imgAtn ) {
                                                                                    return $er->obtenerModalidadesImagenologia ($imgAtn);
                                                                            },
                                                            'group_by' => 'idAtencion',
                                                            'empty_value' => '',
                                                            'help' => 'Método de diagnóstico por imagen',
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))//Modalidad debe ser filtrada por atn 97
                    ->add('idAreaExamenEstab', 'sonata_type_model_hidden', array(
                                                            'mapped' => false,
                                                            'class' => 'MinsalSiapsBundle:MntAreaExamenEstablecimiento'
                    ))
                ->end()
            ->end()
        ;

        if ($explEditable ) {
            $formMapper
                ->tab('Proyección')
                    ->with('Datos Generales')
                        ->add('idExamenServicioDiagnostico', null, array(
                                                                'label' => 'Examen',
                                                                'required' => true, //PONER TODOS LOS QUE DEBEN SER TRUE/FALSE **************************
                                                                'empty_value' => '', //REVISAR TODOS LOS ADMIN PARA QUE QUEDEN BIEN LOS REQUIRED, SIZE, ETC
                                                                'help' => 'Examen en que se agrupa',
                                                                'attr' => array('style' => 'min-width: 100%; max-width: 100%;'),
                                                                'class' => 'MinsalSiapsBundle:CtlExamenServicioDiagnostico',
                                                                'query_builder' => function(EntityRepository $er ) use ($imgAtn ) {
                                                                                        return $er->obtenerExamenesImagenologia ($imgAtn);
                                                                                },
                                                                'group_by' => 'idsexo',
                        ))//stackoverflow.com/questions/17834765/is-there-any-way-to-determine-current-action-create-or-edit-in-sonata-adminbun
                    ->end()
                ->end()
            ;
        }
    }

    public function prePersist($proyeccion) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $proyeccion->setIdUserReg($user);
        $proyeccion->setFechaHoraReg(new \DateTime('now'));
        if ($proyeccion->getCodigo()) { $proyeccion->setCodigo(strtoupper($proyeccion->getCodigo())); }
    }

    public function preUpdate($proyeccion) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $proyeccion->setIdUserMod($user);
        $proyeccion->setFechaHoraMod(new \DateTime('now'));
        if ($proyeccion->getCodigo()) { $proyeccion->setCodigo(strtoupper($proyeccion->getCodigo())); }
    }

    public function validate(ErrorElement $errorElement, $proyeccion) {
        $errorElement
            ->with('idExamenServicioDiagnostico') //Examen en que se agrupa
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista.'))
                ->assertNotBlank(array('message' => '¿Cuál es el examen que agrupa a esta proyección?'))
            ->end()
            ->with('nombre') //Nombre de la proyección
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío.'))
                ->assertNotBlank(array('message' => 'Introduzca el nombre de la proyección.'))
                ->assertLength(array('min' => 5, 'minMessage' => 'Este campo al menos debe contener 5 caracteres.'))
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('codigo') //Código de la proyección
                ->assertLength(array('min' => 5, 'minMessage' => 'Este campo al menos debe contener 5 caracteres.'))
                ->assertRegex(array('pattern' => "/^[a-zA-Z0-9]+$/", 'match' => true,
                                    'message' => 'Este campo solo acepta caracteres alfanuméricos ( a-z, A-Z, 0-9), sin espacios.'))
            ->end()
            ->with('tiempoOcupacionSala')
                ->assertRange(array('min' => 1, 'minMessage' => 'El tiempo ocupado en sala no puede ser menor a 1 minuto.'))
            ->end()
            ->with('tiempoMedico')
                ->assertRange(array('min' => 1, 'minMessage' => 'El tiempo empleado por tecnólogo|médico no puede ser menor a 1 minuto.'))
            ->end()
            ->with('descripcion') //Descripcion Proyeccion
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('observaciones') //Observaciones Proyeccion
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end();

        //Proyección agregada al catálogo local
        if ($this->getForm()->get('exploracionRealizable')->getData()) {
            //AreaExamenEstab
            if (!$this->getForm()->get('idAreaServicioDiagnostico')->getData()) {
                $errorElement
                    ->with('idAreaServicioDiagnostico')
                        ->addViolation('Ha marcado la opción \'Agregar en catálogo local\', pero no ha seleccionado la Modalidad dentro de la cuál se encuentra la Proyección.')
                    ->end()
                    ->with('exploracionRealizable')
                        ->addViolation('')
                    ->end();
            }
        }
        else {
            if ($this->getForm()->get('idAreaServicioDiagnostico')->getData()) {
                $errorElement
                    ->with('idAreaServicioDiagnostico')
                        ->addViolation('La opción \'Agregar en catálogo local\', no ha sido marcada, si no agregará esta proyección al catálogo por favor desmarque la opción.')
                    ->end()
                    ->with('exploracionRealizable')
                        ->addViolation('')
                    ->end();
            }
        }
    }

    //DIALOG DE CONFIRMACION, ACEPTA, PONER 1 EN UN HIDDEN, CANCELA, PONER 0.... EN POSTPERSIST, ES 1 INSERTAR
    //explrz necesita USERREG Y USERMOD, FECHAHORAREG, FECHAHORAMOD en Diagrama
    public function postPersist($proyeccion) {
//        if ($this->getForm()->get('exploracionRealizable')->getData()) {
//            if ($this->getForm()->get('idAreaServicioDiagnostico')->getData()) {
////                $messageReg = '';
//                $errorReg = false;
//
//                $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
//
//                $areaExmEst = $this->getForm()->get('idAreaExamenEstab')->getData() ?
//                                                            $this->getForm()->get('idAreaExamenEstab')->getData() :null;
//
//                if (!$areaExmEst) {
//                    /** MntAreaExamenEstablecimiento */
//                    $areaExamenEstab = new MntAreaExamenEstablecimiento();
//                    $areaExamenEstab->setIdAreaServicioDiagnostico($this->getForm()->get('idAreaServicioDiagnostico')->getData());
//                    $areaExamenEstab->setIdExamenServicioDiagnostico($proyeccion->getIdExamenServicioDiagnostico());
//                    $areaExamenEstab->setIdEstablecimiento($user->getIdEstablecimiento());
//                    $areaExamenEstab->setIdUsuarioReg($user);
//                    $areaExamenEstab->setFechaHoraReg(new \DateTime('now'));
//                    $this->getModelManager()->create($areaExamenEstab);
//
//                    $areaExmEst = $areaExamenEstab;
//
//                    $messageReg = 'La acción realizada generó la creación implícita de un registro de Modalidad y Examen en el Catálogo local.';
//                    $this->getRequest()->getSession()->getFlashBag()->add("warning", $messageReg);
//                }
//
//                /** ImgCtlProyeccionEstablecimiento */
//                $pryRealizable = new ImgCtlProyeccionEstablecimiento();
//                $pryRealizable->setIdProyeccion($proyeccion);
//                $pryRealizable->setIdAreaExamenEstab($areaExmEst);
//                $pryRealizable->setIdUserReg($user);
//                $pryRealizable->setFechaHoraReg(new \DateTime('now')); //BUSCAR COMO USAR EL CREATE DE CADA ADMIN
//                $this->getModelManager()->create($pryRealizable);
//
//                $messageReg = 'La proyección ha sido agregada al Catálogo local.';
//                $this->getRequest()->getSession()->getFlashBag()->add("success", $messageReg);
//            }
//        }
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}