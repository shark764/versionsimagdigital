<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlEstadoSolicitud
 *
 * @ORM\Table(name="ryx_ctl_estado_solicitud", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_estado_solicitud", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlEstadoSolicitud implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_estado_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_estado", type="string", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombreEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="estilo_presentacion", type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $estiloPresentacion = 'primary-v2';

    /**
     * @var integer
     *
     * @ORM\Column(name="porcentaje_avance", type="smallint", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $porcentajeAvance = '0';

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
        return $this->nombreEstado ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombreEstado), 'utf-8') : '';
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
     * Set nombreEstado
     *
     * @param string $nombreEstado
     * @return RyxCtlEstadoSolicitud
     */
    public function setNombreEstado($nombreEstado)
    {
        $this->nombreEstado = $nombreEstado;

        return $this;
    }

    /**
     * Get nombreEstado
     *
     * @return string 
     */
    public function getNombreEstado()
    {
        return $this->nombreEstado;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return RyxCtlEstadoSolicitud
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
     * Set estiloPresentacion
     *
     * @param string $estiloPresentacion
     * @return RyxCtlEstadoSolicitud
     */
    public function setEstiloPresentacion($estiloPresentacion)
    {
        $this->estiloPresentacion = $estiloPresentacion;

        return $this;
    }

    /**
     * Get estiloPresentacion
     *
     * @return string 
     */
    public function getEstiloPresentacion()
    {
        return $this->estiloPresentacion;
    }

    /**
     * Set porcentajeAvance
     *
     * @param integer $porcentajeAvance
     * @return RyxCtlEstadoSolicitud
     */
    public function setPorcentajeAvance($porcentajeAvance)
    {
        $this->porcentajeAvance = $porcentajeAvance;

        return $this;
    }

    /**
     * Get porcentajeAvance
     *
     * @return integer 
     */
    public function getPorcentajeAvance()
    {
        return $this->porcentajeAvance;
    }
}
