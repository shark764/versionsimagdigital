<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlProyeccionRadiologica
 *
 * @ORM\Table(name="ryx_ctl_proyeccion_radiologica", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_proyeccion", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_D4F3A48942479DDC", columns={"id_examen_servicio_diagnostico"}), @ORM\Index(name="IDX_D4F3A489AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_D4F3A489D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCtlProyeccionRadiologicaRepository")
 */
class RyxCtlProyeccionRadiologica implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_proyeccion_radiologica_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
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
     * @var integer
     *
     * @ORM\Column(name="tiempo_ocupacion_sala", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tiempoOcupacionSala = 5;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_medico", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tiempoMedico = 5;

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
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $observaciones;

    /**
     * @var \CtlExamenServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico", inversedBy="examenProyeccionesRadiologicas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_examen_servicio_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idUserReg;

    /**
     * @ORM\OneToMany(targetEntity="RyxCtlProyeccionEstablecimiento", mappedBy="idProyeccion", cascade={"all"}, orphanRemoval=true)
     */
    private $proyeccionesLocales;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proyeccionesLocales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @return RyxCtlProyeccionRadiologica
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
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionEstablecimiento $proyeccionesLocales
     * @return RyxCtlProyeccionRadiologica
     */
    public function addProyeccionesLocale(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionEstablecimiento $proyeccionesLocales)
    {
        $this->proyeccionesLocales[] = $proyeccionesLocales;

        return $this;
    }

    /**
     * Remove proyeccionesLocales
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionEstablecimiento $proyeccionesLocales
     */
    public function removeProyeccionesLocale(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionEstablecimiento $proyeccionesLocales)
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
