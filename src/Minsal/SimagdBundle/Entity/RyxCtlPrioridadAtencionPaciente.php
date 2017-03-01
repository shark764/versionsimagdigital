<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlPrioridadAtencionPaciente
 *
 * @ORM\Table(name="ryx_ctl_prioridad_atencion_paciente", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_prioridad_atencion", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlPrioridadAtencionPaciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_prioridad_atencion_paciente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */
    private $nombre = 'Normal';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=true)
     */
    private $descripcion = 'Paciente puede esperar para ser atendido';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=false)
     */
    private $codigo = 'NRM';

    /**
     * @var string
     *
     * @ORM\Column(name="estilo_presentacion", type="string", nullable=true)
     */
    private $estiloPresentacion = 'success-v2';


}
