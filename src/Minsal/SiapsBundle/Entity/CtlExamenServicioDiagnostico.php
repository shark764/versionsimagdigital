<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlExamenServicioDiagnostico
 *
 * @ORM\Table(name="ctl_examen_servicio_diagnostico", indexes={@ORM\Index(name="IDX_1B539A80695EA351", columns={"id_atencion"}), @ORM\Index(name="IDX_1B539A805A0BF7CA", columns={"idgrupo"}), @ORM\Index(name="IDX_1B539A806724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_1B539A8013B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_1B539A80FFF6A732", columns={"idsexo"})})
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repositorio\ExamenServicioDiagnosticoRepository")
 */
class CtlExamenServicioDiagnostico
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
     * @ORM\Column(name="idestandar", type="string", length=4, nullable=false)
     */
    private $idestandar;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=250, nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var string
     *
     * @ORM\Column(name="img_codigo", type="string", nullable=true)
     */
    private $imgCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="img_observaciones", type="string", length=255, nullable=true)
     */
    private $imgObservaciones;

    /**
     * @var \CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
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
     * @var \CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsexo", referencedColumnName="id")
     * })
     */
    private $idsexo;
    
    public function __toString() {
        return $this->descripcion ? strtoupper($this->imgCodigo) . ' - ' . mb_strtoupper($this->descripcion, 'utf-8') : '';
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
     * @param \Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico $idgrupo
     * @return CtlExamenServicioDiagnostico
     */
    public function setIdgrupo(\Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico $idgrupo = null)
    {
        $this->idgrupo = $idgrupo;

        return $this;
    }

    /**
     * Get idgrupo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico 
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
}
