<?php

namespace Minsal\SimagdBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RyxSolicitudEstudioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RyxSolicitudEstudioRepository extends EntityRepository
{
    public function data($id_estab, $bs_filters = array())
    {
        $query = $this->getEntityManager()
                        ->createQueryBuilder('prc')
                            ->select('prc')
                            ->addSelect('statusSc')
                            ->addSelect('explocal')
                            ->addSelect('unknExp')
                            ->addSelect('prAtn')

                            ->addSelect('prc.id AS id, stdroot.nombre AS origen, CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS paciente, explocal.numero AS numero_expediente, CASE WHEN (empprc.id IS NOT NULL) THEN CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) ELSE \'\' END AS medico, ar.nombre AS area_atencion, atn.nombre AS atencion, m.nombrearea AS modalidad, prAtn.nombre AS triage, prc.fechaCreacion AS fecha_solicitud, statusSc.nombreEstado AS estado, COALESCE(statusSc.porcentajeAvance, 0) AS progreso')

                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS prc_paciente')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('CONCAT(COALESCE(empprc.apellido, \'\'), \', \', COALESCE(empprc.nombre, \'\')) AS prc_empleado, empprc.id AS prc_id_empleado, tpEmp.tipo AS prc_tipoEmpleado')
                            ->addSelect('stdref.nombre AS prc_referido, stdref.id AS prc_id_referido, stdiag.nombre AS prc_diagnosticante, stdiag.id AS prc_id_diagnosticante')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.id AS prc_id_prioridad, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')
                            ->addSelect('usrRg.username AS prc_usernameUserReg, usrRg.id AS prc_id_userReg, usrMd.username AS prc_usernameUserMod, usrMd.id AS prc_id_userMod')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS prc_nombreUserReg')
                            ->addSelect('CASE WHEN (usrMd.username IS NOT NULL) THEN CONCAT(COALESCE(usrMdEmp.apellido, \'\'), \', \', COALESCE(usrMdEmp.nombre, \'\')) ELSE \'\' END AS prc_nombreUserMod')
                            ->addSelect('CASE WHEN (radXInd.id IS NOT NULL) THEN CONCAT(COALESCE(radXInd.apellido, \'\'), \', \', COALESCE(radXInd.nombre, \'\')) ELSE \'\' END AS prc_radXInd, radXInd.id AS prc_id_radXInd')
                            ->from('MinsalSimagdBundle:RyxSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idEmpleado', 'empprc')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('prc.idUserReg', 'usrRg')
                            ->leftJoin('prc.idUserMod', 'usrMd')
                            ->leftJoin('prc.idExpediente', 'exp')
                            ->innerJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->innerJoin('prc.idEstablecimientoReferido', 'stdref')
                            ->leftJoin('prc.idEstablecimientoDiagnosticante', 'stdiag')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('prc.idFormaContacto', 'frCt')
                            ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->innerJoin('aams.idAtencion', 'atn')
                            ->innerJoin('aams.idAreaModEstab', 'ams')
                            ->innerJoin('aams.idEstablecimiento', 'stdroot')
                            ->innerJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('exp.idPaciente', 'pct')
                            // ->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                            //         \Doctrine\ORM\Query\Expr\Join::WITH,
                            //         'pct.id = explocal.idPaciente')//http://stackoverflow.com/questions/15815869/doctrine2-left-join-with-2-conditions
                            ->leftJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->leftJoin('usrMd.idEmpleado', 'usrMdEmp')
                            ->leftJoin('empprc.idTipoEmpleado', 'tpEmp')
                            ->leftJoin('prc.idEstadoSolicitud', 'statusSc')
                            ->leftJoin('prc.idRadiologoAgregaIndicaciones', 'radXInd');

        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')
                            ->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

         $query->andWhere($query->expr()->orx(
                                $query->expr()->eq('prc.idEstablecimientoReferido', ':id_est_ref'),
                                $query->expr()->eq('prc.idEstablecimientoDiagnosticante', ':id_est_diag'),
                                $query->expr()->eq('aams.idEstablecimiento', ':id_est')
                            ))
                            ->setParameter('id_est_ref', $id_estab)
                            ->setParameter('id_est_diag', $id_estab)
                            ->setParameter('id_est', $id_estab);

        $query->orderBy('prc.id', 'DESC')
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

    public function getPatients($idEstab, $numeroExp, $criteria, $fechaNacimiento, $dui, $limiteR, $min_numeroExp = null, $bs_filters = array())
    {
        /** Ningún parámetro fué enviado */
        if(count($criteria) < 1 && !$numeroExp && !$fechaNacimiento && !$dui && !$min_numeroExp) {
            $limiteR = 0;
        }

        /** Consulta de pacientes */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('exp')
                            ->select('exp')
                            ->addSelect('pct')
                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS pct_nombreCompleto')
                            ->addSelect('sex.nombre AS pct_sexo, pctOcp.nombre AS pct_ocupacion, pctEstCv.nombre AS pct_estadoCivil, pctNcl.nacionalidad AS pct_nacionalidad')
                            ->from('MinsalSiapsBundle:MntExpediente', 'exp')
                            ->innerJoin('exp.idPaciente', 'pct')
                            ->innerJoin('pct.idSexo', 'sex')
                            ->leftJoin('pct.idOcupacion', 'pctOcp')
                            ->leftJoin('pct.idEstadoCivil', 'pctEstCv')
                            ->leftJoin('pct.idNacionalidad', 'pctNcl')
                            ->where('exp.idEstablecimiento = :id_est')
                            ->setParameter('id_est', $idEstab)
                            ->orderBy('exp.numero')
                            ->addOrderBy('pct.primerApellido')
                            ->addOrderBy('pct.primerNombre');

        /** Número de expediente enviado */
        if($numeroExp) {
            $query->andWhere($query->expr()->like('LOWER(exp.numero)', ':num_exp'))
                            ->setParameter('num_exp', '%' . strtolower($numeroExp) . '%');
        }

        /** Número de identificación */
        if($dui) {
            $query->andWhere('pct.numeroDocIdePaciente = :dui')
                            ->setParameter('dui', $dui);
        }

        /** Fecha de nacimiento */
        if($fechaNacimiento) {
            $query->andWhere('pct.fechaNacimiento = :fechaNacimiento')
                            ->setParameter('fechaNacimiento', $fechaNacimiento);
        }

        /** Coincidencias en campos de texto */
        if(count($criteria) > 0) {
            $andX = $query->expr()->andX();

            foreach($criteria as $key => $value) {
                $andX->add($query->expr()->like('LOWER(pct.' . $key . ')', ':' . $key));
                $query->setParameter($key, '%' . strtolower($value) . '%');
            }
            $query->andWhere($andX);
        }

        /** NUM de Expediente enviado - Min Search */
        if($min_numeroExp) {
            $query->andWhere($query->expr()->like('LOWER(exp.numero)', ':num_exp'))
                            ->setParameter('num_exp', '%' . strtolower($min_numeroExp) . '%');
        }

        $query->distinct()
                            ->setMaxResults($limiteR);

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

    // http://stackoverflow.com/questions/19185587/left-join-on-condition-and-other-condition-syntax-in-doctrine
    public function getPendingPatients($id_estab, $bs_filters = array())
    {
        /** SubQuery */
        $subQuery = $this->getEntityManager()
                        ->createQueryBuilder()
                            ->select('cit')
                            ->from('MinsalSimagdBundle:RyxCitaProgramada', 'cit')
                            ->where('prc.id = cit.idSolicitudEstudio');

        /** Query */
        $query = $this->getEntityManager()
                        ->createQueryBuilder('prc')
                            ->select('prc')
                            ->addSelect('exp')
                            ->addSelect('statusSc')
                            ->addSelect('explocal')->addSelect('unknExp')
                            ->addSelect('prAtn')

                            ->addSelect('prc.id AS id, stdroot.nombre AS origen, CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS paciente, explocal.numero AS numero_expediente, CASE WHEN (emp.id IS NOT NULL) THEN CONCAT(COALESCE(emp.apellido, \'\'), \', \', COALESCE(emp.nombre, \'\')) ELSE \'\' END AS medico, ar.nombre AS area_atencion, atn.nombre AS atencion, m.nombrearea AS modalidad, prAtn.nombre AS triage, prc.fechaCreacion AS fecha_solicitud, statusSc.nombreEstado AS estado, COALESCE(statusSc.porcentajeAvance, 0) AS progreso')

                            ->addSelect('CONCAT(pct.primerApellido, \' \', COALESCE(pct.segundoApellido, \'\'), \', \', pct.primerNombre, \' \', COALESCE(pct.segundoNombre, \'\')) AS prc_paciente')
                            ->addSelect('stdroot.nombre AS prc_origen, stdroot.id AS prc_id_origen, ar.nombre AS prc_areaAtencion, ar.id AS prc_id_areaAtencion, atn.nombre AS prc_atencion, atn.id AS prc_id_atencion')
                            ->addSelect('CONCAT(COALESCE(emp.apellido, \'\'), \', \', COALESCE(emp.nombre, \'\')) AS prc_empleado, emp.id AS prc_id_empleado, tpEmp.tipo AS prc_tipoEmpleado')
                            ->addSelect('stdref.nombre AS prc_referido, stdref.id AS prc_id_referido, stdiag.nombre AS prc_diagnosticante, stdiag.id AS prc_id_diagnosticante')
                            ->addSelect('m.nombrearea AS prc_modalidad, m.id AS prc_id_modalidad, prAtn.nombre AS prc_prioridadAtencion, prAtn.id AS prc_id_prioridad, prAtn.codigo AS prc_codigoPrioridad, frCt.nombre AS prc_formaContacto, ctPct.parentesco AS prc_contactoPaciente')
                            ->addSelect('usrRg.username AS prc_usernameUserReg, usrRg.id AS prc_id_userReg, usrMd.username AS prc_usernameUserMod, usrMd.id AS prc_id_userMod')
                            ->addSelect('CONCAT(COALESCE(usrRgEmp.apellido, \'\'), \', \', COALESCE(usrRgEmp.nombre, \'\')) AS prc_nombreUserReg')
                            ->addSelect('CASE WHEN (usrMd.username IS NOT NULL) THEN CONCAT(COALESCE(usrMdEmp.apellido, \'\'), \', \', COALESCE(usrMdEmp.nombre, \'\')) ELSE \'\' END AS prc_nombreUserMod')
                            ->addSelect('CASE WHEN (radXInd.id IS NOT NULL) THEN CONCAT(COALESCE(radXInd.apellido, \'\'), \', \', COALESCE(radXInd.nombre, \'\')) ELSE \'\' END AS prc_radXInd, radXInd.id AS prc_id_radXInd')
                            ->from('MinsalSimagdBundle:RyxSolicitudEstudio', 'prc')
                            ->innerJoin('prc.idEmpleado', 'emp')
                            ->innerJoin('prc.idAtenAreaModEstab', 'aams')
                            ->innerJoin('prc.idUserReg', 'usrRg')
                            ->leftJoin('prc.idUserMod', 'usrMd')
                            ->leftJoin('prc.idExpediente', 'exp')
                            ->innerJoin('prc.idAreaServicioDiagnostico', 'm')
                            ->innerJoin('prc.idEstablecimientoReferido', 'stdref')
                            ->leftJoin('prc.idEstablecimientoDiagnosticante', 'stdiag')
                            ->leftJoin('prc.idPrioridadAtencion', 'prAtn')
                            ->leftJoin('prc.idFormaContacto', 'frCt')
                            ->leftJoin('prc.idContactoPaciente', 'ctPct')
                            ->innerJoin('aams.idAtencion', 'atn')
                            ->innerJoin('aams.idAreaModEstab', 'ams')
                            ->innerJoin('aams.idEstablecimiento', 'stdroot')
                            ->innerJoin('ams.idAreaAtencion', 'ar')
                            ->leftJoin('exp.idPaciente', 'pct')
                            ->leftJoin('usrRg.idEmpleado', 'usrRgEmp')
                            ->leftJoin('usrMd.idEmpleado', 'usrMdEmp')
                            ->leftJoin('emp.idTipoEmpleado', 'tpEmp')
                            ->leftJoin('prc.idEstadoSolicitud', 'statusSc')
                            ->leftJoin('prc.idRadiologoAgregaIndicaciones', 'radXInd')
                            ->where('prc.idEstablecimientoReferido = :id_std_ref')
                            ->setParameter('id_std_ref', $id_estab)
                            ->andWhere('prc.requiereCita = TRUE');

        $query->leftJoin('prc.idExpedienteFicticio', 'unknExp')
                            ->leftJoin('MinsalSiapsBundle:MntExpediente', 'explocal',
                                    \Doctrine\ORM\Query\Expr\Join::WITH,
                                            $query->expr()->andx(
                                                $query->expr()->eq('pct.id', 'explocal.idPaciente'),
                                                $query->expr()->eq('explocal.idEstablecimiento', ':id_est_explocal')
                                            )
                            )
                            ->setParameter('id_est_explocal', $id_estab);

        if(is_array($bs_filters) && array_key_exists('xparam', $bs_filters))
        {
            if (is_array($bs_filters['xparam']))
            {
                /*
                * Modalidad enviada como parámetro
                */
                if (array_key_exists('navbar_search_modalidad', $bs_filters['xparam']) && $bs_filters['xparam']['navbar_search_modalidad']['value'])
                {
                    /** Modalidad enviada */
                    $query->andWhere('prc.idAreaServicioDiagnostico = :id_mod')
                                ->setParameter('id_mod', $bs_filters['xparam']['navbar_search_modalidad']['value']);
                }
                /*
                * Número de expediente enviado como parámetro
                */
                if (array_key_exists('navbar_search_expediente', $bs_filters['xparam']) && $bs_filters['xparam']['navbar_search_expediente']['value'])
                {
                    /** Número de expediente enviado */
                    $query->andWhere($query->expr()->like('LOWER(explocal.numero)', ':num_exp'))
                                ->setParameter('num_exp', '%' . strtolower($bs_filters['xparam']['navbar_search_expediente']['value']) . '%');
                }
            }
        }

        $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())))
                            ->orderBy('prAtn.id', 'ASC')
                            ->addOrderBy('prc.id', 'DESC')
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

    /*
     * --| FILTERS for bootstrapTables
     */
    public function getBsTableFiltersV2($query, $bs_filters = array())
    {
        /*
         * custom FILTER COLLECTION for BSTABLE
         */
        if (is_array($bs_filters) && count($bs_filters) > 0)
        {
            $andX = $query->expr()->andX();

            foreach($bs_filters as $key => $value)
            {
                if ($key == 'xparam')
                {
                    if (is_array($value) && count($value) > 0)
                    {
                        foreach($value as $xkey => $xvalue)
                        {
                            if ($xvalue['type'] == 'number')
                            {
                                if (is_array($xvalue['value']) && count($xvalue['value']) == 2)
                                {
                                    if ($xvalue['value']['left'] && preg_match('/^[1-9][0-9]*$/', $xvalue['value']['left']))
                                    {
                                        $andX->add($query->expr()->gte(str_replace('_', '.', $xvalue['target']), ':' . $xkey . '_number_range_left'));
                                        $query->setParameter($xkey . '_number_range_left', $xvalue['value']['left']);
                                    }
                                    if ($xvalue['value']['right'] && preg_match('/^[1-9][0-9]*$/', $xvalue['value']['right']))
                                    {
                                        $andX->add($query->expr()->lte(str_replace('_', '.', $xvalue['target']), ':' . $xkey . '_number_range_right'));
                                        $query->setParameter($xkey . '_number_range_right', $xvalue['value']['right']);
                                    }
                                }
                            }
                            if ($xvalue['type'] == 'combodate')
                            {
                                if (is_array($xvalue['value']) && count($xvalue['value']) == 2)
                                {
                                    if ($xvalue['value']['left'] && preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})/', $xvalue['value']['left']))
                                    {
                                        $andX->add($query->expr()->gte(str_replace('_', '.', $xvalue['target']), ':' . $xkey . '_date_range_left'));
                                        $query->setParameter($xkey . '_date_range_left', \DateTime::createFromFormat('Y-m-d H:i', $xvalue['value']['left']));
                                    }
                                    if ($xvalue['value']['right'] && preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})/', $xvalue['value']['right']))
                                    {
                                        $andX->add($query->expr()->lte(str_replace('_', '.', $xvalue['target']), ':' . $xkey . '_date_range_right'));
                                        $query->setParameter($xkey . '_date_range_right', \DateTime::createFromFormat('Y-m-d H:i', $xvalue['value']['right']));
                                    }
                                }
                            }
                            if ($xvalue['type'] == 'text')
                            {
                                $str = trim($xvalue['value']);
                                if (!is_array($xvalue['value']) && !empty($str))
                                {
                                    $andX->add($query->expr()->like('LOWER(' . str_replace('_', '.', $xvalue['target']) . ')', ':' . $xkey . '_text'));
                                    $query->setParameter($xkey . '_text', '%' . strtolower($str) . '%');
                                }
                            }
                            if ($xvalue['type'] == 'select2')
                            {
                                if (is_array($xvalue['value']) && count($xvalue['value']) > 0)
                                {
                                    $str_target = str_replace(array("[", "]", "(", ")", " "), "", $xvalue['target']);
                                    $ar_target  = explode(',', $str_target);
                                    if (is_array($ar_target) && count($ar_target) > 0)
                                    {
                                        if (count($ar_target) > 1)
                                        {
                                            $orX    = $query->expr()->orX();
                                            foreach ($ar_target as $trg => $target)
                                            {
                                                $orX->add($query->expr()->in(str_replace('_', '.', $target), ':' . $xkey . '_select2'));
                                                $query->setParameter($xkey . '_select2', $xvalue['value']);
                                            }
                                            $andX->add($orX);
                                        }
                                        else
                                        {
                                            $andX->add($query->expr()->in(str_replace('_', '.', $ar_target[0]), ':' . $xkey . '_select2'));
                                            $query->setParameter($xkey . '_select2', $xvalue['value']);
                                        }
                                    }
                                    else
                                    {
                                        $andX->add($query->expr()->in(str_replace('_', '.', $xvalue['target']), ':' . $xkey . '_select2'));
                                        $query->setParameter($xkey . '_select2', $xvalue['value']);
                                    }
                                }
                            }
                            if ($xvalue['type'] == 'boolean')
                            {
                                $bool_value = is_array($xvalue['value']) && count($xvalue['value']) > 0 ? TRUE : FALSE;
                                $andX->add($query->expr()->eq(str_replace('_', '.', $xvalue['target']), $query->expr()->literal($bool_value)));
                            }
                        }
                    }
                }
                else
                {
                    if ($value['type'] == 'number')
                    {
                        if (is_array($value['value']) && count($value['value']) == 2)
                        {
                            if ($value['value']['left'] && preg_match('/^[1-9][0-9]*$/', $value['value']['left']))
                            {
                                $andX->add($query->expr()->gte(str_replace('_', '.', $value['target']), ':' . $key . '_number_range_left'));
                                $query->setParameter($key . '_number_range_left', $value['value']['left']);
                            }
                            if ($value['value']['right'] && preg_match('/^[1-9][0-9]*$/', $value['value']['right']))
                            {
                                $andX->add($query->expr()->lte(str_replace('_', '.', $value['target']), ':' . $key . '_number_range_right'));
                                $query->setParameter($key . '_number_range_right', $value['value']['right']);
                            }
                        }
                    }
                    if ($value['type'] == 'combodate')
                    {
                        if (is_array($value['value']) && count($value['value']) == 2)
                        {
                            if ($value['value']['left'] && preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})/', $value['value']['left']))
                            {
                                $andX->add($query->expr()->gte(str_replace('_', '.', $value['target']), ':' . $key . '_date_range_left'));
                                $query->setParameter($key . '_date_range_left', \DateTime::createFromFormat('Y-m-d H:i', $value['value']['left']));
                            }
                            if ($value['value']['right'] && preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})/', $value['value']['right']))
                            {
                                $andX->add($query->expr()->lte(str_replace('_', '.', $value['target']), ':' . $key . '_date_range_right'));
                                $query->setParameter($key . '_date_range_right', \DateTime::createFromFormat('Y-m-d H:i', $value['value']['right']));
                            }
                        }
                    }
                    if ($value['type'] == 'text')
                    {
                        $str = trim($value['value']);
                        if (!is_array($value['value']) && !empty($str))
                        {
                            $andX->add($query->expr()->like('LOWER(' . str_replace('_', '.', $value['target']) . ')', ':' . $key . '_text'));
                            $query->setParameter($key . '_text', '%' . strtolower($str) . '%');
                        }
                    }
                    if ($value['type'] == 'select2')
                    {
                        if (is_array($value['value']) && count($value['value']) > 0)
                        {
                            $str_target = str_replace(array("[", "]", "(", ")", " "), "", $value['target']);
                            $ar_target  = explode(',', $str_target);
                            if (is_array($ar_target) && count($ar_target) > 0)
                            {
                                if (count($ar_target) > 1)
                                {
                                    $orX    = $query->expr()->orX();
                                    foreach ($ar_target as $trg => $target)
                                    {
                                        $orX->add($query->expr()->in(str_replace('_', '.', $target), ':' . $key . '_select2'));
                                        $query->setParameter($key . '_select2', $value['value']);
                                    }
                                    $andX->add($orX);
                                }
                                else
                                {
                                    $andX->add($query->expr()->in(str_replace('_', '.', $ar_target[0]), ':' . $key . '_select2'));
                                    $query->setParameter($key . '_select2', $value['value']);
                                }
                            }
                            else
                            {
                                $andX->add($query->expr()->in(str_replace('_', '.', $value['target']), ':' . $key . '_select2'));
                                $query->setParameter($key . '_select2', $value['value']);
                            }
                        }
                    }
                    if ($value['type'] == 'boolean')
                    {
                        $bool_value = is_array($value['value']) && count($value['value']) > 0 ? TRUE : FALSE;
                        $andX->add($query->expr()->eq(str_replace('_', '.', $value['target']), $query->expr()->literal($bool_value)));
                    }
                }
            }

            return $andX;
        }

        return false;
    }

}