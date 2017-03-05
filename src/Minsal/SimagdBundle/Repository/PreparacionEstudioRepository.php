<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PreparacionEstudioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PreparacionEstudioRepository extends EntityRepository
{
    public function obtenerPreparacionEstudiosV2($id_estab, $bs_filters = array())
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder('indCit')
                            ->select('indCit')
                            ->addSelect('m')
                            ->addSelect('IDENTITY(m.idAtencion) AS m_id_atencion')
                            ->addSelect('CONCAT(COALESCE(emp.apellido, \'\'), \', \', COALESCE(emp.nombre, \'\')) AS indCit_empleado, emp.id AS indCit_id_empleado, tpEmp.tipo AS indCit_tipoEmpleado')
                            ->addSelect('usrRg.username AS indCit_usernameUserReg, usrRg.id AS indCit_id_userReg, usrMd.username AS indCit_usernameUserMod, usrMd.id AS indCit_id_userMod')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS indCit_nombreUserReg')
                            ->addSelect('CASE WHEN (usrMd.username IS NOT NULL) THEN CONCAT(COALESCE(usrMdEmp.apellido, \'\'), \', \', COALESCE(usrMdEmp.nombre, \'\')) ELSE \'\' END AS indCit_nombreUserMod')
                            ->from('MinsalSimagdBundle:RyxCtlPreparacionEstudio', 'indCit')
                            ->innerJoin('indCit.idAreaServicioDiagnosticoAplica', 'm')
                            ->innerJoin('indCit.idEmpleadoRegistra', 'emp')
                            ->leftJoin('emp.idTipoEmpleado', 'tpEmp')
                            ->innerJoin('indCit.idUserReg', 'usrRg')
                            ->leftJoin('indCit.idUserMod', 'usrMd')
                            ->innerJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->leftJoin('usrMd.idEmpleado', 'usrMdEmp')
                            ->where('indCit.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->orderBy('m.id', 'DESC')
                            ->addOrderBy('indCit.id', 'DESC')
                            ->distinct();
        
        /*
         * --| add filters from BSTABLE_FILTER to query
         */
        $simagd_er_model    = $this->getEntityManager()->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio');
        $apply_filters      = $simagd_er_model->getBsTableFiltersV2($query, $bs_filters);
        if ($apply_filters !== false)
        {
            $query->andWhere($apply_filters);
        }
        /*
         * |-- END filters from BSTABLE_FILTER to query
         */

        return $query->getQuery()->getScalarResult();
    }

}