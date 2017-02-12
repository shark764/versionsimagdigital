<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;

class RyxProcedimientoMaterialUtilizadoAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_material_utilizado';
    protected $baseRoutePattern = 'rayos-x-material-utilizado';

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $securityContext    = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento()->getId();
        
        $yeah   = null;
        if($this->hasParentFieldDescription()) { // this Admin is embedded
            $getter = 'get' . $this->getParentFieldDescription()->getFieldName();
            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();
            if ($parent) {
              $subject = $parent->$getter();
              $yeah = $this->id($parent) ? 'ID: ' . $parent->getId() . ', SUBID: ' . ($this->getSubject()) : 'CREATE NO ID';
            } else {
              $subject = null;
              $yeah = 'null';
            }
        } else { // this Admin is not embedded
            $subject = $this->getSubject();
            $yeah = $subject;
        }
        
//        if ($this->id($parent) && $this->getSubject()) {
            $formMapper
                ->add('yeah', 'text', array(
                                                    'mapped' => false,
                                                    'required' => false,
//                                                    'data' => gettype($this->getSubject()),
//                                                    'data' => $this->id($this->getSubject()),
                                                    'data' => $this->getSubject(),
                                                    'attr' => array('maxlength' => '50',
                                                                    'readonly' => 'readonly',
                                                    )
                ))
            ;
//        }
        
        $formMapper
//            ->add('id')
            ->add('idMaterial', null, array(
                                                'label' => 'Material',
                                                'required' => true,
                                                'empty_value' => '',
                                                'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                        return $er->getUsableMaterials($estabLocal);
                                                                },
						  'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
								  'data-fv-notempty' => 'true',
								  'data-fv-notempty-message' => 'Seleccione un elemento',
						  )
            ))
            ->add('cantidadUtilizada', null, array(
                                                'label' => 'Cantidad',
						  'attr' => array('min' => '0',
								  'max' => '2147483647',
								  'placeholder' => 'Utilizado',

								  'data-fv-integer' => 'true',
								  'data-fv-integer-message' => 'El valor no es un entero',

								  'data-fv-greaterthan-inclusive' => 'true',
								  'data-fv-greaterthan-value' => '0',
								  'data-fv-greaterthan-message' => 'Debe ser mayor o igual a 0',

								  'data-fv-lessthan-inclusive' => 'true',
								  'data-fv-lessthan-value' => '2147483647',
								  'data-fv-lessthan-message' => 'Debe ser menor o igual a 2147483647',
						  )
            ))
            ->add('otrasEspecificaciones', 'textarea', array(
                                                'label' => 'Otras especificaciones',
                                                'required' => false,
//                                                'help' => '50 carácteres hábiles',
                                                'attr' => array('rows' => '2',
                                                                'style' => 'resize:none',
                                                                'maxlength' => '100',
                                                                'placeholder' => 'Otras especificaciones de su utilización',

								  'data-fv-stringlength' => 'true',
								  'data-fv-stringlength-min' => '5',
								  'data-fv-stringlength-max' => '100',
								  'data-fv-stringlength-message' => '5 caracteres mínimo',

								  'data-fv-regexp' => 'true',
								  'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
								  'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                                ),
            ))
        ;
    }

}