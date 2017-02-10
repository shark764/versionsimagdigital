<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlPreparacionEstudio
 *
 * @ORM\Table(name="img_ctl_preparacion_estudio", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_preparacion_estudio", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_9E29DEA7EFA31A58", columns={"id_area_servicio_diagnostico_aplica"}), @ORM\Index(name="IDX_9E29DEA7AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_9E29DEA7D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_9E29DEA77DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_9E29DEA7592B0EA1", columns={"id_empleado_registra"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCtlPreparacionEstudioRepository")
 */
class ImgCtlPreparacionEstudio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_preparacion_estudio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="preparacion_estudio", type="text", nullable=true)
     */
    private $preparacionEstudio;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     */
    private $recomendaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico_aplica", referencedColumnName="id")
     * })
     */
    private $idAreaServicioDiagnosticoAplica;

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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_registra", referencedColumnName="id")
     * })
     */
    private $idEmpleadoRegistra;


    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
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
     * Set preparacionEstudio
     *
     * @param string $preparacionEstudio
     * @return ImgCtlPreparacionEstudio
     */
    public function setPreparacionEstudio($preparacionEstudio)
    {
        $this->preparacionEstudio = $preparacionEstudio;

        return $this;
    }

    /**
     * Get preparacionEstudio
     *
     * @return string
     */
    public function getPreparacionEstudio()
    {
        return $this->preparacionEstudio;
    }

    /**
     * Set recomendaciones
     *
     * @param string $recomendaciones
     * @return ImgCtlPreparacionEstudio
     */
    public function setRecomendaciones($recomendaciones)
    {
        $this->recomendaciones = $recomendaciones;

        return $this;
    }

    /**
     * Get recomendaciones
     *
     * @return string
     */
    public function getRecomendaciones()
    {
        return $this->recomendaciones;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return ImgCtlPreparacionEstudio
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
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     * @return ImgCtlPreparacionEstudio
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
     * @return ImgCtlPreparacionEstudio
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
     * Set nombre
     *
     * @param string $nombre
     * @return ImgCtlPreparacionEstudio
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
     * @return ImgCtlPreparacionEstudio
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
     * Set idAreaServicioDiagnosticoAplica
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnosticoAplica
     * @return ImgCtlPreparacionEstudio
     */
    public function setIdAreaServicioDiagnosticoAplica(\Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnosticoAplica = null)
    {
        $this->idAreaServicioDiagnosticoAplica = $idAreaServicioDiagnosticoAplica;

        return $this;
    }

    /**
     * Get idAreaServicioDiagnosticoAplica
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico
     */
    public function getIdAreaServicioDiagnosticoAplica()
    {
        return $this->idAreaServicioDiagnosticoAplica;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return ImgCtlPreparacionEstudio
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
     * @return ImgCtlPreparacionEstudio
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
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgCtlPreparacionEstudio
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
     * Set idEmpleadoRegistra
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleadoRegistra
     * @return ImgCtlPreparacionEstudio
     */
    public function setIdEmpleadoRegistra(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleadoRegistra = null)
    {
        $this->idEmpleadoRegistra = $idEmpleadoRegistra;

        return $this;
    }

    /**
     * Get idEmpleadoRegistra
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdEmpleadoRegistra()
    {
        return $this->idEmpleadoRegistra;
    }
}
