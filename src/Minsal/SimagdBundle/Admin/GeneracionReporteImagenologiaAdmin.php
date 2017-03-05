<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class GeneracionReporteImagenologiaAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_generacion_reporte';
    protected $baseRoutePattern = 'rayos-x-imagenologia-reportes';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clear();
        $collection->add('list', 'reportes');
        $collection->add('generarReporteImagenologico', 'reporte', [], [], ['expose' => true]);
        $collection->add('resultadoGeneracionReporte', 'generar-reporte', [], [], ['expose' => true]);
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'resultadoGeneracionReporte':
                return 'MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_generarReporte.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}