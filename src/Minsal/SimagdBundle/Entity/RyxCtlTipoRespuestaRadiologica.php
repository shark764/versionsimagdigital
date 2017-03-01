<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlTipoRespuestaRadiologica
 *
 * @ORM\Table(name="ryx_ctl_tipo_respuesta_radiologica", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_tipo_resultado", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlTipoRespuestaRadiologica
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
     */
    private $descripcion;

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
