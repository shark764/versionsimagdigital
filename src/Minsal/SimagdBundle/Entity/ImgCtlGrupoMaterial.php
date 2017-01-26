<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlGrupoMaterial
 *
 * @ORM\Table(name="img_ctl_grupo_material", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_grupo_material", columns={"codigo"})})
 * @ORM\Entity
 */
class ImgCtlGrupoMaterial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_grupo_material_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;


    /**
     * @ORM\OneToMany(targetEntity="ImgCtlSubgrupoMaterial", mappedBy="idGrupoMaterial", cascade={"all"}, orphanRemoval=true)
     */
    private $grupoSubgrupos;


    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grupoSubgrupos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ImgCtlGrupoMaterial
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
     * @return ImgCtlGrupoMaterial
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
     * @return ImgCtlGrupoMaterial
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlSubgrupoMaterial $grupoSubgrupos
     * @return ImgCtlGrupoMaterial
     */
    public function addGrupoSubgrupo(\Minsal\SimagdBundle\Entity\ImgCtlSubgrupoMaterial $grupoSubgrupos)
    {
        $this->grupoSubgrupos[] = $grupoSubgrupos;

        return $this;
    }

    /**
     * Remove grupoSubgrupos
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlSubgrupoMaterial $grupoSubgrupos
     */
    public function removeGrupoSubgrupo(\Minsal\SimagdBundle\Entity\ImgCtlSubgrupoMaterial $grupoSubgrupos)
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
