<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxDatoAutocomplemento
 *
 * @ORM\Table(name="ryx_dato_autocomplemento", indexes={@ORM\Index(name="IDX_FDAC171D992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_FDAC171D926EE634", columns={"id_campo_autocomplementar"})})
 * @ORM\Entity
 */
class RyxDatoAutocomplemento implements EntityInterface
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
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
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
     * @Assert\NotNull(message = "foreign.default.not_null")
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
        return $this->dato ? $this->dato : '';
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
     * Set dato
     *
     * @param string $dato
     * @return RyxDatoAutocomplemento
     */
    public function setDato($dato)
    {
        $this->dato = $dato;

        return $this;
    }

    /**
     * Get dato
     *
     * @return string 
     */
    public function getDato()
    {
        return $this->dato;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return RyxDatoAutocomplemento
     */
    public function setIdAreaServicioDiagnostico(\Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico = null)
    {
        $this->idAreaServicioDiagnostico = $idAreaServicioDiagnostico;

        return $this;
    }

    /**
     * Get idAreaServicioDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico 
     */
    public function getIdAreaServicioDiagnostico()
    {
        return $this->idAreaServicioDiagnostico;
    }

    /**
     * Set idCampoAutocomplementar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlCampoAutocomplementar $idCampoAutocomplementar
     * @return RyxDatoAutocomplemento
     */
    public function setIdCampoAutocomplementar(\Minsal\SimagdBundle\Entity\RyxCtlCampoAutocomplementar $idCampoAutocomplementar = null)
    {
        $this->idCampoAutocomplementar = $idCampoAutocomplementar;

        return $this;
    }

    /**
     * Get idCampoAutocomplementar
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlCampoAutocomplementar 
     */
    public function getIdCampoAutocomplementar()
    {
        return $this->idCampoAutocomplementar;
    }
}
