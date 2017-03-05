<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxSolicitudEstudioComplementarioProyeccion
 *
 * @ORM\Table(name="ryx_solicitud_estudio_complementario_proyeccion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_solicitud_estudio_complementario_proyeccion", columns={"id_solicitud_estudio_complementario", "id_proyeccion_solicitada"})}, indexes={@ORM\Index(name="IDX_B172CA3DCA460C63", columns={"id_proyeccion_solicitada"}), @ORM\Index(name="IDX_B172CA3DF0951F8F", columns={"id_solicitud_estudio_complementario"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudioComplementarioProyeccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_complementario_proyeccion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="vistas_requeridas", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $vistasRequeridas = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="dimensiones", type="string", length=25, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $dimensiones;

    /**
     * @var string
     *
     * @ORM\Column(name="otras_especificaciones", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $otrasEspecificaciones;

    /**
     * @var \RyxCtlProyeccionRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlProyeccionRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proyeccion_solicitada", referencedColumnName="id")
     * })
     */
    private $idProyeccionSolicitada;

    /**
     * @var \RyxSolicitudEstudioComplementario
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudioComplementario", inversedBy="solicitudEstudioComplementarioProyeccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;

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
        return (string) $this->idProyeccionSolicitada;
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
     * Set vistasRequeridas
     *
     * @param integer $vistasRequeridas
     * @return RyxSolicitudEstudioComplementarioProyeccion
     */
    public function setVistasRequeridas($vistasRequeridas)
    {
        $this->vistasRequeridas = $vistasRequeridas;

        return $this;
    }

    /**
     * Get vistasRequeridas
     *
     * @return integer 
     */
    public function getVistasRequeridas()
    {
        return $this->vistasRequeridas;
    }

    /**
     * Set dimensiones
     *
     * @param string $dimensiones
     * @return RyxSolicitudEstudioComplementarioProyeccion
     */
    public function setDimensiones($dimensiones)
    {
        $this->dimensiones = $dimensiones;

        return $this;
    }

    /**
     * Get dimensiones
     *
     * @return string 
     */
    public function getDimensiones()
    {
        return $this->dimensiones;
    }

    /**
     * Set otrasEspecificaciones
     *
     * @param string $otrasEspecificaciones
     * @return RyxSolicitudEstudioComplementarioProyeccion
     */
    public function setOtrasEspecificaciones($otrasEspecificaciones)
    {
        $this->otrasEspecificaciones = $otrasEspecificaciones;

        return $this;
    }

    /**
     * Get otrasEspecificaciones
     *
     * @return string 
     */
    public function getOtrasEspecificaciones()
    {
        return $this->otrasEspecificaciones;
    }

    /**
     * Set idProyeccionSolicitada
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $idProyeccionSolicitada
     * @return RyxSolicitudEstudioComplementarioProyeccion
     */
    public function setIdProyeccionSolicitada(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $idProyeccionSolicitada = null)
    {
        $this->idProyeccionSolicitada = $idProyeccionSolicitada;

        return $this;
    }

    /**
     * Get idProyeccionSolicitada
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica 
     */
    public function getIdProyeccionSolicitada()
    {
        return $this->idProyeccionSolicitada;
    }

    /**
     * Set idSolicitudEstudioComplementario
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $idSolicitudEstudioComplementario
     * @return RyxSolicitudEstudioComplementarioProyeccion
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
}
