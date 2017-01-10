<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecSignosVitales
 *
 * @ORM\Table(name="sec_signos_vitales", indexes={@ORM\Index(name="IDX_9222FCE3A92D004C", columns={"idhistorialclinico"})})
 * @ORM\Entity
 */
class SecSignosVitales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_signos_vitales_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pulso", type="string", length=10, nullable=true)
     */
    private $pulso;

    /**
     * @var string
     *
     * @ORM\Column(name="presionarterial", type="string", length=10, nullable=true)
     */
    private $presionarterial;

    /**
     * @var string
     *
     * @ORM\Column(name="respiracion", type="string", length=6, nullable=true)
     */
    private $respiracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="peso", type="smallint", nullable=true)
     */
    private $peso;

    /**
     * @var float
     *
     * @ORM\Column(name="talla", type="float", precision=10, scale=0, nullable=true)
     */
    private $talla;

    /**
     * @var integer
     *
     * @ORM\Column(name="temperatura", type="smallint", nullable=true)
     */
    private $temperatura;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var \SecHistorialClinico
     *
     * @ORM\ManyToOne(targetEntity="SecHistorialClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idhistorialclinico", referencedColumnName="id")
     * })
     */
    private $idhistorialclinico;

    public function __toString() {
        return $this->idhistorialclinico . ' :: ' . $this->observaciones;
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
     * Set pulso
     *
     * @param string $pulso
     * @return SecSignosVitales
     */
    public function setPulso($pulso)
    {
        $this->pulso = $pulso;

        return $this;
    }

    /**
     * Get pulso
     *
     * @return string 
     */
    public function getPulso()
    {
        return $this->pulso;
    }

    /**
     * Set presionarterial
     *
     * @param string $presionarterial
     * @return SecSignosVitales
     */
    public function setPresionarterial($presionarterial)
    {
        $this->presionarterial = $presionarterial;

        return $this;
    }

    /**
     * Get presionarterial
     *
     * @return string 
     */
    public function getPresionarterial()
    {
        return $this->presionarterial;
    }

    /**
     * Set respiracion
     *
     * @param string $respiracion
     * @return SecSignosVitales
     */
    public function setRespiracion($respiracion)
    {
        $this->respiracion = $respiracion;

        return $this;
    }

    /**
     * Get respiracion
     *
     * @return string 
     */
    public function getRespiracion()
    {
        return $this->respiracion;
    }

    /**
     * Set peso
     *
     * @param integer $peso
     * @return SecSignosVitales
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return integer 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set talla
     *
     * @param float $talla
     * @return SecSignosVitales
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;

        return $this;
    }

    /**
     * Get talla
     *
     * @return float 
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set temperatura
     *
     * @param integer $temperatura
     * @return SecSignosVitales
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;

        return $this;
    }

    /**
     * Get temperatura
     *
     * @return integer 
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return SecSignosVitales
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
     * Set idhistorialclinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idhistorialclinico
     * @return SecSignosVitales
     */
    public function setIdhistorialclinico(\Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idhistorialclinico = null)
    {
        $this->idhistorialclinico = $idhistorialclinico;

        return $this;
    }

    /**
     * Get idhistorialclinico
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecHistorialClinico 
     */
    public function getIdhistorialclinico()
    {
        return $this->idhistorialclinico;
    }
}
