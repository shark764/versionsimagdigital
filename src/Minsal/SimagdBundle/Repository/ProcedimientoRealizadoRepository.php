<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProcedimientoRealizadoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProcedimientoRealizadoRepository extends EntityRepository
{
    public function obtenerExamenesRealizadosEstabPorPaciente($idExpediente, $id_estab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->innerJoin('prz.idSolicitudEstudio', 'prc')
                            ->where('prc.idExpediente = :id_exp')
                            ->setParameter('id_exp', $idExpediente)
                            ->andWhere('prc.idEstablecimientoReferido = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->orderBy('prz.fechaAlmacenado', 'DESC')
                            ->distinct();
        
        return $query->getQuery()->getResult();
    }
    
    public function obtenerAccesoEstab($id, $idEstab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz.id AS przId')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->innerJoin('prz.idSolicitudEstudio', 'prc')
                            ->where('prz.id = :id_prz')
                            ->setParameter('id_prz', $id)
                            ->andWhere('prc.idEstablecimientoReferido = :id_est')
                            ->setParameter('id_est', $idEstab);

        $query->distinct();
        $query->setMaxResults(1);
        
        return $query->getQuery()->getOneOrNullResult() ? true : false;
    }
    
    public function obtenerProcedimientosRealizados($id_estab, $bs_filters = array())
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->innerJoin('prz.idSolicitudEstudio', 'prc')
                            ->andWhere('prc.idEstablecimientoReferido = :id_est_ref')
                            ->setParameter('id_est_ref', $id_estab);
        
        $query->orderBy('prz.id', 'DESC');
                
        $query->distinct();
        
        return $query->getQuery()->getResult();
    }
    
    public function obtenerPendientesRealizar($id_estab, $bs_filters = array())
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                           // ->where('prz.idEstadoProcedimientoRealizado NOT IN (5, 6, 7, 8, 9)')
                            ->andWhere('prz.idSolicitudEstudio = pndR.idSolicitudEstudio');
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('pndR')
                            ->from('MinsalSimagdBundle:ImgPendienteRealizacion', 'pndR')
                            ->where('pndR.idEstablecimiento = :id_est_ref')
                            ->setParameter('id_est_ref', $id_estab)
                            ->orderBy('pndR.fechaIngresoLista', 'ASC')
                            ->addOrderBy('pndR.id', 'DESC');
        
        $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())));
                
        $query->distinct();
        
        return $query->getQuery()->getResult();
    }
    
    public function obtenerPendientesRealizarPersonal($id_estab, $sessionUser)
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->where('prz.idUserReg = :id_user')
                            ->andWhere('prz.idEstadoProcedimientoRealizado NOT IN (5, 6, 7, 8, 9)')
                            ->andWhere('prz.idSolicitudEstudio = pndR.idSolicitudEstudio');
                
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('pndR')
                            ->from('MinsalSimagdBundle:ImgPendienteRealizacion', 'pndR')
                            ->where('pndR.idEstablecimiento = :id_est_ref')
                            ->setParameter('id_est_ref', $id_estab)
                            ->orderBy('pndR.fechaIngresoLista', 'ASC')
                            ->addOrderBy('pndR.id', 'DESC');
        
        $query->andWhere($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_user', $sessionUser);
                
        $query->distinct();
        
        return $query->getQuery()->getResult();
    }
    
    public function data($id_estab, $bs_filters = array())
    {
        /** Consulta de exámenes realizados */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('prz')
                            ->select('prz')
                            ->addSelect('prc')
                            ->addSelect('cit')
                            ->addSelect('solcmpl')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')

                            ->addSelect('statusprz.id AS prz_id_estado, statusprz.nombreEstado AS prz_estado, statusprz.codigo AS prz_codEstado')
                            ->addSelect('CONCAT(COALESCE(tcnlprz.apellido, \'\'), \', \', COALESCE(tcnlprz.nombre, \'\')) AS prz_tecnologo, tcnlprz.id AS prz_id_tecnologo, tpEmp.tipo AS prz_tipoEmpleado')
                            ->addSelect('usrRg.username AS prz_usernameUserReg, usrRg.id AS prz_id_userReg, usrMd.username AS prz_usernameUserMod, usrMd.id AS prz_id_userMod')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS prz_nombreUserReg')
                            ->addSelect('CASE WHEN (usrMd.username IS NOT NULL) THEN CONCAT(COALESCE(usrMdEmp.apellido, \'\'), \', \', COALESCE(usrMdEmp.nombre, \'\')) ELSE \'\' END AS prz_nombreUserMod')

                            ->addSelect('statuscit.id AS cit_id_estado, statuscit.nombreEstado AS cit_estado')
                            ->addSelect('CASE WHEN (empCit.id IS NOT NULL) THEN CONCAT(COALESCE(empCit.apellido, \'\'), \', \', COALESCE(empCit.nombre, \'\')) ELSE \'\' END AS cit_recepcionista, empCit.id AS cit_id_recepcionista')
                            ->addSelect('CASE WHEN (tcnlcit.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlcit.apellido, \'\'), \', \', COALESCE(tcnlcit.nombre, \'\')) ELSE \'\' END AS cit_tecnologo, tcnlcit.id AS cit_id_tecnologo')

                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS prc_paciente')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS prc_solicitante')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')

                            ->addSelect('CASE WHEN (empcmpl.id IS NOT NULL) THEN CONCAT(COALESCE(empcmpl.apellido, \'\'), \', \', COALESCE(empcmpl.nombre, \'\')) ELSE \'\' END AS solcmpl_solicitante')
                            ->addSelect('mcmpl.nombrearea AS solcmpl_modalidad, prAtnCmpl.nombre AS solcmpl_prioridadAtencion, prAtnCmpl.codigo AS solcmpl_codigoPrioridad')
                            
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->innerJoin('prz.idEstadoProcedimientoRealizado', 'statusprz')
                            ->innerJoin('prz.idTecnologoRealiza', 'tcnlprz')
                            ->leftJoin('tcnlprz.idTipoEmpleado', 'tpEmp')
                            ->innerJoin('prz.idUserReg', 'usrRg')
                            ->leftJoin('prz.idUserMod', 'usrMd')
                            ->leftJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->leftJoin('usrMd.idEmpleado', 'usrMdEmp')
                            
                            ->leftJoin('prz.idSolicitudEstudio', 'prc')
                            ->leftJoin('prc.idAtenAreaModEstab', 'aams')
                            ->leftJoin('prc.idEmpleado', 'empprc')
                            ->leftJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('prc.idFormaContacto', 'frCt')
                            ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->leftJoin('aams.idAtencion', 'atn')
                            ->leftJoin('aams.idAreaModEstab', 'ams')
                            ->leftJoin('aams.idEstablecimiento', 'stdroot')
                            ->leftJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('prc.idExpediente', 'exp')
                            ->leftJoin('exp.idPaciente', 'pct')

                            ->leftJoin('prz.idCitaProgramada', 'cit')
                            ->leftJoin('cit.idEstadoCita', 'statuscit')
                            ->leftJoin('cit.idEmpleado', 'empCit')
                            ->leftJoin('cit.idTecnologoProgramado', 'tcnlcit')
                            
                            ->leftJoin('prz.idSolicitudEstudioComplementario', 'solcmpl')
                            ->leftJoin('solcmpl.idAreaServicioDiagnostico', 'mcmpl')
                            ->leftJoin('solcmpl.idRadiologoSolicita', 'empcmpl')
                            ->leftJoin('solcmpl.idPrioridadAtencion', 'prAtnCmpl');
        
        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

        $query->andWhere($query->expr()->orx(
                            $query->expr()->eq('prc.idEstablecimientoReferido', ':id_est_ref'),
                            $query->expr()->eq('solcmpl.idEstablecimientoSolicitado', ':id_est_sol'),
                            $query->expr()->eq('cit.idEstablecimiento', ':id_est_cit')
                        ))
                            ->setParameter('id_est_ref', $id_estab)
                            ->setParameter('id_est_sol', $id_estab)
                            ->setParameter('id_est_cit', $id_estab)
                            ->orderBy('prz.id', 'DESC')
                            ->distinct();
        
        /*
         * --| add filters from BSTABLE_FILTER to query
         */
        $simagd_er_model    = $this->getEntityManager()->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio');
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
    
    public function reporteProcedimientosTecnologo($id_estab, $idAreaServicioDiagnostico, $fechaPrxConsulta)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz.idTecnologoRealiza AS prz_id_tcnl, COUNT(prz.id) AS prz_num_realizados')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz')
                            ->leftJoin('MinsalSimagdBundle:ImgEstudioPaciente', 'est',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                    'prz.id = est.idProcedimientoRealizado')
                            ->innerJoin('cit.idSolicitudEstudio', 'prc')
                            ->where('cit.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->andWhere('prc.idAreaServicioDiagnostico = :id_mod')
                            ->setParameter('id_mod', $idAreaServicioDiagnostico)
                            ->andWhere('cit.fechaProgramada < :fechaPrxC')
                            ->setParameter('fechaPrxC', $fechaPrxConsulta)
                            ->andWhere('cit.idEstadoCita NOT IN (2, 3, 5, 6)')//Cambiar estado de confirmado a atendido en prz => 'Almacenado', o similares
                            ->groupBy('cit.fechaProgramada')//FECHA LIMITE, PROXIMA CONSULTA
                            ->orderBy('reservados', 'ASC')
                            ->addOrderBy('cit.fechaProgramada', 'DESC');
        
        return $query->getQuery()->getResult();
    }
    
    public function getSourceDataEstado($id_estab, $alias = 'prz')
    {
        $entity     = 'ImgCtlEstadoProcedimientoRealizado';
        if ($alias === 'cit')
        {
            $entity = 'ImgCtlEstadoCita';
        }
        if ($alias === 'lct')
        {
            $entity = 'ImgCtlEstadoLectura';
        }
        if ($alias === 'diag')
        {
            $entity = 'ImgCtlEstadoDiagnostico';
        }
        $query      = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('status.id AS id, status.nombreEstado AS text, status.codigo AS cod')
                            ->from('MinsalSimagdBundle:' . $entity, 'status')
                            ->orderBy('status.id', 'ASC');
        
        return $query->getQuery()->getResult();
    }

}