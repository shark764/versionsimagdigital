<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * CtlAreaServicioDiagnostico
 *
 * @ORM\Table(name="ctl_area_servicio_diagnostico", indexes={@ORM\Index(name="IDX_C44C3A31695EA351", columns={"id_atencion"}), @ORM\Index(name="IDX_C44C3A316724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_C44C3A3113B895A1", columns={"idusuarioreg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\CtlAreaServicioDiagnosticoRepository")
 */
class CtlAreaServicioDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_area_servicio_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idarea", type="string", length=10, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $idarea;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrearea", type="string", length=75, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombrearea;

    /**
     * @var string
     *
     * @ORM\Column(name="administrativa", type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $administrativa = 'N';

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
     * @ORM\Column(name="img_descripcion", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $imgDescripcion;

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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idusuarioreg;

    /**
     * @ORM\OneToMany(targetEntity="CtlExamenServicioDiagnostico", mappedBy="idAreaServicioDiagnostico", cascade={"all"}, orphanRemoval=true)
     */
    private $areaExamenesServicioDiagnostico;
    
    public function __toString()
    {
        return $this->nombrearea ? strtoupper($this->idarea) . ' - ' . mb_strtoupper($this->nombrearea, 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areaExamenesServicioDiagnostico = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idarea
     *
     * @param string $idarea
     * @return CtlAreaServicioDiagnostico
     */
    public function setIdarea($idarea)
    {
        $this->idarea = $idarea;

        return $this;
    }

    /**
     * Get idarea
     *
     * @return string 
     */
    public function getIdarea()
    {
        return $this->idarea;
    }

    /**
     * Set nombrearea
     *
     * @param string $nombrearea
     * @return CtlAreaServicioDiagnostico
     */
    public function setNombrearea($nombrearea)
    {
        $this->nombrearea = $nombrearea;

        return $this;
    }

    /**
     * Get nombrearea
     *
     * @return string 
     */
    public function getNombrearea()
    {
        return $this->nombrearea;
    }

    /**
     * Set administrativa
     *
     * @param string $administrativa
     * @return CtlAreaServicioDiagnostico
     */
    public function setAdministrativa($administrativa)
    {
        $this->administrativa = $administrativa;

        return $this;
    }

    /**
     * Get administrativa
     *
     * @return string 
     */
    public function getAdministrativa()
    {
        return $this->administrativa;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return CtlAreaServicioDiagnostico
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
     * @return CtlAreaServicioDiagnostico
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
     * @return CtlAreaServicioDiagnostico
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
     * Set imgDescripcion
     *
     * @param string $imgDescripcion
     * @return CtlAreaServicioDiagnostico
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
     * Set imgObservaciones
     *
     * @param string $imgObservaciones
     * @return CtlAreaServicioDiagnostico
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
     * @return CtlAreaServicioDiagnostico
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
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     * @return CtlAreaServicioDiagnostico
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
     * @return CtlAreaServicioDiagnostico
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
     * Add areaExamenesServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $areaExamenesServicioDiagnostico
     * @return CtlAreaServicioDiagnostico
     */
    public function addAreaExamenesServicioDiagnostico(\Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $areaExamenesServicioDiagnostico)
    {
        $this->areaExamenesServicioDiagnostico[] = $areaExamenesServicioDiagnostico;

        return $this;
    }

    /**
     * Remove areaExamenesServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $areaExamenesServicioDiagnostico
     */
    public function removeAreaExamenesServicioDiagnostico(\Minsal\SimagdBundle\Entity\CtlExamenServicioDiagnostico $areaExamenesServicioDiagnostico)
    {
        $this->areaExamenesServicioDiagnostico->removeElement($areaExamenesServicioDiagnostico);
    }

    /**
     * Get areaExamenesServicioDiagnostico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreaExamenesServicioDiagnostico()
    {
        return $this->areaExamenesServicioDiagnostico;
    }
}
