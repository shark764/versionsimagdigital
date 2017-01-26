<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class ImgCtlPacsEstablecimientoAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_pacs';
    protected $baseRoutePattern = 'rayos-x-pacs-establecimiento';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->remove('delete');
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('habilitarPacs', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            // ->tab('Datos de conexión', array('class' => 'tab-conexion-rx', 'tab_icon' => 'glyphicon glyphicon-cog'))
                ->with('Parámetros de conexión', array('class' => 'col-md-12', 'description' => ''))->end()
            // ->end()
            // ->tab('Configuraciones', array('class' => 'tab-configuracion-rx', 'tab_icon' => 'glyphicon glyphicon-wrench'))
                ->with('Configuraciones', array('class' => 'col-md-12', 'description' => ''))->end()
            // ->end()
        ;

        $formMapper
            // ->tab('Datos de conexión')
                ->with('Parámetros de conexión')
                    ->add('nombreConexion', null, array(
								  'label' => 'Nombre de la Conexión',
								  'attr' => array('maxlength' => '100',
										  'placeholder' => 'Puede escribir un nombre para la conexión',

										  'data-add-input-addon' => 'true',
										  'data-add-input-addon-class' => 'primary-v4',
										  'data-add-input-addon-addon' => 'glyphicon glyphicon-edit',

										  'data-fv-stringlength' => 'true',
										  'data-fv-stringlength-min' => '5',
										  'data-fv-stringlength-max' => '100',
										  'data-fv-stringlength-message' => '5 caracteres mínimo',

										  'data-fv-regexp' => 'true',
										  'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
										  'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
								  )
		    ))
                    ->add('puerto', null, array(
                                                                'label' => 'Puerto',
                                                                'required' => false,
								  'attr' => array('min' => '0',
										  'max' => '65534',
										  'placeholder' => 'N° de puerto de conexión',

										  'data-add-input-addon' => 'true',
										  'data-add-input-addon-class' => 'primary-v4',
										  'data-add-input-addon-addon' => 'glyphicon glyphicon-question-sign',

										  'data-fv-integer' => 'true',
										  'data-fv-integer-message' => 'El valor no es un número válido',

										  'data-fv-greaterthan-inclusive' => 'true',
										  'data-fv-greaterthan-value' => '0',
										  'data-fv-greaterthan-message' => 'Debe ser mayor o igual a 0',

										  'data-fv-lessthan-inclusive' => 'true',
										  'data-fv-lessthan-value' => '65534',
										  'data-fv-lessthan-message' => 'Debe ser menor o igual a 65534',
								  )
                    ))
                    ->add('ip', null, array(
                                                                'label' => 'Dirección IP',
								  'attr' => array('placeholder' => 'Dirección IP (Formato IPV4 o IPV6)',

										  'data-add-input-addon' => 'true',
										  'data-add-input-addon-class' => 'primary-v4',
										  'data-add-input-addon-addon' => 'glyphicon glyphicon-question-sign',

										  'data-fv-notempty' => 'true',
										  'data-fv-notempty-message' => 'Este campo es requerido',

										  'data-fv-ip' => 'true',
										  'data-fv-ip-message' => 'No es una dirección IP correcta',
								  )
                    ))
                    ->add('usuario', null, array(
								  'label' => 'Usuario de la Base de Datos',
								  'attr' => array('maxlength' => '15',
										  'placeholder' => 'Usuario',

										  'data-add-input-addon' => 'true',
										  'data-add-input-addon-class' => 'primary-v4',
										  'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

										  'data-fv-stringlength' => 'true',
										  'data-fv-stringlength-min' => '6',
										  'data-fv-stringlength-max' => '15',
										  'data-fv-stringlength-message' => '6 caracteres mínimo',

										  'data-fv-regexp' => 'true',
										  'data-fv-regexp-regexp' => '^[a-zA-Z0-9]+$',
										  'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
								  )
                    ))
//                http://stackoverflow.com/questions/14067225/repeated-field-type-doesnt-display-properlycss-not-applyingsonata-admin-bu
//                https://github.com/sonata-project/SonataAdminBundle/pull/1093/files
                    ->add('clave', 'repeated', array(
                                                                'type' => 'password',
                                                                'invalid_message' => 'fos_user.password.mismatch',
                                                                'options' => array('translation_domain' => 'FOSUserBundle'),
                                                                'required' => true,
                                                                'first_options' => array('label' => 'form.password'),
                                                                'validation_groups' => array('Default'),
                                                                'second_options' => array('label' => 'form.password_confirmation'),
                    ))
                    ->add('nombreBaseDatos', null, array(
								  'label' => 'Nombre de la Base de Datos',
								  'attr' => array('maxlength' => '25',
										  'placeholder' => 'BD',

										  'data-add-input-addon' => 'true',
										  'data-add-input-addon-class' => 'primary-v4',
										  'data-add-input-addon-addon' => 'glyphicon glyphicon-edit',

										  'data-fv-stringlength' => 'true',
										  'data-fv-stringlength-min' => '4',
										  'data-fv-stringlength-max' => '25',
										  'data-fv-stringlength-message' => '4 caracteres mínimo',

										  'data-fv-regexp' => 'true',
										  'data-fv-regexp-regexp' => '^[a-zA-Z0-9_-]+$',
										  'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
								  )
                    ))
                    ->add('host', null, array(
								  'label' => 'Host del PACS',
								  'attr' => array('maxlength' => '35',
										  'placeholder' => 'Host',

										  'data-add-input-addon' => 'true',
										  'data-add-input-addon-class' => 'primary-v4',
										  'data-add-input-addon-addon' => 'glyphicon glyphicon-question-sign',

										  'data-fv-stringlength' => 'true',
										  'data-fv-stringlength-min' => '4',
										  'data-fv-stringlength-max' => '35',
										  'data-fv-stringlength-message' => '4 caracteres mínimo',

										  'data-fv-regexp' => 'true',
										  'data-fv-regexp-regexp' => '^[a-zA-Z0-9_-]+$',
										  'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
								  )
                    ))
                ->end()
            // ->end()
            // ->tab('Configuraciones')
                ->with('Configuraciones')
                    ->add('idEstablecimiento', null, array(
                                                                'label' => 'Establecimiento',
                                                                'required' => true,
                                                                'empty_value' => '',
                                                                'query_builder' => function(EntityRepository $er ) {
                                                                                        return $er->obtenerEstablecimiento();
                                                                                    },
                                                                'group_by' => 'idTipoEstablecimiento',
                                                                'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
										  'data-apply-formatter' => 'std',

										  'data-fv-notempty' => 'true',
										  'data-fv-notempty-message' => 'Seleccione un elemento',
								)
                    ))
                    ->add('idMotor', null, array(
                                                                'label' => 'Gestor de Base de Datos',
                                                                'required' => true,
//                                                                'empty_value' => '',
                                                                'expanded' => true,
                                                                'multiple' => false,
                                                                'attr' => array('data-fv-notempty' => 'true',
										  'data-fv-notempty-message' => 'Seleccione un elemento',
								  )
                    ))
                    ->add('duracionEstudio', null, array(
                                                                'label' => 'Duración de estudio almacenado (Meses)',
                                                                'required' => false,
								  'attr' => array('min' => '1',
										  'max' => '32767',
										  'placeholder' => 'Tiempo de vida útil',

										  'data-add-input-addon' => 'true',
										  'data-add-input-addon-class' => 'primary-v4',
										  'data-add-input-addon-addon' => 'glyphicon glyphicon-question-sign',

										  'data-fv-integer' => 'true',
										  'data-fv-integer-message' => 'El valor no es un entero',

										  'data-fv-greaterthan-inclusive' => 'true',
										  'data-fv-greaterthan-value' => '1',
										  'data-fv-greaterthan-message' => 'Debe ser mayor o igual a 1',

										  'data-fv-lessthan-inclusive' => 'true',
										  'data-fv-lessthan-value' => '32767',
										  'data-fv-lessthan-message' => 'Debe ser menor o igual a 32767',
								  )
                    ))
                    ->add('habilitado', null, array('label' => 'Habilitado'))
                ->end()
            // ->end()
        ;
    }

    public function validate(ErrorElement $errorElement, $ctlPacs)
    {
        $errorElement
            ->with('puerto') //Puerto
                ->assertNotBlank(array('message' => 'Ingrese el Puerto de la BD'))
            ->end()
            ->with('nombreConexion') //Puerto
                ->assertNotBlank(array('message' => 'Ingrese un nombre para la Conexión'))
            ->end();

//        $claveOriginal = $ctlPacs->getClave();
//        $claveConfirm = $this->getForm()->get('confirmacion')->getData();
//        if ($claveOriginal && $claveConfirm && ($claveOriginal != $claveConfirm) ) {
//            $errorElement
//                ->with('clave')
//                    ->addViolation('Contraseña digitada no coincide con la confirmación')
//                ->end()
//                ->with('confirmacion')
//                    ->addViolation('Contraseña digitada no coincide con la original')
//                ->end();
//        }
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:conexion-edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function prePersist($pacs) {
        /*$empleado->setIdEstablecimiento($this->getModelManager()
                ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true)));*/
//ATRIBUTOS DE LA AUDITORIA
//         $pacs->setIdUserReg($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser());

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $pacs->setIdUserReg($user);
        $pacs->setFechaHoraReg(new \DateTime('now'));

	//$pacs->setIdEstablecimiento(1);
        //$empleado->setFechahorareg(new \DateTime());
        //CONCATENAR LOS NOMBRES PARA FORMAR EL NOMBRE EL EMPLEADO
        //$empleado->setNombreempleado($empleado->getNombre() . ' ' . $empleado->getApellido());
        //PARA VERIFICAR SI TIENE NUMERO DE VIGILANCIA
       // if ($empleado->getNumeroJuntaVigilancia() != '') {
         //   $empleado->setCodigoFarmacia($empleado->getNumeroJuntaVigilancia());
       // }

    }

    public function preUpdate($pacs) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $pacs->setIdUserMod($user);
        $pacs->setFechaHoraMod(new \DateTime('now'));
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();

        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $instance->setHost('localhost');

        //Establecimiento local por defecto
	$estabLocal = $sessionUser->getIdEstablecimiento();
        $instance->setIdEstablecimiento($estabLocal);

        //Motor de BD por defecto (PostgreSQL)
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgCtlMotorBd');
        $motorReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlMotorBd', '2');
        $instance->setIdMotor($motorReference);

        return $instance;
    }

}