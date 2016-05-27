<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlConfiguracionAgenda
 *
 * @ORM\Table(name="img_ctl_configuracion_agenda", indexes={@ORM\Index(name="IDX_16E64C79A7750BE9", columns={"id_area_examen_estab"}), @ORM\Index(name="IDX_16E64C79AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_16E64C79D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class ImgCtlConfiguracionAgenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_configuracion_agenda_id_seq", allocationSize=1, initialValue=1)
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
     * @var \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento")
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
     */
    private $idUserReg;

    public function __toString() {
        return 'Parámetros de: ' . $this->idAreaExamenEstab;
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
     * @return ImgCtlConfiguracionAgenda
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
     * @return ImgCtlConfiguracionAgenda
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
     * @return ImgCtlConfiguracionAgenda
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
     * @return ImgCtlConfiguracionAgenda
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
     * @param \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab
     * @return ImgCtlConfiguracionAgenda
     */
    public function setIdAreaExamenEstab(\Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento $idAreaExamenEstab = null)
    {
        $this->idAreaExamenEstab = $idAreaExamenEstab;

        return $this;
    }

    /**
     * Get idAreaExamenEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento 
     */
    public function getIdAreaExamenEstab()
    {
        return $this->idAreaExamenEstab;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return ImgCtlConfiguracionAgenda
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
     * @return ImgCtlConfiguracionAgenda
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