<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxExclusionBloqueo
 *
 * @ORM\Table(name="ryx_exclusion_bloqueo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_radiologo_bloqueo", columns={"id_radiologo_excluido", "id_bloqueo_agenda"})}, indexes={@ORM\Index(name="IDX_AC86B68137A05A00", columns={"id_bloqueo_agenda"}), @ORM\Index(name="IDX_AC86B681B781D14A", columns={"id_radiologo_excluido"})})
 * @ORM\Entity
 */
class RyxExclusionBloqueo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_exclusion_bloqueo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \RyxBloqueoAgenda
     *
     * @ORM\ManyToOne(targetEntity="RyxBloqueoAgenda", inversedBy="bloqueoExclusionesBloqueo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bloqueo_agenda", referencedColumnName="id")
     * })
     */
    private $idBloqueoAgenda;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_excluido", referencedColumnName="id")
     * })
     */
    private $idRadiologoExcluido;

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
        return (string) $this->$idBloqueoAgenda . ' :: ' . $this->$idRadiologoExcluido;
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
     * Set idBloqueoAgenda
     *
     * @param \Minsal\SimagdBundle\Entity\RyxBloqueoAgenda $idBloqueoAgenda
     * @return RyxExclusionBloqueo
     */
    public function setIdBloqueoAgenda(\Minsal\SimagdBundle\Entity\RyxBloqueoAgenda $idBloqueoAgenda = null)
    {
        $this->idBloqueoAgenda = $idBloqueoAgenda;

        return $this;
    }

    /**
     * Get idBloqueoAgenda
     *
     * @return \Minsal\SimagdBundle\Entity\RyxBloqueoAgenda 
     */
    public function getIdBloqueoAgenda()
    {
        return $this->idBloqueoAgenda;
    }

    /**
     * Set idRadiologoExcluido
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoExcluido
     * @return RyxExclusionBloqueo
     */
    public function setIdRadiologoExcluido(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoExcluido = null)
    {
        $this->idRadiologoExcluido = $idRadiologoExcluido;

        return $this;
    }

    /**
     * Get idRadiologoExcluido
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoExcluido()
    {
        return $this->idRadiologoExcluido;
    }
}
