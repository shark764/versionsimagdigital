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

class ImgMisLecturasNoConcluidasAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_mi_lista_sin_lectura';
    protected $baseRoutePattern = 'rayos-x-mi-lista-sin-lectura';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->clearExcept(array('list'));
        $collection->add('leer');
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        /** SubQuery */
        $subQuery = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgLectura')
                        ->createQueryBuilder()
                            ->select('lct')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->where('lct.idUserReg = :id_user')
                            ->andWhere('lct.idEstadoLectura NOT IN ( 4, 5, 6 )')
                            ->andWhere('lct.idEstudio = ' . $query->getRootAlias() . '.idEstudio');
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_diag')
                        )
                        ->setParameter('id_est_diag', $estabLocal);
        
        $query->andWhere($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_user', $sessionUser->getId());
        
        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle:RyxEstudioPendienteLecturaAdmin:pndL_personal_list_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}