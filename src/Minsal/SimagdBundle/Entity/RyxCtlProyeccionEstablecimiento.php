<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlProyeccionEstablecimiento
 *
 * @ORM\Table(name="ryx_ctl_proyeccion_establecimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_proyeccion_area_examen_estab", columns={"id_area_examen_estab", "id_proyeccion"})}, indexes={@ORM\Index(name="IDX_339A0DE0A7750BE9", columns={"id_area_examen_estab"}), @ORM\Index(name="IDX_339A0DE0BE76A184", columns={"id_proyeccion"}), @ORM\Index(name="IDX_339A0DE0AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_339A0DE0D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlProyeccionEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_proyeccion_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $observaciones;

    /**
     * @var \MntAreaExamenEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="MntAreaExamenEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_examen_estab", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAreaExamenEstab;

    /**
     * @var \RyxCtlProyeccionRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlProyeccionRadiologica", inversedBy="proyeccionesLocales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proyeccion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idProyeccion;

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
        return $this->idProyeccion . ' :: ' . $this->idAreaExamenEstab;
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
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     * @return RyxCtlProyeccionEstablecimiento
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
     * @return RyxCtlProyeccionEstablecimiento
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
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return RyxCtlProyeccionEstablecimiento
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return RyxCtlProyeccionEstablecimiento
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set idAreaExamenEstab
     *
     * @param \Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab
     * @return RyxCtlProyeccionEstablecimiento
     */
    public function setIdAreaExamenEstab(\Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab = null)
    {
        $this->idAreaExamenEstab = $idAreaExamenEstab;

        return $this;
    }

    /**
     * Get idAreaExamenEstab
     *
     * @return \Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento 
     */
    public function getIdAreaExamenEstab()
    {
        return $this->idAreaExamenEstab;
    }

    /**
     * Set idProyeccion
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $idProyeccion
     * @return RyxCtlProyeccionEstablecimiento
     */
    public function setIdProyeccion(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $idProyeccion = null)
    {
        $this->idProyeccion = $idProyeccion;

        return $this;
    }

    /**
     * Get idProyeccion
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica 
     */
    public function getIdProyeccion()
    {
        return $this->idProyeccion;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxCtlProyeccionEstablecimiento
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
     * @return RyxCtlProyeccionEstablecimiento
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
}
