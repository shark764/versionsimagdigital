<?php

namespace Minsal\SiapsBundle\Repositorio;

use Doctrine\ORM\EntityRepository;
use Minsal\SiapsBundle\Entity\MntPaciente;
/**
 * MntPacienteRepository
 *
 */
class MntPacienteRepository extends EntityRepository {

    public function obtenerdatosPaciente($valor) {

        $dql="SELECT p,u,e
              FROM MinsalSiapsBundle:MntPaciente p
              LEFT JOIN p.expedientes e
              LEFT JOIN p.idUser u
              WHERE p.id =:valor";
        $paciente = $this->getEntityManager()
                ->getRepository('MinsalSiapsBundle:MntPaciente')
                ->find($valor);
      
        if(count($paciente->getExpedientes())>0)
                $dql.=" AND e.habilitado=true";
        $consulta = $this->getEntityManager()
                ->createQuery($dql)
                ->setParameter(':valor', $valor);
        
        try {
            return $consulta->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return new MntPaciente();
        }
    }

    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerPacientesPreinscritos($idEstablecimiento)
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prc')
                            ->from('MinsalSimagdBundle:ImgSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->where('exp.id = prc.idExpediente');

        $subQuery->andWhere($subQuery->expr()->orx(
                            $subQuery->expr()->eq('prc.idEstablecimientoReferido', ':id_est_ref'),
                            $subQuery->expr()->eq('prc.idEstablecimientoDiagnosticante', ':id_est_diag'),
                            $subQuery->expr()->eq('aams.idEstablecimiento', ':id_est')
                        ));
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('pct')
                            ->from('MinsalSiapsBundle:MntPaciente', 'pct')
                            ->innerJoin('MinsalSiapsBundle:MntExpediente', 'exp',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                    'pct.id = exp.idPaciente');
        
        $query->where($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_est_ref', $idEstablecimiento)
                            ->setParameter('id_est_diag', $idEstablecimiento)
                            ->setParameter('id_est', $idEstablecimiento);
        
        $query->orderBy('pct.primerApellido')
                            ->addOrderBy('pct.primerNombre');
                
        $query->distinct();
        
        return $query;
    }

    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerTodosPacientesPreinscritos( )
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prc')
                            ->from('MinsalSimagdBundle:ImgSolicitudEstudio', 'prc')
                            ->where('exp.id = prc.idExpediente');
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('pct')
                            ->from('MinsalSiapsBundle:MntPaciente', 'pct')
                            ->innerJoin('MinsalSiapsBundle:MntExpediente', 'exp',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                    'pct.id = exp.idPaciente');
        
        $query->where($query->expr()->exists($subQuery->getDql()));
        
        $query->orderBy('pct.primerApellido')
                            ->addOrderBy('pct.primerNombre');
                
        $query->distinct();
        
        return $query;
    }

    /**
     * Método perteneciente a módulo <simagd>
     * @param type $idEstablecimiento
     * @return type
     */
    public function obtenerPacientesAtendidosImagenologiaEstab( $idEstablecimiento )
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->innerJoin('prz.idSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idExpediente', 'exp')
                            ->where('exp.idPaciente = expL.idPaciente')
                            ->andWhere('prc.idEstablecimientoReferido = :id_est_ref');
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('expL')
                            ->from('MinsalSiapsBundle:MntExpediente', 'expL')
                            ->where('expL.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $idEstablecimiento);
        
        $query->andWhere($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_est_ref', $idEstablecimiento);
        
        $query->orderBy('expL.numero');
                
        $query->distinct();
        
        return $query->getQuery()->getResult();
    }
    
}

?>