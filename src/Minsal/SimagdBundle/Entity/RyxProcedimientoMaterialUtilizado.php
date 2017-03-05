<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxProcedimientoMaterialUtilizado
 *
 * @ORM\Table(name="ryx_procedimiento_material_utilizado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_material_procedimiento_realizado", columns={"id_material", "id_procedimiento_realizado"})}, indexes={@ORM\Index(name="IDX_5CD9169D2C659900", columns={"id_material"}), @ORM\Index(name="IDX_5CD9169D9E9497EB", columns={"id_procedimiento_realizado"})})
 * @ORM\Entity
 */
class RyxProcedimientoMaterialUtilizado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_procedimiento_material_utilizado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_utilizada", type="integer", nullable=true)
     */
    private $cantidadUtilizada = 0;

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
     * @var \RyxCtlMaterial
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlMaterial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_material", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idMaterial;

    /**
     * @var \RyxProcedimientoRadiologicoRealizado
     *
     * @ORM\ManyToOne(targetEntity="RyxProcedimientoRadiologicoRealizado", inversedBy="materialUtilizadoV2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_realizado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idProcedimientoRealizado;

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
        return (string) $this->idMaterial;
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
     * Set cantidadUtilizada
     *
     * @param integer $cantidadUtilizada
     * @return RyxProcedimientoMaterialUtilizado
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
     * @return RyxProcedimientoMaterialUtilizado
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
     * Set idMaterial
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlMaterial $idMaterial
     * @return RyxProcedimientoMaterialUtilizado
     */
    public function setIdMaterial(\Minsal\SimagdBundle\Entity\RyxCtlMaterial $idMaterial = null)
    {
        $this->idMaterial = $idMaterial;

        return $this;
    }

    /**
     * Get idMaterial
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlMaterial 
     */
    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    /**
     * Set idProcedimientoRealizado
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $idProcedimientoRealizado
     * @return RyxProcedimientoMaterialUtilizado
     */
    public function setIdProcedimientoRealizado(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $idProcedimientoRealizado = null)
    {
        $this->idProcedimientoRealizado = $idProcedimientoRealizado;

        return $this;
    }

    /**
     * Get idProcedimientoRealizado
     *
     * @return \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado 
     */
    public function getIdProcedimientoRealizado()
    {
        return $this->idProcedimientoRealizado;
    }
}
