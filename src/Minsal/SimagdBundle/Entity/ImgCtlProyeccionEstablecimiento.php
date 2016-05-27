<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlProyeccionEstablecimiento
 *
 * @ORM\Table(name="img_ctl_proyeccion_establecimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_proyeccion_area_examen_estab", columns={"id_area_examen_estab", "id_proyeccion"})}, indexes={@ORM\Index(name="IDX_C01060BEA7750BE9", columns={"id_area_examen_estab"}), @ORM\Index(name="IDX_C01060BEBE76A184", columns={"id_proyeccion"}), @ORM\Index(name="IDX_C01060BEAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_C01060BED8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class ImgCtlProyeccionEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_proyeccion_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_examen_estab", referencedColumnName="id")
     * })
     */
    private $idAreaExamenEstab;

    /**
     * @var \ImgCtlProyeccion
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlProyeccion", inversedBy="proyeccionesLocales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proyeccion", referencedColumnName="id")
     * })
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
     */
    private $idUserReg;

    public function __toString() {
        return $this->idProyeccion . ' :: ' . $this->idAreaExamenEstab;
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
     * @return ImgCtlProyeccionEstablecimiento
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
     * @return ImgCtlProyeccionEstablecimiento
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
     * @return ImgCtlProyeccionEstablecimiento
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
     * @return ImgCtlProyeccionEstablecimiento
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
     * @param \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab
     * @return ImgCtlProyeccionEstablecimiento
     */
    public function setIdAreaExamenEstab(\Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab = null)
    {
        $this->idAreaExamenEstab = $idAreaExamenEstab;

        return $this;
    }

    /**
     * Get idAreaExamenEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento 
     */
    public function getIdAreaExamenEstab()
    {
        return $this->idAreaExamenEstab;
    }

    /**
     * Set idProyeccion
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlProyeccion $idProyeccion
     * @return ImgCtlProyeccionEstablecimiento
     */
    public function setIdProyeccion(\Minsal\SimagdBundle\Entity\ImgCtlProyeccion $idProyeccion = null)
    {
        $this->idProyeccion = $idProyeccion;

        return $this;
    }

    /**
     * Get idProyeccion
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlProyeccion 
     */
    public function getIdProyeccion()
    {
        return $this->idProyeccion;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return ImgCtlProyeccionEstablecimiento
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
     * @return ImgCtlProyeccionEstablecimiento
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