<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxLecturaEstudio
 *
 * @ORM\Table(name="ryx_lectura_estudio", uniqueConstraints={@ORM\UniqueConstraint(name="idx_lectura_estudio_paciente", columns={"id_estudio", "id_lectura"})}, indexes={@ORM\Index(name="IDX_207ED7286196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_207ED72818971421", columns={"id_lectura"})})
 * @ORM\Entity
 */
class RyxLecturaEstudio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_lectura_estudio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \RyxEstudioPorImagenes
     *
     * @ORM\ManyToOne(targetEntity="RyxEstudioPorImagenes", inversedBy="estudioLecturaEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

    /**
     * @var \RyxLecturaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxLecturaRadiologica", inversedBy="lecturaLecturaEstudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     */
    private $idLectura;

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
        return (string) $this->idLectura . ' :: ' . $this->idEstudio;
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
     * Set idEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $idEstudio
     * @return RyxLecturaEstudio
     */
    public function setIdEstudio(\Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $idEstudio = null)
    {
        $this->idEstudio = $idEstudio;

        return $this;
    }

    /**
     * Get idEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes 
     */
    public function getIdEstudio()
    {
        return $this->idEstudio;
    }

    /**
     * Set idLectura
     *
     * @param \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $idLectura
     * @return RyxLecturaEstudio
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
}
