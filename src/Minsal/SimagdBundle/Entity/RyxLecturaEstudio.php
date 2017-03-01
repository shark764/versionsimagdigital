<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="RyxEstudioPorImagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

    /**
     * @var \RyxLecturaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxLecturaRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     */
    private $idLectura;


}
