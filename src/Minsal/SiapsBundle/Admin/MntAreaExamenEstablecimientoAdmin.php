<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MntAreaExamenEstablecimientoAdmin extends Admin
{
    protected $baseRoutePattern = 'rayos-x-realizable';

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'desc',
        '_sort_by' => 'fechaHoraReg'
   );
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('imgHabilitado')
            ->add('imgRealizaLectura')
            ->add('imgDuracionClinicaEstudio')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('idAreaServicioDiagnostico', null, array('label' => 'Modalidad'))
            ->add('idExamenServicioDiagnostico', null, array('label' => 'Examen'))
            ->add('idEstablecimiento', null, array('label' => 'Establecimiento'))
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('imgHabilitado', null, array('label' => 'Habilitado'))
            ->add('imgRealizaLectura', null, array('label' => 'Lectura'))
            ->add('imgDuracionClinicaEstudio', null, array('label' => 'Duración'))
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
            ->add('idAreaServicioDiagnostico')
            ->add('idExamenServicioDiagnostico')
            ->add('idEstablecimiento')
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
    
    public function prePersist($realizable) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $realizable->setIdUsuarioReg($user);
        $realizable->setFechaHoraReg(new \DateTime('now'));
    }
    
    public function preUpdate($realizable) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $realizable->setIdUsuarioMod($user);
        $realizable->setFechaHoraMod(new \DateTime('now'));
    }
    
    public function getNewInstance() {
        $instance = parent::getNewInstance();
        
        //Atención por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlEstablecimiento');
        $stdReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', '30');
        $instance->setIdEstablecimiento($stdReference);
        
        //Atención por defecto
        $em = $this->getModelManager()->getEntityManager('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico');
        $areaReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', '22');
        $instance->setIdAreaServicioDiagnostico($areaReference);
        
        $instance->setImgRealizaLectura(TRUE);
        
        return $instance;
    }
}
