<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgPendienteLectura
 *
 * @ORM\Table(name="img_pendiente_lectura", indexes={@ORM\Index(name="IDX_5A209F077DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_5A209F076196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_5A209F07C7F5B193", columns={"id_radiologo_anexa"}), @ORM\Index(name="IDX_5A209F076E8C181B", columns={"id_radiologo_asignado"}), @ORM\Index(name="IDX_5A209F07526C8D52", columns={"id_solicitud_diagnostico"}), @ORM\Index(name="IDX_5A209F078AAAED82", columns={"id_asigna_radiologo"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\PendienteLecturaRepository")
 */
class ImgPendienteLectura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_pendiente_lectura_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="solicitud_post_estudio", type="boolean", nullable=true)
     */
    private $solicitudPostEstudio = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="anexado_por_radiologo", type="boolean", nullable=true)
     */
    private $anexadoPorRadiologo = false;

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
     * @var \ImgEstudioPaciente
     *
     * @ORM\ManyToOne(targetEntity="ImgEstudioPaciente", inversedBy="estudioPendienteLectura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_anexa", referencedColumnName="id")
     * })
     */
    private $idRadiologoAnexa;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_asignado", referencedColumnName="id")
     * })
     */
    private $idRadiologoAsignado;

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_radiologo", referencedColumnName="id")
     * })
     */
    private $idAsignaRadiologo;

    public function __toString() {
        return $this->idEstudio . ' :: ' . $this->idEstablecimiento;
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
     * @return ImgPendienteLectura
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
     * Set solicitudPostEstudio
     *
     * @param boolean $solicitudPostEstudio
     * @return ImgPendienteLectura
     */
    public function setSolicitudPostEstudio($solicitudPostEstudio)
    {
        $this->solicitudPostEstudio = $solicitudPostEstudio;

        return $this;
    }

    /**
     * Get solicitudPostEstudio
     *
     * @return boolean 
     */
    public function getSolicitudPostEstudio()
    {
        return $this->solicitudPostEstudio;
    }

    /**
     * Set anexadoPorRadiologo
     *
     * @param boolean $anexadoPorRadiologo
     * @return ImgPendienteLectura
     */
    public function setAnexadoPorRadiologo($anexadoPorRadiologo)
    {
        $this->anexadoPorRadiologo = $anexadoPorRadiologo;

        return $this;
    }

    /**
     * Get anexadoPorRadiologo
     *
     * @return boolean 
     */
    public function getAnexadoPorRadiologo()
    {
        return $this->anexadoPorRadiologo;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgPendienteLectura
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
     * Set idEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudio
     * @return ImgPendienteLectura
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
     * Set idRadiologoAnexa
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAnexa
     * @return ImgPendienteLectura
     */
    public function setIdRadiologoAnexa(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAnexa = null)
    {
        $this->idRadiologoAnexa = $idRadiologoAnexa;

        return $this;
    }

    /**
     * Get idRadiologoAnexa
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoAnexa()
    {
        return $this->idRadiologoAnexa;
    }

    /**
     * Set idRadiologoAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAsignado
     * @return ImgPendienteLectura
     */
    public function setIdRadiologoAsignado(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAsignado = null)
    {
        $this->idRadiologoAsignado = $idRadiologoAsignado;

        return $this;
    }

    /**
     * Get idRadiologoAsignado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoAsignado()
    {
        return $this->idRadiologoAsignado;
    }

    /**
     * Set idSolicitudDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico $idSolicitudDiagnostico
     * @return ImgPendienteLectura
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
     * Set idAsignaRadiologo
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaRadiologo
     * @return ImgPendienteLectura
     */
    public function setIdAsignaRadiologo(\Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaRadiologo = null)
    {
        $this->idAsignaRadiologo = $idAsignaRadiologo;

        return $this;
    }

    /**
     * Get idAsignaRadiologo
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdAsignaRadiologo()
    {
        return $this->idAsignaRadiologo;
    }
}
