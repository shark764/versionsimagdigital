<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxCtlConfiguracionAgenda
 *
 * @ORM\Table(name="ryx_ctl_configuracion_agenda", indexes={@ORM\Index(name="IDX_1A45BF94A7750BE9", columns={"id_area_examen_estab"}), @ORM\Index(name="IDX_1A45BF94AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_1A45BF94D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxCtlConfiguracionAgendaRepository")
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
     * @ORM\Column(name="maximo_citas_dia", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $maximoCitasDia = 15;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_citas_turno", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $maximoCitasTurno;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_citas_hora", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $maximoCitasHora;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_citas_medico", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idUserReg;

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
        return 'Parámetros de: ' . $this->idAreaExamenEstab;
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
     * Set maximoCitasDia
     *
     * @param integer $maximoCitasDia
     * @return RyxCtlConfiguracionAgenda
     */
    public function setMaximoCitasDia($maximoCitasDia)
    {
        $this->maximoCitasDia = $maximoCitasDia;

        return $this;
    }

    /**
     * Get maximoCitasDia
     *
     * @return integer 
     */
    public function getMaximoCitasDia()
    {
        return $this->maximoCitasDia;
    }

    /**
     * Set maximoCitasTurno
     *
     * @param integer $maximoCitasTurno
     * @return RyxCtlConfiguracionAgenda
     */
    public function setMaximoCitasTurno($maximoCitasTurno)
    {
        $this->maximoCitasTurno = $maximoCitasTurno;

        return $this;
    }

    /**
     * Get maximoCitasTurno
     *
     * @return integer 
     */
    public function getMaximoCitasTurno()
    {
        return $this->maximoCitasTurno;
    }

    /**
     * Set maximoCitasHora
     *
     * @param integer $maximoCitasHora
     * @return RyxCtlConfiguracionAgenda
     */
    public function setMaximoCitasHora($maximoCitasHora)
    {
        $this->maximoCitasHora = $maximoCitasHora;

        return $this;
    }

    /**
     * Get maximoCitasHora
     *
     * @return integer 
     */
    public function getMaximoCitasHora()
    {
        return $this->maximoCitasHora;
    }

    /**
     * Set maximoCitasMedico
     *
     * @param integer $maximoCitasMedico
     * @return RyxCtlConfiguracionAgenda
     */
    public function setMaximoCitasMedico($maximoCitasMedico)
    {
        $this->maximoCitasMedico = $maximoCitasMedico;

        return $this;
    }

    /**
     * Get maximoCitasMedico
     *
     * @return integer 
     */
    public function getMaximoCitasMedico()
    {
        return $this->maximoCitasMedico;
    }

    /**
     * Set idAreaExamenEstab
     *
     * @param \Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab
     * @return RyxCtlConfiguracionAgenda
     */
    public function setIdAreaExamenEstab(\Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab = null)
    {
        $this->idAreaExamenEstab = $idAreaExamenEstab;

        return $this;
    }

    /**
     * Get idAreaExamenEstab
     *
     * @return \Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento 
     */
    public function getIdAreaExamenEstab()
    {
        return $this->idAreaExamenEstab;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxCtlConfiguracionAgenda
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return RyxCtlConfiguracionAgenda
     */
    public function setIdUserReg(\Application\Sonata\UserBundle\Entity\User $idUserReg = null)
    {
        $this->idUserReg = $idUserReg;

        return $this;
    }

    /**
     * Get idUserReg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserReg()
    {
        return $this->idUserReg;
    }
}
