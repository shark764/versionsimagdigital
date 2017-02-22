<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlProyeccion
 *
 * @ORM\Table(name="img_ctl_proyeccion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_proyeccion", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_B3B8441F42479DDC", columns={"id_examen_servicio_diagnostico"}), @ORM\Index(name="IDX_B3B8441FAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_B3B8441FD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCtlProyeccionRadiologicaRepository")
 */
class ImgCtlProyeccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_proyeccion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

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
     * @var integer
     *
     * @ORM\Column(name="tiempo_ocupacion_sala", type="smallint", nullable=true)
     */
    private $tiempoOcupacionSala = '5';

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_medico", type="smallint", nullable=true)
     */
    private $tiempoMedico = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \CtlExamenServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico", inversedBy="examenProyeccionesRadiologicas")
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
     * @ORM\OneToMany(targetEntity="ImgCtlProyeccionEstablecimiento", mappedBy="idProyeccion", cascade={"all"}, orphanRemoval=true)
     */
    private $proyeccionesLocales;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proyeccionesLocales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ImgCtlProyeccion
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
     * @return ImgCtlProyeccion
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
     * @return ImgCtlProyeccion
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
     * @return ImgCtlProyeccion
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
     * Set tiempoOcupacionSala
     *
     * @param integer $tiempoOcupacionSala
     * @return ImgCtlProyeccion
     */
    public function setTiempoOcupacionSala($tiempoOcupacionSala)
    {
        $this->tiempoOcupacionSala = $tiempoOcupacionSala;

        return $this;
    }

    /**
     * Get tiempoOcupacionSala
     *
     * @return integer
     */
    public function getTiempoOcupacionSala()
    {
        return $this->tiempoOcupacionSala;
    }

    /**
     * Set tiempoMedico
     *
     * @param integer $tiempoMedico
     * @return ImgCtlProyeccion
     */
    public function setTiempoMedico($tiempoMedico)
    {
        $this->tiempoMedico = $tiempoMedico;

        return $this;
    }

    /**
     * Get tiempoMedico
     *
     * @return integer
     */
    public function getTiempoMedico()
    {
        return $this->tiempoMedico;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ImgCtlProyeccion
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return ImgCtlProyeccion
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
     * Set idExamenServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $idExamenServicioDiagnostico
     * @return ImgCtlProyeccion
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
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return ImgCtlProyeccion
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
     * @return ImgCtlProyeccion
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
     * Add proyeccionesLocales
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento $proyeccionesLocales
     * @return ImgCtlProyeccion
     */
    public function addProyeccionesLocale(\Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento $proyeccionesLocales)
    {
        $this->proyeccionesLocales[] = $proyeccionesLocales;

        return $this;
    }

    /**
     * Remove proyeccionesLocales
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento $proyeccionesLocales
     */
    public function removeProyeccionesLocale(\Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento $proyeccionesLocales)
    {
        $this->proyeccionesLocales->removeElement($proyeccionesLocales);
    }

    /**
     * Get proyeccionesLocales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProyeccionesLocales()
    {
        return $this->proyeccionesLocales;
    }
}
