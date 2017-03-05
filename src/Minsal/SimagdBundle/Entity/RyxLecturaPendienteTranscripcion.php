<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxLecturaPendienteTranscripcion
 *
 * @ORM\Table(name="ryx_lectura_pendiente_transcripcion", indexes={@ORM\Index(name="IDX_5809D741408A6B12", columns={"id_asigna_transcriptor"}), @ORM\Index(name="IDX_5809D7417DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_5809D74118971421", columns={"id_lectura"}), @ORM\Index(name="IDX_5809D741CC6E65C8", columns={"id_transcriptor_asignado"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxLecturaPendienteTranscripcionRepository")
 */
class RyxLecturaPendienteTranscripcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_lectura_pendiente_transcripcion_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="fue_impugnado", type="boolean", nullable=true)
     */
    private $fueImpugnado = false;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_transcriptor", referencedColumnName="id")
     * })
     */
    private $idAsignaTranscriptor;

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
     * @var \RyxLecturaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxLecturaRadiologica", inversedBy="lecturaPendienteTranscribir")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idLectura;

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
        return $this->idLectura . ' :: ' . $this->idEstablecimiento;
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
     * @return RyxLecturaPendienteTranscripcion
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
     * Set fueImpugnado
     *
     * @param boolean $fueImpugnado
     * @return RyxLecturaPendienteTranscripcion
     */
    public function setFueImpugnado($fueImpugnado)
    {
        $this->fueImpugnado = $fueImpugnado;

        return $this;
    }

    /**
     * Get fueImpugnado
     *
     * @return boolean 
     */
    public function getFueImpugnado()
    {
        return $this->fueImpugnado;
    }

    /**
     * Set idAsignaTranscriptor
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaTranscriptor
     * @return RyxLecturaPendienteTranscripcion
     */
    public function setIdAsignaTranscriptor(\Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaTranscriptor = null)
    {
        $this->idAsignaTranscriptor = $idAsignaTranscriptor;

        return $this;
    }

    /**
     * Get idAsignaTranscriptor
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdAsignaTranscriptor()
    {
        return $this->idAsignaTranscriptor;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxLecturaPendienteTranscripcion
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
     * Set idLectura
     *
     * @param \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $idLectura
     * @return RyxLecturaPendienteTranscripcion
     */
    public function setIdLectura(\Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $idLectura = null)
    {
        $this->idLectura = $idLectura;

        return $this;
    }

    /**
     * Get idLectura
     *
     * @return \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica 
     */
    public function getIdLectura()
    {
        return $this->idLectura;
    }

    /**
     * Set idTranscriptorAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTranscriptorAsignado
     * @return RyxLecturaPendienteTranscripcion
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
}
