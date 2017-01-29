<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgPendienteRealizacion
 *
 * @ORM\Table(name="img_pendiente_realizacion", indexes={@ORM\Index(name="IDX_43198E575BBAAD2F", columns={"id_cita_programada"}), @ORM\Index(name="IDX_43198E577DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_43198E57486B3529", columns={"id_procedimiento_iniciado"}), @ORM\Index(name="IDX_43198E5760C0CAA5", columns={"id_registra_emergencia"}), @ORM\Index(name="IDX_43198E57F0951F8F", columns={"id_solicitud_estudio_complementario"}), @ORM\Index(name="IDX_43198E576AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_43198E577500743E", columns={"id_tecnologo_asignado"}), @ORM\Index(name="IDX_43198E577FF9412C", columns={"id_asigna_examinante"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\PendienteRealizacionRepository")
 */
class ImgPendienteRealizacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_pendiente_realizacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso_lista", type="datetime", nullable=true)
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
     * @var \ImgCita
     *
     * @ORM\ManyToOne(targetEntity="ImgCita", inversedBy="citaExamenPendienteRealizar")
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
     */
    private $idEstablecimiento;

    /**
     * @var \ImgProcedimientoRealizado
     *
     * @ORM\ManyToOne(targetEntity="ImgProcedimientoRealizado", inversedBy="examenPendienteRealizar")
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
     * @var \ImgSolicitudEstudioComplementario
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudioComplementario", inversedBy="complementarioExamenPendienteRealizar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;

    /**
     * @var \ImgSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudio", inversedBy="solicitudEstudioExamenPendienteRealizar")
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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_examinante", referencedColumnName="id")
     * })
     */
    private $idAsignaExaminante;

    public function __toString()
    {
        return $this->idSolicitudEstudio . ' :: ' . $this->idEstablecimiento;
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
     * @return ImgPendienteRealizacion
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
     * @return ImgPendienteRealizacion
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
     * @return ImgPendienteRealizacion
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
     * @param \Minsal\SimagdBundle\Entity\ImgCita $idCitaProgramada
     * @return ImgPendienteRealizacion
     */
    public function setIdCitaProgramada(\Minsal\SimagdBundle\Entity\ImgCita $idCitaProgramada = null)
    {
        $this->idCitaProgramada = $idCitaProgramada;

        return $this;
    }

    /**
     * Get idCitaProgramada
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCita 
     */
    public function getIdCitaProgramada()
    {
        return $this->idCitaProgramada;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgPendienteRealizacion
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
     * @param \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $idProcedimientoIniciado
     * @return ImgPendienteRealizacion
     */
    public function setIdProcedimientoIniciado(\Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $idProcedimientoIniciado = null)
    {
        $this->idProcedimientoIniciado = $idProcedimientoIniciado;

        return $this;
    }

    /**
     * Get idProcedimientoIniciado
     *
     * @return \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado 
     */
    public function getIdProcedimientoIniciado()
    {
        return $this->idProcedimientoIniciado;
    }

    /**
     * Set idRegistraEmergencia
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRegistraEmergencia
     * @return ImgPendienteRealizacion
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
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $idSolicitudEstudioComplementario
     * @return ImgPendienteRealizacion
     */
    public function setIdSolicitudEstudioComplementario(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $idSolicitudEstudioComplementario = null)
    {
        $this->idSolicitudEstudioComplementario = $idSolicitudEstudioComplementario;

        return $this;
    }

    /**
     * Get idSolicitudEstudioComplementario
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario 
     */
    public function getIdSolicitudEstudioComplementario()
    {
        return $this->idSolicitudEstudioComplementario;
    }

    /**
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio
     * @return ImgPendienteRealizacion
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
     * Set idTecnologoAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoAsignado
     * @return ImgPendienteRealizacion
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

    /**
     * Set idAsignaExaminante
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaExaminante
     * @return ImgPendienteRealizacion
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
}
