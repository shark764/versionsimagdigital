<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlEstadoSolicitud
 *
 * @ORM\Table(name="ryx_ctl_estado_solicitud", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_estado_solicitud", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlEstadoSolicitud
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
     */
    private $nombreEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=false)
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