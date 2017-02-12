<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class RyxSolicitudEstudioMamografiaAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_solicitud_estudio_mamografia';
    protected $baseRoutePattern = 'rayos-x-solicitud-estudio-mamografia';
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('edadPresentoMenarquia')
            ->add('usaHormonas')
            ->add('usaAnticonceptivos')
            ->add('antecedentesFamiliaresCancerMama')
            ->add('mamografiasPrevias')
            ->add('edadPresentoMenopausia')
            ->add('tieneOvarios')
            ->add('usaTsh')
            ->add('antecedentesPersonalesCancerMama')
            ->add('fechaResultado')
            ->add('embarazo')
            ->add('edadPrimerEmbarazo')
            ->add('abortos')
            ->add('partos')
            ->add('cesareas')
            ->add('cirugiasPrevias')
            ->add('implantes')
            ->add('disminucion')
            ->add('mastectomia')
            ->add('cuadrantectomia')
            ->add('patologias')
            ->add('observaciones')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('edadPresentoMenarquia')
            ->add('usaHormonas')
            ->add('usaAnticonceptivos')
            ->add('antecedentesFamiliaresCancerMama')
            ->add('mamografiasPrevias')
            ->add('edadPresentoMenopausia')
            ->add('tieneOvarios')
            ->add('usaTsh')
            ->add('antecedentesPersonalesCancerMama')
            ->add('fechaResultado')
            ->add('embarazo')
            ->add('edadPrimerEmbarazo')
            ->add('abortos')
            ->add('partos')
            ->add('cesareas')
            ->add('cirugiasPrevias')
            ->add('implantes')
            ->add('disminucion')
            ->add('mastectomia')
            ->add('cuadrantectomia')
            ->add('patologias')
            ->add('observaciones')
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
            /*->add('id')*/
            ->add('edadPresentoMenarquia')
            ->add('usaHormonas')
            ->add('usaAnticonceptivos')
            ->add('antecedentesFamiliaresCancerMama')
            ->add('mamografiasPrevias')
            ->add('edadPresentoMenopausia')
            ->add('tieneOvarios')
            ->add('usaTsh')
            ->add('antecedentesPersonalesCancerMama')
            ->add('fechaResultado')
            ->add('embarazo')
            ->add('edadPrimerEmbarazo')
            ->add('abortos')
            ->add('partos')
            ->add('cesareas')
            ->add('cirugiasPrevias')
            ->add('implantes')
            ->add('disminucion')
            ->add('mastectomia')
            ->add('cuadrantectomia')
            ->add('patologias')
            ->add('observaciones')
            ->add('solicitudEstudioMamografiaSintomatologia', 'sonata_type_collection', array(
                                        'label' =>'Sintomatología de la mama',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'help' => 'Especifique si la anomalía se presenta en mama izquierda, derecha, ninguna o ambas'
                                        // 'cascade_validation' => true,),
                ), array('edit' => 'inline'/*, 'inline' => 'table')*/))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('edadPresentoMenarquia')
            ->add('usaHormonas')
            ->add('usaAnticonceptivos')
            ->add('antecedentesFamiliaresCancerMama')
            ->add('mamografiasPrevias')
            ->add('edadPresentoMenopausia')
            ->add('tieneOvarios')
            ->add('usaTsh')
            ->add('antecedentesPersonalesCancerMama')
            ->add('fechaResultado')
            ->add('embarazo')
            ->add('edadPrimerEmbarazo')
            ->add('abortos')
            ->add('partos')
            ->add('cesareas')
            ->add('cirugiasPrevias')
            ->add('implantes')
            ->add('disminucion')
            ->add('mastectomia')
            ->add('cuadrantectomia')
            ->add('patologias')
            ->add('observaciones')
        ;
    }
    
    public function getNewInstance()
    {
        $instance   = parent::getNewInstance();
        
        /*
         * default values
         */
        
        /*
         * ADD FORM FOR SINTOMATOLOGY OF MAMOGRAFY STUDY
         */
//        $instance = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioMamografia();
        $form_sintomatologia = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioMamografiaSintomatologia();
        $instance->addSolicitudEstudioMamografiaSintomatologium($form_sintomatologia);
        /*
         * END
         */
        
        return $instance;
    }
}