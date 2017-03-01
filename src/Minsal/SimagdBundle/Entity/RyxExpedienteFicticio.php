<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxExpedienteFicticio
 *
 * @ORM\Table(name="ryx_expediente_ficticio", uniqueConstraints={@ORM\UniqueConstraint(name="idx_numero_expediente_ficticio", columns={"id_establecimiento", "numero"})}, indexes={@ORM\Index(name="IDX_D7967A3B7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_D7967A3BD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxExpedienteFicticio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_expediente_ficticio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=12, nullable=true)
     */
    private $numero;

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
     */
    private $fechaHoraReg = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_ficticio", type="string", length=75, nullable=true)
     */
    private $nombreFicticio = 'Paciente desconocido';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristicas", type="string", length=255, nullable=true)
     */
    private $caracteristicas = 'El paciente se encuentra inconsciente';

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;


}
