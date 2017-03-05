<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlPatronDiagnostico
 *
 * @ORM\Table(name="ryx_ctl_patron_diagnostico", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_patron_diagnostico_establecimiento", columns={"codigo", "id_establecimiento"})}, indexes={@ORM\Index(name="IDX_2EC2B493992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_2EC2B493592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_2EC2B4937DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_2EC2B49329CF97D1", columns={"id_radiologo_define"}), @ORM\Index(name="IDX_2EC2B493D426DB54", columns={"id_tipo_resultado"}), @ORM\Index(name="IDX_2EC2B493AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_2EC2B493D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCtlPatronDiagnosticoRepository")
 */
class RyxCtlPatronDiagnostico implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_patron_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hallazgos", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $hallazgos;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $conclusion;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $recomendaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones_generales", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $indicacionesGenerales;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraMod;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $codigo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var \CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAreaServicioDiagnostico;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_registra", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEmpleadoRegistra;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimiento;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_define", referencedColumnName="id")
     * })
     */
    private $idRadiologoDefine;

    /**
     * @var \RyxCtlTipoRespuestaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlTipoRespuestaRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_resultado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTipoResultado;

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
     * @Assert\NotNull(message = "foreign.default.not_null")
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
        return mb_strtoupper(trim($this->nombre), 'utf-8') . ($this->idRadiologoDefine ? ' - ' . $this->idRadiologoDefine : '');
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


    /**
     * Set hallazgos
     *
     * @param string $hallazgos
     * @return RyxCtlPatronDiagnostico
     */
    public function setHallazgos($hallazgos)
    {
        $this->hallazgos = $hallazgos;

        return $this;
    }

    /**
     * Get hallazgos
     *
     * @return string 
     */
    public function getHallazgos()
    {
        return $this->hallazgos;
    }

    /**
     * Set conclusion
     *
     * @param string $conclusion
     * @return RyxCtlPatronDiagnostico
     */
    public function setConclusion($conclusion)
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    /**
     * Get conclusion
     *
     * @return string 
     */
    public function getConclusion()
    {
        return $this->conclusion;
    }

    /**
     * Set recomendaciones
     *
     * @param string $recomendaciones
     * @return RyxCtlPatronDiagnostico
     */
    public function setRecomendaciones($recomendaciones)
    {
        $this->recomendaciones = $recomendaciones;

        return $this;
    }

    /**
     * Get recomendaciones
     *
     * @return string 
     */
    public function getRecomendaciones()
    {
        return $this->recomendaciones;
    }

    /**
     * Set indicacionesGenerales
     *
     * @param string $indicacionesGenerales
     * @return RyxCtlPatronDiagnostico
     */
    public function setIndicacionesGenerales($indicacionesGenerales)
    {
        $this->indicacionesGenerales = $indicacionesGenerales;

        return $this;
    }

    /**
     * Get indicacionesGenerales
     *
     * @return string 
     */
    public function getIndicacionesGenerales()
    {
        return $this->indicacionesGenerales;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return RyxCtlPatronDiagnostico
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     * @return RyxCtlPatronDiagnostico
     */
    public function setFechaHoraReg($fechaHoraReg)
    {
        $this->fechaHoraReg = $fechaHoraReg;

        return $this;
    }

    /**
     * Get fechaHoraReg
     *
     * @return \DateTime 
     */
    public function getFechaHoraReg()
    {
        return $this->fechaHoraReg;
    }

    /**
     * Set fechaHoraMod
     *
     * @param \DateTime $fechaHoraMod
     * @return RyxCtlPatronDiagnostico
     */
    public function setFechaHoraMod($fechaHoraMod)
    {
        $this->fechaHoraMod = $fechaHoraMod;

        return $this;
    }

    /**
     * Get fechaHoraMod
     *
     * @return \DateTime 
     */
    public function getFechaHoraMod()
    {
        return $this->fechaHoraMod;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return RyxCtlPatronDiagnostico
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return RyxCtlPatronDiagnostico
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return RyxCtlPatronDiagnostico
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return RyxCtlPatronDiagnostico
     */
    public function setIdAreaServicioDiagnostico(\Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico = null)
    {
        $this->idAreaServicioDiagnostico = $idAreaServicioDiagnostico;

        return $this;
    }

    /**
     * Get idAreaServicioDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico 
     */
    public function getIdAreaServicioDiagnostico()
    {
        return $this->idAreaServicioDiagnostico;
    }

    /**
     * Set idEmpleadoRegistra
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleadoRegistra
     * @return RyxCtlPatronDiagnostico
     */
    public function setIdEmpleadoRegistra(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleadoRegistra = null)
    {
        $this->idEmpleadoRegistra = $idEmpleadoRegistra;

        return $this;
    }

    /**
     * Get idEmpleadoRegistra
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdEmpleadoRegistra()
    {
        return $this->idEmpleadoRegistra;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxCtlPatronDiagnostico
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set idRadiologoDefine
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoDefine
     * @return RyxCtlPatronDiagnostico
     */
    public function setIdRadiologoDefine(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoDefine = null)
    {
        $this->idRadiologoDefine = $idRadiologoDefine;

        return $this;
    }

    /**
     * Get idRadiologoDefine
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoDefine()
    {
        return $this->idRadiologoDefine;
    }

    /**
     * Set idTipoResultado
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlTipoRespuestaRadiologica $idTipoResultado
     * @return RyxCtlPatronDiagnostico
     */
    public function setIdTipoResultado(\Minsal\SimagdBundle\Entity\RyxCtlTipoRespuestaRadiologica $idTipoResultado = null)
    {
        $this->idTipoResultado = $idTipoResultado;

        return $this;
    }

    /**
     * Get idTipoResultado
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlTipoRespuestaRadiologica 
     */
    public function getIdTipoResultado()
    {
        return $this->idTipoResultado;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxCtlPatronDiagnostico
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return RyxCtlPatronDiagnostico
     */
    public function setIdUserReg(\Application\Sonata\UserBundle\Entity\User $idUserReg = null)
    {
        $this->idUserReg = $idUserReg;

        return $this;
    }

    /**
     * Get idUserReg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserReg()
    {
        return $this->idUserReg;
    }
}
