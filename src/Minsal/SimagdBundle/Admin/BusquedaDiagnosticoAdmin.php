<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Route\RouteCollection;

class BusquedaDiagnosticoAdmin extends Admin
{
    protected $baseRouteName = 'simagd_busqueda_diagnostico';
    protected $baseRoutePattern = 'rayos-x-busqueda-diagnostico';

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'desc',
        '_sort_by' => 'id'
   );
    
   public function getConfigurationPool() {
       $instance = parent::getConfigurationPool();
//       $instance->getOption('form_type')->setData('horizontal');
       return $instance;
   }
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        $collection->clearExcept(array('show', 'list'));
        $collection->add('nota');
        $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
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
        $listMapper
            ->addIdentifier('id', null, array('route' => array('name' => 'show')))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAtenAreaModEstab.idEstablecimiento', null, array('label' => 'Preinscrito en', 'route' => array('name' => 'show')))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idExpediente.idPaciente', null, array('label' => 'Paciente', 'route' => array('name' => 'show')))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAreaServicioDiagnostico', null, array('label' => 'Modalidad', 'route' => array('name' => 'show')))
            ->add('idLectura.idEstablecimiento', null, array('label' => 'Interpretado en', 'route' => array('name' => 'show')))
            ->add('idLectura.idEmpleado', null, array('label' => 'Interpretó', 'route' => array('name' => 'show')))
            ->add('idEmpleado', null, array('label' => 'Transcribió', 'route' => array('name' => 'show')))
            ->add('idEstadoDiagnostico', null, array('label' => 'Estado', 'route' => array('name' => 'show')))
//            ->add('idProyeccion', null, array('label' => 'Proyección imagenológica', 'route' => array('name' => 'show')))
//            ->add('fechaTranscrito', null, array('label' => 'Se transcribió', 'pattern' => 'EEE dd-MMM-yy h:mm:ss a',))
            ->add('fechaAprobado', null, array('label' => 'Se aprobó', 'pattern' => 'EEE dd-MMM-yy h:mm:ss a',))
            ->add('idLectura.correlativo', null, array('label' => 'Correlativo'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array('template' => 'MinsalSimagdBundle:list_button_action:simagd_show_action.html.twig'),
                    'nota' => array('template' => 'MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_nota_action.html.twig')
                )
            ))
        ;
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
        $showMapper
            ->with('Diagnóstico')->end()
            ->with('Datos Generales')
                ->add('id')
                ->add('idEmpleado', null, array('label' => 'Transcribe', 'route' => array('name' => 'show')))
                ->add('transcripcion', null, array('label' => 'Resultados', 'template' => 'MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_ckeditor_show.html.twig'))
                ->add('hallazgos', null, array('label' => 'Hallazgos', 'template' => 'MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_ckeditor_show.html.twig'))
                ->add('conclusion', null, array('label' => 'Conclusión'))
                ->add('idEstadoDiagnostico', null, array('label' => 'Estado'))
            ->end()
            ->with('Detalles')
                ->add('fechaTranscrito', null, array('label' => 'Se transcribió', 'pattern' => 'EEEE d \'de\' MMMM, yyyy h:mm:ss a',))
                ->add('fechaCorregido', null, array('label' => 'Se corrigió', 'pattern' => 'EEEE d \'de\' MMMM, yyyy h:mm:ss a',))
                ->add('fechaAprobado', null, array('label' => 'Se aprobó', 'pattern' => 'EEEE d \'de\' MMMM, yyyy h:mm:ss a',))
                ->add('idLectura.idEstablecimiento', null, array('label' => 'Registrado en', 'route' => array('name' => 'show')))
                ->add('idUserReg.idEmpleado', null, array('label' => 'Usuario que registró', 'route' => array('name' => 'show')))
                ->add('idUserMod.idEmpleado', null, array('label' => 'Último usuario que editó', 'route' => array('name' => 'show')))
            ->end()
            ->with('Incidencias')
                ->add('incidencias', null, array('label' => 'Incidencias ocurridas'))
                ->add('observaciones', null, array('label' => 'Observaciones'))
                ->add('errores', null, array('label' => 'Errores encontrados'))
            ->end()
            ->with('Notas agregadas')
                ->add('notasDiagnostico', 'sonata_type_collection', array('label' => 'Nota', 'route' => array('name' => 'show'),
//                                                                                'template' => 'MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_explSol_show.html.twig'
                                                                            ),
                                                                            array('edit' => 'inline', 'inline' => 'table'))
            ->end()
        ;
    }
    
    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle::simagd_base_list.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
