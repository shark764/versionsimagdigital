<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlMaterial
 *
 * @ORM\Table(name="img_ctl_material", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_material", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_1FC06762A599A5B7", columns={"id_subgrupo_material"}), @ORM\Index(name="IDX_1FC06762AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_1FC06762D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\MaterialRepository")
 */
class ImgCtlMaterial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_material_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     */
    private $fechaHoraReg = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;

    /**
     * @var \ImgCtlSubgrupoMaterial
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlSubgrupoMaterial", inversedBy="subgrupoMateriales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subgrupo_material", referencedColumnName="id")
     * })
     */
    private $idSubgrupoMaterial;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;


    /**
     * @ORM\OneToMany(targetEntity="ImgCtlMaterialEstablecimiento", mappedBy="idMaterial", cascade={"all"}, orphanRemoval=true)
     */
    private $materialesLocales;


    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materialesLocales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ImgCtlMaterial
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return ImgCtlMaterial
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
     * Set codigo
     *
     * @param string $codigo
     * @return ImgCtlMaterial
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
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     * @return ImgCtlMaterial
     */
    public function setFechaHoraReg($fechaHoraReg)
    {
        $this->fechaHoraReg = $fechaHoraReg;

        return $this;
    }

    /**
     * Get fechaHoraReg
     *
     * @return \DateTime 
     */
    public function getFechaHoraReg()
    {
        return $this->fechaHoraReg;
    }

    /**
     * Set fechaHoraMod
     *
     * @param \DateTime $fechaHoraMod
     * @return ImgCtlMaterial
     */
    public function setFechaHoraMod($fechaHoraMod)
    {
        $this->fechaHoraMod = $fechaHoraMod;

        return $this;
    }

    /**
     * Get fechaHoraMod
     *
     * @return \DateTime 
     */
    public function getFechaHoraMod()
    {
        return $this->fechaHoraMod;
    }

    /**
     * Set idSubgrupoMaterial
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlSubgrupoMaterial $idSubgrupoMaterial
     * @return ImgCtlMaterial
     */
    public function setIdSubgrupoMaterial(\Minsal\SimagdBundle\Entity\ImgCtlSubgrupoMaterial $idSubgrupoMaterial = null)
    {
        $this->idSubgrupoMaterial = $idSubgrupoMaterial;

        return $this;
    }

    /**
     * Get idSubgrupoMaterial
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlSubgrupoMaterial 
     */
    public function getIdSubgrupoMaterial()
    {
        return $this->idSubgrupoMaterial;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return ImgCtlMaterial
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return ImgCtlMaterial
     */
    public function setIdUserReg(\Application\Sonata\UserBundle\Entity\User $idUserReg = null)
    {
        $this->idUserReg = $idUserReg;

        return $this;
    }

    /**
     * Get idUserReg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserReg()
    {
        return $this->idUserReg;
    }

    /**
     * Add materialesLocales
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento $materialesLocales
     * @return ImgCtlMaterial
     */
    public function addMaterialesLocale(\Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento $materialesLocales)
    {
        $this->materialesLocales[] = $materialesLocales;

        return $this;
    }

    /**
     * Remove materialesLocales
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento $materialesLocales
     */
    public function removeMaterialesLocale(\Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento $materialesLocales)
    {
        $this->materialesLocales->removeElement($materialesLocales);
    }

    /**
     * Get materialesLocales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaterialesLocales()
    {
        return $this->materialesLocales;
    }
}
