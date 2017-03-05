<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxProcedimientoRadiologicoRealizado
 *
 * @ORM\Table(name="ryx_procedimiento_radiologico_realizado", indexes={@ORM\Index(name="IDX_701DBA505BBAAD2F", columns={"id_cita_programada"}), @ORM\Index(name="IDX_701DBA50DD66500E", columns={"id_tecnologo_realiza"}), @ORM\Index(name="IDX_701DBA507DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_701DBA50282A2E1B", columns={"id_estado_procedimiento_realizado"}), @ORM\Index(name="IDX_701DBA5060C0CAA5", columns={"id_registra_emergencia"}), @ORM\Index(name="IDX_701DBA50F0951F8F", columns={"id_solicitud_estudio_complementario"}), @ORM\Index(name="IDX_701DBA506AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_701DBA50AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_701DBA50D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxProcedimientoRadiologicoRealizadoRepository")
 */
class RyxProcedimientoRadiologicoRealizado implements EntityInterface
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
     * @ORM\ManyToOne(targetEntity="RyxCitaProgramada", inversedBy="citaProcedimientosRealizados")
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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTecnologoRealiza;

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
     * @var \RyxCtlEstadoProcedimientoRealizado
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoProcedimientoRealizado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_procedimiento_realizado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudioComplementario", inversedBy="complementarioExamenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;

    /**
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio", inversedBy="solicitudEstudioProcedimientosRealizados")
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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idUserReg;

    /**
     * @ORM\OneToMany(targetEntity="RyxProcedimientoMaterialUtilizado", mappedBy="idProcedimientoRealizado", cascade={"all"}, orphanRemoval=true)
     */
    private $materialUtilizadoV2;

    /**
     * @ORM\OneToMany(targetEntity="RyxEstudioPorImagenes", mappedBy="idProcedimientoRealizado", cascade={"all"}, orphanRemoval=true)
     */
    private $examenEstudio;

    /**
     * @ORM\OneToMany(targetEntity="RyxExamenPendienteRealizacion", mappedBy="idProcedimientoIniciado", cascade={"all"}, orphanRemoval=true)
     */
    private $examenPendienteRealizar;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materialUtilizadoV2 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examenEstudio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examenPendienteRealizar = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->idSolicitudEstudio . ' :: ' . $this->idEstadoProcedimientoRealizado;
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
     * Set fechaAtendido
     *
     * @param \DateTime $fechaAtendido
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setFechaAtendido($fechaAtendido)
    {
        $this->fechaAtendido = $fechaAtendido;

        return $this;
    }

    /**
     * Get fechaAtendido
     *
     * @return \DateTime 
     */
    public function getFechaAtendido()
    {
        return $this->fechaAtendido;
    }

    /**
     * Set fechaRealizado
     *
     * @param \DateTime $fechaRealizado
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setFechaRealizado($fechaRealizado)
    {
        $this->fechaRealizado = $fechaRealizado;

        return $this;
    }

    /**
     * Get fechaRealizado
     *
     * @return \DateTime 
     */
    public function getFechaRealizado()
    {
        return $this->fechaRealizado;
    }

    /**
     * Set fechaProcesado
     *
     * @param \DateTime $fechaProcesado
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setFechaProcesado($fechaProcesado)
    {
        $this->fechaProcesado = $fechaProcesado;

        return $this;
    }

    /**
     * Get fechaProcesado
     *
     * @return \DateTime 
     */
    public function getFechaProcesado()
    {
        return $this->fechaProcesado;
    }

    /**
     * Set fechaAlmacenado
     *
     * @param \DateTime $fechaAlmacenado
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setFechaAlmacenado($fechaAlmacenado)
    {
        $this->fechaAlmacenado = $fechaAlmacenado;

        return $this;
    }

    /**
     * Get fechaAlmacenado
     *
     * @return \DateTime 
     */
    public function getFechaAlmacenado()
    {
        return $this->fechaAlmacenado;
    }

    /**
     * Set equipoUtilizado
     *
     * @param string $equipoUtilizado
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setEquipoUtilizado($equipoUtilizado)
    {
        $this->equipoUtilizado = $equipoUtilizado;

        return $this;
    }

    /**
     * Get equipoUtilizado
     *
     * @return string 
     */
    public function getEquipoUtilizado()
    {
        return $this->equipoUtilizado;
    }

    /**
     * Set tecnicaUtilizada
     *
     * @param string $tecnicaUtilizada
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setTecnicaUtilizada($tecnicaUtilizada)
    {
        $this->tecnicaUtilizada = $tecnicaUtilizada;

        return $this;
    }

    /**
     * Get tecnicaUtilizada
     *
     * @return string 
     */
    public function getTecnicaUtilizada()
    {
        return $this->tecnicaUtilizada;
    }

    /**
     * Set hipotesisDiagnostica
     *
     * @param string $hipotesisDiagnostica
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setHipotesisDiagnostica($hipotesisDiagnostica)
    {
        $this->hipotesisDiagnostica = $hipotesisDiagnostica;

        return $this;
    }

    /**
     * Get hipotesisDiagnostica
     *
     * @return string 
     */
    public function getHipotesisDiagnostica()
    {
        return $this->hipotesisDiagnostica;
    }

    /**
     * Set incidencias
     *
     * @param string $incidencias
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setIncidencias($incidencias)
    {
        $this->incidencias = $incidencias;

        return $this;
    }

    /**
     * Get incidencias
     *
     * @return string 
     */
    public function getIncidencias()
    {
        return $this->incidencias;
    }

    /**
     * Set fechaNacimientoIndeterminada
     *
     * @param boolean $fechaNacimientoIndeterminada
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setFechaNacimientoIndeterminada($fechaNacimientoIndeterminada)
    {
        $this->fechaNacimientoIndeterminada = $fechaNacimientoIndeterminada;

        return $this;
    }

    /**
     * Get fechaNacimientoIndeterminada
     *
     * @return boolean 
     */
    public function getFechaNacimientoIndeterminada()
    {
        return $this->fechaNacimientoIndeterminada;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return RyxProcedimientoRadiologicoRealizado
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
     * Set salaRealizado
     *
     * @param string $salaRealizado
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setSalaRealizado($salaRealizado)
    {
        $this->salaRealizado = $salaRealizado;

        return $this;
    }

    /**
     * Get salaRealizado
     *
     * @return string 
     */
    public function getSalaRealizado()
    {
        return $this->salaRealizado;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set esEmergencia
     *
     * @param boolean $esEmergencia
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setEsEmergencia($esEmergencia)
    {
        $this->esEmergencia = $esEmergencia;

        return $this;
    }

    /**
     * Get esEmergencia
     *
     * @return boolean 
     */
    public function getEsEmergencia()
    {
        return $this->esEmergencia;
    }

    /**
     * Set esComplementario
     *
     * @param boolean $esComplementario
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setEsComplementario($esComplementario)
    {
        $this->esComplementario = $esComplementario;

        return $this;
    }

    /**
     * Get esComplementario
     *
     * @return boolean 
     */
    public function getEsComplementario()
    {
        return $this->esComplementario;
    }

    /**
     * Set idCitaProgramada
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCitaProgramada $idCitaProgramada
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setIdCitaProgramada(\Minsal\SimagdBundle\Entity\RyxCitaProgramada $idCitaProgramada = null)
    {
        $this->idCitaProgramada = $idCitaProgramada;

        return $this;
    }

    /**
     * Get idCitaProgramada
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCitaProgramada 
     */
    public function getIdCitaProgramada()
    {
        return $this->idCitaProgramada;
    }

    /**
     * Set idTecnologoRealiza
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoRealiza
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setIdTecnologoRealiza(\Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoRealiza = null)
    {
        $this->idTecnologoRealiza = $idTecnologoRealiza;

        return $this;
    }

    /**
     * Get idTecnologoRealiza
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdTecnologoRealiza()
    {
        return $this->idTecnologoRealiza;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxProcedimientoRadiologicoRealizado
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
     * Set idEstadoProcedimientoRealizado
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlEstadoProcedimientoRealizado $idEstadoProcedimientoRealizado
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setIdEstadoProcedimientoRealizado(\Minsal\SimagdBundle\Entity\RyxCtlEstadoProcedimientoRealizado $idEstadoProcedimientoRealizado = null)
    {
        $this->idEstadoProcedimientoRealizado = $idEstadoProcedimientoRealizado;

        return $this;
    }

    /**
     * Get idEstadoProcedimientoRealizado
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlEstadoProcedimientoRealizado 
     */
    public function getIdEstadoProcedimientoRealizado()
    {
        return $this->idEstadoProcedimientoRealizado;
    }

    /**
     * Set idRegistraEmergencia
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRegistraEmergencia
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setIdRegistraEmergencia(\Minsal\SiapsBundle\Entity\MntEmpleado $idRegistraEmergencia = null)
    {
        $this->idRegistraEmergencia = $idRegistraEmergencia;

        return $this;
    }

    /**
     * Get idRegistraEmergencia
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRegistraEmergencia()
    {
        return $this->idRegistraEmergencia;
    }

    /**
     * Set idSolicitudEstudioComplementario
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $idSolicitudEstudioComplementario
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setIdSolicitudEstudioComplementario(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $idSolicitudEstudioComplementario = null)
    {
        $this->idSolicitudEstudioComplementario = $idSolicitudEstudioComplementario;

        return $this;
    }

    /**
     * Get idSolicitudEstudioComplementario
     *
     * @return \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario 
     */
    public function getIdSolicitudEstudioComplementario()
    {
        return $this->idSolicitudEstudioComplementario;
    }

    /**
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function setIdSolicitudEstudio(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio = null)
    {
        $this->idSolicitudEstudio = $idSolicitudEstudio;

        return $this;
    }

    /**
     * Get idSolicitudEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio 
     */
    public function getIdSolicitudEstudio()
    {
        return $this->idSolicitudEstudio;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxProcedimientoRadiologicoRealizado
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
     * @return RyxProcedimientoRadiologicoRealizado
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

    /**
     * Add materialUtilizadoV2
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoMaterialUtilizado $materialUtilizadoV2
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function addMaterialUtilizadoV2(\Minsal\SimagdBundle\Entity\RyxProcedimientoMaterialUtilizado $materialUtilizadoV2)
    {
        $this->materialUtilizadoV2[] = $materialUtilizadoV2;

        return $this;
    }

    /**
     * Remove materialUtilizadoV2
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoMaterialUtilizado $materialUtilizadoV2
     */
    public function removeMaterialUtilizadoV2(\Minsal\SimagdBundle\Entity\RyxProcedimientoMaterialUtilizado $materialUtilizadoV2)
    {
        $this->materialUtilizadoV2->removeElement($materialUtilizadoV2);
    }

    /**
     * Get materialUtilizadoV2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaterialUtilizadoV2()
    {
        return $this->materialUtilizadoV2;
    }

    /**
     * Add examenEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $examenEstudio
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function addExamenEstudio(\Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $examenEstudio)
    {
        $this->examenEstudio[] = $examenEstudio;

        return $this;
    }

    /**
     * Remove examenEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $examenEstudio
     */
    public function removeExamenEstudio(\Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $examenEstudio)
    {
        $this->examenEstudio->removeElement($examenEstudio);
    }

    /**
     * Get examenEstudio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamenEstudio()
    {
        return $this->examenEstudio;
    }

    /**
     * Add examenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $examenPendienteRealizar
     * @return RyxProcedimientoRadiologicoRealizado
     */
    public function addExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $examenPendienteRealizar)
    {
        $this->examenPendienteRealizar[] = $examenPendienteRealizar;

        return $this;
    }

    /**
     * Remove examenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $examenPendienteRealizar
     */
    public function removeExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $examenPendienteRealizar)
    {
        $this->examenPendienteRealizar->removeElement($examenPendienteRealizar);
    }

    /**
     * Get examenPendienteRealizar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamenPendienteRealizar()
    {
        return $this->examenPendienteRealizar;
    }
}
