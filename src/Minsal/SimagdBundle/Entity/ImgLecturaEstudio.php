<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgLecturaEstudio
 *
 * @ORM\Table(name="img_lectura_estudio", uniqueConstraints={@ORM\UniqueConstraint(name="idx_lectura_estudio_paciente", columns={"id_estudio", "id_lectura"})}, indexes={@ORM\Index(name="IDX_6D1356B86196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_6D1356B818971421", columns={"id_lectura"})})
 * @ORM\Entity
 */
class ImgLecturaEstudio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_lectura_estudio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \ImgEstudioPaciente
     *
     * @ORM\ManyToOne(targetEntity="ImgEstudioPaciente", inversedBy="estudioLecturaEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

    /**
     * @var \ImgLectura
     *
     * @ORM\ManyToOne(targetEntity="ImgLectura", inversedBy="lecturaLecturaEstudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     */
    private $idLectura;


    public function __toString()
    {
        return (string) $this->idLectura . ' :: ' . $this->idEstudio;
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
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudio
     * @return ImgLecturaEstudio
     */
    public function setIdEstudio(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudio = null)
    {
        $this->idEstudio = $idEstudio;

        return $this;
    }

    /**
     * Get idEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\ImgEstudioPaciente 
     */
    public function getIdEstudio()
    {
        return $this->idEstudio;
    }

    /**
     * Set idLectura
     *
     * @param \Minsal\SimagdBundle\Entity\ImgLectura $idLectura
     * @return ImgLecturaEstudio
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
}
