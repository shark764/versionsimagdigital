<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="RyxBloqueoAgenda")
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
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
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

}