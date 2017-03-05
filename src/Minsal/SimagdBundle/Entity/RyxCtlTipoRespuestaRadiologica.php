<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlTipoRespuestaRadiologica
 *
 * @ORM\Table(name="ryx_ctl_tipo_respuesta_radiologica", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_tipo_resultado", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlTipoRespuestaRadiologica implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_tipo_respuesta_radiologica_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tipo", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombreTipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indeterminado", type="boolean", nullable=true)
     */
    private $indeterminado = false;

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
    private $descripcion;

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
        return $this->nombreTipo ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombreTipo), 'utf-8') : '';
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
     * Set nombreTipo
     *
     * @param string $nombreTipo
     * @return RyxCtlTipoRespuestaRadiologica
     */
    public function setNombreTipo($nombreTipo)
    {
        $this->nombreTipo = $nombreTipo;

        return $this;
    }

    /**
     * Get nombreTipo
     *
     * @return string 
     */
    public function getNombreTipo()
    {
        return $this->nombreTipo;
    }

    /**
     * Set indeterminado
     *
     * @param boolean $indeterminado
     * @return RyxCtlTipoRespuestaRadiologica
     */
    public function setIndeterminado($indeterminado)
    {
        $this->indeterminado = $indeterminado;

        return $this;
    }

    /**
     * Get indeterminado
     *
     * @return boolean 
     */
    public function getIndeterminado()
    {
        return $this->indeterminado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RyxCtlTipoRespuestaRadiologica
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
     * Set codigo
     *
     * @param string $codigo
     * @return RyxCtlTipoRespuestaRadiologica
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
     * @return RyxCtlTipoRespuestaRadiologica
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
}
