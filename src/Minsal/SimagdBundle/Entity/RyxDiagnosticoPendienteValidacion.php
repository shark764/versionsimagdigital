<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxDiagnosticoPendienteValidacion
 *
 * @ORM\Table(name="ryx_diagnostico_pendiente_validacion", indexes={@ORM\Index(name="IDX_84FBD63DC6991215", columns={"id_asigna_validador"}), @ORM\Index(name="IDX_84FBD63D838319BF", columns={"id_diagnostico"}), @ORM\Index(name="IDX_84FBD63D7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_84FBD63D6E8C181B", columns={"id_radiologo_asignado"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxDiagnosticoPendienteValidacionRepository")
 */
class RyxDiagnosticoPendienteValidacion implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_diagnostico_pendiente_validacion_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="fue_corregido", type="boolean", nullable=true)
     */
    private $fueCorregido = false;

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
     * @var \RyxDiagnosticoRadiologico
     *
     * @ORM\ManyToOne(targetEntity="RyxDiagnosticoRadiologico", inversedBy="diagnosticoPendienteValidar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDiagnostico;

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_asignado", referencedColumnName="id")
     * })
     */
    private $idRadiologoAsignado;

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
        return $this->idDiagnostico . ' :: ' . $this->idEstablecimiento;
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
     * @return RyxDiagnosticoPendienteValidacion
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
     * @return RyxDiagnosticoPendienteValidacion
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
     * Set idAsignaValidador
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idAsignaValidador
     * @return RyxDiagnosticoPendienteValidacion
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
     * Set idDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxDiagnosticoRadiologico $idDiagnostico
     * @return RyxDiagnosticoPendienteValidacion
     */
    public function setIdDiagnostico(\Minsal\SimagdBundle\Entity\RyxDiagnosticoRadiologico $idDiagnostico = null)
    {
        $this->idDiagnostico = $idDiagnostico;

        return $this;
    }

    /**
     * Get idDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\RyxDiagnosticoRadiologico 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxDiagnosticoPendienteValidacion
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
     * Set idRadiologoAsignado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAsignado
     * @return RyxDiagnosticoPendienteValidacion
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
