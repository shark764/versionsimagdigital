<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ImgSolicitudEstudioMamografiaAdmin extends Admin
{
    protected $baseRouteName = 'simagd_solicitud_estudio_mamografia';
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
            ->add('solicitudEstudioMamografiaSintomatologia')
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
}
