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

class RyxCtlConfiguracionAgendaAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_configuracion_agenda';
    protected $baseRoutePattern = 'rayos-x-configuracion-agenda';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->remove('delete');
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idAreaExamenEstab.idAreaServicioDiagnostico', null, array('label' => 'Modalidad'))
            ->add('idAreaExamenEstab.idAreaServicioDiagnostico.imgCodigo', null, array('label' => 'Código de modalidad'))
            ->add('idAreaExamenEstab.idExamenServicioDiagnostico', null, array('label' => 'Examen'))
            ->add('idAreaExamenEstab.idExamenServicioDiagnostico.idsexo', null, array('label' => 'Aplica al sexo'))
            ->add('idAreaExamenEstab.idExamenServicioDiagnostico.imgCodigo', null, array('label' => 'Código de examen'))
            ->add('maximoCitasDia', null, array('label' => 'Máximo por día'))
            ->add('maximoCitasTurno', null, array('label' => 'Máximo por turno'))
            ->add('maximoCitasHora', null, array('label' => 'Máximo por hora'))
            ->add('maximoCitasMedico', null, array('label' => 'Máximo por tecnólogo'))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Parámetros')
                ->with('Parámetros de citación', array('class' => 'col-md-6', 'description' => 'Con este formulario puede agregar parámetros para programación de citas'))->end()
            ->end()
        ;

        $imgAtn = '97';

        $formMapper
            ->tab('Parámetros')
                ->with('Parámetros de citación')
                    ->add('idAreaServicioDiagnostico', 'entity', array(
                                                            'label' => 'Modalidad',
                                                            'required' => false,
                                                            'mapped' => false,
                                                            'class' => 'MinsalSimagdBundle:CtlAreaServicioDiagnostico',
                                                            'query_builder' => function(EntityRepository $er ) use ($imgAtn ) {
                                                                                    return $er->obtenerModalidadesImagenologia ($imgAtn);
                                                                            },
                                                            'empty_value' => '',
                                                            'group_by' => 'idAtencion',
                                                            'help' => 'Método de diagnóstico por imagen',
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('idExamenServicioDiagnostico', 'entity', array(
                                                            'label' => 'Examen',
                                                            'required' => false, //PONER TODOS LOS QUE DEBEN SER TRUE/FALSE **************************
                                                            'mapped' => false,
                                                            'class' => 'MinsalSimagdBundle:CtlExamenServicioDiagnostico',
                                                            'query_builder' => function(EntityRepository $er ) use ($imgAtn ) {
                                                                                    return $er->obtenerExamenesImagenologia ($imgAtn);
                                                                            },
                                                            'empty_value' => '', //REVISAR TODOS LOS ADMIN PARA QUE QUEDEN BIEN LOS REQUIRED, SIZE, ETC
                                                            'group_by' => 'idsexo',
                                                            'help' => 'Examen para el que se parametriza',
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('idAreaExamenEstab', 'sonata_type_model_hidden')
                    ->add('maximoCitasDia', null, array('label' => 'Máximo por día'))
                    ->add('maximoCitasTurno', null, array('label' => 'Máximo por turno'))
                    ->add('maximoCitasHora', null, array('label' => 'Máximo por hora'))
                    ->add('maximoCitasMedico', null, array('label' => 'Máximo por tecnólogo'))
                ->end()
            ->end()
        ;
    }

    public function validate(ErrorElement $errorElement, $paramCita) {
        $errorElement
            ->with('maximoCitasDia')
                ->assertRange(array('min' => 1, 'minMessage' => 'Citas máximas por día debe ser mayor a 1.'))
            ->end()
            ->with('maximoCitasTurno')
                ->assertRange(array('min' => 1, 'minMessage' => 'Citas máximas por turno debe ser mayor a 1.'))
            ->end()
            ->with('maximoCitasHora')
                ->assertRange(array('min' => 1, 'minMessage' => 'Citas máximas por hora debe ser mayor a 1.'))
            ->end()
            ->with('maximoCitasMedico')
                ->assertRange(array('min' => 1, 'minMessage' => 'Citas máximas por tecnólogo debe ser mayor a 1.'))
            ->end();

        //AreaExamenEstab
        if (!$paramCita->getIdAreaExamenEstab()) {
            $errorElement
                ->with('idAreaServicioDiagnostico')
                    ->addViolation('No puede determinarse la modalidad y examen que parametriza')
                ->end()
                ->with('idExamenServicioDiagnostico')
                    ->addViolation('No puede determinarse la modalidad y examen que parametriza')
                ->end();
        }

        //Modalidad --> AreaExamenEstab
        if (is_null($this->getForm()->get('idAreaServicioDiagnostico')->getData())) { $errorElement->with ('idAreaServicioDiagnostico')
                                                                        ->addViolation ('¿Qué modalidad desea parametrizar?')->end(); }
        //Examen --> AreaExamenEstab
        if (is_null($this->getForm()->get('idExamenServicioDiagnostico')->getData())) { $errorElement->with ('idExamenServicioDiagnostico')
                                                                        ->addViolation ('¿Qué examen desea parametrizar?')->end(); }
    }

    public function prePersist($paramCita) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $paramCita->setIdUserReg($user);
    }

    public function preUpdate($paramCita) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $paramCita->setIdUserMod($user);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();

        $query->innerJoin($query->getRootAlias() . '.idAreaExamenEstab', 'mr')
                        ->andWhere('mr.idEstablecimiento = :id_est_rz')
                        ->setParameter('id_est_rz', $estabLocal);

        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:RyxCtlConfiguracionAgendaAdmin:prmCit_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle::simagd_base_list.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:RyxCtlConfiguracionAgendaAdmin:prmCit_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}