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
                            ->orderBy('prz.fechaAlmacenado', 'desc');
        $query->distinct();
        
        return $query->getQuery()->getResult();
    }
    
    public function obtenerAccesoEstab($id, $idEstab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz.id as przId')
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
        
        $query->orderBy('prz.id', 'desc');
                
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
                            ->orderBy('pndR.fechaIngresoLista', 'asc')
                            ->addOrderBy('pndR.id', 'desc');
        
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
                            ->orderBy('pndR.fechaIngresoLista', 'asc')
                            ->addOrderBy('pndR.id', 'desc');
        
        $query->andWhere($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_user', $sessionUser);
                
        $query->distinct();
        
        return $query->getQuery()->getResult();
    }

    public function obtenerPendientesRealizarV2($id_estab, $bs_filters = array())
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('prz')
                            ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz');
                           // ->where('prz.idEstadoProcedimientoRealizado NOT IN (5, 6, 7, 8, 9)');

        $subQuery->andWhere($subQuery->expr()->orx(
                            $subQuery->expr()->eq('prz.idSolicitudEstudio', 'pndR.idSolicitudEstudio'),
                            $subQuery->expr()->eq('prz.idCitaProgramada', 'pndR.idCitaProgramada'),
                            $subQuery->expr()->eq('prz.idSolicitudEstudioComplementario', 'pndR.idSolicitudEstudioComplementario')
                        ));
			    // ->where('prz.id = pndR.idProcedimientoIniciado');
			    // ->where('prz.idSolicitudEstudio = pndR.idSolicitudEstudio OR prz.idCitaProgramada = pndR.idCitaProgramada OR prz.idSolicitudEstudioComplementario = pndR.idSolicitudEstudioComplementario');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('pndR')
                            ->select('pndR')
                            ->addSelect('prc')
                            ->addSelect('cit')
                            ->addSelect('solcmpl')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')

                            ->addSelect('pndR.id as id, stdroot.nombre as origen, concat(pct.primerApellido, \' \', coalesce(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', coalesce(pct.segundoNombre, \'\')) as paciente, explocal.numero as numero_expediente, case when (empprc.id is not null) then concat(coalesce(empprc.apellido, \'\'), \', \', coalesce(empprc.nombre, \'\')) else \'\' end as medico, ar.nombre as area_atencion, atn.nombre as atencion, m.nombrearea as modalidad, prAtn.nombre as triage')

                            ->addSelect('stdPndR.nombre as pndR_establecimiento, stdPndR.id as pndR_id_establecimiento')

                            ->addSelect('statuscit.id as cit_id_estado, statuscit.nombreEstado as cit_estado')
                            ->addSelect('case when (empCit.id is not null) then concat(coalesce(empCit.apellido, \'\'), \', \', coalesce(empCit.nombre, \'\')) else \'\' end as cit_recepcionista, empCit.id as cit_id_recepcionista')
                            ->addSelect('case when (tcnlcit.id is not null) then concat(coalesce(tcnlcit.apellido, \'\'), \', \', coalesce(tcnlcit.nombre, \'\')) else \'\' end as cit_tecnologo, tcnlcit.id as cit_id_tecnologo')

                            ->addSelect('concat(pct.primerApellido, \' \', coalesce(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', coalesce(pct.segundoNombre, \'\')) as prc_paciente')
                            ->addSelect('stdroot.nombre as prc_origen, stdroot.id as prc_id_origen, ar.nombre as prc_areaAtencion, ar.id as prc_id_areaAtencion, atn.nombre as prc_atencion, atn.id as prc_id_atencion')
                            ->addSelect('case when (empprc.id is not null) then concat(coalesce(empprc.apellido, \'\'), \', \', coalesce(empprc.nombre, \'\')) else \'\' end as prc_solicitante')
                            ->addSelect('m.nombrearea as prc_modalidad, m.id as prc_id_modalidad, prAtn.nombre as prc_prioridadAtencion, prAtn.codigo as prc_codigoPrioridad, frCt.nombre as prc_formaContacto, ctPct.parentesco as prc_contactoPaciente')

                            ->addSelect('case when (empcmpl.id is not null) then concat(coalesce(empcmpl.apellido, \'\'), \', \', coalesce(empcmpl.nombre, \'\')) else \'\' end as solcmpl_solicitante')
                            ->addSelect('mcmpl.nombrearea as solcmpl_modalidad, prAtnCmpl.nombre as solcmpl_prioridadAtencion, prAtnCmpl.codigo as solcmpl_codigoPrioridad')

                            ->from('MinsalSimagdBundle:ImgPendienteRealizacion', 'pndR')
                            ->innerJoin('pndR.idEstablecimiento', 'stdPndR')

                            ->leftJoin('pndR.idSolicitudEstudio', 'prc')
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

                            ->leftJoin('pndR.idSolicitudEstudioComplementario', 'solcmpl')
                            ->leftJoin('solcmpl.idAreaServicioDiagnostico', 'mcmpl')
                            ->leftJoin('solcmpl.idRadiologoSolicita', 'empcmpl')
                            ->leftJoin('solcmpl.idPrioridadAtencion', 'prAtnCmpl')

                            ->leftJoin('pndR.idCitaProgramada', 'cit')
                            ->leftJoin('cit.idEstadoCita', 'statuscit')
                            ->leftJoin('cit.idEmpleado', 'empCit')
                            ->leftJoin('cit.idTecnologoProgramado', 'tcnlcit')

                            ->where('pndR.idEstablecimiento = :id_est_ref')
                            ->setParameter('id_est_ref', $id_estab)
                            ->andWhere('pndR.idProcedimientoIniciado IS NULL')
                            ->orderBy('pndR.fechaIngresoLista', 'asc')
                            ->addOrderBy('pndR.id', 'desc');
        
        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

        $query/*->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())))*/
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

    public function obtenerPendientesRealizarPersonalV2($id_estab, $sessionUser, $bs_filters = array())
    {
        /** SubQuery */
        //         $subQuery = $this->getEntityManager()
        //                         ->createQueryBuilder()
        //                             ->select('prz')
        //                             ->from('MinsalSimagdBundle:ImgProcedimientoRealizado', 'prz');
        // //                            ->where('prz.idEstadoProcedimientoRealizado NOT IN (5, 6, 7, 8, 9)');
        //
        //         $subQuery->andWhere($subQuery->expr()->orx(
        //                             $subQuery->expr()->eq('prz.idSolicitudEstudio', 'pndR.idSolicitudEstudio'),
        //                             $subQuery->expr()->eq('prz.idCitaProgramada', 'pndR.idCitaProgramada'),
        //                             $subQuery->expr()->eq('prz.idSolicitudEstudioComplementario', 'pndR.idSolicitudEstudioComplementario')
        //                         ));
        // // 			    ->where('prz.id = pndR.idProcedimientoIniciado');
        // // 			    ->where('prz.idSolicitudEstudio = pndR.idSolicitudEstudio OR prz.idCitaProgramada = pndR.idCitaProgramada OR prz.idSolicitudEstudioComplementario = pndR.idSolicitudEstudioComplementario');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('pndR')
                            ->select('pndR')
                            ->addSelect('prz')
                            ->addSelect('prc')
                            ->addSelect('cit')
                            ->addSelect('solcmpl')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')

                            ->addSelect('stdPndR.nombre as pndR_establecimiento, stdPndR.id as pndR_id_establecimiento')

                            ->addSelect('statusprz.id as prz_id_estado, statusprz.nombreEstado as prz_estado, statusprz.codigo as prz_codEstado')
                            ->addSelect('concat(coalesce(tcnlprz.apellido, \'\'), \', \', coalesce(tcnlprz.nombre, \'\')) as prz_tecnologo, tcnlprz.id as prz_id_tecnologo')

                            ->addSelect('statuscit.id as cit_id_estado, statuscit.nombreEstado as cit_estado')
                            ->addSelect('case when (empCit.id is not null) then concat(coalesce(empCit.apellido, \'\'), \', \', coalesce(empCit.nombre, \'\')) else \'\' end as cit_recepcionista, empCit.id as cit_id_recepcionista')
                            ->addSelect('case when (tcnlcit.id is not null) then concat(coalesce(tcnlcit.apellido, \'\'), \', \', coalesce(tcnlcit.nombre, \'\')) else \'\' end as cit_tecnologo, tcnlcit.id as cit_id_tecnologo')

                            ->addSelect('concat(pct.primerApellido, \' \', coalesce(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', coalesce(pct.segundoNombre, \'\')) as prc_paciente')
                            ->addSelect('stdroot.nombre as prc_origen, stdroot.id as prc_id_origen, ar.nombre as prc_areaAtencion, ar.id as prc_id_areaAtencion, atn.nombre as prc_atencion, atn.id as prc_id_atencion')
                            ->addSelect('case when (empprc.id is not null) then concat(coalesce(empprc.apellido, \'\'), \', \', coalesce(empprc.nombre, \'\')) else \'\' end as prc_solicitante')
                            ->addSelect('m.nombrearea as prc_modalidad, m.id as prc_id_modalidad, prAtn.nombre as prc_prioridadAtencion, prAtn.codigo as prc_codigoPrioridad, frCt.nombre as prc_formaContacto, ctPct.parentesco as prc_contactoPaciente')

                            ->addSelect('case when (empcmpl.id is not null) then concat(coalesce(empcmpl.apellido, \'\'), \', \', coalesce(empcmpl.nombre, \'\')) else \'\' end as solcmpl_solicitante')
                            ->addSelect('mcmpl.nombrearea as solcmpl_modalidad, prAtnCmpl.nombre as solcmpl_prioridadAtencion, prAtnCmpl.codigo as solcmpl_codigoPrioridad')

                            ->from('MinsalSimagdBundle:ImgPendienteRealizacion', 'pndR')
                            ->innerJoin('pndR.idEstablecimiento', 'stdPndR')

                            ->innerJoin('pndR.idProcedimientoIniciado', 'prz')
                            ->innerJoin('prz.idEstadoProcedimientoRealizado', 'statusprz')
                            ->innerJoin('prz.idTecnologoRealiza', 'tcnlprz')

                            /** SIEMPRE DEBE HABER UN PRC, AUNQ VENGA DE SOLCMPL, SOLCMPL->idSolicitudEstudio */
                            ->leftJoin('pndR.idSolicitudEstudio', 'prc')
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

                            ->leftJoin('pndR.idSolicitudEstudioComplementario', 'solcmpl')
                            ->leftJoin('solcmpl.idAreaServicioDiagnostico', 'mcmpl')
                            ->leftJoin('solcmpl.idRadiologoSolicita', 'empcmpl')
                            ->leftJoin('solcmpl.idPrioridadAtencion', 'prAtnCmpl')

                            ->leftJoin('pndR.idCitaProgramada', 'cit')
                            ->leftJoin('cit.idEstadoCita', 'statuscit')
                            ->leftJoin('cit.idEmpleado', 'empCit')
                            ->leftJoin('cit.idTecnologoProgramado', 'tcnlcit')

                            ->where('pndR.idEstablecimiento = :id_est_ref')
                            ->setParameter('id_est_ref', $id_estab)
                            ->andWhere('prz.idUserReg = :id_user')
                            ->setParameter('id_user', $sessionUser)
                            ->andWhere('statusprz.codigo NOT IN (:status_prz_cod)')
                            ->setParameter('status_prz_cod', array('ALM', 'CNL', 'RZD', 'DCT', 'PST'))
                            ->orderBy('pndR.fechaIngresoLista', 'asc')
                            ->addOrderBy('pndR.id', 'desc')
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
    
    public function obtenerProcedimientosRealizadosV2($id_estab, $bs_filters = array())
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

                            ->addSelect('statusprz.id as prz_id_estado, statusprz.nombreEstado as prz_estado, statusprz.codigo as prz_codEstado')
                            ->addSelect('concat(coalesce(tcnlprz.apellido, \'\'), \', \', coalesce(tcnlprz.nombre, \'\')) as prz_tecnologo, tcnlprz.id as prz_id_tecnologo, tpEmp.tipo as prz_tipoEmpleado')
                            ->addSelect('usrRg.username as prz_usernameUserReg, usrRg.id as prz_id_userReg, usrMd.username as prz_usernameUserMod, usrMd.id as prz_id_userMod')
                            ->addSelect('concat(coalesce(usrRgEmp.apellido, \'\'), \', \', coalesce(usrRgEmp.nombre, \'\')) as prz_nombreUserReg')
                            ->addSelect('case when (usrMd.username is not null) then concat(coalesce(usrMdEmp.apellido, \'\'), \', \', coalesce(usrMdEmp.nombre, \'\')) else \'\' end as prz_nombreUserMod')

                            ->addSelect('statuscit.id as cit_id_estado, statuscit.nombreEstado as cit_estado')
                            ->addSelect('case when (empCit.id is not null) then concat(coalesce(empCit.apellido, \'\'), \', \', coalesce(empCit.nombre, \'\')) else \'\' end as cit_recepcionista, empCit.id as cit_id_recepcionista')
                            ->addSelect('case when (tcnlcit.id is not null) then concat(coalesce(tcnlcit.apellido, \'\'), \', \', coalesce(tcnlcit.nombre, \'\')) else \'\' end as cit_tecnologo, tcnlcit.id as cit_id_tecnologo')

                            ->addSelect('concat(pct.primerApellido, \' \', coalesce(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', coalesce(pct.segundoNombre, \'\')) as prc_paciente')
                            ->addSelect('stdroot.nombre as prc_origen, stdroot.id as prc_id_origen, ar.nombre as prc_areaAtencion, ar.id as prc_id_areaAtencion, atn.nombre as prc_atencion, atn.id as prc_id_atencion')
                            ->addSelect('case when (empprc.id is not null) then concat(coalesce(empprc.apellido, \'\'), \', \', coalesce(empprc.nombre, \'\')) else \'\' end as prc_solicitante')
                            ->addSelect('m.nombrearea as prc_modalidad, m.id as prc_id_modalidad, prAtn.nombre as prc_prioridadAtencion, prAtn.codigo as prc_codigoPrioridad, frCt.nombre as prc_formaContacto, ctPct.parentesco as prc_contactoPaciente')

                            ->addSelect('case when (empcmpl.id is not null) then concat(coalesce(empcmpl.apellido, \'\'), \', \', coalesce(empcmpl.nombre, \'\')) else \'\' end as solcmpl_solicitante')
                            ->addSelect('mcmpl.nombrearea as solcmpl_modalidad, prAtnCmpl.nombre as solcmpl_prioridadAtencion, prAtnCmpl.codigo as solcmpl_codigoPrioridad')
                            
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
                            ->orderBy('prz.id', 'desc')
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
                            ->select('prz.idTecnologoRealiza as prz_id_tcnl, count(prz.id) as prz_num_realizados')
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
                            ->orderBy('reservados', 'asc')
                            ->addOrderBy('cit.fechaProgramada', 'desc');
        
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
                            ->select('status.id as id, status.nombreEstado as text, status.codigo as cod')
                            ->from('MinsalSimagdBundle:' . $entity, 'status')
                            ->orderBy('status.id', 'asc');
        
        return $query->getQuery()->getResult();
    }
}
