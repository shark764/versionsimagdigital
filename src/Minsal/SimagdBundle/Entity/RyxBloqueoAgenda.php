<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxBloqueoAgenda
 *
 * @ORM\Table(name="ryx_bloqueo_agenda", indexes={@ORM\Index(name="IDX_3BCEF10992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_3BCEF10592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_3BCEF107DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_3BCEF1032E38BF3", columns={"id_radiologo_bloqueo"}), @ORM\Index(name="IDX_3BCEF10AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_3BCEF10D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxBloqueoAgendaRepository")
 */
class RyxBloqueoAgenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_bloqueo_agenda_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\DateTime()
     */
    private $fechaCreacion = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=75, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $titulo = 'Horario Bloqueado';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $descripcion = 'Este horario se encuentra bloqueado, no puede programar citas en este intervalo';

    /**
     * @var boolean
     *
     * @ORM\Column(name="dia_completo", type="boolean", nullable=true)
     */
    private $diaCompleto = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Time()
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Time()
     */
    private $horaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $color = 'yellow';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ultima_edicion", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaUltimaEdicion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="superposicion", type="boolean", nullable=true)
     */
    private $superposicion = false;

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_registra", referencedColumnName="id")
     * })
     */
    private $idEmpleadoRegistra;

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
     *   @ORM\JoinColumn(name="id_radiologo_bloqueo", referencedColumnName="id")
     * })
     */
    private $idRadiologoBloqueo;

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
     * @ORM\OneToMany(targetEntity="ImgExclusionBloqueo", mappedBy="idBloqueoAgenda", cascade={"all"}, orphanRemoval=true)
     */
    private $bloqueoExclusionesBloqueo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bloqueoExclusionesBloqueo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->titulo;
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