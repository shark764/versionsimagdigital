<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgLectura
 *
 * @ORM\Table(name="img_lectura", indexes={@ORM\Index(name="IDX_8B65F9B9890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_8B65F9B97DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_8B65F9B9D93DAF86", columns={"id_estado_lectura"}), @ORM\Index(name="IDX_8B65F9B96196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_8B65F9B933CCFAF2", columns={"id_expediente_ficticio"}), @ORM\Index(name="IDX_8B65F9B9701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_8B65F9B9F80B40A", columns={"id_patron_asociado"}), @ORM\Index(name="IDX_8B65F9B963643B18", columns={"id_radiologo_designado_aprobacion"}), @ORM\Index(name="IDX_8B65F9B94E924116", columns={"id_radiologo_solicita"}), @ORM\Index(name="IDX_8B65F9B9526C8D52", columns={"id_solicitud_diagnostico"}), @ORM\Index(name="IDX_8B65F9B9D426DB54", columns={"id_tipo_resultado"}), @ORM\Index(name="IDX_8B65F9B9CC6E65C8", columns={"id_transcriptor_asignado"}), @ORM\Index(name="IDX_8B65F9B9D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxLecturaRadiologicaRepository")
 */
class ImgLectura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_lectura_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="correlativo", type="string", nullable=true)
     */
    private $correlativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_lectura", type="datetime", nullable=true)
     */
    private $fechaLectura = '(now())::timestamp(0) without time zone';

    /**
     * @var boolean
     *
     * @ORM\Column(name="lectura_remota", type="boolean", nullable=true)
     */
    private $lecturaRemota = false;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones", type="string", length=255, nullable=true)
     */
    private $indicaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var boolean
     *
     * @ORM\Column(name="solicitada_por_radiologo", type="boolean", nullable=true)
     */
    private $solicitadaPorRadiologo = false;

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
     * @var \ImgCtlEstadoLectura
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlEstadoLectura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_lectura", referencedColumnName="id")
     * })
     */
    private $idEstadoLectura;

    /**
     * @var \ImgEstudioPaciente
     *
     * @ORM\ManyToOne(targetEntity="ImgEstudioPaciente", inversedBy="estudioLecturasRealizadas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

    /**
     * @var \ImgExpedienteFicticio
     *
     * @ORM\ManyToOne(targetEntity="ImgExpedienteFicticio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente_ficticio", referencedColumnName="id")
     * })
     */
    private $idExpedienteFicticio;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

    /**
     * @var \ImgCtlPatronDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlPatronDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patron_asociado", referencedColumnName="id")
     * })
     */
    private $idPatronAsociado;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_designado_aprobacion", referencedColumnName="id")
     * })
     */
    private $idRadiologoDesignadoAprobacion;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_solicita", referencedColumnName="id")
     * })
     */
    private $idRadiologoSolicita;

    /**
     * @var \ImgSolicitudDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_diagnostico", referencedColumnName="id")
     * })
     */
    private $idSolicitudDiagnostico;

    /**
     * @var \ImgCtlTipoResultado
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlTipoResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_resultado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTipoResultado;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_transcriptor_asignado", referencedColumnName="id")
     * })
     */
    private $idTranscriptorAsignado;

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
     * @ORM\ManyToMany(targetEntity="ImgEstudioPaciente")
     * @ORM\JoinTable(name="img_lectura_estudio",
     *      joinColumns={@ORM\JoinColumn(name="id_lectura", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_estudio", referencedColumnName="id")}
     * )
     */
    private $estudiosLectura;


    /**
     * @ORM\OneToMany(targetEntity="ImgDiagnostico", mappedBy="idLectura", cascade={"all"}, orphanRemoval=true)
     */
    private $lecturaDiagnostico;

    /**
     * @ORM\OneToMany(targetEntity="ImgPendienteTranscripcion", mappedBy="idLectura", cascade={"all"}, orphanRemoval=true)
     */
    private $lecturaPendienteTranscribir;

    /**
     * @ORM\OneToMany(targetEntity="ImgLecturaEstudio", mappedBy="idLectura", cascade={"all"}, orphanRemoval=true)
     */
    private $lecturaLecturaEstudios;

    public function __toString()
    {
        return $this->correlativo . ' :: ' . $this->idEstudio . ' :: ' . $this->idEstadoLectura;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estudiosLectura = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lecturaDiagnostico = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lecturaPendienteTranscribir = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lecturaLecturaEstudios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set correlativo
     *
     * @param string $correlativo
     * @return ImgLectura
     */
    public function setCorrelativo($correlativo)
    {
        $this->correlativo = $correlativo;

        return $this;
    }

    /**
     * Get correlativo
     *
     * @return string 
     */
    public function getCorrelativo()
    {
        return $this->correlativo;
    }

    /**
     * Set fechaLectura
     *
     * @param \DateTime $fechaLectura
     * @return ImgLectura
     */
    public function setFechaLectura($fechaLectura)
    {
        $this->fechaLectura = $fechaLectura;

        return $this;
    }

    /**
     * Get fechaLectura
     *
     * @return \DateTime 
     */
    public function getFechaLectura()
    {
        return $this->fechaLectura;
    }

    /**
     * Set lecturaRemota
     *
     * @param boolean $lecturaRemota
     * @return ImgLectura
     */
    public function setLecturaRemota($lecturaRemota)
    {
        $this->lecturaRemota = $lecturaRemota;

        return $this;
    }

    /**
     * Get lecturaRemota
     *
     * @return boolean 
     */
    public function getLecturaRemota()
    {
        return $this->lecturaRemota;
    }

    /**
     * Set indicaciones
     *
     * @param string $indicaciones
     * @return ImgLectura
     */
    public function setIndicaciones($indicaciones)
    {
        $this->indicaciones = $indicaciones;

        return $this;
    }

    /**
     * Get indicaciones
     *
     * @return string 
     */
    public function getIndicaciones()
    {
        return $this->indicaciones;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return ImgLectura
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
     * Set solicitadaPorRadiologo
     *
     * @param boolean $solicitadaPorRadiologo
     * @return ImgLectura
     */
    public function setSolicitadaPorRadiologo($solicitadaPorRadiologo)
    {
        $this->solicitadaPorRadiologo = $solicitadaPorRadiologo;

        return $this;
    }

    /**
     * Get solicitadaPorRadiologo
     *
     * @return boolean 
     */
    public function getSolicitadaPorRadiologo()
    {
        return $this->solicitadaPorRadiologo;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return ImgLectura
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
     * @return ImgLectura
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
     * Set idEstadoLectura
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlEstadoLectura $idEstadoLectura
     * @return ImgLectura
     */
    public function setIdEstadoLectura(\Minsal\SimagdBundle\Entity\ImgCtlEstadoLectura $idEstadoLectura = null)
    {
        $this->idEstadoLectura = $idEstadoLectura;

        return $this;
    }

    /**
     * Get idEstadoLectura
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlEstadoLectura 
     */
    public function getIdEstadoLectura()
    {
        return $this->idEstadoLectura;
    }

    /**
     * Set idEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudio
     * @return ImgLectura
     */
    public function setIdEstudio(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudio = null)
    {
        $this->idEstudio = $idEstudio;

        return $this;
    }

    /**
     * Get idEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\ImgEstudioPaciente 
     */
    public function getIdEstudio()
    {
        return $this->idEstudio;
    }

    /**
     * Set idExpedienteFicticio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgExpedienteFicticio $idExpedienteFicticio
     * @return ImgLectura
     */
    public function setIdExpedienteFicticio(\Minsal\SimagdBundle\Entity\ImgExpedienteFicticio $idExpedienteFicticio = null)
    {
        $this->idExpedienteFicticio = $idExpedienteFicticio;

        return $this;
    }

    /**
     * Get idExpedienteFicticio
     *
     * @return \Minsal\SimagdBundle\Entity\ImgExpedienteFicticio 
     */
    public function getIdExpedienteFicticio()
    {
        return $this->idExpedienteFicticio;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return ImgLectura
     */
    public function setIdExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $idExpediente = null)
    {
        $this->idExpediente = $idExpediente;

        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente 
     */
    public function getIdExpediente()
    {
        return $this->idExpediente;
    }

    /**
     * Set idPatronAsociado
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico $idPatronAsociado
     * @return ImgLectura
     */
    public function setIdPatronAsociado(\Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico $idPatronAsociado = null)
    {
        $this->idPatronAsociado = $idPatronAsociado;

        return $this;
    }

    /**
     * Get idPatronAsociado
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico 
     */
    public function getIdPatronAsociado()
    {
        return $this->idPatronAsociado;
    }

    /**
     * Set idRadiologoDesignadoAprobacion
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoDesignadoAprobacion
     * @return ImgLectura
     */
    public function setIdRadiologoDesignadoAprobacion(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoDesignadoAprobacion = null)
    {
        $this->idRadiologoDesignadoAprobacion = $idRadiologoDesignadoAprobacion;

        return $this;
    }

    /**
     * Get idRadiologoDesignadoAprobacion
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoDesignadoAprobacion()
    {
        return $this->idRadiologoDesignadoAprobacion;
    }

    /**
     * Set idRadiologoSolicita
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoSolicita
     * @return ImgLectura
     */
    public function setIdRadiologoSolicita(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoSolicita = null)
    {
        $this->idRadiologoSolicita = $idRadiologoSolicita;

        return $this;
    }

    /**
     * Get idRadiologoSolicita
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoSolicita()
    {
        return $this->idRadiologoSolicita;
    }

    /**
     * Set idSolicitudDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico $idSolicitudDiagnostico
     * @return ImgLectura
     */
    public function setIdSolicitudDiagnostico(\Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico $idSolicitudDiagnostico = null)
    {
        $this->idSolicitudDiagnostico = $idSolicitudDiagnostico;

        return $this;
    }

    /**
     * Get idSolicitudDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico 
     */
    public function getIdSolicitudDiagnostico()
    {
        return $this->idSolicitudDiagnostico;
    }

    /**
     * Set idTipoResultado
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlTipoResultado $idTipoResultado
     * @return ImgLectura
     */
    public function setIdTipoResultado(\Minsal\SimagdBundle\Entity\ImgCtlTipoResultado $idTipoResultado = null)
    {
        $this->idTipoResultado = $idTipoResultado;

        return $this;
    }

    /**
     * Get idTipoResultado
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlTipoResultado 
     */
    public function getIdTipoResultado()
    {
        return $this->idTipoResultado;
    }

    /**
     * Set idTranscriptorAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTranscriptorAsignado
     * @return ImgLectura
     */
    public function setIdTranscriptorAsignado(\Minsal\SiapsBundle\Entity\MntEmpleado $idTranscriptorAsignado = null)
    {
        $this->idTranscriptorAsignado = $idTranscriptorAsignado;

        return $this;
    }

    /**
     * Get idTranscriptorAsignado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdTranscriptorAsignado()
    {
        return $this->idTranscriptorAsignado;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return ImgLectura
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
     * Add estudiosLectura
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudiosLectura
     * @return ImgLectura
     */
    public function addEstudiosLectura(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudiosLectura)
    {
        $this->estudiosLectura[] = $estudiosLectura;

        return $this;
    }

    /**
     * Remove estudiosLectura
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudiosLectura
     */
    public function removeEstudiosLectura(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudiosLectura)
    {
        $this->estudiosLectura->removeElement($estudiosLectura);
    }

    /**
     * Get estudiosLectura
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudiosLectura()
    {
        return $this->estudiosLectura;
    }

    /**
     * Add lecturaDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgDiagnostico $lecturaDiagnostico
     * @return ImgLectura
     */
    public function addLecturaDiagnostico(\Minsal\SimagdBundle\Entity\ImgDiagnostico $lecturaDiagnostico)
    {
        $this->lecturaDiagnostico[] = $lecturaDiagnostico;

        return $this;
    }

    /**
     * Remove lecturaDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgDiagnostico $lecturaDiagnostico
     */
    public function removeLecturaDiagnostico(\Minsal\SimagdBundle\Entity\ImgDiagnostico $lecturaDiagnostico)
    {
        $this->lecturaDiagnostico->removeElement($lecturaDiagnostico);
    }

    /**
     * Get lecturaDiagnostico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLecturaDiagnostico()
    {
        return $this->lecturaDiagnostico;
    }

    /**
     * Add lecturaPendienteTranscribir
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion $lecturaPendienteTranscribir
     * @return ImgLectura
     */
    public function addLecturaPendienteTranscribir(\Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion $lecturaPendienteTranscribir)
    {
        $this->lecturaPendienteTranscribir[] = $lecturaPendienteTranscribir;

        return $this;
    }

    /**
     * Remove lecturaPendienteTranscribir
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion $lecturaPendienteTranscribir
     */
    public function removeLecturaPendienteTranscribir(\Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion $lecturaPendienteTranscribir)
    {
        $this->lecturaPendienteTranscribir->removeElement($lecturaPendienteTranscribir);
    }

    /**
     * Get lecturaPendienteTranscribir
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLecturaPendienteTranscribir()
    {
        return $this->lecturaPendienteTranscribir;
    }

    /**
     * Add lecturaLecturaEstudios
     *
     * @param \Minsal\SimagdBundle\Entity\ImgLecturaEstudio $lecturaLecturaEstudios
     * @return ImgLectura
     */
    public function addLecturaLecturaEstudio(\Minsal\SimagdBundle\Entity\ImgLecturaEstudio $lecturaLecturaEstudios)
    {
        $this->lecturaLecturaEstudios[] = $lecturaLecturaEstudios;

        return $this;
    }

    /**
     * Remove lecturaLecturaEstudios
     *
     * @param \Minsal\SimagdBundle\Entity\ImgLecturaEstudio $lecturaLecturaEstudios
     */
    public function removeLecturaLecturaEstudio(\Minsal\SimagdBundle\Entity\ImgLecturaEstudio $lecturaLecturaEstudios)
    {
        $this->lecturaLecturaEstudios->removeElement($lecturaLecturaEstudios);
    }

    /**
     * Get lecturaLecturaEstudios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLecturaLecturaEstudios()
    {
        return $this->lecturaLecturaEstudios;
    }
}
