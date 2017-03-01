<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlProyeccionEstablecimiento
 *
 * @ORM\Table(name="ryx_ctl_proyeccion_establecimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_proyeccion_area_examen_estab", columns={"id_area_examen_estab", "id_proyeccion"})}, indexes={@ORM\Index(name="IDX_339A0DE0A7750BE9", columns={"id_area_examen_estab"}), @ORM\Index(name="IDX_339A0DE0BE76A184", columns={"id_proyeccion"}), @ORM\Index(name="IDX_339A0DE0AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_339A0DE0D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlProyeccionEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_proyeccion_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \MntAreaExamenEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="MntAreaExamenEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_examen_estab", referencedColumnName="id")
     * })
     */
    private $idAreaExamenEstab;

    /**
     * @var \RyxCtlProyeccionRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlProyeccionRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proyeccion", referencedColumnName="id")
     * })
     */
    private $idProyeccion;

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
