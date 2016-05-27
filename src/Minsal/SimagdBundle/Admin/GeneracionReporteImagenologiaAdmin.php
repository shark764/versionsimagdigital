<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class GeneracionReporteImagenologiaAdmin extends Admin
{
    protected $baseRouteName = 'simagd_generacion_reporte';
    protected $baseRoutePattern = 'rayos-x-imagenologia-reportes';
    
    protected function configureRoutes(RouteCollection $collection) {
        $collection->clear();
        $collection->add('list', 'reportes');
        $collection->add('generarReporteImagenologico', 'reporte', [], [], ['expose' => true]);
        $collection->add('resultadoGeneracionReporte', 'generar-reporte', [], [], ['expose' => true]);
    }
    
    public function getTemplate($name) {
        switch ($name) {
            case 'resultadoGeneracionReporte':
                return 'MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_generarReporte.html.twig';
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
        
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        
    }
}
