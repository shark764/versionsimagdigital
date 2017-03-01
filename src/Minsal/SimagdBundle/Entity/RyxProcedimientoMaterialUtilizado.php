<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    private $cantidadUtilizada = '0';

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
     */
    private $idMaterial;

    /**
     * @var \RyxProcedimientoRadiologicoRealizado
     *
     * @ORM\ManyToOne(targetEntity="RyxProcedimientoRadiologicoRealizado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_realizado", referencedColumnName="id")
     * })
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
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
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

}