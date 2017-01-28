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

class ImgDatoAutocomplementoAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_dato_autocomplemento';            //SUSTITUIR METODO GET NEW INSTANCE CON EL ESTABLECIMIENTO YA SETEADO
    protected $baseRoutePattern = 'rayos-x-dato-autocomplemento';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->remove('delete');
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
    }

}