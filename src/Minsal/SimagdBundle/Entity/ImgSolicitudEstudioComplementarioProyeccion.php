<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgSolicitudEstudioComplementarioProyeccion
 *
 * @ORM\Table(name="img_solicitud_estudio_complementario_proyeccion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_solicitud_estudio_complementario_proyeccion", columns={"id_solicitud_estudio_complementario", "id_proyeccion_solicitada"})}, indexes={@ORM\Index(name="IDX_9AD6C69BCA460C63", columns={"id_proyeccion_solicitada"}), @ORM\Index(name="IDX_9AD6C69BF0951F8F", columns={"id_solicitud_estudio_complementario"})})
 * @ORM\Entity
 */
class ImgSolicitudEstudioComplementarioProyeccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_solicitud_estudio_complementario_proyeccion_id_seq", allocationSize=1, initialValue=1)
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
     * @var \ImgSolicitudEstudioComplementario
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudioComplementario", inversedBy="solicitudEstudioComplementarioProyeccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;



    public function __toString()
    {
        return '' . $this->idProyeccionSolicitada;
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
     * @return ImgSolicitudEstudioComplementarioProyeccion
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
     * @return ImgSolicitudEstudioComplementarioProyeccion
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
     * @return ImgSolicitudEstudioComplementarioProyeccion
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
     * @return ImgSolicitudEstudioComplementarioProyeccion
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
     * Set idSolicitudEstudioComplementario
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $idSolicitudEstudioComplementario
     * @return ImgSolicitudEstudioComplementarioProyeccion
     */
    public function setIdSolicitudEstudioComplementario(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $idSolicitudEstudioComplementario = null)
    {
        $this->idSolicitudEstudioComplementario = $idSolicitudEstudioComplementario;

        return $this;
    }

    /**
     * Get idSolicitudEstudioComplementario
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario 
     */
    public function getIdSolicitudEstudioComplementario()
    {
        return $this->idSolicitudEstudioComplementario;
    }
}
