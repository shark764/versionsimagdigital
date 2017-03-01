<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxSolicitudDiagnosticoPostEstudio
 *
 * @ORM\Table(name="ryx_solicitud_diagnostico_post_estudio", indexes={@ORM\Index(name="IDX_A1126B86890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_A1126B869A3949E3", columns={"id_establecimiento_solicitado"}), @ORM\Index(name="IDX_A1126B86AB124167", columns={"id_estado_solicitud"}), @ORM\Index(name="IDX_A1126B866196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_A1126B866AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_A1126B86D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxSolicitudDiagnosticoPostEstudio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_diagnostico_post_estudio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="solicitud_remota", type="boolean", nullable=true)
     */
    private $solicitudRemota = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=255, nullable=false)
     */
    private $justificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_proxima_consulta", type="date", nullable=true)
     */
    private $fechaProximaConsulta;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

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
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

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
