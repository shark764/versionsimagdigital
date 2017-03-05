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

class RyxEstudioPendienteLecturaAdmin extends MinsalSimagdBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_sin_lectura';
    protected $baseRoutePattern = 'rayos-x-sin-lectura';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->clearExcept(array('list'));
        $collection->add('leer');
        $collection->add('registrarEnMiLista', null, [], [], ['expose' => true]);
        $collection->add('addToUndiagnosedStudiesList', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('addToWorkList', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('save', 'guardar', [], [], ['expose' => true]);
        $collection->add('saveandclose', 'guardar-finalizar', [], [], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        /** SubQuery */
        $subQuery = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\RyxLecturaRadiologica')
                        ->createQueryBuilder()
                            ->select('lct')
                            ->from('MinsalSimagdBundle:RyxLecturaRadiologica', 'lct')
//                            ->where('lct.idEstadoLectura NOT IN ( 4, 5, 6 )')
                            ->andWhere('lct.idEstudio = ' . $query->getRootAlias() . '.idEstudio');
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_diag')
                        )
                        ->setParameter('id_est_diag', $estabLocal);
        
        $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())));
        
        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle:RyxEstudioPendienteLecturaAdmin:pndL_list_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
    public function prePersist($pndLectura)
    {
        $pndLectura->setFechaIngresoLista(new \DateTime('now'));
    }
    
    public function preUpdate($pndLectura)
    {
        $pndLectura->setFechaIngresoLista(new \DateTime('now'));
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
	
        $estabLocal = $sessionUser->getIdEstablecimiento();
        
        $instance->setIdEstablecimiento($estabLocal);
        
        //Estudio padre
        if ($this->hasRequest()) {
            $estudio = $this->getRequest()->get('__est', null);
            if ($estudio !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes');
                $estudioReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes', $estudio);
                $instance->setIdEstudio($estudioReference);
            }
            
            //Lectura solicitada por radiólogo
            $solicitudPorRadiologo = $this->getRequest()->get('__xrad', false);
            if ($solicitudPorRadiologo !== false) {
                $instance->setAnexadoPorRadiologo(TRUE);
                $instance->setSolicitudPostEstudio(TRUE);
        
                if ( in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))
			    || $securityContext->isGranted('ROLE_ADMIN') ) {
                    /** Solicitud de lectura radiológica por radiólogo y no por médico */
                    $instance->setIdRadiologoAnexa($sessionUser->getIdEmpleado());
                }
            }
        }
        
        return $instance;
    }

}