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

class ImgPendienteRealizacionAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_sin_realizar';
    protected $baseRoutePattern = 'rayos-x-sin-realizar';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('show', 'consultar');
        // $collection->clearExcept(array('list'));
        $collection->add('realizar');
        $collection->add('registrarEnMiLista', null, [], [], ['expose' => true]);
        $collection->add('registrarEstudioAlmacenado', null, [], [], ['expose' => true]);
        $collection->add('addEmergency', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('save', 'guardar', [], [], ['expose' => true]);
        $collection->add('saveandsearchinpacs', 'guardar-buscar-pacs', [], [], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        /** SubQuery */
        $subQuery = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado')
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
//                            ->where('prz.idEstadoProcedimientoRealizado NOT IN ( 5, 6, 7, 8, 9 )')
                            ->andWhere('prz.idSolicitudEstudio = ' . $query->getRootAlias() . '.idSolicitudEstudio');
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_ref')
                        )
                        ->setParameter('id_est_ref', $estabLocal);
        
        $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())));
        
        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle:RyxExamenPendienteRealizacionAdmin:pndR_list_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
    public function prePersist($pndRealizar) {
        $pndRealizar->setFechaIngresoLista(new \DateTime('now'));
    }
    
    public function preUpdate($pndRealizar) {
        $pndRealizar->setFechaIngresoLista(new \DateTime('now'));
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
	
        $estabLocal = $sessionUser->getIdEstablecimiento();
        
        $instance->setIdEstablecimiento($estabLocal);
        
        return $instance;
    }

}