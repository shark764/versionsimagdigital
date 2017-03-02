<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxDatoAutocomplemento
 *
 * @ORM\Table(name="ryx_dato_autocomplemento", indexes={@ORM\Index(name="IDX_FDAC171D992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_FDAC171D926EE634", columns={"id_campo_autocomplementar"})})
 * @ORM\Entity
 */
class RyxDatoAutocomplemento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_dato_autocomplemento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dato", type="string", length=100, nullable=false)
     */
    private $dato;

    /**
     * @var \CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico", referencedColumnName="id")
     * })
     */
    private $idAreaServicioDiagnostico;

    /**
     * @var \RyxCtlCampoAutocomplementar
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlCampoAutocomplementar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_campo_autocomplementar", referencedColumnName="id")
     * })
     */
    private $idCampoAutocomplementar;

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