<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlGrupoMaterial
 *
 * @ORM\Table(name="ryx_ctl_grupo_material", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_grupo_material", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlGrupoMaterial implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_grupo_material_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\OneToMany(targetEntity="RyxCtlSubgrupoMaterial", mappedBy="idGrupoMaterial", cascade={"all"}, orphanRemoval=true)
     */
    private $grupoSubgrupos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grupoSubgrupos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return RyxCtlGrupoMaterial
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
     * @return RyxCtlGrupoMaterial
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
     * @return RyxCtlGrupoMaterial
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
     * Add grupoSubgrupos
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlSubgrupoMaterial $grupoSubgrupos
     * @return RyxCtlGrupoMaterial
     */
    public function addGrupoSubgrupo(\Minsal\SimagdBundle\Entity\RyxCtlSubgrupoMaterial $grupoSubgrupos)
    {
        $this->grupoSubgrupos[] = $grupoSubgrupos;

        return $this;
    }

    /**
     * Remove grupoSubgrupos
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlSubgrupoMaterial $grupoSubgrupos
     */
    public function removeGrupoSubgrupo(\Minsal\SimagdBundle\Entity\RyxCtlSubgrupoMaterial $grupoSubgrupos)
    {
        $this->grupoSubgrupos->removeElement($grupoSubgrupos);
    }

    /**
     * Get grupoSubgrupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupoSubgrupos()
    {
        return $this->grupoSubgrupos;
    }
}
