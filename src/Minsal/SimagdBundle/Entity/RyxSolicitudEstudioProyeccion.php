<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxSolicitudEstudioProyeccion
 *
 * @ORM\Table(name="ryx_solicitud_estudio_proyeccion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_solicitud_estudio_proyeccion", columns={"id_solicitud_estudio", "id_proyeccion_solicitada"})}, indexes={@ORM\Index(name="IDX_26885BF5CA460C63", columns={"id_proyeccion_solicitada"}), @ORM\Index(name="IDX_26885BF56AAA01BF", columns={"id_solicitud_estudio"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudioProyeccion implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_proyeccion_id_seq", allocationSize=1, initialValue=1)
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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idProyeccionSolicitada;

    /**
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio", inversedBy="solicitudEstudioProyeccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idSolicitudEstudio;

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
     * @return RyxSolicitudEstudioProyeccion
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
     * @return RyxSolicitudEstudioProyeccion
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
     * @return RyxSolicitudEstudioProyeccion
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
     * @return RyxSolicitudEstudioProyeccion
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
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio
     * @return RyxSolicitudEstudioProyeccion
     */
    public function setIdSolicitudEstudio(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio = null)
    {
        $this->idSolicitudEstudio = $idSolicitudEstudio;

        return $this;
    }

    /**
     * Get idSolicitudEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio 
     */
    public function getIdSolicitudEstudio()
    {
        return $this->idSolicitudEstudio;
    }
}
