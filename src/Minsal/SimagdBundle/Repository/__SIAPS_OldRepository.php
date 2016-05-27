<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of __SIAPS_OldRepository
 *
 * @author farid
 * 
 * 
 * __SIAPS_OldRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class __SIAPS_OldRepository extends EntityRepository
{
    //put your code here
    
    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerAreasAtencionSolicitadasPreinscripcion($idEstablecimiento)
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prc')
                            ->from('MinsalSimagdBundle:ImgSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('aams.idAreaModEstab', 'ams')
                            ->where('ar.id = ams.idAreaAtencion');

        $subQuery->andWhere($subQuery->expr()->orx(
                            $subQuery->expr()->eq('prc.idEstablecimientoReferido', ':id_est_ref'),
                            $subQuery->expr()->eq('prc.idEstablecimientoDiagnosticante', ':id_est_diag'),
                            $subQuery->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ));
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('ar')
                            ->from('MinsalSiapsBundle:CtlAreaAtencion', 'ar');
        
        $query->where($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_est_ref', $idEstablecimiento)
                            ->setParameter('id_est_diag', $idEstablecimiento)
                            ->setParameter('id_est', $idEstablecimiento);
        
        $query->orderBy('ar.nombre');
                
        $query->distinct();
        
        return $query;
    }
}
