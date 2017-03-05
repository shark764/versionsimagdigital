<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ExpedienteFicticioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExpedienteFicticioRepository extends EntityRepository
{
    /*
     * número de expediente consecutivo
     */
    public function obtenerNumeroSiguiente($id_estabLocal)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('IDENTITY(unknExp.idEstablecimiento) AS idEstab, MAX(unknExp.numero) AS maxNumber')   // last is not always max numer
                            ->from('MinsalSimagdBundle:RyxExpedienteFicticio', 'unknExp')
                            ->where('unknExp.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estabLocal)
                            ->groupBy('unknExp.idEstablecimiento');

        $query->distinct();
        $query->setMaxResults(1);
        
        return $query->getQuery()->getOneOrNullResult();
    }
    
    /*
     * **************************************************************************
     * Migrar registros a nuevo expediente
     * **************************************************************************
     */
    public function cambiarExpediente($id_estabLocal, $id_expLocal, $id_usserMod, $rows = array())
    {
        /*
         * QueryBuilder
         */
        $qb = $this->getEntityManager()->createQueryBuilder();
        /*
         * Query
         */
        $q  = $qb->update('MinsalSimagdBundle:RyxSolicitudEstudio', 'prc')
                    ->set('prc.idExpediente', $qb->expr()->literal($id_expLocal))
                    ->set('prc.idExpedienteFicticio',':null_unkExp')
                    ->setParameter('null_unkExp', NULL)
                    ->set('prc.idUserMod', $qb->expr()->literal($id_usserMod))
                    ->where('prc.idEstablecimientoReferido = :id_est_prc')
                    ->setParameter('id_est_prc', $id_estabLocal)
                    ->andWhere('prc.id IN (:prc_rows_affected)')
                    ->setParameter('prc_rows_affected', $rows)
                ->getQuery();
        /*
         * execute query
         */
        $p = $q->execute();
    }

}
/*
 * *********************************************************************************************
 * SELECT max(substring(numero from (length(numero)-1))) from img_expediente_ficticio;
 * *********************************************************************************************
 */

/*
 * LA VERDADERA --| PARA TRIGGER
 * *********************************************************************************************
 * select max(numero) AS max_number_exp from img_expediente_ficticio where numero like CONCAT('%-', substring(to_char(now(), 'yyyy') from 3));
 * *********************************************************************************************
 */

/*
 * *********************************************************************************************
 * SELECT max(substring(numero from 4 for (length(numero)-1))) from img_expediente_ficticio;
 * *********************************************************************************************
 */