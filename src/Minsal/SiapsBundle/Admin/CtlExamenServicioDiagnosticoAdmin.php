<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CtlExamenServicioDiagnosticoAdmin extends Admin
{
    protected $baseRoutePattern = 'rayos-x-examen';
    
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
            ->add('descripcion')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
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
            ->add('idsexo')
            ->add('idestandar')
            ->add('descripcion')
            ->add('imgCodigo')
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
            ->add('idestandar')
            ->add('descripcion')
            ->add('fechahorareg')
            ->add('fechahoramod')
            ->add('imgCodigo')
            ->add('imgObservaciones')
        ;
    }
    
    public function prePersist($examen) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $examen->setIdusuarioreg($user);
        $examen->setFechahorareg(new \DateTime('now'));
    }
    
    public function preUpdate($examen) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $examen->setIdusuariomod($user);
        $examen->setFechahoramod(new \DateTime('now'));
    }
    
    public function getNewInstance() {
        $instance = parent::getNewInstance();
        
        //Atención por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAtencion');
        $atencionReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAtencion', '97');
        $instance->setIdAtencion($atencionReference);
        
        $instance->setIdestandar(1000);
        
        return $instance;
    }
}