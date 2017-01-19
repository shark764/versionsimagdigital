<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;

class ImgSolicitudEstudioComplementarioProyeccionAdmin extends Admin
{
    protected $baseRouteName    = 'simagd_solicitud_estudio_complementario_proyeccion';
    protected $baseRoutePattern = 'rayos-x-proyecciones-complementarias-solicitadas';

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Seleccionar proyección')
                ->add('idProyeccionSolicitada', null, array(
                                                    'label' => 'Proyección',
                                                    'required' => true,
                                                    'empty_value' => '',
						    'group_by' => 'idExamenServicioDiagnostico',
                                                    'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
								    'data-fv-notempty' => 'true',
								    'data-fv-notempty-message' => 'Seleccione un elemento',
						    )
                ))
            ->end()
            ->with('Detalles')
                ->add('vistasRequeridas', null, array(
                                                    'label' => 'Vistas',
                                                    'required' => false,
						    'attr' => array('min' => '0',
								    'max' => '32767',
								    'placeholder' => 'N° de vistas',

								    'data-fv-integer' => 'true',
								    'data-fv-integer-message' => 'El valor no es un entero',

								    'data-fv-greaterthan-inclusive' => 'true',
								    'data-fv-greaterthan-value' => '0',
								    'data-fv-greaterthan-message' => 'Debe ser mayor o igual a 0',

								    'data-fv-lessthan-inclusive' => 'true',
								    'data-fv-lessthan-value' => '32767',
								    'data-fv-lessthan-message' => 'Debe ser menor o igual a 32767',
						    )
                ))
                ->add('dimensiones', null, array(
                                                    'label' => 'Dimensiones',
                                                    'required' => false,
                                                    'attr' => array('maxlength' => '25',
                                                                    'placeholder' => 'Ej.: 8x10, 8x24',

								    'data-fv-stringlength' => 'true',
								    'data-fv-stringlength-min' => '1',
								    'data-fv-stringlength-max' => '25',
								    'data-fv-stringlength-message' => '1 caracter mínimo',

								    'data-fv-regexp' => 'true',
								    'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.()_-\s]+$',
								    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
						    )
                ))
                ->add('otrasEspecificaciones', 'textarea', array(
                                                    'label' => 'Otras especificaciones',
                                                    'required' => false,
//                                                     'help' => '100 carácteres hábiles',
                                                    'attr' => array('rows' => '2',
                                                                    'style' => 'resize:none',
                                                                    'maxlength' => '100',
                                                                    'placeholder' => 'Aspectos a considerar con esta proyección',

								    'data-fv-stringlength' => 'true',
								    'data-fv-stringlength-min' => '5',
								    'data-fv-stringlength-max' => '100',
								    'data-fv-stringlength-message' => '5 caracteres mínimo',

								    'data-fv-regexp' => 'true',
								    'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
								    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
						    )
                ))
            ->end()
        ;
    }

}