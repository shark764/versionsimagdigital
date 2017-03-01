<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCitaProgramada
 *
 * @ORM\Table(name="ryx_cita_programada", indexes={@ORM\Index(name="IDX_4639A1FE51F7CF06", columns={"id_configuracion_agenda"}), @ORM\Index(name="IDX_4639A1FE890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_4639A1FE7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_4639A1FEDD0D821B", columns={"id_estado_cita"}), @ORM\Index(name="IDX_4639A1FEDEFEA3F", columns={"id_responsable_autoriza"}), @ORM\Index(name="IDX_4639A1FE6AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_4639A1FE91124CBF", columns={"id_tecnologo_programado"}), @ORM\Index(name="IDX_4639A1FEDEA2D3D3", columns={"id_user_prg"}), @ORM\Index(name="IDX_4639A1FE94AEBFD3", columns={"id_user_reprg"})})
 * @ORM\Entity
 */
class RyxCitaProgramada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_cita_programada_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reprogramada", type="boolean", nullable=true)
     */
    private $reprogramada = false;

    /**
     * @var string
     *
     * @ORM\Column(name="incidencias", type="string", length=255, nullable=true)
     */
    private $incidencias;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="razon_anulada", type="string", length=150, nullable=true)
     */
    private $razonAnulada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_confirmacion", type="datetime", nullable=true)
     */
    private $fechaConfirmacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reprogramacion", type="datetime", nullable=true)
     */
    private $fechaReprogramacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="necesita_autorizacion", type="boolean", nullable=true)
     */
    private $necesitaAutorizacion = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cita_autorizada", type="boolean", nullable=true)
     */
    private $citaAutorizada = false;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_responsable_autoriza", type="string", nullable=true)
     */
    private $nombreResponsableAutoriza;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dia_completo", type="boolean", nullable=true)
     */
    private $diaCompleto = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_inicio", type="datetime", nullable=false)
     */
    private $fechaHoraInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin", type="datetime", nullable=false)
     */
    private $fechaHoraFin;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=15, nullable=true)
     */
    private $color = '#31708f';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_inicio_anterior", type="datetime", nullable=true)
     */
    private $fechaHoraInicioAnterior;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin_anterior", type="datetime", nullable=true)
     */
    private $fechaHoraFinAnterior;

    /**
     * @var \RyxCtlConfiguracionAgenda
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlConfiguracionAgenda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_configuracion_agenda", referencedColumnName="id")
     * })
     */
    private $idConfiguracionAgenda;

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
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \RyxCtlEstadoCita
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoCita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_cita", referencedColumnName="id")
     * })
     */
    private $idEstadoCita;

    /**
     * @var \CtlParentesco
     *
     * @ORM\ManyToOne(targetEntity="CtlParentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_responsable_autoriza", referencedColumnName="id")
     * })
     */
    private $idResponsableAutoriza;

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
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tecnologo_programado", referencedColumnName="id")
     * })
     */
    private $idTecnologoProgramado;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_prg", referencedColumnName="id")
     * })
     */
    private $idUserPrg;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reprg", referencedColumnName="id")
     * })
     */
    private $idUserReprg;


}
