<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCitaProgramada
 *
 * @ORM\Table(name="ryx_cita_programada", indexes={@ORM\Index(name="IDX_4639A1FE51F7CF06", columns={"id_configuracion_agenda"}), @ORM\Index(name="IDX_4639A1FE890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_4639A1FE7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_4639A1FEDD0D821B", columns={"id_estado_cita"}), @ORM\Index(name="IDX_4639A1FEDEFEA3F", columns={"id_responsable_autoriza"}), @ORM\Index(name="IDX_4639A1FE6AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_4639A1FE91124CBF", columns={"id_tecnologo_programado"}), @ORM\Index(name="IDX_4639A1FEDEA2D3D3", columns={"id_user_prg"}), @ORM\Index(name="IDX_4639A1FE94AEBFD3", columns={"id_user_reprg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCitaProgramadaRepository")
 */
class RyxCitaProgramada implements EntityInterface
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
    private $color = '#183f52';

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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEmpleado;

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
     * @var \RyxCtlEstadoCita
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoCita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_cita", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio", inversedBy="solicitudEstudioCitas")
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
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @ORM\OneToMany(targetEntity="RyxProcedimientoRadiologicoRealizado", mappedBy="idCitaProgramada", cascade={"all"}, orphanRemoval=true)
     */
    private $citaProcedimientosRealizados;

    /**
     * @ORM\OneToMany(targetEntity="RyxExamenPendienteRealizacion", mappedBy="idCitaProgramada", cascade={"all"}, orphanRemoval=true)
     */
    private $citaExamenPendienteRealizar;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->citaProcedimientosRealizados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->citaExamenPendienteRealizar = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return 'Cita de: ' . $this->idSolicitudEstudio . ' :: ' . $this->idEstadoCita;
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
     * Set reprogramada
     *
     * @param boolean $reprogramada
     * @return RyxCitaProgramada
     */
    public function setReprogramada($reprogramada)
    {
        $this->reprogramada = $reprogramada;

        return $this;
    }

    /**
     * Get reprogramada
     *
     * @return boolean 
     */
    public function getReprogramada()
    {
        return $this->reprogramada;
    }

    /**
     * Set incidencias
     *
     * @param string $incidencias
     * @return RyxCitaProgramada
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return RyxCitaProgramada
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
     * Set razonAnulada
     *
     * @param string $razonAnulada
     * @return RyxCitaProgramada
     */
    public function setRazonAnulada($razonAnulada)
    {
        $this->razonAnulada = $razonAnulada;

        return $this;
    }

    /**
     * Get razonAnulada
     *
     * @return string 
     */
    public function getRazonAnulada()
    {
        return $this->razonAnulada;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return RyxCitaProgramada
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaConfirmacion
     *
     * @param \DateTime $fechaConfirmacion
     * @return RyxCitaProgramada
     */
    public function setFechaConfirmacion($fechaConfirmacion)
    {
        $this->fechaConfirmacion = $fechaConfirmacion;

        return $this;
    }

    /**
     * Get fechaConfirmacion
     *
     * @return \DateTime 
     */
    public function getFechaConfirmacion()
    {
        return $this->fechaConfirmacion;
    }

    /**
     * Set fechaReprogramacion
     *
     * @param \DateTime $fechaReprogramacion
     * @return RyxCitaProgramada
     */
    public function setFechaReprogramacion($fechaReprogramacion)
    {
        $this->fechaReprogramacion = $fechaReprogramacion;

        return $this;
    }

    /**
     * Get fechaReprogramacion
     *
     * @return \DateTime 
     */
    public function getFechaReprogramacion()
    {
        return $this->fechaReprogramacion;
    }

    /**
     * Set necesitaAutorizacion
     *
     * @param boolean $necesitaAutorizacion
     * @return RyxCitaProgramada
     */
    public function setNecesitaAutorizacion($necesitaAutorizacion)
    {
        $this->necesitaAutorizacion = $necesitaAutorizacion;

        return $this;
    }

    /**
     * Get necesitaAutorizacion
     *
     * @return boolean 
     */
    public function getNecesitaAutorizacion()
    {
        return $this->necesitaAutorizacion;
    }

    /**
     * Set citaAutorizada
     *
     * @param boolean $citaAutorizada
     * @return RyxCitaProgramada
     */
    public function setCitaAutorizada($citaAutorizada)
    {
        $this->citaAutorizada = $citaAutorizada;

        return $this;
    }

    /**
     * Get citaAutorizada
     *
     * @return boolean 
     */
    public function getCitaAutorizada()
    {
        return $this->citaAutorizada;
    }

    /**
     * Set nombreResponsableAutoriza
     *
     * @param string $nombreResponsableAutoriza
     * @return RyxCitaProgramada
     */
    public function setNombreResponsableAutoriza($nombreResponsableAutoriza)
    {
        $this->nombreResponsableAutoriza = $nombreResponsableAutoriza;

        return $this;
    }

    /**
     * Get nombreResponsableAutoriza
     *
     * @return string 
     */
    public function getNombreResponsableAutoriza()
    {
        return $this->nombreResponsableAutoriza;
    }

    /**
     * Set diaCompleto
     *
     * @param boolean $diaCompleto
     * @return RyxCitaProgramada
     */
    public function setDiaCompleto($diaCompleto)
    {
        $this->diaCompleto = $diaCompleto;

        return $this;
    }

    /**
     * Get diaCompleto
     *
     * @return boolean 
     */
    public function getDiaCompleto()
    {
        return $this->diaCompleto;
    }

    /**
     * Set fechaHoraInicio
     *
     * @param \DateTime $fechaHoraInicio
     * @return RyxCitaProgramada
     */
    public function setFechaHoraInicio($fechaHoraInicio)
    {
        $this->fechaHoraInicio = $fechaHoraInicio;

        return $this;
    }

    /**
     * Get fechaHoraInicio
     *
     * @return \DateTime 
     */
    public function getFechaHoraInicio()
    {
        return $this->fechaHoraInicio;
    }

    /**
     * Set fechaHoraFin
     *
     * @param \DateTime $fechaHoraFin
     * @return RyxCitaProgramada
     */
    public function setFechaHoraFin($fechaHoraFin)
    {
        $this->fechaHoraFin = $fechaHoraFin;

        return $this;
    }

    /**
     * Get fechaHoraFin
     *
     * @return \DateTime 
     */
    public function getFechaHoraFin()
    {
        return $this->fechaHoraFin;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return RyxCitaProgramada
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set fechaHoraInicioAnterior
     *
     * @param \DateTime $fechaHoraInicioAnterior
     * @return RyxCitaProgramada
     */
    public function setFechaHoraInicioAnterior($fechaHoraInicioAnterior)
    {
        $this->fechaHoraInicioAnterior = $fechaHoraInicioAnterior;

        return $this;
    }

    /**
     * Get fechaHoraInicioAnterior
     *
     * @return \DateTime 
     */
    public function getFechaHoraInicioAnterior()
    {
        return $this->fechaHoraInicioAnterior;
    }

    /**
     * Set fechaHoraFinAnterior
     *
     * @param \DateTime $fechaHoraFinAnterior
     * @return RyxCitaProgramada
     */
    public function setFechaHoraFinAnterior($fechaHoraFinAnterior)
    {
        $this->fechaHoraFinAnterior = $fechaHoraFinAnterior;

        return $this;
    }

    /**
     * Get fechaHoraFinAnterior
     *
     * @return \DateTime 
     */
    public function getFechaHoraFinAnterior()
    {
        return $this->fechaHoraFinAnterior;
    }

    /**
     * Set idConfiguracionAgenda
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlConfiguracionAgenda $idConfiguracionAgenda
     * @return RyxCitaProgramada
     */
    public function setIdConfiguracionAgenda(\Minsal\SimagdBundle\Entity\RyxCtlConfiguracionAgenda $idConfiguracionAgenda = null)
    {
        $this->idConfiguracionAgenda = $idConfiguracionAgenda;

        return $this;
    }

    /**
     * Get idConfiguracionAgenda
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlConfiguracionAgenda 
     */
    public function getIdConfiguracionAgenda()
    {
        return $this->idConfiguracionAgenda;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return RyxCitaProgramada
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxCitaProgramada
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
     * Set idEstadoCita
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlEstadoCita $idEstadoCita
     * @return RyxCitaProgramada
     */
    public function setIdEstadoCita(\Minsal\SimagdBundle\Entity\RyxCtlEstadoCita $idEstadoCita = null)
    {
        $this->idEstadoCita = $idEstadoCita;

        return $this;
    }

    /**
     * Get idEstadoCita
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlEstadoCita 
     */
    public function getIdEstadoCita()
    {
        return $this->idEstadoCita;
    }

    /**
     * Set idResponsableAutoriza
     *
     * @param \Minsal\SiapsBundle\Entity\CtlParentesco $idResponsableAutoriza
     * @return RyxCitaProgramada
     */
    public function setIdResponsableAutoriza(\Minsal\SiapsBundle\Entity\CtlParentesco $idResponsableAutoriza = null)
    {
        $this->idResponsableAutoriza = $idResponsableAutoriza;

        return $this;
    }

    /**
     * Get idResponsableAutoriza
     *
     * @return \Minsal\SiapsBundle\Entity\CtlParentesco 
     */
    public function getIdResponsableAutoriza()
    {
        return $this->idResponsableAutoriza;
    }

    /**
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio
     * @return RyxCitaProgramada
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
     * Set idTecnologoProgramado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoProgramado
     * @return RyxCitaProgramada
     */
    public function setIdTecnologoProgramado(\Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoProgramado = null)
    {
        $this->idTecnologoProgramado = $idTecnologoProgramado;

        return $this;
    }

    /**
     * Get idTecnologoProgramado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdTecnologoProgramado()
    {
        return $this->idTecnologoProgramado;
    }

    /**
     * Set idUserPrg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserPrg
     * @return RyxCitaProgramada
     */
    public function setIdUserPrg(\Application\Sonata\UserBundle\Entity\User $idUserPrg = null)
    {
        $this->idUserPrg = $idUserPrg;

        return $this;
    }

    /**
     * Get idUserPrg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserPrg()
    {
        return $this->idUserPrg;
    }

    /**
     * Set idUserReprg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReprg
     * @return RyxCitaProgramada
     */
    public function setIdUserReprg(\Application\Sonata\UserBundle\Entity\User $idUserReprg = null)
    {
        $this->idUserReprg = $idUserReprg;

        return $this;
    }

    /**
     * Get idUserReprg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserReprg()
    {
        return $this->idUserReprg;
    }

    /**
     * Add citaProcedimientosRealizados
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $citaProcedimientosRealizados
     * @return RyxCitaProgramada
     */
    public function addCitaProcedimientosRealizado(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $citaProcedimientosRealizados)
    {
        $this->citaProcedimientosRealizados[] = $citaProcedimientosRealizados;

        return $this;
    }

    /**
     * Remove citaProcedimientosRealizados
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $citaProcedimientosRealizados
     */
    public function removeCitaProcedimientosRealizado(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $citaProcedimientosRealizados)
    {
        $this->citaProcedimientosRealizados->removeElement($citaProcedimientosRealizados);
    }

    /**
     * Get citaProcedimientosRealizados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCitaProcedimientosRealizados()
    {
        return $this->citaProcedimientosRealizados;
    }

    /**
     * Add citaExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $citaExamenPendienteRealizar
     * @return RyxCitaProgramada
     */
    public function addCitaExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $citaExamenPendienteRealizar)
    {
        $this->citaExamenPendienteRealizar[] = $citaExamenPendienteRealizar;

        return $this;
    }

    /**
     * Remove citaExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $citaExamenPendienteRealizar
     */
    public function removeCitaExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $citaExamenPendienteRealizar)
    {
        $this->citaExamenPendienteRealizar->removeElement($citaExamenPendienteRealizar);
    }

    /**
     * Get citaExamenPendienteRealizar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCitaExamenPendienteRealizar()
    {
        return $this->citaExamenPendienteRealizar;
    }
}
