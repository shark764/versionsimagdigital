<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxDiagnosticoRadiologico
 *
 * @ORM\Table(name="ryx_diagnostico_radiologico", indexes={@ORM\Index(name="IDX_84921FBF890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_84921FBF22BF8FB7", columns={"id_estado_diagnostico"}), @ORM\Index(name="IDX_84921FBF18971421", columns={"id_lectura"}), @ORM\Index(name="IDX_84921FBF9DF124FC", columns={"id_patron_aplicado"}), @ORM\Index(name="IDX_84921FBFD4D28F5A", columns={"id_radiologo_aprueba"}), @ORM\Index(name="IDX_84921FBFAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_84921FBFD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxDiagnosticoRadiologico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_diagnostico_radiologico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hallazgos", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $hallazgos;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $conclusion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_transcrito", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaTranscrito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_corregido", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaCorregido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobado", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaAprobado;

    /**
     * @var string
     *
     * @ORM\Column(name="errores", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $errores;

    /**
     * @var string
     *
     * @ORM\Column(name="incidencias", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $incidencias;

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
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $recomendaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaRegistro = '(now())::timestamp(0) without time zone';

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
     * @var \RyxCtlEstadoDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_diagnostico", referencedColumnName="id")
     * })
     */
    private $idEstadoDiagnostico;

    /**
     * @var \RyxLecturaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxLecturaRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     */
    private $idLectura;

    /**
     * @var \RyxCtlPatronDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlPatronDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patron_aplicado", referencedColumnName="id")
     * })
     */
    private $idPatronAplicado;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_aprueba", referencedColumnName="id")
     * })
     */
    private $idRadiologoAprueba;

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

}