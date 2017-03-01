<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxProcedimientoRadiologicoRealizado
 *
 * @ORM\Table(name="ryx_procedimiento_radiologico_realizado", indexes={@ORM\Index(name="IDX_701DBA505BBAAD2F", columns={"id_cita_programada"}), @ORM\Index(name="IDX_701DBA50DD66500E", columns={"id_tecnologo_realiza"}), @ORM\Index(name="IDX_701DBA507DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_701DBA50282A2E1B", columns={"id_estado_procedimiento_realizado"}), @ORM\Index(name="IDX_701DBA5060C0CAA5", columns={"id_registra_emergencia"}), @ORM\Index(name="IDX_701DBA50F0951F8F", columns={"id_solicitud_estudio_complementario"}), @ORM\Index(name="IDX_701DBA506AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_701DBA50AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_701DBA50D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxProcedimientoRadiologicoRealizado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_procedimiento_radiologico_realizado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_atendido", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaAtendido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_realizado", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaRealizado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_procesado", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaProcesado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_almacenado", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaAlmacenado;

    /**
     * @var string
     *
     * @ORM\Column(name="equipo_utilizado", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $equipoUtilizado;

    /**
     * @var string
     *
     * @ORM\Column(name="tecnica_utilizada", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $tecnicaUtilizada;

    /**
     * @var string
     *
     * @ORM\Column(name="hipotesis_diagnostica", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $hipotesisDiagnostica;

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
     * @var boolean
     *
     * @ORM\Column(name="fecha_nacimiento_indeterminada", type="boolean", nullable=true)
     */
    private $fechaNacimientoIndeterminada = false;

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
     * @ORM\Column(name="sala_realizado", type="string", length=50, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $salaRealizado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaRegistro = '(now())::timestamp(0) without time zone';

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_emergencia", type="boolean", nullable=true)
     */
    private $esEmergencia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_complementario", type="boolean", nullable=true)
     */
    private $esComplementario = false;

    /**
     * @var \RyxCitaProgramada
     *
     * @ORM\ManyToOne(targetEntity="RyxCitaProgramada")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cita_programada", referencedColumnName="id")
     * })
     */
    private $idCitaProgramada;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tecnologo_realiza", referencedColumnName="id")
     * })
     */
    private $idTecnologoRealiza;

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
     * @var \RyxCtlEstadoProcedimientoRealizado
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoProcedimientoRealizado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_procedimiento_realizado", referencedColumnName="id")
     * })
     */
    private $idEstadoProcedimientoRealizado;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_registra_emergencia", referencedColumnName="id")
     * })
     */
    private $idRegistraEmergencia;

    /**
     * @var \RyxSolicitudEstudioComplementario
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudioComplementario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;

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