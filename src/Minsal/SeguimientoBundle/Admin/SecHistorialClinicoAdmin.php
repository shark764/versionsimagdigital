<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SecHistorialClinicoAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'desc',
        '_sort_by' => 'fechahorareg'
   );

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('preinscribir');
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
    }

        /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idNumeroExpediente', null, array('label' => 'Paciente'))
            ->add('idEmpleado', null, array('label' => 'Empleado'))
            ->add('fechaconsulta', null, array('label' => 'Consulta'))
            ->add('fechahorareg', null, array('label' => 'Registro'))
            ->add('piloto', null, array('label' => 'Piloto'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('idNumeroExpediente', null, array('label' => 'Paciente'))
            ->add('idEmpleado', null, array('label' => 'Empleado'))
            ->add('fechaconsulta', null, array('label' => 'Consulta'))
            ->add('fechahorareg', null, array('label' => 'Registro'))
            ->add('piloto', null, array('label' => 'Piloto'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'preinscribir' => array('template' => 'MinsalSimagdBundle:SecHistorialClinicoAdmin:sec_preinscribir_action.html.twig'),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();

        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idestablecimiento', ':id_est_sec')
                        )
                        ->setParameter('id_est_sec', $estabLocal);

        return $query;
    }
}
