<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ImagenologiaDigitalAdmin extends Admin
{
    protected $baseRouteName = 'simagd_imagenologia_digital';
    protected $baseRoutePattern = 'rayos-x-imagenologia-digital';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clear();
        $collection->add('list', 'inicio');
        $collection->add('busquedaPaciente', 'busqueda-paciente');
        $collection->add('obtenerDatosBusqueda', null, [], [], ['expose' => true]);
        $collection->add('resultadosBusquedaPaciente', null, [], [], ['expose' => true]);
        $collection->add('historialImagenologiaPaciente', null, [], [], ['expose' => true]);
        $collection->add('obtenerHistorialImagenologiaPaciente', null, [], [], ['expose' => true]);
        $collection->add('accesoDenegado', 'acceso-no-autorizado', [], [], ['expose' => true]);
        $collection->add('registroNoEncontrado', 'registro-no-encontrado', [], [], ['expose' => true]);
        $collection->add('listarDatosPaciente', null, [], [], ['expose' => true]);
        $collection->add('generateDataPaciente', null, [], [], ['expose' => true]);
        $collection->add('listarCitasPaciente', null, [], [], ['expose' => true]);
        $collection->add('listarExamenesPaciente', null, [], [], ['expose' => true]);
        $collection->add('generateDataPaciente', null, [], [], ['expose' => true]);
        $collection->add('asignarNuevoExpediente', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('worklist', 'lista-de-trabajo', [], [], ['expose' => true]);
        $collection->add('requestDashboard', 'solicitudes', [], [], ['expose' => true]);
        $collection->add('resultsDashboard', 'resultados', [], [], ['expose' => true]);
        $collection->add('catalogsDashboard', 'catalogos', [], [], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        /*
         * getJsonFiltersForBsTables
         */
        $collection->add('getJsonFiltersForBsTables', null, [], [], ['expose' => true]);
        $collection->add('getJsonGroupDependentEntities', null, [], [], ['expose' => true]);
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'busquedaPaciente':
                return 'MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_busquedaPaciente.html.twig';
                break;
            case 'resultadosBusquedaPaciente':
                return 'MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_resultado_busquedaPaciente.html.twig';
                break;
            case 'historialImagenologiaPaciente':
                return 'MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_historial_imagenologico_paciente.html.twig';
                break;
            case 'accesoDenegado':
                return 'MinsalSimagdBundle::simagd_accesoDenegado.html.twig';
                break;
            case 'registroNoEncontrado':
                return 'MinsalSimagdBundle::simagd_registroNoEncontrado.html.twig';
                break;
            case 'listarDatosPaciente':
                return 'MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_listarDatosPaciente.html.twig';
                break;
            case 'worklist':
                return 'MinsalSimagdBundle:Worklist:worklist.html.twig';
                break;
            case 'request_dashboard':
                return 'MinsalSimagdBundle:Dashboard:request_dashboard.html.twig';
                break;
            case 'results_dashboard':
                return 'MinsalSimagdBundle:Dashboard:results_dashboard.html.twig';
                break;
            case 'catalogs_dashboard':
                return 'MinsalSimagdBundle:Dashboard:catalogs_dashboard.html.twig';
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