<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CitaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CitaRepository extends EntityRepository
{

    public function events($p = array())
    {
        $conn   = $this->getEntityManager()->getConnection();

        $sql    = "select date_trunc('day', c.fecha_hora_inicio) AS fecha,
                        SUM(CASE WHEN s.codigo = 'ESP' THEN 1 ELSE 0 END) AS ESP,
                        SUM(CASE WHEN s.codigo = 'CNF' THEN 1 ELSE 0 END) AS CNF,
                        SUM(CASE WHEN s.codigo = 'ATN' THEN 1 ELSE 0 END) AS ATN,
                        SUM(CASE WHEN s.codigo = 'RPG' THEN 1 ELSE 0 END) AS RPG,
                        SUM(CASE WHEN s.codigo = 'CNL' or s.codigo = 'ANL' THEN 1 ELSE 0 END) AS CNL,
                        COUNT(c.id) AS total,
                        true AS allDay, /*'#555'*/'#183f52' AS color, 'summary' AS type
                        /*to_char(c.fecha_hora_inicio, 'FMMonth FMDDth, YYYY') AS title*/
                    from img_cita c
                        inner join img_ctl_estado_cita s
                            on s.id = c.id_estado_cita
                        left join img_solicitud_estudio r
                            on r.id = c.id_solicitud_estudio
                        left join ctl_area_servicio_diagnostico a
                            on a.id = r.id_area_servicio_diagnostico
                        left join mnt_expediente e
                            on e.id = r.id_expediente
                        left join mnt_empleado m
                            on m.id = c.id_tecnologo_programado
                    where c.id_establecimiento = :id_locale
                        and a.id = :id_mdld
                        and c.fecha_hora_inicio >= :cal_start_date and c.fecha_hora_fin <= :cal_end_date
                    group by 1
                    order by 1, 7 desc";

        $stmt   = $conn->prepare($sql);
        $stmt->bindValue(':id_locale', $p['locale'], \PDO::PARAM_INT);
        $stmt->bindValue(':id_mdld', $p['modality'], \PDO::PARAM_INT);
        $stmt->bindValue(':cal_start_date', \DateTime::createFromFormat('Y-m-d', $p['start'])->setTime(0, 0), "datetime");
        $stmt->bindValue(':cal_end_date', \DateTime::createFromFormat('Y-m-d', $p['end'])->setTime(0, 0), "datetime");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public function obtenerReservados($id_estab, $idAreaServicioDiagnostico, $fechaPrxConsulta)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('cit.fechaProgramada, COUNT(cit.fechaProgramada) AS reservados')
                            ->from('MinsalSimagdBundle:ImgCita', 'cit')
                            ->innerJoin('cit.idSolicitudEstudio', 'prc')
                            ->where('cit.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->andWhere('prc.idAreaServicioDiagnostico = :id_mod')
                            ->setParameter('id_mod', $idAreaServicioDiagnostico)
                            ->andWhere('cit.fechaProgramada < :fechaPrxC')
                            ->setParameter('fechaPrxC', $fechaPrxConsulta)
                            ->andWhere('cit.idEstadoCita NOT IN ( 2, 3, 5, 6 )')//Cambiar estado de confirmado a atendido en prz => 'Almacenado', o similares
                            ->groupBy('cit.fechaProgramada')//FECHA LIMITE, PROXIMA CONSULTA
                            ->orderBy('reservados', 'asc')
                            ->addOrderBy('cit.fechaProgramada', 'desc');

        return $query->getQuery()->getResult();
    }

    public function obtenerCitasEstabPorPaciente($idExpediente, $id_estab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('cit')
                            ->from('MinsalSimagdBundle:ImgCita', 'cit')
                            ->innerJoin('cit.idSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->where('prc.idExpediente = :id_exp')
                            ->setParameter('id_exp', $idExpediente)
                            ->andWhere('aams.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->orderBy('cit.fechaProgramada', 'desc');
        $query->distinct();

        return $query->getQuery()->getResult();
    }

    public function obtenerEventosReservadosCalendario($id_estab, $start, $end, $idAreaServicioDiagnostico, $idTecnologo = null, $numeroExp = null)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder('cit')
                            ->select('cit')
                            ->addSelect('prc')
                            ->addSelect('statusSc')
                            ->addSelect('explocal')
                            ->addSelect('unknExp')
                            ->addSelect('prAtn')
                            ->addSelect('cit.id AS id, cit.diaCompleto as allDay, cit.color as color')
                            ->addSelect('stdcit.nombre AS cit_establecimiento, stdcit.id AS cit_id_establecimiento, statuscit.nombreEstado as cit_estado, statuscit.codigo as cit_codEstado, statuscit.id AS cit_id_estado, cit.observaciones as description')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.id AS prc_id_prioridad, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS title')
                            ->addSelect('CONCAT(COALESCE(empcit.apellido, \'\'), \', \', COALESCE(empcit.nombre, \'\')) AS cit_empleado, empcit.id AS cit_id_empleado, tpEmp.tipo as cit_tipoEmpleado')
                            ->addSelect('usrRg.username as cit_usernameUserReg, usrRg.id AS cit_id_userReg, usrMd.username as cit_usernameUserMod, usrMd.id AS cit_id_userMod')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS cit_nombreUserReg')
                            ->addSelect('CASE WHEN (usrMd.username IS NOT NULL) THEN CONCAT(COALESCE(usrMdEmp.apellido, \'\'), \', \', COALESCE(usrMdEmp.nombre, \'\')) ELSE \'\' END AS cit_nombreUserMod')
                            ->addSelect('CASE WHEN (tcnlcit.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlcit.apellido, \'\'), \', \', COALESCE(tcnlcit.nombre, \'\')) ELSE \'\' END AS cit_tecnologo, tcnlcit.id AS cit_id_tecnologo')
                            ->addSelect('CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS prc_solicitante')
                            ->addSelect('CASE WHEN (radXInd.id IS NOT NULL) THEN CONCAT(COALESCE(radXInd.apellido, \'\'), \', \', COALESCE(radXInd.nombre, \'\')) ELSE \'\' END AS prc_radXInd, radXInd.id AS prc_id_radXInd')
                            ->from('MinsalSimagdBundle:ImgCita', 'cit')
                            ->innerJoin('cit.idEstadoCita', 'statuscit')
                            ->innerJoin('cit.idEstablecimiento', 'stdcit')
                            ->innerJoin('cit.idSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idExpediente', 'exp')
                            ->innerJoin('exp.idPaciente', 'pct')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('aams.idAtencion', 'atn')
                            ->innerJoin('aams.idAreaModEstab', 'ams')
                            ->innerJoin('aams.idEstablecimiento', 'stdroot')
                            ->innerJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('prc.idEmpleado', 'empprc')
                            ->innerJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('prc.idFormaContacto', 'frCt')
                            ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->innerJoin('cit.idEmpleado', 'empcit')
                            ->leftJoin('empcit.idTipoEmpleado', 'tpEmp')
                            ->leftJoin('cit.idTecnologoProgramado', 'tcnlcit')
                            ->innerJoin('cit.idUserPrg', 'usrRg')
                            ->leftJoin('cit.idUserReprg', 'usrMd')
                            ->leftJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->leftJoin('usrMd.idEmpleado', 'usrMdEmp')
                            ->leftJoin('prc.idEstadoSolicitud', 'statusSc')
                            ->leftJoin('prc.idRadiologoAgregaIndicaciones', 'radXInd')
                            ->where('prc.idAreaServicioDiagnostico = :id_mod')
                            ->setParameter('id_mod', $idAreaServicioDiagnostico)
                            ->andWhere('cit.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->andWhere('statuscit.codigo NOT IN (:status_cit_cod)')
                            ->setParameter('status_cit_cod', array('CNF', 'ATN', 'ANL', 'CNL'))
                            ->orderBy('cit.id', 'desc')
                            ->distinct();

        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

        if ($start && $end)
        {
            $query->andWhere('cit.fechaHoraInicio >= :cal_start_date')
                            ->andWhere('cit.fechaHoraFin <= :cal_end_date')
                            ->setParameter('cal_start_date', \DateTime::createFromFormat('Y-m-d', $start)->setTime(0, 0))
                            ->setParameter('cal_end_date', \DateTime::createFromFormat('Y-m-d', $end)->setTime(0, 0));
        }

        /** Tecnólogo programado enviado */
        if ($idTecnologo) {
            $query->andWhere('cit.idTecnologoProgramado = :id_tcnl')
                            ->setParameter('id_tcnl', $idTecnologo);
        }

        /** Número de expediente enviado */
        if($numeroExp) {
            $query->andWhere($query->expr()->like('LOWER(explocal.numero)', ':num_exp'))
                            ->setParameter('num_exp', '%' . strtolower($numeroExp) . '%');
        }

        return $query->getQuery()->getScalarResult();
    }

    public function obtenerParametroCitacion($id_estab, $idAreaServicioDiagnostico, $idProyeccionesSolicitadas )
    {
	$examenesIdArray = $this->getEntityManager()->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')
								->obtenerExamenesPorExplArray($idProyeccionesSolicitadas, false);

	$countExmArray = array_count_values($examenesIdArray );
	$idExamenServicioDiagnostico = count($countExmArray) > 0 ? array_search( max($countExmArray), $countExmArray ) : '-1';

        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prmCit')
                            ->from('MinsalSimagdBundle:ImgCtlConfiguracionAgenda', 'prmCit')
                            ->innerJoin('prmCit.idAreaExamenEstab', 'mr')
                            ->where('mr.idAreaServicioDiagnostico = :id_mod')
                            ->setParameter('id_mod', $idAreaServicioDiagnostico)
                            ->andWhere('mr.idExamenServicioDiagnostico = :id_exm')
                            ->setParameter('id_exm', $idExamenServicioDiagnostico)
                            ->andWhere('mr.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->andWhere('mr.imgHabilitado = TRUE')
                            ->orderBy('prmCit.maximoCitasDia', 'desc')
                            ->addOrderBy('prmCit.maximoCitasMedico', 'desc')
                            ->addOrderBy('prmCit.maximoCitasTurno', 'desc')
                            ->addOrderBy('prmCit.maximoCitasHora', 'desc');

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function obtenerAccesoEstab($id, $idEstab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('cit.id AS citId')
                            ->from('MinsalSimagdBundle:ImgCita', 'cit')
                            ->where('cit.id = :id_cit')
                            ->setParameter('id_cit', $id)
                            ->andWhere('cit.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $idEstab);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult() ? true : false;
    }

    public function obtenerAccesoEstabParamCit($id, $idEstab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prmCit.id AS prmCitId')
                            ->from('MinsalSimagdBundle:ImgCtlConfiguracionAgenda', 'prmCit')
                            ->innerJoin('prmCit.idAreaExamenEstab', 'mr')
                            ->where('prmCit.id = :id_prmCit')
                            ->setParameter('id_prmCit', $id)
                            ->andWhere('mr.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $idEstab);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult() ? true : false;
    }

    public function getPatients($id_estab, $numeroExp )
    {
        /** Consulta de pacientes */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('exp', 'pct')
                            ->from('MinsalSiapsBundle:MntExpediente', 'exp')
                            ->innerJoin('exp.idPaciente', 'pct')
                            ->where('exp.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->orderBy('exp.numero')
                            ->addOrderBy('pct.primerApellido')
                            ->addOrderBy('pct.primerNombre')
                            ->distinct();

        $query->andWhere($query->expr()->like('LOWER(exp.numero)', ':num_exp'))
                            ->setParameter('num_exp', '%' . strtolower($numeroExp) . '%');

        return $query->getQuery()->getResult();
    }

    public function obtenerCitaOrNullPorSolicitud($idSolicitudEstudio, $idEstab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('cit.id AS citId')
                            ->from('MinsalSimagdBundle:ImgCita', 'cit')
                            ->where('cit.idSolicitudEstudio = :id_prc')
                            ->setParameter('id_prc', $idSolicitudEstudio)
                            ->andWhere('cit.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $idEstab)
                            ->orderBy('cit.id', 'desc');

        $query->distinct();
        $query->setMaxResults(1);

        $result = $query->getQuery()->getOneOrNullResult();
        return $result ? $result['citId'] : NULL;
    }

    public function obtenerCitasProgramadasV2($id_estab, $bs_filters = array())
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder('cit')
                            ->select('cit')
                            ->addSelect('prc')
                            ->addSelect('statusSc')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')
//                             ->addSelect('prc.datosClinicos as datosClinicosV2')
                            ->addSelect('statuscit.nombreEstado as cit_estado, statuscit.codigo as cit_codEstado, statuscit.id AS cit_id_estado, rpAtz.parentesco as cit_responsable, rpAtz.id AS cit_id_responsable')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS prc_paciente')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('CONCAT(COALESCE(empcit.apellido, \'\'), \', \', COALESCE(empcit.nombre, \'\')) AS cit_empleado, empcit.id AS cit_id_empleado, tpEmp.tipo as cit_tipoEmpleado')
                            ->addSelect('stdcit.nombre AS cit_establecimiento, stdcit.id AS cit_id_establecimiento, stdiag.nombre AS prc_diagnosticante, stdiag.id AS prc_id_diagnosticante')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.id AS prc_id_prioridad, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')
                            ->addSelect('usrRg.username as cit_usernameUserReg, usrRg.id AS cit_id_userReg, usrMd.username as cit_usernameUserMod, usrMd.id AS cit_id_userMod')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS cit_nombreUserReg')
                            ->addSelect('CASE WHEN (usrMd.username IS NOT NULL) THEN CONCAT(COALESCE(usrMdEmp.apellido, \'\'), \', \', COALESCE(usrMdEmp.nombre, \'\')) ELSE \'\' END AS cit_nombreUserMod')
                            ->addSelect('CASE WHEN (tcnlcit.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlcit.apellido, \'\'), \', \', COALESCE(tcnlcit.nombre, \'\')) ELSE \'\' END AS cit_tecnologo, tcnlcit.id AS cit_id_tecnologo')
                            ->addSelect('CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS prc_solicitante')
                            ->addSelect('CASE WHEN (radXInd.id IS NOT NULL) THEN CONCAT(COALESCE(radXInd.apellido, \'\'), \', \', COALESCE(radXInd.nombre, \'\')) ELSE \'\' END AS prc_radXInd, radXInd.id AS prc_id_radXInd')
                            ->from('MinsalSimagdBundle:ImgCita', 'cit')
                            ->leftJoin('cit.idSolicitudEstudio', 'prc')
                            ->innerJoin('cit.idEmpleado', 'empcit')
                            ->innerJoin('cit.idEstadoCita', 'statuscit')
                            ->leftJoin('cit.idTecnologoProgramado', 'tcnlcit')
                            ->leftJoin('cit.idResponsableAutoriza', 'rpAtz')
                            ->innerJoin('cit.idEstablecimiento', 'stdcit')
                            ->leftJoin('prc.idEmpleado', 'empprc')
                            ->leftJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('cit.idUserPrg', 'usrRg')
                            ->leftJoin('cit.idUserReprg', 'usrMd')
                            ->leftJoin('prc.idExpediente', 'exp')
                            ->leftJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->leftJoin('prc.idEstablecimientoDiagnosticante', 'stdiag')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('prc.idFormaContacto', 'frCt')
                            ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->leftJoin('aams.idAtencion', 'atn')
                            ->leftJoin('aams.idAreaModEstab', 'ams')
                            ->leftJoin('aams.idEstablecimiento', 'stdroot')
                            ->leftJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('exp.idPaciente', 'pct')
                            ->leftJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->leftJoin('usrMd.idEmpleado', 'usrMdEmp')
                            ->leftJoin('empcit.idTipoEmpleado', 'tpEmp')
                            ->leftJoin('prc.idEstadoSolicitud', 'statusSc')
                            ->leftJoin('prc.idRadiologoAgregaIndicaciones', 'radXInd')
                            ->where('cit.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab);

        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

        $query->orderBy('cit.id', 'desc')
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

}
