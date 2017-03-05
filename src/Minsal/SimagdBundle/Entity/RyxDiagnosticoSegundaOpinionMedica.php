<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxDiagnosticoSegundaOpinionMedica
 *
 * @ORM\Table(name="ryx_diagnostico_segunda_opinion_medica", indexes={@ORM\Index(name="IDX_F185AA86838319BF", columns={"id_diagnostico"}), @ORM\Index(name="IDX_F185AA86890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_F185AA867DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_F185AA869FA5140", columns={"id_tipo_nota_diagnostico"}), @ORM\Index(name="IDX_F185AA86D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxDiagnosticoSegundaOpinionMedicaRepository")
 */
class RyxDiagnosticoSegundaOpinionMedica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_diagnostico_segunda_opinion_medica_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $contenido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_emision", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaEmision = '(now())::timestamp(0) without time zone';

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
     * @var \RyxDiagnosticoRadiologico
     *
     * @ORM\ManyToOne(targetEntity="RyxDiagnosticoRadiologico", inversedBy="notasDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDiagnostico;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEmpleado;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimiento;

    /**
     * @var \RyxCtlTipoOpinionMedicaDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlTipoOpinionMedicaDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_nota_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTipoNotaDiagnostico;

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
        return $this->idDiagnostico . ' :: ' . $this->idTipoNotaDiagnostico;
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
     * Set contenido
     *
     * @param string $contenido
     * @return RyxDiagnosticoSegundaOpinionMedica
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
     * @return RyxDiagnosticoSegundaOpinionMedica
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
     * @return RyxDiagnosticoSegundaOpinionMedica
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
     * @param \Minsal\SimagdBundle\Entity\RyxDiagnosticoRadiologico $idDiagnostico
     * @return RyxDiagnosticoSegundaOpinionMedica
     */
    public function setIdDiagnostico(\Minsal\SimagdBundle\Entity\RyxDiagnosticoRadiologico $idDiagnostico = null)
    {
        $this->idDiagnostico = $idDiagnostico;

        return $this;
    }

    /**
     * Get idDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\RyxDiagnosticoRadiologico 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return RyxDiagnosticoSegundaOpinionMedica
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
     * @return RyxDiagnosticoSegundaOpinionMedica
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
     * @param \Minsal\SimagdBundle\Entity\RyxCtlTipoOpinionMedicaDiagnostico $idTipoNotaDiagnostico
     * @return RyxDiagnosticoSegundaOpinionMedica
     */
    public function setIdTipoNotaDiagnostico(\Minsal\SimagdBundle\Entity\RyxCtlTipoOpinionMedicaDiagnostico $idTipoNotaDiagnostico = null)
    {
        $this->idTipoNotaDiagnostico = $idTipoNotaDiagnostico;

        return $this;
    }

    /**
     * Get idTipoNotaDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlTipoOpinionMedicaDiagnostico 
     */
    public function getIdTipoNotaDiagnostico()
    {
        return $this->idTipoNotaDiagnostico;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return RyxDiagnosticoSegundaOpinionMedica
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
