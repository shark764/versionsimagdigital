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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImgCtlPatronDiagnosticoAdmin extends Admin
{
    protected $baseRouteName = 'simagd_patron_diagnostico';
    protected $baseRoutePattern = 'rayos-x-patron-diagnostico';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('delete');
        $collection->add('agregarEnMiCatalogo', null, [], [], ['expose' => true]);
        $collection->add('crearPatronDiagnostico', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarPatronDiagnostico', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('listarPatronesDiagnostico', null, [], [], ['expose' => true]);
        $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('addDiagnosisAsPattern', null, [], [], ['expose' => true]);
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
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
    
    public function prePersist($patron)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $patron->setIdUserReg($sessionUser);
        $patron->setFechaHoraReg(new \DateTime('now'));
        if ($patron->getCodigo()) {
	    $patron->setCodigo(strtoupper($patron->getCodigo()));
	}
    }
    
    public function preUpdate($patron)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $patron->setIdUserMod($sessionUser);
        $patron->setFechaHoraMod(new \DateTime('now'));
        if ($patron->getCodigo()) {
	    $patron->setCodigo(strtoupper($patron->getCodigo()));
	}
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
}
