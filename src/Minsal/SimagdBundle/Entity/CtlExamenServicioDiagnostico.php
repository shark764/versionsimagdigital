<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * CtlExamenServicioDiagnostico
 *
 * @ORM\Table(name="ctl_examen_servicio_diagnostico", indexes={@ORM\Index(name="IDX_1B539A80695EA351", columns={"id_atencion"}), @ORM\Index(name="IDX_1B539A805A0BF7CA", columns={"idgrupo"}), @ORM\Index(name="IDX_1B539A806724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_1B539A8013B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_1B539A80FFF6A732", columns={"idsexo"}), @ORM\Index(name="IDX_1B539A80992127D5", columns={"id_area_servicio_diagnostico"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\CtlExamenServicioDiagnosticoRepository")
 */
class CtlExamenServicioDiagnostico implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_examen_servicio_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idestandar", type="string", length=10, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $idestandar;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=250, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechahorareg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechahoramod;

    /**
     * @var string
     *
     * @ORM\Column(name="img_codigo", type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $imgCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="img_observaciones", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $imgObservaciones;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAtencion;

    /**
     * @var \CtlExamenServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idgrupo", referencedColumnName="id")
     * })
     */
    private $idgrupo;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsexo", referencedColumnName="id")
     * })
     */
    private $idsexo;

    /**
     * @var \CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaServicioDiagnostico", inversedBy="areaExamenesServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAreaServicioDiagnostico;

    /**
     * @ORM\OneToMany(targetEntity="RyxCtlProyeccionRadiologica", mappedBy="idExamenServicioDiagnostico", cascade={"all"}, orphanRemoval=true)
     */
    private $examenProyeccionesRadiologicas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->examenProyeccionesRadiologicas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->descripcion ? strtoupper($this->idestandar) . ' - ' . mb_strtoupper($this->descripcion, 'utf-8') : '';
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
     * Set idestandar
     *
     * @param string $idestandar
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdestandar($idestandar)
    {
        $this->idestandar = $idestandar;

        return $this;
    }

    /**
     * Get idestandar
     *
     * @return string 
     */
    public function getIdestandar()
    {
        return $this->idestandar;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CtlExamenServicioDiagnostico
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
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return CtlExamenServicioDiagnostico
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime 
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     * @return CtlExamenServicioDiagnostico
     */
    public function setFechahoramod($fechahoramod)
    {
        $this->fechahoramod = $fechahoramod;

        return $this;
    }

    /**
     * Get fechahoramod
     *
     * @return \DateTime 
     */
    public function getFechahoramod()
    {
        return $this->fechahoramod;
    }

    /**
     * Set imgCodigo
     *
     * @param string $imgCodigo
     * @return CtlExamenServicioDiagnostico
     */
    public function setImgCodigo($imgCodigo)
    {
        $this->imgCodigo = $imgCodigo;

        return $this;
    }

    /**
     * Get imgCodigo
     *
     * @return string 
     */
    public function getImgCodigo()
    {
        return $this->imgCodigo;
    }

    /**
     * Set imgObservaciones
     *
     * @param string $imgObservaciones
     * @return CtlExamenServicioDiagnostico
     */
    public function setImgObservaciones($imgObservaciones)
    {
        $this->imgObservaciones = $imgObservaciones;

        return $this;
    }

    /**
     * Get imgObservaciones
     *
     * @return string 
     */
    public function getImgObservaciones()
    {
        return $this->imgObservaciones;
    }

    /**
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdAtencion(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion = null)
    {
        $this->idAtencion = $idAtencion;

        return $this;
    }

    /**
     * Get idAtencion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion 
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

    /**
     * Set idgrupo
     *
     * @param \Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $idgrupo
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdgrupo(\Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $idgrupo = null)
    {
        $this->idgrupo = $idgrupo;

        return $this;
    }

    /**
     * Get idgrupo
     *
     * @return \Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico 
     */
    public function getIdgrupo()
    {
        return $this->idgrupo;
    }

    /**
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdusuariomod(\Application\Sonata\UserBundle\Entity\User $idusuariomod = null)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = null)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set idsexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idsexo
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdsexo(\Minsal\SiapsBundle\Entity\CtlSexo $idsexo = null)
    {
        $this->idsexo = $idsexo;

        return $this;
    }

    /**
     * Get idsexo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlSexo 
     */
    public function getIdsexo()
    {
        return $this->idsexo;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return CtlExamenServicioDiagnostico
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
     * Add examenProyeccionesRadiologicas
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $examenProyeccionesRadiologicas
     * @return CtlExamenServicioDiagnostico
     */
    public function addExamenProyeccionesRadiologica(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $examenProyeccionesRadiologicas)
    {
        $this->examenProyeccionesRadiologicas[] = $examenProyeccionesRadiologicas;

        return $this;
    }

    /**
     * Remove examenProyeccionesRadiologicas
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $examenProyeccionesRadiologicas
     */
    public function removeExamenProyeccionesRadiologica(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $examenProyeccionesRadiologicas)
    {
        $this->examenProyeccionesRadiologicas->removeElement($examenProyeccionesRadiologicas);
    }

    /**
     * Get examenProyeccionesRadiologicas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamenProyeccionesRadiologicas()
    {
        return $this->examenProyeccionesRadiologicas;
    }
}
