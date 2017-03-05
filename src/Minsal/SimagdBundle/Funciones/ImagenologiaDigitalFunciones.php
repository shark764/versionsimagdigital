<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SimagdBundle\Funciones;

use Doctrine\ORM\EntityManager;

/**
 * Description of ImagenologiaDigitalFunciones
 *
 * @author farid
 */
class ImagenologiaDigitalFunciones {

    protected $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    /**
     * 
     * @param type $prc
     * @param type $user
     * @return boolean
     */
    public function verificarCreacionCita( $prc = null, $user = null )
    {
        //Parámetro es null
        if ( !$prc ) { return array(false, 1005); }

        //No es numérico
        if( !preg_match('/^[1-9][0-9]*$/', $prc) ) { return array(false, 1004); }

        //Solicitud de estudio no existe
        $em = $this->entityManager;
        $prcEntity = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->find($prc);
        if ( !$prcEntity ) { return array(false, 1003); }

        //No está marcada para cita
        if ( !$prcEntity->getRequiereCita() ) { return array(false, 1002); }

        //No ha sido referido a este establecimiento
        $estabLocal = $user->getIdEstablecimiento()->getId();
        if($estabLocal != $prcEntity->getIdEstablecimientoReferido()->getId() ) { return array(false, 1000); }

        //Paciente no posee expediente en este establecimiento
        $expLocal = $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneBy(array(
                                                'idPaciente' => $prcEntity->getIdExpediente()->getIdPaciente()->getId(),
                                                'idEstablecimiento' => $estabLocal
                                            ));
        if ( !$expLocal ) { return array(false, 1001); }

        return array(true, 0);
    }
    
    public function verificarCreacionLectura( $est = null, $user = null )
    {
        //Parámetro es null
        if ( !$est ) { return array(false, 1005); }

        //No es numérico
        if( !preg_match('/^[1-9][0-9]*$/', $est) ) { return array(false, 1004); }

        //Estudio no existe
        $em = $this->entityManager;
        $estEntity = $em->getRepository('MinsalSimagdBundle:RyxEstudioPorImagenes')->find($est);
        if ( !$estEntity ) { return array(false, 1003); }

        //No se ha solicitado diagnótico
        $prcEntity = $estEntity->getIdProcedimientoRealizado()->getIdSolicitudEstudio();
        $solDiagEntity = $em->getRepository('MinsalSimagdBundle:RyxSolicitudDiagnosticoPostEstudio')
                                                ->findOneBy( array('idSolicitudEstudio' => $prcEntity->getId(), 'idEstudio' => $est) );
        if ( !$prcEntity->getRequiereDiagnostico() && !$solDiagEntity ) { return array(false, 1006); }

        //No ha sido solicitado a este establecimiento
        $estabLocal = $user->getIdEstablecimiento()->getId();
        if( $prcEntity->getRequiereDiagnostico() &&
                            ($estabLocal != $prcEntity->getIdEstablecimientoDiagnosticante()->getId() ) )
            { return array(false, 1007); }
        if( $solDiagEntity && ($estabLocal != $solDiagEntity->getIdEstablecimientoSolicitado()->getId() ) )
            { return array(false, 1007); }

        return array(true, 0);
    }
    
    public function verificarCreacionDiagnostico( $lct = null, $user = null )
    {
        //Parámetro es null
        if ( !$lct ) { return array(false, 1005); }

        //No es numérico
        if( !preg_match('/^[1-9][0-9]*$/', $lct) ) { return array(false, 1004); }

        //Lectura no existe
        $em = $this->entityManager;
        $lctEntity = $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->find($lct);
        if ( !$lctEntity ) { return array(false, 1003); }

        //Lectura no ha sido culminada, esta descartada, o pendiente
        $estado = $lctEntity->getIdEstadoLectura()->getId();
        if ( !in_array($estado, array(4)) ) { return array(false, 1008); }

        //No ha sido solicitado a este establecimiento
        $estabLocal = $user->getIdEstablecimiento()->getId();
        if ($estabLocal != $lctEntity->getIdEstablecimiento()->getId() )
            { return array(false, 1007); }

        return array(true, 0);
    }
    
    public function verificarCreacionSolicitudDiagnostico( $prc = null, $est = null, $user = null )
    {
        //Parámetros son null
        if ( !( $prc && $est ) ) { return array(false, 1005); }

        //No son numéricos
        if( !( preg_match('/^[1-9][0-9]*$/', $prc) && preg_match('/^[1-9][0-9]*$/', $est) ) ) { return array(false, 1004); }

        //Registros no existen
        $em = $this->entityManager;
        $prcEntity = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->find($prc);
        $estEntity = $em->getRepository('MinsalSimagdBundle:RyxEstudioPorImagenes')->find($est);
        if ( !( $prcEntity && $estEntity ) ) { return array(false, 1003); }
        
        //No se ha registrado estudio
        if ( !$estEntity ) { return array(false, 1013); }
        
        //Registros no coinciden
        if ( $estEntity->getIdProcedimientoRealizado()->getIdSolicitudEstudio()->getId() != $prcEntity->getId() ) { return array(false, 1009); }

        //Ya se ha solicitado diagnótico
        if ( $prcEntity->getRequiereDiagnostico() ) { return array(false, 1010); }

        //No ha sido preinscrito en este establecimiento
        $estabLocal = $user->getIdEstablecimiento()->getId();
        if ($estabLocal != $prcEntity->getIdAtenAreaModEstab()->getIdEstablecimiento()->getId() )
            { return array(false, 1011); }
            
        //Ya existe diagnóstico
        $diagnostico = $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->findOneBy(array('idEstudio' => $est));
        if ( $diagnostico ) { return array(false, 1012); }

        return array(true, 0);
    }
    
    public function verificarCreacionProcedimientoRealizado( $prc = null, $cit = null, $user = null )
    {
        //Parámetro es null
        if ( !$prc ) { return array(false, 1005); }

        //No es numérico, si existe cita y parámetro tampoco es numérico
        if( !preg_match('/^[1-9][0-9]*$/', $prc) ) { return array(false, 1004); }
        if( $cit && !preg_match('/^[1-9][0-9]*$/', $cit) ) { return array(false, 1004); }

        //Solicitud de estudio no existe
        $em = $this->entityManager;
        $prcEntity = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->find($prc);
        if ( !$prcEntity ) { return array(false, 1003); }
        
        //Está marcada para cita, parámetro no enviado
        if ( !$cit && $prcEntity->getRequiereCita() ) { return array(false, 1005); }
        
        //No está marcada para cita, parámetro es enviado
        if ( $cit && !$prcEntity->getRequiereCita() ) { return array(false, 1017); }
        
        //Está marcada para cita, cita no existe
        $citaEntity = $em->getRepository('MinsalSimagdBundle:RyxCitaProgramada')->findOneBy(array( 'idSolicitudEstudio' => $prc ));
        if ( !$citaEntity && $prcEntity->getRequiereCita() ) { return array(false, 1015); }
        
        //Cita asociada no corresponde a parámetro
        if ( $citaEntity && $citaEntity->getId() != $cit ) { return array(false, 1016); }
        
        //Cita asociada no está confirmada
        if ( $citaEntity && !in_array($citaEntity->getIdEstadoCita()->getId(), array(2)) ) { return array(false, 1014); }
        
        //No ha sido referido a este establecimiento
        $estabLocal = $user->getIdEstablecimiento()->getId();
        if($estabLocal != $prcEntity->getIdEstablecimientoReferido()->getId() ) { return array(false, 1000); }

        //Paciente no posee expediente en este establecimiento
        $expLocal = $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneBy(array(
                                                'idPaciente' => $prcEntity->getIdExpediente()->getIdPaciente()->getId(),
                                                'idEstablecimiento' => $estabLocal
                                            ));
        if ( !$expLocal ) { return array(false, 1001); }

        return array(true, 0);
    }
    
    public function verificarCreacionPreinscripcion( $exp = null, $hcl = null, $user = null )
    {
        //Parámetro es null
        if ( !$exp ) { return array(false, 1005); }

        //No es numérico, si existe historial y parámetro tampoco es numérico
        if( !preg_match('/^[1-9][0-9]*$/', $exp) ) { return array(false, 1004); }
        if( $hcl && !preg_match('/^[1-9][0-9]*$/', $hcl) ) { return array(false, 1004); }

        //Expediente no existe
        $em = $this->entityManager;
        $expEntity = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($exp);
        if ( !$expEntity ) { return array(false, 1003); }
        
        //No puede acceder a este registro
        $estabLocal = $user->getIdEstablecimiento()->getId();
        if($estabLocal != $expEntity->getIdEstablecimiento()->getId() ) { return array(false, 1018); }

        //historial no existe
        $hclEntity = $hcl ? $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($hcl) : null;
        if( $hcl && !$hclEntity ) { return array(false, 1003); }
        
        //No puede acceder a este registro
        if( $hcl && $estabLocal != $hclEntity->getIdEstablecimiento()->getId() ) { return array(false, 1018); }
        
        //expediente asociado no corresponde a parámetro
        if( $hcl && $hclEntity->getIdNumeroExpediente()->getId() != $exp ) { return array(false, 1019); }
        
        //El registro debe provenir de Consulta externa
        if( $hcl && strtoupper($hclEntity->getPiloto()) == 'V' ) { return array(false, 1020); }

        return array(true, 0);
    }
    
    public function verificarCreacionNotaDiagnostico( $diag = null, $user = null )
    {
        //Parámetro es null
        if ( !$diag ) { return array(false, 1005); }

        //No es numérico
        if( !preg_match('/^[1-9][0-9]*$/', $diag) ) { return array(false, 1004); }

        //Diagnóstico no existe
        $em = $this->entityManager;
        $diagEntity = $em->getRepository('MinsalSimagdBundle:RyxDiagnosticoRadiologico')->find($diag);
        if ( !$diagEntity ) { return array(false, 1003); }

        //Transcripción no ha sido culminada, esta descartada, o pendiente
        $estado = $diagEntity->getIdEstadoDiagnostico()->getId();
        if ( !in_array($estado, array(6)) ) { return array(false, 1021); }

        return array(true, 0);
    }

    public function obtenerMensajeError( $error )
    {
        $mensaje = 'La acción no es válida';

	switch ( $error )  {
            case 1000:
                $mensaje = 'El paciente no ha sido preinscrito hacia este establecimiento';
                break;
            case 1001:
                $mensaje = 'El paciente no posee expediente en este establecimiento';
                break;
            case 1002:
                $mensaje = 'La preinscripción no se encuentra marcada para creación de cita de Imagenología';
                break;
            case 1003:
                $mensaje = 'No existe el registro que solicita';
                break;
            case 1004:
                $mensaje = 'El número del registro que solicita no es válido';
                break;
            case 1005:
                $mensaje = 'El parámetro está vacío';
                break;
            case 1006:
                $mensaje = 'No ha sido solicitado diagnótico para este estudio';
                break;
            case 1007:
                $mensaje = 'Diagnóstico no ha sido solicitado en este establecimiento';
                break;
            case 1008:
                $mensaje = 'No puede registrarse transcripción para esta lectura';
                break;
            case 1009:
                $mensaje = 'Estudio no corresponde a la preinscripción solicitada';
                break;
            case 1010:
                $mensaje = 'Solicitud de estudio ya contiene solicitud de diagnóstico pre-estudio';
                break;
            case 1011:
                $mensaje = 'No puede acceder a esta preinscripción';
                break;
            case 1012:
                $mensaje = 'Estudio preinscrito ya posee diagnóstico registrado';
                break;
            case 1013:
                $mensaje = 'Aun no se ha registrado estudio para esta preinscripción';
                break;
            case 1014:
                $mensaje = 'Cita programada para este examen no está confirmada';
                break;
            case 1015:
                $mensaje = 'Cita requerida para esta preinscripción aun no ha sido programada';
                break;
            case 1016:
                $mensaje = 'Cita programada no coincide con parámetro';
                break;
            case 1017:
                $mensaje = 'Solicitud de estudio no fue marcada para programación de cita';
                break;
            case 1018:
                $mensaje = 'No puede acceder a este registro';
                break;
            case 1019:
                $mensaje = 'Expediente no corresponde a registro de historial clínico';
                break;
            case 1020:
                $mensaje = 'El registro debe provenir de Consulta externa';
                break;
            case 1021:
                $mensaje = 'No pueden agregarse notas al diagnóstico hasta que sea concluido';
                break;
            default:
                break;
        }

        return $mensaje;
    }
    
}
