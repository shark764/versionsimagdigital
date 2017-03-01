<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlConexionPacsEstablecimiento
 *
 * @ORM\Table(name="ryx_ctl_conexion_pacs_establecimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_nombre_conexion_pacs", columns={"nombre_conexion"})}, indexes={@ORM\Index(name="IDX_A65D35F7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_A65D35F25D64570", columns={"id_motor"}), @ORM\Index(name="IDX_A65D35FAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_A65D35FD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlConexionPacsEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_conexion_pacs_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_conexion", type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombreConexion = 'conn_pacsdb_local';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=255, nullable=false)
     */
    private $clave;

    /**
     * @var integer
     *
     * @ORM\Column(name="puerto", type="integer", nullable=false)
     */
    private $puerto = '5432';

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", nullable=false)
     */
    private $host;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_estudio", type="smallint", nullable=true)
     */
    private $duracionEstudio = '48';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_base_datos", type="string", nullable=false)
     */
    private $nombreBaseDatos = 'dcm4chee';

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

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
     * @var boolean
     *
     * @ORM\Column(name="principal", type="boolean", nullable=false)
     */
    private $principal = false;

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
     * @var \RyxCtlMotorBd
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlMotorBd")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motor", referencedColumnName="id")
     * })
     */
    private $idMotor;

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