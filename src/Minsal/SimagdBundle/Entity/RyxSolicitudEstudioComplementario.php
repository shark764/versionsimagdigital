<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxSolicitudEstudioComplementario
 *
 * @ORM\Table(name="ryx_solicitud_estudio_complementario", indexes={@ORM\Index(name="IDX_AE38E690992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_AE38E6909A3949E3", columns={"id_establecimiento_solicitado"}), @ORM\Index(name="IDX_AE38E690AB124167", columns={"id_estado_solicitud"}), @ORM\Index(name="IDX_AE38E690F485B2E3", columns={"id_estudio_padre"}), @ORM\Index(name="IDX_AE38E6907E7CB1E8", columns={"id_prioridad_atencion"}), @ORM\Index(name="IDX_AE38E6904E924116", columns={"id_radiologo_solicita"}), @ORM\Index(name="IDX_AE38E6906AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_AE38E690D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudioComplementario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_complementario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="datetime", nullable=true)
     */
    private $fechaSolicitud = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=255, nullable=true)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones_estudio", type="text", nullable=true)
     */
    private $indicacionesEstudio;

    /**
     * @var \CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico", referencedColumnName="id")
     * })
     */
    private $idAreaServicioDiagnostico;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_solicitado", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoSolicitado;

    /**
     * @var \RyxCtlEstadoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_solicitud", referencedColumnName="id")
     * })
     */
    private $idEstadoSolicitud;

    /**
     * @var \RyxEstudioPorImagenes
     *
     * @ORM\ManyToOne(targetEntity="RyxEstudioPorImagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio_padre", referencedColumnName="id")
     * })
     */
    private $idEstudioPadre;

    /**
     * @var \RyxCtlPrioridadAtencionPaciente
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlPrioridadAtencionPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prioridad_atencion", referencedColumnName="id")
     * })
     */
    private $idPrioridadAtencion;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_solicita", referencedColumnName="id")
     * })
     */
    private $idRadiologoSolicita;

    /**
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudio;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;


}
