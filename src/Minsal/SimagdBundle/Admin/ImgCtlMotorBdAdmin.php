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

class ImgCtlMotorBdAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_motor_bd';
    protected $baseRoutePattern = 'rayos-x-motor-bd';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->remove('delete');
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
    }
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nombre', null, array('label' =>'Nombre'))
            ->add('codigo', null, array('label' =>'Código'))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Motor de BD')
                ->with('Ingreso en Catálogo', array('class' => 'col-md-6', 'description' => 'Con este formulario puede agregar un Motor de Base de Datos'))->end()
            ->end()
        ;
        
        $formMapper
            ->tab('Motor de BD')
                ->with('Ingreso en Catálogo')
//                    ->add('id')
                    ->add('nombre', null, array('label' =>'Nombre'))
                    ->add('codigo', null, array('label' =>'Código'))
                ->end()
            ->end()
        ;
    }
    
    public function validate(ErrorElement $errorElement, $motorBd) {
        $errorElement
            ->with('nombre') //Nombre
                ->assertNotNull(array('message' => 'No puede dejar este campo vacío'))
                ->assertNotBlank(array('message' => 'Introduzca el nombre del motor de BD'))
                ->assertLength(array('min' => 1, 'minMessage' => 'Este campo al menos debe contener 1 caracter'))
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false, 
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('codigo') //Código
                ->assertLength(array('min' => 1, 'minMessage' => 'Este campo al menos debe contener 1 caracter'))
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false, 
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end();
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgCtlMotorBdAdmin:mtrBd_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle::simagd_base_list.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgCtlMotorBdAdmin:mtrBd_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}