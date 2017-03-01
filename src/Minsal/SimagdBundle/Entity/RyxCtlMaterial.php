<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlMaterial
 *
 * @ORM\Table(name="ryx_ctl_material", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_material", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_5D0400F7A599A5B7", columns={"id_subgrupo_material"}), @ORM\Index(name="IDX_5D0400F7AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_5D0400F7D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlMaterial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_material_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo;

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
     * @var \RyxCtlSubgrupoMaterial
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlSubgrupoMaterial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subgrupo_material", referencedColumnName="id")
     * })
     */
    private $idSubgrupoMaterial;

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
