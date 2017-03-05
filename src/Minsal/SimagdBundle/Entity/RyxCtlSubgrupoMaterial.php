<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlSubgrupoMaterial
 *
 * @ORM\Table(name="ryx_ctl_subgrupo_material", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_subgrupo_material", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_8A7E3D0B935F756", columns={"id_grupo_material"})})
 * @ORM\Entity
 */
class RyxCtlSubgrupoMaterial implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_subgrupo_material_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $descripcion;

    /**
     * @var \RyxCtlGrupoMaterial
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlGrupoMaterial", inversedBy="grupoSubgrupos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_material", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idGrupoMaterial;

    /**
     * @ORM\OneToMany(targetEntity="RyxCtlMaterial", mappedBy="idSubgrupoMaterial", cascade={"all"}, orphanRemoval=true)
     */
    private $subgrupoMateriales;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subgrupoMateriales = new \Doctrine\Common\Collections\ArrayCollection();
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


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return RyxCtlSubgrupoMaterial
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return RyxCtlSubgrupoMaterial
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RyxCtlSubgrupoMaterial
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idGrupoMaterial
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlGrupoMaterial $idGrupoMaterial
     * @return RyxCtlSubgrupoMaterial
     */
    public function setIdGrupoMaterial(\Minsal\SimagdBundle\Entity\RyxCtlGrupoMaterial $idGrupoMaterial = null)
    {
        $this->idGrupoMaterial = $idGrupoMaterial;

        return $this;
    }

    /**
     * Get idGrupoMaterial
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlGrupoMaterial 
     */
    public function getIdGrupoMaterial()
    {
        return $this->idGrupoMaterial;
    }

    /**
     * Add subgrupoMateriales
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlMaterial $subgrupoMateriales
     * @return RyxCtlSubgrupoMaterial
     */
    public function addSubgrupoMateriale(\Minsal\SimagdBundle\Entity\RyxCtlMaterial $subgrupoMateriales)
    {
        $this->subgrupoMateriales[] = $subgrupoMateriales;

        return $this;
    }

    /**
     * Remove subgrupoMateriales
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlMaterial $subgrupoMateriales
     */
    public function removeSubgrupoMateriale(\Minsal\SimagdBundle\Entity\RyxCtlMaterial $subgrupoMateriales)
    {
        $this->subgrupoMateriales->removeElement($subgrupoMateriales);
    }

    /**
     * Get subgrupoMateriales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubgrupoMateriales()
    {
        return $this->subgrupoMateriales;
    }
}
