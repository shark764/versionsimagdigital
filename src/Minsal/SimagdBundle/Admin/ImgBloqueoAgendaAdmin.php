<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
use Doctrine\ORM\EntityRepository;

class ImgBloqueoAgendaAdmin extends Admin
{
    protected $baseRouteName = 'simagd_bloqueo_agenda';
    protected $baseRoutePattern = 'rayos-x-bloqueos';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        $collection->clearExcept(array('show', 'list'));
        $collection->add('obtenerBloqueosAgenda', null, [], [], ['expose' => true]);
        $collection->add('nuevoBloqueo', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('actualizarBloqueo', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('removerBloqueo', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('listarBloqueos', null, [], [], ['expose' => true]);
        $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('excluirRadiologoBloqueo', null, [], ['_method' => 'POST'], ['expose' => true]);
    }
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
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
    
    public function prePersist($bloqueo) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $bloqueo->setIdUserReg($user);
        $bloqueo->setFechaCreacion(new \DateTime('now'));
        if (!$bloqueo->getColor() || $bloqueo->getColor() == '#ffffff') {
	    $bloqueo->setColor('yellow');
        }
    }
    
    public function preUpdate($bloqueo) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $bloqueo->setIdUserMod($user);
        $bloqueo->setFechaUltimaEdicion(new \DateTime('now'));
        if (!$bloqueo->getColor() || $bloqueo->getColor() == '#ffffff') {
	    $bloqueo->setColor('yellow');
        }
    }
    
    public function getNewInstance() {
        $instance = parent::getNewInstance();
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $estabLocal = $sessionUser->getIdEstablecimiento();
        $instance->setIdEstablecimiento($estabLocal);
        $instance->setIdEmpleadoRegistra($sessionUser->getIdEmpleado());
        
        return $instance;
    }
}
