<?php

namespace Minsal\SiapsBundle\Repositorio;

use Doctrine\ORM\EntityRepository;
use Minsal\SiapsBundle\Entity\CtlEstablecimiento;

/**
 * CtlEstablecimientoRepository
 *
 */
class CtlEstablecimientoRepository extends EntityRepository {
    
    /* Analista Programador */
    /* Samuel Pérez */
    /** Obtiene los establecimientos tipo 1 de prueba **/
    public function obtenerEstablecimiento() {

        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('e')
                        ->from('MinsalSiapsBundle:CtlEstablecimiento', 'e');
//                        ->where('e.idTipoEstablecimiento = 1');
    }

    public function obtenerEstablecimientoConfigurado() {
        $establecimiento = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('e')
                ->from('MinsalSiapsBundle:CtlEstablecimiento', 'e')
                ->where('e.configurado = true')
                ->getQuery();

        try {
            return $establecimiento->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return new CtlEstablecimiento();
        }
    }

    public function obtenerEstabConfigurado() {

        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('e')
                        ->from('MinsalSiapsBundle:CtlEstablecimiento', 'e')
                        ->where('e.configurado = true');
    }

    public function obtenerEstablecimientosCoexion($ruta, $valor) {

        $regiones = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('e.id')
                ->from('MinsalSiapsBundle:MntConexion', 'c')
                ->join('c.idEstablecimiento', 'e')
                ->getQuery()
                ->getResult()
        ;

        if ($ruta == 'create')
            return $this->getEntityManager()
                            ->createQueryBuilder()
                            ->select('e')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'e')
                            ->join('e.idTipoEstablecimiento', 'te')
                            ->where('e.id NOT IN (:id)')
                            ->andWhere('te.id=12')
                            ->setParameter(':id', $regiones ? : '0' );

        else if ($ruta == 'edit')
            return $this->getEntityManager()
                            ->createQueryBuilder()
                            ->select('e')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'e')
                            ->where('e.id =:valor')
                            ->setParameter(':valor', $valor)
            ;
        else
            return $this->getEntityManager()
                            ->createQueryBuilder()
                            ->select('e')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'e')
                            ->join('e.idTipoEstablecimiento', 'te')
                            ->where('te.id=12')
            ;
    }

    /**
     * Método perteneciente a módulo <simagd>
     * @return type
     */
    public function obtenerEstabParaRefDiag($solRefDiag = 'idEstablecimientoDiagnosticante')
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('mr')
                            ->from('MinsalSiapsBundle:MntAreaExamenEstablecimiento', 'mr')
                            ->where('stdsol.id = mr.idEstablecimiento');
        if($solRefDiag == 'idEstablecimientoReferido') { $subQuery->andWhere('mr.imgHabilitado = TRUE'); }
        else { $subQuery->andWhere('mr.imgRealizaLectura = TRUE'); }
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('stdsol')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'stdsol');
        
        $query->where($query->expr()->exists($subQuery->getDql()));
        
        $query->orderBy('stdsol.idTipoEstablecimiento')
                            ->addOrderBy('stdsol.nombre');
                
        $query->distinct();
        
        return $query;
    }
        
    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerEstabSolicitadosRefDiag($idEstablecimiento, $solRefDiag = 'idEstablecimientoReferido', $alias = 'prc')
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prc')
                            ->from('MinsalSimagdBundle:ImgSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->where('stdsol.id = ' . $alias . '.' . $solRefDiag);

        $subQuery->andWhere($subQuery->expr()->orx(
                            $subQuery->expr()->eq('prc.idEstablecimientoReferido', ':id_est_ref'),
                            $subQuery->expr()->eq('prc.idEstablecimientoDiagnosticante', ':id_est_diag'),
                            $subQuery->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ));
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('stdsol')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'stdsol');
        
        $query->where($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_est_ref', $idEstablecimiento)
                            ->setParameter('id_est_diag', $idEstablecimiento)
                            ->setParameter('id_est', $idEstablecimiento);
        
        $query->orderBy('stdsol.idTipoEstablecimiento')
                            ->addOrderBy('stdsol.nombre');
                
        $query->distinct();
        
        return $query;
    }
        
    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerEstabSolicitadosDiagPostEstudio($idEstablecimiento)
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('soldiag')
                            ->from('MinsalSimagdBundle:ImgSolicitudDiagnostico', 'soldiag')
                            ->innerJoin('soldiag.idSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->where('stdsol.id = soldiag.idEstablecimientoSolicitado');

        $subQuery->andWhere($subQuery->expr()->orx(
                            $subQuery->expr()->eq('prc.idEstablecimientoReferido', ':id_est_ref'),
                            $subQuery->expr()->eq('prc.idEstablecimientoDiagnosticante', ':id_est_diag'),
                            $subQuery->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ));
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('stdsol')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'stdsol');
        
        $query->where($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_est_ref', $idEstablecimiento)
                            ->setParameter('id_est_diag', $idEstablecimiento)
                            ->setParameter('id_est', $idEstablecimiento);
        
        $query->orderBy('stdsol.idTipoEstablecimiento')
                            ->addOrderBy('stdsol.nombre');
                
        $query->distinct();
        
        return $query;
    }
        
    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerTodosEstabSolicitadosRefDiag( $solRefDiag = 'idEstablecimientoReferido', $alias = 'prc' )
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prc')
                            ->from('MinsalSimagdBundle:ImgSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->where('stdsol.id = ' . $alias . '.' . $solRefDiag);
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('stdsol')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'stdsol');
        
        $query->where($query->expr()->exists($subQuery->getDql()));
        
        $query->orderBy('stdsol.idTipoEstablecimiento')
                            ->addOrderBy('stdsol.nombre');
                
        $query->distinct();
        
        return $query;
    }
        
    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerTodosEstabLectura( )
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lct')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->where('stdlct.id = lct.idEstablecimiento');
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('stdlct')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'stdlct');
        
        $query->where($query->expr()->exists($subQuery->getDql()));
        
        $query->orderBy('stdlct.idTipoEstablecimiento')
                            ->addOrderBy('stdlct.nombre');
                
        $query->distinct();
        
        return $query;
    }
        
    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function getSourceDataOrigenV1($idEstablecimiento)
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prc')
                            ->from('MinsalSimagdBundle:ImgSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->where('stdsol.id = aams.idEstablecimiento');

        $subQuery->andWhere($subQuery->expr()->orx(
                            $subQuery->expr()->eq('prc.idEstablecimientoReferido', ':id_est_ref'),
                            $subQuery->expr()->eq('prc.idEstablecimientoDiagnosticante', ':id_est_diag'),
                            $subQuery->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ));
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('stdsol.id as id, stdsol.nombre as text, IDENTITY(stdsol.idTipoEstablecimiento) as tipo')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'stdsol');
        
        $query->where($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_est_ref', $idEstablecimiento)
                            ->setParameter('id_est_diag', $idEstablecimiento)
                            ->setParameter('id_est', $idEstablecimiento);
        
        $query->orderBy('stdsol.idTipoEstablecimiento')
                            ->addOrderBy('stdsol.nombre');
                
        $query->distinct();
        
        return $query->getQuery()->getScalarResult();
    }
    
    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function getSourceDataOrigen($idEstablecimiento)
    {
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('stdsol.id as id, stdsol.nombre as text, IDENTITY(stdsol.idTipoEstablecimiento) as tipo')
                            ->from('MinsalSiapsBundle:CtlEstablecimiento', 'stdsol')
                            ->orderBy('stdsol.idTipoEstablecimiento')
                            ->addOrderBy('stdsol.nombre');
                
        $query->distinct();
        
        return $query->getQuery()->getScalarResult();
    }

}