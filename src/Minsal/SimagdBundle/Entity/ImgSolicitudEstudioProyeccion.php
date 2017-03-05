<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgSolicitudEstudioProyeccion
 *
 * @ORM\Table(name="img_solicitud_estudio_proyeccion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_solicitud_estudio_proyeccion", columns={"id_solicitud_estudio", "id_proyeccion_solicitada"})}, indexes={@ORM\Index(name="IDX_3983AC98CA460C63", columns={"id_proyeccion_solicitada"}), @ORM\Index(name="IDX_3983AC986AAA01BF", columns={"id_solicitud_estudio"})})
 * @ORM\Entity
 */
class ImgSolicitudEstudioProyeccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_solicitud_estudio_proyeccion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="vistas_requeridas", type="smallint", nullable=true)
     */
    private $vistasRequeridas = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="dimensiones", type="string", length=25, nullable=true)
     */
    private $dimensiones;

    /**
     * @var string
     *
     * @ORM\Column(name="otras_especificaciones", type="string", length=100, nullable=true)
     */
    private $otrasEspecificaciones;

    /**
     * @var \ImgCtlProyeccion
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlProyeccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proyeccion_solicitada", referencedColumnName="id")
     * })
     */
    private $idProyeccionSolicitada;

    /**
     * @var \ImgSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudio", inversedBy="solicitudEstudioProyeccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudio;


    public function __toString()
    {
        return (string) $this->idProyeccionSolicitada;
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
     * @return ImgSolicitudEstudioProyeccion
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
     * @return ImgSolicitudEstudioProyeccion
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
     * @return ImgSolicitudEstudioProyeccion
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlProyeccion $idProyeccionSolicitada
     * @return ImgSolicitudEstudioProyeccion
     */
    public function setIdProyeccionSolicitada(\Minsal\SimagdBundle\Entity\ImgCtlProyeccion $idProyeccionSolicitada = null)
    {
        $this->idProyeccionSolicitada = $idProyeccionSolicitada;

        return $this;
    }

    /**
     * Get idProyeccionSolicitada
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlProyeccion 
     */
    public function getIdProyeccionSolicitada()
    {
        return $this->idProyeccionSolicitada;
    }

    /**
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio
     * @return ImgSolicitudEstudioProyeccion
     */
    public function setIdSolicitudEstudio(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio = null)
    {
        $this->idSolicitudEstudio = $idSolicitudEstudio;

        return $this;
    }

    /**
     * Get idSolicitudEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio 
     */
    public function getIdSolicitudEstudio()
    {
        return $this->idSolicitudEstudio;
    }
}
