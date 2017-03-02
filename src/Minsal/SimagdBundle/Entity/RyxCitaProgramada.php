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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $incidencias;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="razon_anulada", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $razonAnulada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaCreacion = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_confirmacion", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaConfirmacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reprogramacion", type="datetime", nullable=true)
     * @Assert\DateTime()
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
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
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\DateTime()
     */
    private $fechaHoraInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin", type="datetime", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\DateTime()
     */
    private $fechaHoraFin;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $color = '#31708f';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_inicio_anterior", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraInicioAnterior;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin_anterior", type="datetime", nullable=true)
     * @Assert\DateTime()
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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
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
     * @var \Minsal\SiapsBundle\Entity\CtlParentesco
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlParentesco")
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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tecnologo_programado", referencedColumnName="id")
     * })
     */
    private $idTecnologoProgramado;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_prg", referencedColumnName="id")
     * })
     */
    private $idUserPrg;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reprg", referencedColumnName="id")
     * })
     */
    private $idUserReprg;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
    /**
     * Text converter for the Entity (Second form).
     */
    public function getPresentacionEntidad()
    {
    }
    
    /**
     * Text converter for the Entity (Third form).
     */
    public function getFormatoPresentacionEntidad()
    {
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

}