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

use Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento;

class ImgCtlMaterialAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_material';            //SUSTITUIR METODO GET NEW INSTANCE CON EL ESTABLECIMIENTO YA SETEADO
    protected $baseRoutePattern = 'rayos-x-material';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->remove('delete');
        $collection->add('agregarEnMiCatalogo', null, [], [], ['expose' => true]);
        $collection->add('crearMaterial', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarMaterial', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    public function prePersist($material) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $material->setIdUserReg($user);
        $material->setFechaHoraReg(new \DateTime('now'));
        if ($material->getCodigo()) {
	    $material->setCodigo(strtoupper($material->getCodigo()));
	}
    }

    public function preUpdate($material) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $material->setIdUserMod($user);
        $material->setFechaHoraMod(new \DateTime('now'));
        if ($material->getCodigo()) {
	    $material->setCodigo(strtoupper($material->getCodigo()));
	}
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgCtlMaterialAdmin:mtrl_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgCtlMaterialAdmin:mtrl_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgCtlMaterialAdmin:mtrl_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}