<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CtlAreaServicioDiagnosticoAdmin extends Admin
{
    protected $baseRoutePattern = 'rayos-x-modalidad';
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            //->add('idarea')
            ->add('nombrearea')
            ->add('administrativa')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
            //->add('imgDescripcion')
            //->add('imgObservaciones')
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
            ->add('idAtencion')
            ->add('nombrearea')
            ->add('imgCodigo')
            ->add('administrativa')
            ->add('imgDescripcion')
            ->add('idarea')
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
            ->add('idAtencion')
            ->add('idarea')
            ->add('nombrearea')
            ->add('administrativa')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
            ->add('imgDescripcion', null, array('template' => 'MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_ckeditor_show.html.twig'))
            ->add('imgObservaciones')
        ;
    }
    
    public function prePersist($modalidad) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $modalidad->setIdusuarioreg($user);
        $modalidad->setFechahorareg(new \DateTime('now'));
    }
    
    public function preUpdate($modalidad) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $modalidad->setIdusuariomod($user);
        $modalidad->setFechahoramod(new \DateTime('now'));
    }
    
    public function getNewInstance() {
        $instance = parent::getNewInstance();
        
        //Atención por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAtencion');
        $atencionReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAtencion', '97');
        $instance->setIdAtencion($atencionReference);
        
        $instance->setIdarea(1000);
        
        $instance->setImgCodigo('00000001');
        
        return $instance;
    }
}
