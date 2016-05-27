<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgPendienteValidacion
 *
 * @ORM\Table(name="img_pendiente_validacion", indexes={@ORM\Index(name="IDX_CF5AE920838319BF", columns={"id_diagnostico"}), @ORM\Index(name="IDX_CF5AE9207DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_CF5AE920C6991215", columns={"id_asigna_validador"}), @ORM\Index(name="IDX_CF5AE9206E8C181B", columns={"id_radiologo_asignado"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\PendienteValidacionRepository")
 */
class ImgPendienteValidacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_pendiente_validacion_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="fue_corregido", type="boolean", nullable=true)
     */
    private $fueCorregido = false;

    /**
     * @var \ImgDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="ImgDiagnostico", inversedBy="diagnosticoPendienteValidar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diagnostico", referencedColumnName="id")
     * })
     */
    private $idDiagnostico;

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_validador", referencedColumnName="id")
     * })
     */
    private $idAsignaValidador;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_asignado", referencedColumnName="id")
     * })
     */
    private $idRadiologoAsignado;

    public function __toString() {
        return $this->idDiagnostico . ' :: ' . $this->idEstablecimiento;
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
     * @return ImgPendienteValidacion
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
     * Set fueCorregido
     *
     * @param boolean $fueCorregido
     * @return ImgPendienteValidacion
     */
    public function setFueCorregido($fueCorregido)
    {
        $this->fueCorregido = $fueCorregido;

        return $this;
    }

    /**
     * Get fueCorregido
     *
     * @return boolean 
     */
    public function getFueCorregido()
    {
        return $this->fueCorregido;
    }

    /**
     * Set idDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgDiagnostico $idDiagnostico
     * @return ImgPendienteValidacion
     */
    public function setIdDiagnostico(\Minsal\SimagdBundle\Entity\ImgDiagnostico $idDiagnostico = null)
    {
        $this->idDiagnostico = $idDiagnostico;

        return $this;
    }

    /**
     * Get idDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\ImgDiagnostico 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgPendienteValidacion
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
     * Set idAsignaValidador
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaValidador
     * @return ImgPendienteValidacion
     */
    public function setIdAsignaValidador(\Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaValidador = null)
    {
        $this->idAsignaValidador = $idAsignaValidador;

        return $this;
    }

    /**
     * Get idAsignaValidador
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdAsignaValidador()
    {
        return $this->idAsignaValidador;
    }

    /**
     * Set idRadiologoAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAsignado
     * @return ImgPendienteValidacion
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
}
