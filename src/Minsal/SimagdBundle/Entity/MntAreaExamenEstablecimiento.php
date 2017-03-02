<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntAreaExamenEstablecimiento
 *
 * @ORM\Table(name="mnt_area_examen_establecimiento", indexes={@ORM\Index(name="IDX_B9629B61992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_B9629B617DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_B9629B6142479DDC", columns={"id_examen_servicio_diagnostico"}), @ORM\Index(name="IDX_B9629B61735E702C", columns={"id_usuario_mod"}), @ORM\Index(name="IDX_B9629B617C22D51", columns={"id_usuario_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\MntAreaExamenEstablecimientoRepository")
 */
class MntAreaExamenEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_area_examen_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaHoraReg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="date", nullable=true)
     * @Assert\Date()
     */
    private $fechaHoraMod;

    /**
     * @var boolean
     *
     * @ORM\Column(name="img_habilitado", type="boolean", nullable=true)
     */
    private $imgHabilitado = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="img_realiza_lectura", type="boolean", nullable=true)
     */
    private $imgRealizaLectura = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="img_duracion_clinica_estudio", type="smallint", nullable=true)
     */
    private $imgDuracionClinicaEstudio = 6;

    /**
     * @var string
     *
     * @ORM\Column(name="img_descripcion", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $imgDescripcion;

    /**
     * @var \CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico", referencedColumnName="id")
     * })
     */
    private $idAreaServicioDiagnostico;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \CtlExamenServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_examen_servicio_diagnostico", referencedColumnName="id")
     * })
     */
    private $idExamenServicioDiagnostico;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_mod", referencedColumnName="id")
     * })
     */
    private $idUsuarioMod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_reg", referencedColumnName="id")
     * })
     */
    private $idUsuarioReg;
    
    public function __toString()
    {
        return $this->idAreaServicioDiagnostico . ' :: ' . $this->idExamenServicioDiagnostico . ' :: ' . $this->idEstablecimiento;
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
     * @return MntAreaExamenEstablecimiento
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
     * @return MntAreaExamenEstablecimiento
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
     * Set imgHabilitado
     *
     * @param boolean $imgHabilitado
     * @return MntAreaExamenEstablecimiento
     */
    public function setImgHabilitado($imgHabilitado)
    {
        $this->imgHabilitado = $imgHabilitado;

        return $this;
    }

    /**
     * Get imgHabilitado
     *
     * @return boolean 
     */
    public function getImgHabilitado()
    {
        return $this->imgHabilitado;
    }

    /**
     * Set imgRealizaLectura
     *
     * @param boolean $imgRealizaLectura
     * @return MntAreaExamenEstablecimiento
     */
    public function setImgRealizaLectura($imgRealizaLectura)
    {
        $this->imgRealizaLectura = $imgRealizaLectura;

        return $this;
    }

    /**
     * Get imgRealizaLectura
     *
     * @return boolean 
     */
    public function getImgRealizaLectura()
    {
        return $this->imgRealizaLectura;
    }

    /**
     * Set imgDuracionClinicaEstudio
     *
     * @param integer $imgDuracionClinicaEstudio
     * @return MntAreaExamenEstablecimiento
     */
    public function setImgDuracionClinicaEstudio($imgDuracionClinicaEstudio)
    {
        $this->imgDuracionClinicaEstudio = $imgDuracionClinicaEstudio;

        return $this;
    }

    /**
     * Get imgDuracionClinicaEstudio
     *
     * @return integer 
     */
    public function getImgDuracionClinicaEstudio()
    {
        return $this->imgDuracionClinicaEstudio;
    }

    /**
     * Set imgDescripcion
     *
     * @param string $imgDescripcion
     * @return MntAreaExamenEstablecimiento
     */
    public function setImgDescripcion($imgDescripcion)
    {
        $this->imgDescripcion = $imgDescripcion;

        return $this;
    }

    /**
     * Get imgDescripcion
     *
     * @return string 
     */
    public function getImgDescripcion()
    {
        return $this->imgDescripcion;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return MntAreaExamenEstablecimiento
     */
    public function setIdAreaServicioDiagnostico(\Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico = null)
    {
        $this->idAreaServicioDiagnostico = $idAreaServicioDiagnostico;

        return $this;
    }

    /**
     * Get idAreaServicioDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico 
     */
    public function getIdAreaServicioDiagnostico()
    {
        return $this->idAreaServicioDiagnostico;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return MntAreaExamenEstablecimiento
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set idExamenServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $idExamenServicioDiagnostico
     * @return MntAreaExamenEstablecimiento
     */
    public function setIdExamenServicioDiagnostico(\Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $idExamenServicioDiagnostico = null)
    {
        $this->idExamenServicioDiagnostico = $idExamenServicioDiagnostico;

        return $this;
    }

    /**
     * Get idExamenServicioDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico 
     */
    public function getIdExamenServicioDiagnostico()
    {
        return $this->idExamenServicioDiagnostico;
    }

    /**
     * Set idUsuarioMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuarioMod
     * @return MntAreaExamenEstablecimiento
     */
    public function setIdUsuarioMod(\Application\Sonata\UserBundle\Entity\User $idUsuarioMod = null)
    {
        $this->idUsuarioMod = $idUsuarioMod;

        return $this;
    }

    /**
     * Get idUsuarioMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUsuarioMod()
    {
        return $this->idUsuarioMod;
    }

    /**
     * Set idUsuarioReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUsuarioReg
     * @return MntAreaExamenEstablecimiento
     */
    public function setIdUsuarioReg(\Application\Sonata\UserBundle\Entity\User $idUsuarioReg = null)
    {
        $this->idUsuarioReg = $idUsuarioReg;

        return $this;
    }

    /**
     * Get idUsuarioReg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUsuarioReg()
    {
        return $this->idUsuarioReg;
    }
}
