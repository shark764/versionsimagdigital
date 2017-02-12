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

class RyxCtlPreparacionEstudioAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_preparacion_estudio';
    protected $baseRoutePattern = 'rayos-x-preparacion-estudio';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->remove('delete');
        $collection->add('agregarEnMiCatalogo', null, [], [], ['expose' => true]);
        $collection->add('crearIndicacionCita', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarIndicacionCita', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
    }

    public function prePersist($indicacionesCita)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $indicacionesCita->setIdUserReg($sessionUser);
        $indicacionesCita->setFechaHoraReg(new \DateTime('now'));
    }

    public function preUpdate($indicacionesCita)
    {
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $indicacionesCita->setIdUserMod($sessionUser);
        $indicacionesCita->setFechaHoraMod(new \DateTime('now'));
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:RyxCtlPreparacionEstudioAdmin:indCit_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:RyxCtlPreparacionEstudioAdmin:indCit_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:RyxCtlPreparacionEstudioAdmin:indCit_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}