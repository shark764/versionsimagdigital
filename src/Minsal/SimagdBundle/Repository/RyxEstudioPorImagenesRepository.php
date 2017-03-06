<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RyxEstudioPorImagenesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RyxEstudioPorImagenesRepository extends EntityRepository
{
    public function obtenerEstudioPreinscrito($idSolicitudEstudio)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('est')
                            ->from('MinsalSimagdBundle:RyxEstudioPorImagenes', 'est')
                            ->innerJoin('est.idProcedimientoRealizado', 'prz')
                            ->where('prz.idSolicitudEstudio = :id_prc')
                            ->setParameter('id_prc', $idSolicitudEstudio);
        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }

    /* Funcion que retorna los datos para realizar
       las Validaciones del PACS */
    public function verificarDatos($idProcedimiento)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('m')
                            ->from('MinsalSimagdBundle:RyxEstudioPorImagenes', 'm')
                            ->where('m.idProcedimientoRealizado = :id_proc')
                            ->setParameter('id_proc', $idProcedimiento);
        $query->distinct();

        return $query->getQuery()->getResult();
    }

    public function verificarUid($iuid)
    {
        $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('u')
                ->from('MinsalSimagdBundle:RyxEstudioPorImagenes', 'u')
                ->where('u.estudioUid = :estudio_iuid')
                ->setParameter('estudio_iuid', $iuid);

         return $query->getQuery()->getResult();
    }

    /**
     * Método perteneciente a módulo <simagd>
     * @param type $id_estab
     * @return type
     */
    public function getStudiesWithoutRadiologicalDiagnosis($id_estab, $idLectura = null, $idPaciente = null)
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lctEst')
                            ->from('MinsalSimagdBundle:RyxLecturaEstudio', 'lctEst')
                            ->innerJoin('lctEst.idLectura', 'lct')
                            ->where('est.id = lctEst.idEstudio')
                            ->andWhere('lct.idEstablecimiento = :id_est');

	/** SubQuery4 */
	$subQuery4 = $this->getEntityManager()
			->createQueryBuilder()
                            ->select('soldiag')
                            ->from('MinsalSimagdBundle:RyxSolicitudDiagnosticoPostEstudio', 'soldiag')
			    ->where('est.id = soldiag.idEstudio')
			    ->andWhere('soldiag.idEstablecimientoSolicitado = :id_est_sol');

	/** SubQuery5 */
	$subQuery5 = $this->getEntityManager()
			->createQueryBuilder()
                            ->select('prc')
                            ->from('MinsalSimagdBundle:RyxSolicitudEstudio', 'prc')
                            ->innerJoin('MinsalSimagdBundle:RyxProcedimientoRadiologicoRealizado', 'prz_2',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                    'prc.id = prz_2.idSolicitudEstudio')
			    ->where('prz.id = prz_2.id')
			    ->andWhere('prc.requiereDiagnostico = TRUE')
			    ->andWhere('prc.idEstablecimientoDiagnosticante = :id_est_diag');

	/** SubQuery6 */
	$subQuery6 = $this->getEntityManager()
			->createQueryBuilder()
                            ->select('pndL')
                            ->from('MinsalSimagdBundle:RyxEstudioPendienteLectura', 'pndL')
			    ->where('est.id = pndL.idEstudio')
			    ->andWhere('pndL.idEstablecimiento = :id_est_2');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('est', 'prz')
                            ->from('MinsalSimagdBundle:RyxEstudioPorImagenes', 'est')
                            ->innerJoin('est.idProcedimientoRealizado', 'prz');

        if ($idLectura) {
            /** SubQuery2 */
            $subQuery2 = $this->getEntityManager()
                            ->createQueryBuilder()
                                ->select('lctEst2')
                                ->from('MinsalSimagdBundle:RyxLecturaEstudio', 'lctEst2')
                                ->where('est.id = lctEst2.idEstudio')
                                ->andWhere('lctEst2.idLectura = :id_lct');

            $query->andWhere($query->expr()->orx(
                                    $query->expr()->exists($subQuery2->getDql()),
                                    $query->expr()->not($query->expr()->exists($subQuery->getDql()))
                                ))
                                ->setParameter('id_lct', $idLectura)
                                ->setParameter('id_est', $id_estab);

            /** SubQuery3 */
            $subQuery3 = $this->getEntityManager()
                            ->createQueryBuilder()
                                ->select('lct_2')
				->from('MinsalSimagdBundle:RyxLecturaRadiologica', 'lct_2')
                                ->where('est.id = lct_2.idEstudio')
				->andWhere('lct_2.solicitadaPorRadiologo = TRUE')
                                ->andWhere('lct_2.id = :id_lct_2');

            $query->andWhere($query->expr()->orx(
                                    $query->expr()->exists($subQuery3->getDql()),
                                    $query->expr()->exists($subQuery4->getDql()),
                                    $query->expr()->exists($subQuery5->getDql()),
                                    $query->expr()->exists($subQuery6->getDql()),
                                    $query->expr()->not($query->expr()->isNull('prz.idSolicitudEstudioComplementario'))
                                ))
                                ->setParameter('id_lct_2', $idLectura)
                                ->setParameter('id_est_sol', $id_estab)
                                ->setParameter('id_est_diag', $id_estab)
                                ->setParameter('id_est_2', $id_estab);
        } else {
            $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())))
                                ->setParameter('id_est', $id_estab);

	    $query->andWhere($query->expr()->orx(
				    $query->expr()->exists($subQuery4->getDql()),
				    $query->expr()->exists($subQuery5->getDql()),
                                    $query->expr()->exists($subQuery6->getDql()),
				    $query->expr()->not($query->expr()->isNull('prz.idSolicitudEstudioComplementario'))
				))
				->setParameter('id_est_sol', $id_estab)
                                ->setParameter('id_est_diag', $id_estab)
                                ->setParameter('id_est_2', $id_estab);
        }

        if ($idPaciente) {
            $query->innerJoin('est.idExpediente', 'exp')
                                ->andWhere('exp.idPaciente = :id_pct')
                                ->setParameter('id_pct', $idPaciente);
        } else {
	    if ($idLectura) {
		$query->setMaxResults(0);
	    }
        }

        $query->orderBy('prz.idSolicitudEstudioComplementario', 'DESC')
                            ->addOrderBy('prz.idSolicitudEstudio', 'DESC')
                            ->addOrderBy('est.fechaEstudio', 'DESC')
                            ->addOrderBy('prz.id', 'DESC');

        $query->distinct();

        return $query;
    }

    public function obtenerEstudiosPaciente($id_estab, $fechaDesde, $fechaHasta, $criteria, $limiteResultados)
    {
//        $criteria
//                $criteria['fechaNacimiento']
//                $criteria['numeroExp']
//                $criteria['dui']
//                $criteria['criteriaStr']

        /** Ningún parámetro fué enviado */
        if(count($criteria) < 1) {
            $limiteResultados = 0;
        }

        /** Consulta de pacientes */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('est')
                            ->select('est')
                            ->addSelect('exp')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS est_paciente')
                            ->addSelect('stdest.nombre AS est_almacenado, stdest.id AS est_id_almacenado')
                            ->from('MinsalSimagdBundle:RyxEstudioPorImagenes', 'est')
                            ->innerJoin('est.idExpediente', 'exp')
                            ->innerJoin('exp.idPaciente', 'pct')
                            ->innerJoin('est.idEstablecimiento', 'stdest')
                            ->where('est.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->orderBy('est.fechaEstudio')
                            ->addOrderBy('exp.numero');

        /** Número de expediente enviado */
        if (array_key_exists('numeroExp', $criteria)) {
            $query->andWhere($query->expr()->like('LOWER(exp.numero)', ':num_exp'))
                            ->setParameter('num_exp', '%' . strtolower($criteria['numeroExp']) . '%');
        }

        /** Número de identificación */
        if (array_key_exists('dui', $criteria)) {
            $query->andWhere('pct.numeroDocIdePaciente = :dui')
                            ->setParameter('dui', $criteria['dui']);
        }

        /** Fecha de nacimiento */
        if (array_key_exists('fechaNacimiento', $criteria)) {
            $query->andWhere('pct.fechaNacimiento = :fechaNacimiento')
                            ->setParameter('fechaNacimiento', $criteria['fechaNacimiento']);
        }

        /** Coincidencias en campos de texto */
        if (array_key_exists('criteriaStr', $criteria) && count($criteria['criteriaStr']) > 0) {
            $andX = $query->expr()->andX();

            foreach($criteria['criteriaStr'] as $key => $value) {
                $andX->add($query->expr()->like('LOWER(pct.' . $key . ')', ':' . $key));
                $query->setParameter($key, '%' . strtolower($value) . '%');
            }
            $query->andWhere($andX);
        }

	/** Rango de fechas de búsqueda */
	if($fechaDesde && $fechaHasta) {
	    $query->andWhere($query->expr()->between('est.fechaEstudio', ':fecha_desde', ':fecha_hasta'))
			    ->setParameter('fecha_desde', $fechaDesde)
			    ->setParameter('fecha_hasta', $fechaHasta);
	}

        $query->distinct();
        $query->setMaxResults($limiteResultados);

        return $query->getQuery()->getScalarResult();
    }

    public function countEstudioLecturasRealizadas($idEstudio)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('COUNT(lct.id) AS numReg')
                            ->from('MinsalSimagdBundle:RyxLecturaRadiologica', 'lct')
                            ->where('lct.idEstudio = :id_est')
                            ->setParameter('id_est', $idEstudio);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function countEstudioPendienteLectura($idEstudio)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('COUNT(pndL.id) AS numReg')
                            ->from('MinsalSimagdBundle:RyxEstudioPendienteLectura', 'pndL')
                            ->where('pndL.idEstudio = :id_est')
                            ->setParameter('id_est', $idEstudio);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function countEstudioLecturaEstudio($idEstudio)
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('COUNT(lctEst.id) AS numReg')
                            ->from('MinsalSimagdBundle:RyxLecturaEstudio', 'lctEst')
                            ->where('lctEst.idEstudio = :id_est')
                            ->setParameter('id_est', $idEstudio);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function data($idStdPacs, $fechaDesde, $fechaHasta, $criteria, $limiteR, $bs_filters = array())
    {
        /** Ningún parámetro fué enviado */
        if(count($criteria) < 1 &&
                !(array_key_exists('xparam', $bs_filters) && array_key_exists('explocal_numero', $bs_filters['xparam']))) {
            $limiteR = 0;
        }

        /** Consulta de pacientes */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('est')
                            ->select('est')
                            ->addSelect('prz')
                            ->addSelect('prc')
                            ->addSelect('solcmpl')
                            ->addSelect('estPdr')
                            ->addSelect('cit')
                            ->addSelect('exp')
                            ->addSelect('pct')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')

                            ->addSelect('est.id AS id, stdroot.nombre AS origen, CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS paciente, explocal.numero AS numero_expediente, CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS medico, ar.nombre AS area_atencion, atn.nombre AS atencion, m.nombrearea AS modalidad, prAtn.nombre AS triage, est.fechaEstudio AS fecha_estudio')

                            ->addSelect('statusprz.id AS prz_id_estado, statusprz.nombreEstado AS prz_estado, statusprz.codigo AS prz_codEstado')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS est_paciente')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.id AS prc_id_prioridad, prAtn.codigo AS prc_codigoPrioridad')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS prc_solicitante')
                            ->addSelect('CASE WHEN (empcmpl.id IS NOT NULL) THEN CONCAT(COALESCE(empcmpl.apellido, \'\'), \', \', COALESCE(empcmpl.nombre, \'\')) ELSE \'\' END AS solcmpl_solicitante')
                            ->addSelect('CONCAT(COALESCE(tcnlprz.apellido, \'\'), \', \', COALESCE(tcnlprz.nombre, \'\')) AS prz_tecnologo, tcnlprz.id AS prz_id_tecnologo')
                            ->addSelect('stdest.nombre AS est_almacenado, stdest.id AS est_id_almacenado')
                            ->addSelect('mcmpl.nombrearea AS solcmpl_modalidad, mcmpl.id AS solcmpl_id_modalidad, prAtnCmpl.nombre AS solcmpl_prioridadAtencion, prAtnCmpl.id AS solcmpl_id_prioridad, prAtnCmpl.codigo AS solcmpl_codigoPrioridad')
                            ->from('MinsalSimagdBundle:RyxEstudioPorImagenes', 'est')
                            ->innerJoin('est.idEstablecimiento', 'stdest')
                            ->innerJoin('est.idProcedimientoRealizado', 'prz')
                            ->innerJoin('prz.idEstadoProcedimientoRealizado', 'statusprz')
                            ->innerJoin('prz.idTecnologoRealiza', 'tcnlprz')

                            ->leftJoin('prz.idSolicitudEstudio', 'prc')
                            ->leftJoin('prc.idAtenAreaModEstab', 'aams')
                            ->leftJoin('prc.idEmpleado', 'empprc')
                            ->leftJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('aams.idAtencion', 'atn')
                            ->leftJoin('aams.idAreaModEstab', 'ams')
                            ->leftJoin('aams.idEstablecimiento', 'stdroot')
                            ->leftJoin('ams.idAreaAtencion', 'ar')

                            ->innerJoin('est.idExpediente', 'exp')
                            ->innerJoin('exp.idPaciente', 'pct')

                            ->leftJoin('prz.idCitaProgramada', 'cit')
                            ->leftJoin('cit.idEstadoCita', 'statuscit')

                            ->leftJoin('prz.idSolicitudEstudioComplementario', 'solcmpl')
                            ->leftJoin('solcmpl.idAreaServicioDiagnostico', 'mcmpl')
                            ->leftJoin('solcmpl.idRadiologoSolicita', 'empcmpl')
                            ->leftJoin('solcmpl.idPrioridadAtencion', 'prAtnCmpl')
                            ->leftJoin('solcmpl.idEstudioPadre', 'estPdr')

                            ->where('est.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $idStdPacs)
                            ->orderBy('est.fechaEstudio', 'DESC')
                            ->addOrderBy('explocal.numero', 'DESC');

        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $idStdPacs);

        /** Número de expediente enviado */
        if (array_key_exists('numeroExp', $criteria)) {
            $query->andWhere($query->expr()->like('LOWER(exp.numero)', ':num_exp'))
                            ->setParameter('num_exp', '%' . strtolower($criteria['numeroExp']) . '%');
        }

        /** Número de identificación */
        if (array_key_exists('dui', $criteria)) {
            $query->andWhere('pct.numeroDocIdePaciente = :dui')
                            ->setParameter('dui', $criteria['dui']);
        }

        /** Fecha de nacimiento */
        if (array_key_exists('fechaNacimiento', $criteria)) {
            $query->andWhere('pct.fechaNacimiento = :fechaNacimiento')
                            ->setParameter('fechaNacimiento', $criteria['fechaNacimiento']);
        }

        /** Coincidencias en campos de texto */
        if (array_key_exists('criteriaStr', $criteria) && count($criteria['criteriaStr']) > 0) {
            $andX = $query->expr()->andX();

            foreach($criteria['criteriaStr'] as $key => $value) {
                $andX->add($query->expr()->like('LOWER(pct.' . $key . ')', ':' . $key));
                $query->setParameter($key, '%' . strtolower($value) . '%');
            }
            $query->andWhere($andX);
        }

	/** Rango de fechas de búsqueda */
	if($fechaDesde && $fechaHasta) {
	    $query->andWhere($query->expr()->between('est.fechaEstudio', ':fecha_desde', ':fecha_hasta'))
			    ->setParameter('fecha_desde', $fechaDesde)
			    ->setParameter('fecha_hasta', $fechaHasta);
	}

        $query->distinct();
        $query->setMaxResults($limiteR);

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


//        echo "" . $query;
//        throw new AccessDeniedException();

        return $query->getQuery()->getScalarResult();
    }

    public function obtenerEstudioSinSolicitudDiagV2($prc_id, $std_id = null)
    {
        /** SubQuery lctEst */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('lctEst')
                            ->from('MinsalSimagdBundle:RyxLecturaEstudio', 'lctEst')
//                             ->innerJoin('lctEst.idLectura', 'lct')
                            ->where('est.id = lctEst.idEstudio');
//                             ->andWhere('lct.idEstablecimiento = :id_est');

	/** SubQuery2 soldiag */
	$subQuery2 = $this->getEntityManager()
			->createQueryBuilder()
                            ->select('soldiag')
                            ->from('MinsalSimagdBundle:RyxSolicitudDiagnosticoPostEstudio', 'soldiag')
			    ->where('est.id = soldiag.idEstudio')
                            ->andWhere('soldiag.idSolicitudEstudio = :id_prc_2');
// 			    ->andWhere('soldiag.idEstablecimientoSolicitado = :id_est_2');

	/** SubQuery3 lct */
	$subQuery3 = $this->getEntityManager()
			->createQueryBuilder()
			    ->select('lct')
			    ->from('MinsalSimagdBundle:RyxLecturaRadiologica', 'lct')
			    ->where('est.id = lct.idEstudio');
//                             ->andWhere('lct.idEstablecimiento = :id_est_3');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('est')
                            ->select('est')
                            ->from('MinsalSimagdBundle:RyxEstudioPorImagenes', 'est')
                            ->innerJoin('est.idProcedimientoRealizado', 'prz')
                            ->where('prz.idSolicitudEstudio = :id_prc')
                            ->setParameter('id_prc', $prc_id)
//                             ->andWhere('est.idEstablecimiento = :id_est')
//                             ->setParameter('id_est', $std_id)
                            ->andWhere('prz.idSolicitudEstudioComplementario IS NULL')
                            ->orderBy('est.fechaEstudio', 'DESC');

	$query->andWhere($query->expr()->andx(
				$query->expr()->not($query->expr()->exists($subQuery->getDql())),
				$query->expr()->not($query->expr()->exists($subQuery2->getDql())),
				$query->expr()->not($query->expr()->exists($subQuery3->getDql()))
			    ))
			    ->setParameter('id_prc_2', $prc_id);

        $query->distinct();
        $query->setMaxResults(1);

        return $query->getQuery()->getScalarResult();
    }

    public function getPatients($id_estab, $numeroExp)
    {
        /** Consulta de pacientes */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('exp')
                            ->select('exp')
                            ->addSelect('pct')
                            ->addSelect('exp.id AS exp_id, exp.numero AS exp_numero')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS pct_nombreCompleto')
                            ->from('MinsalSiapsBundle:MntExpediente', 'exp')
                            ->innerJoin('exp.idPaciente', 'pct')
                            ->where('exp.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $id_estab)
                            ->orderBy('exp.numero')
                            ->addOrderBy('pct_nombreCompleto')
                            ->distinct()
                            ->setMaxResults(15);

        $query->andWhere($query->expr()->like('LOWER(exp.numero)', ':num_exp'))
                            ->setParameter('num_exp', '%' . strtolower($numeroExp) . '%');

        return $query->getQuery()->getScalarResult();
    }

}
//if ( exists (   select "id"
//                from "ryx_solicitud_diagnostico_post_estudio"
//                where "id_estudio" = old.id_estudio )
//    ) or
//    ( exists (  select "prc"."id"
//                from "ryx_solicitud_estudio" as "prc"
//                inner join "ryx_procedimiento_radiologico_realizado" as "prz" on ("prc"."id" = "prz"."id_solicitud_estudio")
//                inner join "ryx_estudio_por_imagenes" as "est" on ("prz"."id" = "est"."id_procedimiento_realizado")
//                where "est"."id" = old.id_estudio and
//                        ( "prc"."requiere_diagnostico" is true or
//                            "prz"."id_solicitud_estudio_complementario" is not null
//                        ))
//    ) or
//    envio_radiologo is true then

    /* ESTABS DEBEN SER HACIA ESTE ESTAB, REVISAR ESO EN TRIGGERS, DIAGNOSTICANTE, SOLICITADO, DEBE SER EL LOCAL PARA AGREGAR A LISTA O EN "NO LEIDOS DE LCT_FORM" */