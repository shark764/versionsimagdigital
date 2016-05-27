<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgPendienteTranscripcion
 *
 * @ORM\Table(name="img_pendiente_transcripcion", indexes={@ORM\Index(name="IDX_A5021FE27DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_A5021FE218971421", columns={"id_lectura"}), @ORM\Index(name="IDX_A5021FE2CC6E65C8", columns={"id_transcriptor_asignado"}), @ORM\Index(name="IDX_A5021FE2408A6B12", columns={"id_asigna_transcriptor"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\PendienteTranscripcionRepository")
 */
class ImgPendienteTranscripcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_pendiente_transcripcion_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="fue_impugnado", type="boolean", nullable=true)
     */
    private $fueImpugnado = false;

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
     * @var \ImgLectura
     *
     * @ORM\ManyToOne(targetEntity="ImgLectura", inversedBy="lecturaPendienteTranscribir")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_transcriptor", referencedColumnName="id")
     * })
     */
    private $idAsignaTranscriptor;

    public function __toString() {
        return $this->idLectura . ' :: ' . $this->idEstablecimiento;
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
     * @return ImgPendienteTranscripcion
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
     * @return ImgPendienteTranscripcion
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
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgPendienteTranscripcion
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
     * @param \Minsal\SimagdBundle\Entity\ImgLectura $idLectura
     * @return ImgPendienteTranscripcion
     */
    public function setIdLectura(\Minsal\SimagdBundle\Entity\ImgLectura $idLectura = null)
    {
        $this->idLectura = $idLectura;

        return $this;
    }

    /**
     * Get idLectura
     *
     * @return \Minsal\SimagdBundle\Entity\ImgLectura 
     */
    public function getIdLectura()
    {
        return $this->idLectura;
    }

    /**
     * Set idTranscriptorAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTranscriptorAsignado
     * @return ImgPendienteTranscripcion
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
     * Set idAsignaTranscriptor
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaTranscriptor
     * @return ImgPendienteTranscripcion
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
}
