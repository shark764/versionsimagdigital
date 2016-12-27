<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecMotivoConsulta
 *
 * @ORM\Table(name="sec_motivo_consulta", indexes={@ORM\Index(name="IDX_97EE0175A92D004C", columns={"idhistorialclinico"})})
 * @ORM\Entity
 */
class SecMotivoConsulta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_motivo_consulta_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="motivoconsulta", type="text", nullable=false)
     */
    private $motivoconsulta;

    /**
     * @var string
     *
     * @ORM\Column(name="evolucionpaciente", type="text", nullable=false)
     */
    private $evolucionpaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="hxexamenes", type="text", nullable=true)
     */
    private $hxexamenes;

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
        return $this->idhistorialclinico . ' :: ' . $this->motivoconsulta;
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
     * Set motivoconsulta
     *
     * @param string $motivoconsulta
     * @return SecMotivoConsulta
     */
    public function setMotivoconsulta($motivoconsulta)
    {
        $this->motivoconsulta = $motivoconsulta;

        return $this;
    }

    /**
     * Get motivoconsulta
     *
     * @return string 
     */
    public function getMotivoconsulta()
    {
        return $this->motivoconsulta;
    }

    /**
     * Set evolucionpaciente
     *
     * @param string $evolucionpaciente
     * @return SecMotivoConsulta
     */
    public function setEvolucionpaciente($evolucionpaciente)
    {
        $this->evolucionpaciente = $evolucionpaciente;

        return $this;
    }

    /**
     * Get evolucionpaciente
     *
     * @return string 
     */
    public function getEvolucionpaciente()
    {
        return $this->evolucionpaciente;
    }

    /**
     * Set hxexamenes
     *
     * @param string $hxexamenes
     * @return SecMotivoConsulta
     */
    public function setHxexamenes($hxexamenes)
    {
        $this->hxexamenes = $hxexamenes;

        return $this;
    }

    /**
     * Get hxexamenes
     *
     * @return string 
     */
    public function getHxexamenes()
    {
        return $this->hxexamenes;
    }

    /**
     * Set idhistorialclinico
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecHistorialClinico $idhistorialclinico
     * @return SecMotivoConsulta
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
