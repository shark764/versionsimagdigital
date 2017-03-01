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

class CtlAreaServicioDiagnosticoAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_area_servicio_diagnostico';
    protected $baseRoutePattern = 'rayos-x-modalidad';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('idarea')
            ->add('nombrearea')
            ->add('administrativa')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
            ->add('imgDescripcion')
            ->add('imgObservaciones')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('idarea')
            ->add('nombrearea')
            ->add('administrativa')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
            ->add('imgDescripcion')
            ->add('imgObservaciones')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
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
            ->add('id')
            ->add('idarea')
            ->add('nombrearea')
            ->add('administrativa')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
            ->add('imgDescripcion')
            ->add('imgObservaciones')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('idarea')
            ->add('nombrearea')
            ->add('administrativa')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
            ->add('imgDescripcion')
            ->add('imgObservaciones')
        ;
    }

}