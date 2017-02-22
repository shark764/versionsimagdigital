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

class MntAreaExamenEstablecimientoAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_area_examen_establecimiento';
    protected $baseRoutePattern = 'rayos-x-area-examen-agregado';

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
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('imgHabilitado')
            ->add('imgRealizaLectura')
            ->add('imgDuracionClinicaEstudio')
            ->add('imgDescripcion')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('imgHabilitado')
            ->add('imgRealizaLectura')
            ->add('imgDuracionClinicaEstudio')
            ->add('imgDescripcion')
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
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('imgHabilitado')
            ->add('imgRealizaLectura')
            ->add('imgDuracionClinicaEstudio')
            ->add('imgDescripcion')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('imgHabilitado')
            ->add('imgRealizaLectura')
            ->add('imgDuracionClinicaEstudio')
            ->add('imgDescripcion')
        ;
    }

}