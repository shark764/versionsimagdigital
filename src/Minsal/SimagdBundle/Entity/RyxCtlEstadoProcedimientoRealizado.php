<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlEstadoProcedimientoRealizado
 *
 * @ORM\Table(name="ryx_ctl_estado_procedimiento_realizado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_estado_procedimiento_realizado", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlEstadoProcedimientoRealizado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_estado_procedimiento_realizado_id_seq", allocationSize=1, initialValue=1)
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
     */
    private $estiloPresentacion = 'primary-v2';


}
