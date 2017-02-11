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

class ImgNotaDiagnosticoAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_segunda_opinion_medica';
    protected $baseRoutePattern = 'rayos-x-nota';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        // $collection->remove('delete');
        $collection->add('crearNota', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarNota', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Nota al diagnóstico')
                ->with('Nota a agregar', array('class' => 'notdiag-with-notas-nota col-md-12', 'description' => 'Registro de nota al diagnóstico radiológico'))->end()
            ->end()
            ->tab('Detalles')
                ->with('Detalles de la nota', array('class' => 'col-md-6', 'description' => 'Descripción de la nota agregada'))->end()
            ->end()
        ;
        
        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();
        
        $formMapper
            ->tab('Nota al diagnóstico')
                ->with('Nota a agregar')
                    ->add('idDiagnostico', 'sonata_type_model_hidden', array(), array('admin_code' => 'minsal_simagd.admin.img_diagnostico'))
                    ->add('idEmpleado', null, array(
                                                            'label' => 'Realizó',
                                                            'required' => true,
                                                            'empty_value' => '',
                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                    return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(4, 5));
                                                                                },
                                                            'group_by' => 'idTipoEmpleado',
                                                            'help' => 'Emitió la nota',
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('idTipoNotaDiagnostico', null, array(
                                                            'label' => 'Tipo',
                                                            'required' => true,
//                                                            'empty_value' => '',
                                                            'expanded' => true,
                                                            'multiple' => false,
                                                            'help' => 'Seleccione un tipo',
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('contenido', 'ckeditor', array(
                                                            'label' => 'Nota sobre el diagnóstico',
                                                            'required' => false,
                                'config' => array(
                                    'extraPlugins' => 'templates',
                                    'templates'    => 'my_template',
                                    'toolbar' => array(
                                        array(
                                            'name' => 'document',
                                            'items' => array('-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                                        ),
                                        array(
                                            'name' => 'basicstyles',
                                            'items' => array('Bold', 'Italic', 'Underline', '-', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                                        ),
                                        array(
                                            'name' => 'editing',
                                            'items' => array('Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'),
                                        ),
                                        '/',
                                        array(
                                            'name' => 'clipboard',
                                            'items' => array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
                                        ),
                                        array(
                                            'name' => 'paragraphs',
                                            'items' => array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'),
                                        ),
                                        '/',
                                        array(
                                            'name' => 'styles',
                                            'items' => array('Styles', 'Format', 'Font', 'FontSize'),
                                        ),
                                        array(
                                            'name' => 'colors',
                                            'items' => array('TextColor', 'BGColor'),
                                        ),
                                    ),
                                    'uiColor' => '#abcdef',
                                    'startup_outline_blocks' => false,
                                    'width' => '100%',
                                    'height' => '320',
                                    'language' => 'es_ES',
                                    'scayt_autoStartup' => true,
                                   // 'scayt_userDictionaryName' => 'DiccionarioMedico',
                                    //'scayt_customDictionaryIds' => '3021,3456,3478"',
                                //...
                                ),
                    ))
                ->end()
            ->end()
            ->tab('Detalles')
                ->with('Detalles de la nota')                
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
    
    public function prePersist($nota) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $nota->setIdUserReg($user);
        $nota->setFechaEmision(new \DateTime('now'));
    }
    
    public function validate(ErrorElement $errorElement, $nota) {
        $errorElement
            ->with('idTipoNotaDiagnostico') //Tipo de la nota agregada
                ->assertNotBlank(array('message' => '¿Qué tipo de nota está agregando al diagnóstico?'))
            ->end()
            ->with('contenido') //Tipo de la nota agregada
                ->assertNotBlank(array('message' => 'No ha escrito la nota que agregará al diagnóstico'))
                ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
            ->end()
            ->with('idEmpleado') //Médico
                ->assertNotBlank(array('message' => 'No ha seleccionado al médico que emite esta nota'))
            ->end();
        
        //Diagnóstico
        if (!$nota->getIdDiagnostico()) {
            $errorElement->with('observaciones')
                            ->addViolation('No ha seleccionado el diagnóstico, vuelva a la lista y seleccione para cuál desea agregar esta nota')
                        ->end();
        }
        //Establecimiento al que pertenece el médico
        if (!$nota->getIdEstablecimiento()) {
            $errorElement->with('observaciones')
                            ->addViolation('La nota no puede agregarse a este establecimiento, verifique que esté seleccionada un diagnóstico')
                        ->end();
        }
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        if ( in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY')) ) {
	    $instance->setIdEmpleado($sessionUser->getIdEmpleado());
	}
        
        //Establecimiento
        $estabLocal = $sessionUser->getIdEstablecimiento();
//        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlEstablecimiento');
//        $estabReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $estab);
        $instance->setIdEstablecimiento($estabLocal);
        
        //Tipo de nota por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlTipoNotaDiagnostico');
        $tipoReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlTipoNotaDiagnostico', '1');
        $instance->setIdTipoNotaDiagnostico($tipoReference);
        
        //Diagnóstico padre
        if ($this->hasRequest()) {
            $diagnostico = $this->getRequest()->get('diagnostico', null);
            if ($diagnostico !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgDiagnostico');
                $diagnosticoReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgDiagnostico', $diagnostico);
                $instance->setIdDiagnostico($diagnosticoReference);
            }
        }
        
        return $instance;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_diag')
                        )
                        ->setParameter('id_est_diag', $estabLocal);
        
        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:RyxDiagnosticoSegundaOpinionMedicaAdmin:notdiag_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:RyxDiagnosticoSegundaOpinionMedicaAdmin:notdiag_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:RyxDiagnosticoSegundaOpinionMedicaAdmin:notdiag_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}