<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PendienteTranscripcionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PendienteTranscripcionRepository extends EntityRepository
{
    /*
     * **************************************************************************
     * Asignar transcriptor a elementos de lista
     * **************************************************************************
     */
    public function addToWorkList($id_estabLocal, $id_trcX, $id_empUsserAssign, $rows = array())
    {
        /*
         * QueryBuilder
         */
        $qb = $this->getEntityManager()->createQueryBuilder();
        /*
         * Query
         */
        $q  = $qb->update('MinsalSimagdBundle:RyxLecturaPendienteTranscripcion', 'pndT')
                    ->set('pndT.idTranscriptorAsignado', $qb->expr()->literal($id_trcX))
                    ->set('pndT.idAsignaTranscriptor', $qb->expr()->literal($id_empUsserAssign))
                    ->where('pndT.idEstablecimiento = :id_est_pndT')
                    ->setParameter('id_est_pndT', $id_estabLocal)
                    ->andWhere('pndT.id IN (:pndT_rows_affected)')
                    ->setParameter('pndT_rows_affected', $rows)
                ->getQuery();
        /*
         * execute query
         */
        $p = $q->execute();
    }

    public function getWorkList($id_estab, $bs_filters = array())
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('diag')
                            ->from('MinsalSimagdBundle:RyxDiagnosticoRadiologico', 'diag')
                            // ->where('diag.idEstadoDiagnostico NOT IN ( 3, 5, 6 )')
                            ->andWhere('diag.idLectura = pndT.idLectura');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('pndT')
                            ->select('pndT')
                            ->addSelect('lct')
                            ->addSelect('ptrAsc')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')

                            ->addSelect('pndT.id AS id, stdroot.nombre AS origen, CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS paciente, explocal.numero AS numero_expediente, CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS medico, ar.nombre AS area_atencion, atn.nombre AS atencion, m.nombrearea AS modalidad, prAtn.nombre AS triage, CONCAT(COALESCE(emplct.apellido, \'\'), \', \', COALESCE(emplct.nombre, \'\')) AS radiologo, statuslct.nombreEstado AS estado, pndT.fechaIngresoLista AS fecha_ingreso, CASE WHEN (tcnlprz.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlprz.apellido, \'\'), \', \', COALESCE(tcnlprz.nombre, \'\')) ELSE \'\' END AS tecnologo'/*, diag.conclusion AS conclusion'*/)

                            ->addSelect('statuslct.id AS lct_id_estado, statuslct.nombreEstado AS lct_estado, tipoR.id AS lct_id_tipoResultado, tipoR.nombreTipo AS lct_tipoResultado, tipoR.indeterminado AS lct_indeterminado')
                            ->addSelect('prc.fechaCreacion AS prc_fechaCreacion, est.id AS est_id, est.fechaEstudio AS est_fechaEstudio, est.url AS est_url, prz.fechaAlmacenado AS prz_fechaAlmacenado')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS prc_paciente')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) AS prc_solicitante')
                            ->addSelect('CONCAT(COALESCE(emplct.apellido, \'\'), \', \', COALESCE(emplct.nombre, \'\')) AS lct_radiologo, emplct.id AS lct_id_radiologo, tpEmp.tipo AS lct_tipoEmpleado')
                            ->addSelect('CASE WHEN (lctVal.id IS NOT NULL) THEN CONCAT(COALESCE(lctVal.apellido, \'\'), \', \', COALESCE(lctVal.nombre, \'\')) ELSE \'\' END AS lct_radiologoVal, lctVal.id AS lct_id_radiologoVal')
                            ->addSelect('CASE WHEN (lctSol.id IS NOT NULL) THEN CONCAT(COALESCE(lctSol.apellido, \'\'), \', \', COALESCE(lctSol.nombre, \'\')) ELSE \'\' END AS lct_radiologoSol, lctSol.id AS lct_id_radiologoSol')
                            ->addSelect('stdref.nombre AS prc_referido, stdref.id AS prc_id_referido, stdiag.nombre AS prc_diagnosticante, stdiag.id AS prc_id_diagnosticante, stdlct.nombre AS lct_solicitado, stdlct.id AS lct_id_solicitado')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')
                            ->addSelect('usrRg.username AS lct_usernameUserReg, usrRg.id AS lct_id_userReg')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS lct_nombreUserReg')
                            ->addSelect('CASE WHEN (tcnlprz.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlprz.apellido, \'\'), \', \', COALESCE(tcnlprz.nombre, \'\')) ELSE \'\' END AS prz_tecnologo')
                            ->from('MinsalSimagdBundle:RyxLecturaPendienteTranscripcion', 'pndT')
                            ->innerJoin('pndT.idLectura', 'lct')
                            ->innerJoin('lct.idEstadoLectura', 'statuslct')
                            ->innerJoin('lct.idTipoResultado', 'tipoR')
                            ->innerJoin('lct.idEmpleado', 'emplct')
                            ->leftJoin('lct.idRadiologoDesignadoAprobacion', 'lctVal')
                            ->leftJoin('lct.idRadiologoSolicita', 'lctSol')
                            ->leftJoin('lct.idEstudio', 'est')
                            ->leftJoin('lct.idPatronAsociado', 'ptrAsc')
                            ->leftJoin('est.idProcedimientoRealizado', 'prz')
                            ->leftJoin('prz.idSolicitudEstudio', 'prc')
                            ->leftJoin('prz.idTecnologoRealiza', 'tcnlprz')
                            ->innerJoin('lct.idUserReg', 'usrRg')
                            ->leftJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('prc.idEmpleado', 'empprc')
                            ->leftJoin('prc.idExpediente', 'exp')
                            ->leftJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->leftJoin('prc.idEstablecimientoReferido', 'stdref')
                            ->leftJoin('prc.idEstablecimientoDiagnosticante', 'stdiag')
                            ->leftJoin('lct.idEstablecimiento', 'stdlct')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('prc.idFormaContacto', 'frCt')
                            ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->leftJoin('aams.idAtencion', 'atn')
                            ->leftJoin('aams.idAreaModEstab', 'ams')
                            ->leftJoin('aams.idEstablecimiento', 'stdroot')
                            ->leftJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('exp.idPaciente', 'pct')
                            ->innerJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->leftJoin('emplct.idTipoEmpleado', 'tpEmp')
                            // ->leftJoin('MinsalSimagdBundle:RyxDiagnosticoRadiologico', 'diag',
                            //         \Doctrine\ORM\Query\Expr\Join::WITH,
                            //         'lct.id = diag.idLectura')
                            ->where('pndT.idEstablecimiento = :id_est_diag')
                            ->setParameter('id_est_diag', $id_estab)
                            ->orderBy('pndT.fechaIngresoLista', 'ASC')
                            ->addOrderBy('pndT.id', 'DESC');

        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

        $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())))
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

    public function assignedWorkList($id_estab, $sessionUser, $bs_filters = array())
    {
        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('pndT')
                            ->select('pndT')
                            ->addSelect('lct')
                            ->addSelect('diag')
                            ->addSelect('ptrApl')
                            ->addSelect('ptrAsc')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')
                            ->addSelect('statuslct.id AS lct_id_estado, statuslct.nombreEstado AS lct_estado, tipoR.id AS lct_id_tipoResultado, tipoR.nombreTipo AS lct_tipoResultado, tipoR.indeterminado AS lct_indeterminado, statusdiag.id AS diag_id_estado, statusdiag.nombreEstado AS diag_estado')
                            ->addSelect('prc.fechaCreacion AS prc_fechaCreacion, est.id AS est_id, est.fechaEstudio AS est_fechaEstudio, est.url AS est_url, prz.fechaAlmacenado AS prz_fechaAlmacenado')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS prc_paciente')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) AS prc_solicitante')
                            ->addSelect('CONCAT(COALESCE(emplct.apellido, \'\'), \', \', COALESCE(emplct.nombre, \'\')) AS lct_radiologo, emplct.id AS lct_id_radiologo, tpEmp.tipo AS lct_tipoEmpleado')
                            ->addSelect('CONCAT(COALESCE(empDiag.apellido, \'\'), \', \', COALESCE(empDiag.nombre, \'\')) AS diag_transcriptor, empDiag.id AS diag_id_transcriptor')
                            ->addSelect('CASE WHEN (lctVal.id IS NOT NULL) THEN CONCAT(COALESCE(lctVal.apellido, \'\'), \', \', COALESCE(lctVal.nombre, \'\')) ELSE \'\' END AS lct_radiologoVal, lctVal.id AS lct_id_radiologoVal')
                            ->addSelect('CASE WHEN (lctSol.id IS NOT NULL) THEN CONCAT(COALESCE(lctSol.apellido, \'\'), \', \', COALESCE(lctSol.nombre, \'\')) ELSE \'\' END AS lct_radiologoSol, lctSol.id AS lct_id_radiologoSol')
                            ->addSelect('stdref.nombre AS prc_referido, stdref.id AS prc_id_referido, stdiag.nombre AS prc_diagnosticante, stdiag.id AS prc_id_diagnosticante, stdlct.nombre AS lct_solicitado, stdlct.id AS lct_id_solicitado')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')
                            ->addSelect('usrRg.username AS lct_usernameUserReg, usrRg.id AS lct_id_userReg')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS lct_nombreUserReg')
                            ->addSelect('CASE WHEN (tcnlprz.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlprz.apellido, \'\'), \', \', COALESCE(tcnlprz.nombre, \'\')) ELSE \'\' END AS prz_tecnologo')
                            ->from('MinsalSimagdBundle:RyxLecturaPendienteTranscripcion', 'pndT')
                            ->innerJoin('pndT.idLectura', 'lct')
                            ->innerJoin('MinsalSimagdBundle:RyxDiagnosticoRadiologico', 'diag',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                    'lct.id = diag.idLectura')
                            ->innerJoin('diag.idEstadoDiagnostico', 'statusdiag')
                            ->innerJoin('lct.idEstadoLectura', 'statuslct')
                            ->innerJoin('lct.idTipoResultado', 'tipoR')
                            ->innerJoin('lct.idEmpleado', 'emplct')
                            ->innerJoin('diag.idEmpleado', 'empDiag')
                            ->leftJoin('lct.idPatronAsociado', 'ptrAsc')
                            ->leftJoin('diag.idPatronAplicado', 'ptrApl')
                            ->leftJoin('lct.idRadiologoDesignadoAprobacion', 'lctVal')
                            ->leftJoin('lct.idRadiologoSolicita', 'lctSol')
                            ->leftJoin('lct.idEstudio', 'est')
                            ->leftJoin('est.idProcedimientoRealizado', 'prz')
                            ->leftJoin('prz.idSolicitudEstudio', 'prc')
                            ->leftJoin('prz.idTecnologoRealiza', 'tcnlprz')
                            ->innerJoin('lct.idUserReg', 'usrRg')
                            ->innerJoin('diag.idUserReg', 'diagUsrRg')
                            ->leftJoin('diag.idUserMod', 'diagUsrMd')
                            ->leftJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('prc.idEmpleado', 'empprc')
                            ->leftJoin('prc.idExpediente', 'exp')
                            ->leftJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->leftJoin('prc.idEstablecimientoReferido', 'stdref')
                            ->leftJoin('prc.idEstablecimientoDiagnosticante', 'stdiag')
                            ->leftJoin('lct.idEstablecimiento', 'stdlct')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('prc.idFormaContacto', 'frCt')
                            ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->leftJoin('aams.idAtencion', 'atn')
                            ->leftJoin('aams.idAreaModEstab', 'ams')
                            ->leftJoin('aams.idEstablecimiento', 'stdroot')
                            ->leftJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('exp.idPaciente', 'pct')
                            ->innerJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->innerJoin('diagUsrRg.idEmpleado', 'diagUsrRgEmp')
                            ->leftJoin('diagUsrMd.idEmpleado', 'diagUsrMdEmp')
                            ->leftJoin('empDiag.idTipoEmpleado', 'tpEmp')
                            ->where('pndT.idEstablecimiento = :id_est_diag')
                            ->setParameter('id_est_diag', $id_estab)
                            ->andWhere('diag.idUserReg = :id_user')
                            ->setParameter('id_user', $sessionUser)
                            ->andWhere('statusdiag.codigo NOT IN (:status_diag_cod)')
                            ->setParameter('status_diag_cod', array('TRC', 'CRG', 'APR'))
                            ->orderBy('pndT.fechaIngresoLista', 'ASC')
                            ->addOrderBy('pndT.id', 'DESC')
                            ->distinct();

        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

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