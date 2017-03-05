<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlMaterial
 *
 * @ORM\Table(name="ryx_ctl_material", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_material", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_5D0400F7A599A5B7", columns={"id_subgrupo_material"}), @ORM\Index(name="IDX_5D0400F7AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_5D0400F7D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCtlMaterialRepository")
 */
class RyxCtlMaterial implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_material_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $descripcion;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraMod;

    /**
     * @var \RyxCtlSubgrupoMaterial
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlSubgrupoMaterial", inversedBy="subgrupoMateriales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subgrupo_material", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idUserReg;

    /**
     * @ORM\OneToMany(targetEntity="RyxCtlMaterialEstablecimiento", mappedBy="idMaterial", cascade={"all"}, orphanRemoval=true)
     */
    private $materialesLocales;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materialesLocales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return RyxCtlMaterial
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
     * @return RyxCtlMaterial
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
     * @return RyxCtlMaterial
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
     * @return RyxCtlMaterial
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
     * @return RyxCtlMaterial
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
     * @param \Minsal\SimagdBundle\Entity\RyxCtlSubgrupoMaterial $idSubgrupoMaterial
     * @return RyxCtlMaterial
     */
    public function setIdSubgrupoMaterial(\Minsal\SimagdBundle\Entity\RyxCtlSubgrupoMaterial $idSubgrupoMaterial = null)
    {
        $this->idSubgrupoMaterial = $idSubgrupoMaterial;

        return $this;
    }

    /**
     * Get idSubgrupoMaterial
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlSubgrupoMaterial 
     */
    public function getIdSubgrupoMaterial()
    {
        return $this->idSubgrupoMaterial;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxCtlMaterial
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
     * @return RyxCtlMaterial
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
     * @param \Minsal\SimagdBundle\Entity\RyxCtlMaterialEstablecimiento $materialesLocales
     * @return RyxCtlMaterial
     */
    public function addMaterialesLocale(\Minsal\SimagdBundle\Entity\RyxCtlMaterialEstablecimiento $materialesLocales)
    {
        $this->materialesLocales[] = $materialesLocales;

        return $this;
    }

    /**
     * Remove materialesLocales
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlMaterialEstablecimiento $materialesLocales
     */
    public function removeMaterialesLocale(\Minsal\SimagdBundle\Entity\RyxCtlMaterialEstablecimiento $materialesLocales)
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
