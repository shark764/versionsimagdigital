<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgDatoAutocomplemento
 *
 * @ORM\Table(name="img_dato_autocomplemento", indexes={@ORM\Index(name="IDX_7C978868926EE634", columns={"id_campo_autocomplementar"}), @ORM\Index(name="IDX_7C978868992127D5", columns={"id_area_servicio_diagnostico"})})
 * @ORM\Entity
 */
class ImgDatoAutocomplemento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_dato_autocomplemento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dato", type="string", length=100, nullable=false)
     */
    private $dato;

    /**
     * @var \ImgCtlCampoAutocomplementar
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlCampoAutocomplementar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_campo_autocomplementar", referencedColumnName="id")
     * })
     */
    private $idCampoAutocomplementar;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico", referencedColumnName="id")
     * })
     */
    private $idAreaServicioDiagnostico;

    public function __toString() {
        return $this->dato ? $this->dato : '';
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
     * @return ImgDatoAutocomplemento
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
     * Set idCampoAutocomplementar
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlCampoAutocomplementar $idCampoAutocomplementar
     * @return ImgDatoAutocomplemento
     */
    public function setIdCampoAutocomplementar(\Minsal\SimagdBundle\Entity\ImgCtlCampoAutocomplementar $idCampoAutocomplementar = null)
    {
        $this->idCampoAutocomplementar = $idCampoAutocomplementar;

        return $this;
    }

    /**
     * Get idCampoAutocomplementar
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlCampoAutocomplementar 
     */
    public function getIdCampoAutocomplementar()
    {
        return $this->idCampoAutocomplementar;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return ImgDatoAutocomplemento
     */
    public function setIdAreaServicioDiagnostico(\Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico = null)
    {
        $this->idAreaServicioDiagnostico = $idAreaServicioDiagnostico;

        return $this;
    }

    /**
     * Get idAreaServicioDiagnostico
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico 
     */
    public function getIdAreaServicioDiagnostico()
    {
        return $this->idAreaServicioDiagnostico;
    }
}
