<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgMaterialUtilizado
 *
 * @ORM\Table(name="img_material_utilizado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_material_procedimiento_realizado", columns={"id_material", "id_procedimiento_realizado"})}, indexes={@ORM\Index(name="IDX_136D8B619E9497EB", columns={"id_procedimiento_realizado"}), @ORM\Index(name="IDX_136D8B612C659900", columns={"id_material"})})
 * @ORM\Entity
 */
class ImgMaterialUtilizado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_material_utilizado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_utilizada", type="integer", nullable=true)
     */
    private $cantidadUtilizada = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="otras_especificaciones", type="string", length=100, nullable=true)
     */
    private $otrasEspecificaciones;

    /**
     * @var \ImgProcedimientoRealizado
     *
     * @ORM\ManyToOne(targetEntity="ImgProcedimientoRealizado", inversedBy="materialUtilizadoV2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_realizado", referencedColumnName="id")
     * })
     */
    private $idProcedimientoRealizado;

    /**
     * @var \ImgCtlMaterial
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlMaterial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_material", referencedColumnName="id")
     * })
     */
    private $idMaterial;

    public function __toString()
    {
        return (string) $this->idMaterial;
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
     * Set cantidadUtilizada
     *
     * @param integer $cantidadUtilizada
     * @return ImgMaterialUtilizado
     */
    public function setCantidadUtilizada($cantidadUtilizada)
    {
        $this->cantidadUtilizada = $cantidadUtilizada;

        return $this;
    }

    /**
     * Get cantidadUtilizada
     *
     * @return integer 
     */
    public function getCantidadUtilizada()
    {
        return $this->cantidadUtilizada;
    }

    /**
     * Set otrasEspecificaciones
     *
     * @param string $otrasEspecificaciones
     * @return ImgMaterialUtilizado
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
     * Set idProcedimientoRealizado
     *
     * @param \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $idProcedimientoRealizado
     * @return ImgMaterialUtilizado
     */
    public function setIdProcedimientoRealizado(\Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $idProcedimientoRealizado = null)
    {
        $this->idProcedimientoRealizado = $idProcedimientoRealizado;

        return $this;
    }

    /**
     * Get idProcedimientoRealizado
     *
     * @return \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado 
     */
    public function getIdProcedimientoRealizado()
    {
        return $this->idProcedimientoRealizado;
    }

    /**
     * Set idMaterial
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlMaterial $idMaterial
     * @return ImgMaterialUtilizado
     */
    public function setIdMaterial(\Minsal\SimagdBundle\Entity\ImgCtlMaterial $idMaterial = null)
    {
        $this->idMaterial = $idMaterial;

        return $this;
    }

    /**
     * Get idMaterial
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlMaterial 
     */
    public function getIdMaterial()
    {
        return $this->idMaterial;
    }
}
