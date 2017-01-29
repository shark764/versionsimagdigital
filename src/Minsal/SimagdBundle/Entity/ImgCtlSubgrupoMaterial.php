<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlSubgrupoMaterial
 *
 * @ORM\Table(name="img_ctl_subgrupo_material", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_subgrupo_material", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_AA908327935F756", columns={"id_grupo_material"})})
 * @ORM\Entity
 */
class ImgCtlSubgrupoMaterial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_subgrupo_material_id_seq", allocationSize=1, initialValue=1)
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
     * @var \ImgCtlGrupoMaterial
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlGrupoMaterial", inversedBy="grupoSubgrupos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_material", referencedColumnName="id")
     * })
     */
    private $idGrupoMaterial;


    /**
     * @ORM\OneToMany(targetEntity="ImgCtlMaterial", mappedBy="idSubgrupoMaterial", cascade={"all"}, orphanRemoval=true)
     */
    private $subgrupoMateriales;


    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subgrupoMateriales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ImgCtlSubgrupoMaterial
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
     * @return ImgCtlSubgrupoMaterial
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
     * @return ImgCtlSubgrupoMaterial
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlGrupoMaterial $idGrupoMaterial
     * @return ImgCtlSubgrupoMaterial
     */
    public function setIdGrupoMaterial(\Minsal\SimagdBundle\Entity\ImgCtlGrupoMaterial $idGrupoMaterial = null)
    {
        $this->idGrupoMaterial = $idGrupoMaterial;

        return $this;
    }

    /**
     * Get idGrupoMaterial
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlGrupoMaterial 
     */
    public function getIdGrupoMaterial()
    {
        return $this->idGrupoMaterial;
    }

    /**
     * Add subgrupoMateriales
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlMaterial $subgrupoMateriales
     * @return ImgCtlSubgrupoMaterial
     */
    public function addSubgrupoMateriale(\Minsal\SimagdBundle\Entity\ImgCtlMaterial $subgrupoMateriales)
    {
        $this->subgrupoMateriales[] = $subgrupoMateriales;

        return $this;
    }

    /**
     * Remove subgrupoMateriales
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlMaterial $subgrupoMateriales
     */
    public function removeSubgrupoMateriale(\Minsal\SimagdBundle\Entity\ImgCtlMaterial $subgrupoMateriales)
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
