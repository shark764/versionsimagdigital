<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlConfiguracionAgenda
 *
 * @ORM\Table(name="ryx_ctl_configuracion_agenda", indexes={@ORM\Index(name="IDX_1A45BF94A7750BE9", columns={"id_area_examen_estab"}), @ORM\Index(name="IDX_1A45BF94AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_1A45BF94D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlConfiguracionAgenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_configuracion_agenda_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_citas_dia", type="smallint", nullable=true)
     */
    private $maximoCitasDia = '15';

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_citas_turno", type="smallint", nullable=true)
     */
    private $maximoCitasTurno;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_citas_hora", type="smallint", nullable=true)
     */
    private $maximoCitasHora;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_citas_medico", type="smallint", nullable=true)
     */
    private $maximoCitasMedico;

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
