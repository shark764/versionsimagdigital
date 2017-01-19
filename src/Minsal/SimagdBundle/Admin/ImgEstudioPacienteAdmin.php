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
class ImgEstudioPacienteAdmin extends Admin
{
    protected $baseRouteName    = 'simagd_estudio';
    protected $baseRoutePattern = 'rayos-x-estudios';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->clearExcept(array('show', 'list'));
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('download', null, [], [], ['expose' => true]);
        $collection->add('getPatients', null, [], [], ['expose' => true]);
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'busqueda-estudio', [], [], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }
   
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
    }
    
    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle:ImgEstudioPacienteAdmin:est_busquedaEstudio_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
}