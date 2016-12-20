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

class ImgMisExamenesNoConcluidosAdmin extends Admin
{
    protected $baseRouteName = 'simagd_mi_lista_sin_realizar';
    protected $baseRoutePattern = 'rayos-x-mi-lista-sin-realizar';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        $collection->clearExcept(array('list'));
        $collection->add('realizar');
        $collection->add('listarPendientesRealizar', null, [], [], ['expose' => true]);
        $collection->add('actualizarEstudioAlmacenado', null, [], [], ['expose' => true]);
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
    
    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);
        
        /** SubQuery */
        $subQuery = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado')
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->where('prz.idUserReg = :id_user')
                            ->andWhere('prz.idEstadoProcedimientoRealizado NOT IN ( 5, 6, 7, 8, 9 )')
                            ->andWhere('prz.idSolicitudEstudio = ' . $query->getRootAlias() . '.idSolicitudEstudio');
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_ref')
                        )
                        ->setParameter('id_est_ref', $estabLocal);
        
        $query->andWhere($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_user', $sessionUser->getId());
        
        return $query;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle:ImgPendienteRealizacionAdmin:pndR_personal_list_v2.html.twig';
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
    
}
