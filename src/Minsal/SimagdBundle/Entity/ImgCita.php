<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCita
 *
 * @ORM\Table(name="img_cita", indexes={@ORM\Index(name="IDX_F0266B5A51F7CF06", columns={"id_configuracion_agenda"}), @ORM\Index(name="IDX_F0266B5A890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_F0266B5A7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_F0266B5ADD0D821B", columns={"id_estado_cita"}), @ORM\Index(name="IDX_F0266B5ADEFEA3F", columns={"id_responsable_autoriza"}), @ORM\Index(name="IDX_F0266B5A6AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_F0266B5A91124CBF", columns={"id_tecnologo_programado"}), @ORM\Index(name="IDX_F0266B5ADEA2D3D3", columns={"id_user_prg"}), @ORM\Index(name="IDX_F0266B5A94AEBFD3", columns={"id_user_reprg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCitaProgramadaRepository")
 */
class ImgCita
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_cita_id_seq", allocationSize=1, initialValue=1)
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
     * @var \ImgCtlConfiguracionAgenda
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlConfiguracionAgenda")
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
     * @var \ImgCtlEstadoCita
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlEstadoCita")
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
     * @var \ImgSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudio", inversedBy="solicitudEstudioCitas")
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
     * @ORM\OneToMany(targetEntity="ImgProcedimientoRealizado", mappedBy="idCitaProgramada", cascade={"all"}, orphanRemoval=true)
     */
    private $citaProcedimientosRealizados;

    /**
     * @ORM\OneToMany(targetEntity="ImgPendienteRealizacion", mappedBy="idCitaProgramada", cascade={"all"}, orphanRemoval=true)
     */
    private $citaExamenPendienteRealizar;


    public function __toString()
    {
        return 'Cita de: ' . $this->idSolicitudEstudio . ' :: ' . $this->idEstadoCita;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->citaProcedimientosRealizados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->citaExamenPendienteRealizar = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlConfiguracionAgenda $idConfiguracionAgenda
     * @return ImgCita
     */
    public function setIdConfiguracionAgenda(\Minsal\SimagdBundle\Entity\ImgCtlConfiguracionAgenda $idConfiguracionAgenda = null)
    {
        $this->idConfiguracionAgenda = $idConfiguracionAgenda;

        return $this;
    }

    /**
     * Get idConfiguracionAgenda
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlConfiguracionAgenda 
     */
    public function getIdConfiguracionAgenda()
    {
        return $this->idConfiguracionAgenda;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return ImgCita
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
     * @return ImgCita
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlEstadoCita $idEstadoCita
     * @return ImgCita
     */
    public function setIdEstadoCita(\Minsal\SimagdBundle\Entity\ImgCtlEstadoCita $idEstadoCita = null)
    {
        $this->idEstadoCita = $idEstadoCita;

        return $this;
    }

    /**
     * Get idEstadoCita
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlEstadoCita 
     */
    public function getIdEstadoCita()
    {
        return $this->idEstadoCita;
    }

    /**
     * Set idResponsableAutoriza
     *
     * @param \Minsal\SiapsBundle\Entity\CtlParentesco $idResponsableAutoriza
     * @return ImgCita
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
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio
     * @return ImgCita
     */
    public function setIdSolicitudEstudio(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio = null)
    {
        $this->idSolicitudEstudio = $idSolicitudEstudio;

        return $this;
    }

    /**
     * Get idSolicitudEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio 
     */
    public function getIdSolicitudEstudio()
    {
        return $this->idSolicitudEstudio;
    }

    /**
     * Set idTecnologoProgramado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoProgramado
     * @return ImgCita
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
     * @return ImgCita
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
     * @return ImgCita
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
     * @param \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $citaProcedimientosRealizados
     * @return ImgCita
     */
    public function addCitaProcedimientosRealizado(\Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $citaProcedimientosRealizados)
    {
        $this->citaProcedimientosRealizados[] = $citaProcedimientosRealizados;

        return $this;
    }

    /**
     * Remove citaProcedimientosRealizados
     *
     * @param \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $citaProcedimientosRealizados
     */
    public function removeCitaProcedimientosRealizado(\Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $citaProcedimientosRealizados)
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
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $citaExamenPendienteRealizar
     * @return ImgCita
     */
    public function addCitaExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $citaExamenPendienteRealizar)
    {
        $this->citaExamenPendienteRealizar[] = $citaExamenPendienteRealizar;

        return $this;
    }

    /**
     * Remove citaExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $citaExamenPendienteRealizar
     */
    public function removeCitaExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $citaExamenPendienteRealizar)
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
