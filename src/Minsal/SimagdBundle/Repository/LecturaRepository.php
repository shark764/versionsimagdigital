<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LecturaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LecturaRepository extends EntityRepository
{
    public function obtenerTiposResultadoList()
    {
        $tiposResultado = $this->getEntityManager()
                    ->getRepository('MinsalSimagdBundle:ImgCtlTipoResultado')->findAll();

        $list = array();

        foreach ($tiposResultado as $tipoResult)
        {
            if(!$tipoResult->getIndeterminado()) {
                $list['Determinado'][$tipoResult->getId()] = $tipoResult;
            }
            else {
                $list['Indeterminado'][$tipoResult->getId()] = $tipoResult;
            }
        }

        return $list;
    }

    public function getLatestCorrelative($id_estab, $idAreaServicioDiagnostico)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('MAX(lct.correlativo) AS maxCod, IDENTITY(lct.idEstablecimiento), IDENTITY(prc.idAreaServicioDiagnostico )')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->innerJoin('lct.idEstudio', 'est')
                            ->innerJoin('est.idProcedimientoRealizado', 'prz')
                            ->innerJoin('prz.idSolicitudEstudio', 'prc')
                            ->where('lct.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->andWhere('prc.idAreaServicioDiagnostico = :id_mod')
                            ->setParameter('id_mod', $idAreaServicioDiagnostico)
                            ->groupBy('lct.idEstablecimiento')
                            ->addGroupBy('prc.idAreaServicioDiagnostico');

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function obtenerAccesoEstab($id, $idEstab)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lct.id AS lctId')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->where('lct.id = :id_lct')
                            ->setParameter('id_lct', $id)
                            ->andWhere('lct.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $idEstab);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult() ? true : false;
    }

    public function obtenerAccesoLectura($id, $idUser)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lct.id AS lctId')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->where('lct.id = :id_lct')
                            ->setParameter('id_lct', $id)
                            ->andWhere('lct.idUserReg = :id_user_lct_reg')
                            ->setParameter('id_user_lct_reg', $idUser);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult() ? true : false;
    }

    public function lecturaFueTranscrita($idLct = '-1')
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('diag.id AS diagId')
                            ->from('MinsalSimagdBundle:ImgDiagnostico', 'diag')
                            ->where('diag.idLectura = :id_lct')
                            ->setParameter('id_lct', $idLct);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult() ? true : false;
    }

    public function obtenerLecturas($id_estab, $bs_filters = array())
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lct')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->where('lct.idEstablecimiento = :id_est_diag')
                            ->setParameter('id_est_diag', $id_estab)
                            ->orderBy('lct.fechaLectura', 'DESC')
                            ->addOrderBy('lct.id', 'DESC')
                            ->distinct();

        return $query->getQuery()->getResult();
    }

    public function obtenerPendientesLectura($id_estab, $bs_filters = array())
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lct')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
//                            ->where('lct.idEstadoLectura NOT IN ( 4, 5, 6 )')
                            ->andWhere('lct.idEstudio = pndL.idEstudio');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('pndL')
                            ->from('MinsalSimagdBundle:ImgPendienteLectura', 'pndL')
                            ->where('pndL.idEstablecimiento = :id_est_diag')
                            ->setParameter('id_est_diag', $id_estab)
                            ->orderBy('pndL.fechaIngresoLista', 'ASC')
                            ->addOrderBy('pndL.id', 'DESC');

        $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())));

        $query->distinct();

        return $query->getQuery()->getResult();
    }

    public function obtenerPendientesLecturaPersonal($id_estab, $sessionUser, $bs_filters = array())
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lct')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->where('lct.idUserReg = :id_user')
                            ->andWhere('lct.idEstadoLectura NOT IN ( 4, 5, 6 )')
                            ->andWhere('lct.idEstudio = pndL.idEstudio');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('pndL')
                            ->from('MinsalSimagdBundle:ImgPendienteLectura', 'pndL')
                            ->where('pndL.idEstablecimiento = :id_est_diag')
                            ->setParameter('id_est_diag', $id_estab)
                            ->orderBy('pndL.fechaIngresoLista', 'ASC')
                            ->addOrderBy('pndL.id', 'DESC');

        $query->andWhere($query->expr()->exists($subQuery->getDql()))
                            ->setParameter('id_user', $sessionUser);

        $query->distinct();

        return $query->getQuery()->getResult();
    }

    public function data($id_estab, $bs_filters = array())
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder('lct')
                            ->select('lct')
                            ->addSelect('est')
                            // ->addSelect('ptrAsc')
                            ->addSelect('explocal')->addSelect('unknExp')
                            // ->addSelect('prAtn')

                            ->addSelect('lct.id AS id, stdroot.nombre AS origen, CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS paciente, explocal.numero AS numero_expediente, CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS medico, ar.nombre AS area_atencion, atn.nombre AS atencion, m.nombrearea AS modalidad, prAtn.nombre AS triage, CONCAT(COALESCE(emplct.apellido, \'\'), \', \', COALESCE(emplct.nombre, \'\')) AS radiologo, statuslct.nombreEstado AS estado, lct.fechaLectura AS fecha_lectura, CASE WHEN (tcnlprz.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlprz.apellido, \'\'), \', \', COALESCE(tcnlprz.nombre, \'\')) ELSE \'\' END AS tecnologo')

                            // ->addSelect('statusprz.id AS prz_id_estado, statusprz.nombreEstado AS prz_estado, statusprz.codigo AS prz_codEstado')
                            // ->addSelect('statuslct.id AS lct_id_estado, statuslct.nombreEstado AS lct_estado, statuslct.codigo AS lct_codEstado, tipoR.id AS lct_id_tipoResultado, tipoR.nombreTipo AS lct_tipoResultado, tipoR.indeterminado AS lct_indeterminado')
                            // ->addSelect('prc.fechaCreacion AS prc_fechaCreacion, prz.fechaAlmacenado AS prz_fechaAlmacenado')
                            // ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS prc_paciente')
                            // ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            // ->addSelect('CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) AS prc_solicitante')
                            // ->addSelect('CONCAT(COALESCE(emplct.apellido, \'\'), \', \', COALESCE(emplct.nombre, \'\')) AS lct_radiologo, emplct.id AS lct_id_radiologo, tpEmp.tipo AS lct_tipoEmpleado')
                            // ->addSelect('CASE WHEN (lctVal.id IS NOT NULL) THEN CONCAT(COALESCE(lctVal.apellido, \'\'), \', \', COALESCE(lctVal.nombre, \'\')) ELSE \'\' END AS lct_radiologoVal, lctVal.id AS lct_id_radiologoVal')
                            // ->addSelect('CASE WHEN (lctSol.id IS NOT NULL) THEN CONCAT(COALESCE(lctSol.apellido, \'\'), \', \', COALESCE(lctSol.nombre, \'\')) ELSE \'\' END AS lct_radiologoSol, lctSol.id AS lct_id_radiologoSol')
                            // ->addSelect('stdref.nombre AS prc_referido, stdref.id AS prc_id_referido, stdiag.nombre AS prc_diagnosticante, stdiag.id AS prc_id_diagnosticante, stdlct.nombre AS lct_solicitado, stdlct.id AS lct_id_solicitado')
                            // ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')
                            // ->addSelect('usrRg.username AS lct_usernameUserReg, usrRg.id AS lct_id_userReg')
                            // ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS lct_nombreUserReg')
                            // ->addSelect('CASE WHEN (tcnlprz.id IS NOT NULL) THEN CONCAT(COALESCE(tcnlprz.apellido, \'\'), \', \', COALESCE(tcnlprz.nombre, \'\')) ELSE \'\' END AS prz_tecnologo')
                            ->from('MinsalSimagdBundle:ImgLectura', 'lct')
                            ->innerJoin('lct.idEstadoLectura', 'statuslct')
                            ->innerJoin('lct.idTipoResultado', 'tipoR')
                            ->innerJoin('lct.idEmpleado', 'emplct')
                            ->leftJoin('lct.idPatronAsociado', 'ptrAsc')
                            ->leftJoin('lct.idRadiologoDesignadoAprobacion', 'lctVal')
                            ->leftJoin('lct.idRadiologoSolicita', 'lctSol')
                            ->leftJoin('lct.idEstudio', 'est')
                            ->leftJoin('est.idProcedimientoRealizado', 'prz')
                            ->leftJoin('prz.idEstadoProcedimientoRealizado', 'statusprz')
                            ->leftJoin('prz.idSolicitudEstudio', 'prc')
                            ->leftJoin('prz.idTecnologoRealiza', 'tcnlprz')
                            // ->innerJoin('lct.idUserReg', 'usrRg')
                            ->leftJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('prc.idEmpleado', 'empprc')
                            ->leftJoin('prc.idExpediente', 'exp')
                            ->leftJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->leftJoin('prc.idEstablecimientoReferido', 'stdref')
                            ->leftJoin('prc.idEstablecimientoDiagnosticante', 'stdiag')
                            ->leftJoin('lct.idEstablecimiento', 'stdlct')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            // ->leftJoin('prc.idFormaContacto', 'frCt')
                            // ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->leftJoin('aams.idAtencion', 'atn')
                            ->leftJoin('aams.idAreaModEstab', 'ams')
                            ->leftJoin('aams.idEstablecimiento', 'stdroot')
                            ->leftJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('exp.idPaciente', 'pct')
                            // ->innerJoin('usrRg.idEmpleado', 'usrRgEmp')
                            // ->leftJoin('emplct.idTipoEmpleado', 'tpEmp')
                            ->where('lct.idEstablecimiento = :id_est_diag')
                            ->setParameter('id_est_diag', $id_estab)
                            ->orderBy('lct.fechaLectura', 'DESC')
                            ->addOrderBy('lct.id', 'DESC')
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

    public function getSourceDataTipo($id_estab, $alias = 'tipoR')
    {
        $entity     = 'ImgCtlTipoResultado';
        if ($alias === 'tipoN')
        {
            $entity = 'ImgCtlTipoNotaDiagnostico';
        }
        $query      = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('type.id AS id, type.nombreTipo AS text, type.codigo AS cod')
                            ->from('MinsalSimagdBundle:' . $entity, 'type')
                            ->orderBy('type.id', 'ASC');

        return $query->getQuery()->getResult();
    }

}