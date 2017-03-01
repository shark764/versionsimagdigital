<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlProyeccionRadiologica
 *
 * @ORM\Table(name="ryx_ctl_proyeccion_radiologica", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_proyeccion", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_D4F3A48942479DDC", columns={"id_examen_servicio_diagnostico"}), @ORM\Index(name="IDX_D4F3A489AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_D4F3A489D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlProyeccionRadiologica
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
     * @ORM\Column(name="tiempo_ocupacion_sala", type="smallint", nullable=true)
     */
    private $tiempoOcupacionSala = 5;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_medico", type="smallint", nullable=true)
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
     * @ORM\ManyToOne(targetEntity="CtlExamenServicioDiagnostico")
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