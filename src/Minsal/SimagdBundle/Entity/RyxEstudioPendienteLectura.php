<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxEstudioPendienteLectura
 *
 * @ORM\Table(name="ryx_estudio_pendiente_lectura", indexes={@ORM\Index(name="IDX_3EC4D3688AAAED82", columns={"id_asigna_radiologo"}), @ORM\Index(name="IDX_3EC4D3687DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_3EC4D3686196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_3EC4D368C7F5B193", columns={"id_radiologo_anexa"}), @ORM\Index(name="IDX_3EC4D3686E8C181B", columns={"id_radiologo_asignado"}), @ORM\Index(name="IDX_3EC4D368526C8D52", columns={"id_solicitud_diagnostico"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxEstudioPendienteLecturaRepository")
 */
class RyxEstudioPendienteLectura implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_estudio_pendiente_lectura_id_seq", allocationSize=1, initialValue=1)
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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_radiologo", referencedColumnName="id")
     * })
     */
    private $idAsignaRadiologo;

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
     * @var \RyxEstudioPorImagenes
     *
     * @ORM\ManyToOne(targetEntity="RyxEstudioPorImagenes", inversedBy="estudioPendienteLectura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @var \RyxSolicitudDiagnosticoPostEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudDiagnosticoPostEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_diagnostico", referencedColumnName="id")
     * })
     */
    private $idSolicitudDiagnostico;

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
        return $this->idEstudio . ' :: ' . $this->idEstablecimiento;
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
     * @return RyxEstudioPendienteLectura
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
     * @return RyxEstudioPendienteLectura
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
     * @return RyxEstudioPendienteLectura
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
     * Set idAsignaRadiologo
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaRadiologo
     * @return RyxEstudioPendienteLectura
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

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxEstudioPendienteLectura
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
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $idEstudio
     * @return RyxEstudioPendienteLectura
     */
    public function setIdEstudio(\Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $idEstudio = null)
    {
        $this->idEstudio = $idEstudio;

        return $this;
    }

    /**
     * Get idEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes 
     */
    public function getIdEstudio()
    {
        return $this->idEstudio;
    }

    /**
     * Set idRadiologoAnexa
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAnexa
     * @return RyxEstudioPendienteLectura
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
     * @return RyxEstudioPendienteLectura
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
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $idSolicitudDiagnostico
     * @return RyxEstudioPendienteLectura
     */
    public function setIdSolicitudDiagnostico(\Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $idSolicitudDiagnostico = null)
    {
        $this->idSolicitudDiagnostico = $idSolicitudDiagnostico;

        return $this;
    }

    /**
     * Get idSolicitudDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio 
     */
    public function getIdSolicitudDiagnostico()
    {
        return $this->idSolicitudDiagnostico;
    }
}
