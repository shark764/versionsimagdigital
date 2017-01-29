<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgNotaDiagnostico
 *
 * @ORM\Table(name="img_nota_diagnostico", indexes={@ORM\Index(name="IDX_9F90E301838319BF", columns={"id_diagnostico"}), @ORM\Index(name="IDX_9F90E301890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_9F90E3017DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_9F90E3019FA5140", columns={"id_tipo_nota_diagnostico"}), @ORM\Index(name="IDX_9F90E301D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\NotaDiagnosticoRepository")
 */
class ImgNotaDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_nota_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=true)
     */
    private $contenido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_emision", type="datetime", nullable=true)
     */
    private $fechaEmision = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \ImgDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="ImgDiagnostico", inversedBy="notasDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diagnostico", referencedColumnName="id")
     * })
     */
    private $idDiagnostico;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

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
     * @var \ImgCtlTipoNotaDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlTipoNotaDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_nota_diagnostico", referencedColumnName="id")
     * })
     */
    private $idTipoNotaDiagnostico;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;

    public function __toString()
    {
        return $this->idDiagnostico . ' :: ' . $this->idTipoNotaDiagnostico;
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
     * Set contenido
     *
     * @param string $contenido
     * @return ImgNotaDiagnostico
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set fechaEmision
     *
     * @param \DateTime $fechaEmision
     * @return ImgNotaDiagnostico
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fechaEmision = $fechaEmision;

        return $this;
    }

    /**
     * Get fechaEmision
     *
     * @return \DateTime 
     */
    public function getFechaEmision()
    {
        return $this->fechaEmision;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return ImgNotaDiagnostico
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
     * Set idDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgDiagnostico $idDiagnostico
     * @return ImgNotaDiagnostico
     */
    public function setIdDiagnostico(\Minsal\SimagdBundle\Entity\ImgDiagnostico $idDiagnostico = null)
    {
        $this->idDiagnostico = $idDiagnostico;

        return $this;
    }

    /**
     * Get idDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\ImgDiagnostico 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return ImgNotaDiagnostico
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgNotaDiagnostico
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
     * Set idTipoNotaDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlTipoNotaDiagnostico $idTipoNotaDiagnostico
     * @return ImgNotaDiagnostico
     */
    public function setIdTipoNotaDiagnostico(\Minsal\SimagdBundle\Entity\ImgCtlTipoNotaDiagnostico $idTipoNotaDiagnostico = null)
    {
        $this->idTipoNotaDiagnostico = $idTipoNotaDiagnostico;

        return $this;
    }

    /**
     * Get idTipoNotaDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlTipoNotaDiagnostico 
     */
    public function getIdTipoNotaDiagnostico()
    {
        return $this->idTipoNotaDiagnostico;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return ImgNotaDiagnostico
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
