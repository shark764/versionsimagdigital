<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxExamenPendienteRealizacion
 *
 * @ORM\Table(name="ryx_examen_pendiente_realizacion", indexes={@ORM\Index(name="IDX_9B93C7CD7FF9412C", columns={"id_asigna_examinante"}), @ORM\Index(name="IDX_9B93C7CD5BBAAD2F", columns={"id_cita_programada"}), @ORM\Index(name="IDX_9B93C7CD7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_9B93C7CD486B3529", columns={"id_procedimiento_iniciado"}), @ORM\Index(name="IDX_9B93C7CD60C0CAA5", columns={"id_registra_emergencia"}), @ORM\Index(name="IDX_9B93C7CDF0951F8F", columns={"id_solicitud_estudio_complementario"}), @ORM\Index(name="IDX_9B93C7CD6AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_9B93C7CD7500743E", columns={"id_tecnologo_asignado"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxExamenPendienteRealizacionRepository")
 */
class RyxExamenPendienteRealizacion implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_examen_pendiente_realizacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso_lista", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaIngresoLista = '(now())::timestamp(0) without time zone';

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_examinante", referencedColumnName="id")
     * })
     */
    private $idAsignaExaminante;

    /**
     * @var \RyxCitaProgramada
     *
     * @ORM\ManyToOne(targetEntity="RyxCitaProgramada", inversedBy="citaExamenPendienteRealizar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cita_programada", referencedColumnName="id")
     * })
     */
    private $idCitaProgramada;

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
     * @var \RyxProcedimientoRadiologicoRealizado
     *
     * @ORM\ManyToOne(targetEntity="RyxProcedimientoRadiologicoRealizado", inversedBy="examenPendienteRealizar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_iniciado", referencedColumnName="id")
     * })
     */
    private $idProcedimientoIniciado;

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
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudioComplementario", inversedBy="complementarioExamenPendienteRealizar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;

    /**
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio", inversedBy="solicitudEstudioExamenPendienteRealizar")
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
     *   @ORM\JoinColumn(name="id_tecnologo_asignado", referencedColumnName="id")
     * })
     */
    private $idTecnologoAsignado;

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
        return $this->idSolicitudEstudio . ' :: ' . $this->idEstablecimiento;
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
     * Set fechaIngresoLista
     *
     * @param \DateTime $fechaIngresoLista
     * @return RyxExamenPendienteRealizacion
     */
    public function setFechaIngresoLista($fechaIngresoLista)
    {
        $this->fechaIngresoLista = $fechaIngresoLista;

        return $this;
    }

    /**
     * Get fechaIngresoLista
     *
     * @return \DateTime 
     */
    public function getFechaIngresoLista()
    {
        return $this->fechaIngresoLista;
    }

    /**
     * Set esEmergencia
     *
     * @param boolean $esEmergencia
     * @return RyxExamenPendienteRealizacion
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
     * @return RyxExamenPendienteRealizacion
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
     * Set idAsignaExaminante
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaExaminante
     * @return RyxExamenPendienteRealizacion
     */
    public function setIdAsignaExaminante(\Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaExaminante = null)
    {
        $this->idAsignaExaminante = $idAsignaExaminante;

        return $this;
    }

    /**
     * Get idAsignaExaminante
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdAsignaExaminante()
    {
        return $this->idAsignaExaminante;
    }

    /**
     * Set idCitaProgramada
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCitaProgramada $idCitaProgramada
     * @return RyxExamenPendienteRealizacion
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
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxExamenPendienteRealizacion
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
     * Set idProcedimientoIniciado
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $idProcedimientoIniciado
     * @return RyxExamenPendienteRealizacion
     */
    public function setIdProcedimientoIniciado(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $idProcedimientoIniciado = null)
    {
        $this->idProcedimientoIniciado = $idProcedimientoIniciado;

        return $this;
    }

    /**
     * Get idProcedimientoIniciado
     *
     * @return \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado 
     */
    public function getIdProcedimientoIniciado()
    {
        return $this->idProcedimientoIniciado;
    }

    /**
     * Set idRegistraEmergencia
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRegistraEmergencia
     * @return RyxExamenPendienteRealizacion
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
     * @return RyxExamenPendienteRealizacion
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
     * @return RyxExamenPendienteRealizacion
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
     * Set idTecnologoAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoAsignado
     * @return RyxExamenPendienteRealizacion
     */
    public function setIdTecnologoAsignado(\Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoAsignado = null)
    {
        $this->idTecnologoAsignado = $idTecnologoAsignado;

        return $this;
    }

    /**
     * Get idTecnologoAsignado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdTecnologoAsignado()
    {
        return $this->idTecnologoAsignado;
    }
}
