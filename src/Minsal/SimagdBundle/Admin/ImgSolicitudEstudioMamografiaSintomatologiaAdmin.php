<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ImgSolicitudEstudioMamografiaSintomatologiaAdmin extends Admin
{
    protected $baseRouteName    = 'simagd_solicitud_estudio_mamografia_sintomatologia';
    protected $baseRoutePattern = 'rayos-x-solicitud-estudio-mamografia-sintomatologia';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('dolorOMalestar')
            ->add('masaOAbultamiento')
            ->add('retraccionDelPezon')
            ->add('lesionEnPielOEngrosamiento')
            ->add('manchasOCambioColoracion')
            ->add('comezon')
            ->add('secrecion')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('dolorOMalestar')
            ->add('masaOAbultamiento')
            ->add('retraccionDelPezon')
            ->add('lesionEnPielOEngrosamiento')
            ->add('manchasOCambioColoracion')
            ->add('comezon')
            ->add('secrecion')
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
            ->add('dolorOMalestar')
            ->add('masaOAbultamiento')
            ->add('retraccionDelPezon')
            ->add('lesionEnPielOEngrosamiento')
            ->add('manchasOCambioColoracion')
            ->add('comezon')
            ->add('secrecion')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('dolorOMalestar')
            ->add('masaOAbultamiento')
            ->add('retraccionDelPezon')
            ->add('lesionEnPielOEngrosamiento')
            ->add('manchasOCambioColoracion')
            ->add('comezon')
            ->add('secrecion')
        ;
    }

}