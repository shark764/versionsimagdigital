<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlMaterialEstablecimiento
 *
 * @ORM\Table(name="ryx_ctl_material_establecimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_material_establecimiento", columns={"id_material", "id_establecimiento"})}, indexes={@ORM\Index(name="IDX_C017481E7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_C017481E2C659900", columns={"id_material"}), @ORM\Index(name="IDX_C017481EAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_C017481ED8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlMaterialEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_material_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_disponible", type="integer", nullable=false)
     */
    private $cantidadDisponible = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;

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
     * @var \RyxCtlMaterial
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlMaterial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_material", referencedColumnName="id")
     * })
     */
    private $idMaterial;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

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
