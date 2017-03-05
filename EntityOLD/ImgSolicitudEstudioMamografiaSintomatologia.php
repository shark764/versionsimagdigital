<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgSolicitudEstudioMamografiaSintomatologia
 *
 * @ORM\Table(name="img_solicitud_estudio_mamografia_sintomatologia", indexes={@ORM\Index(name="IDX_D5B2758B1D6974AC", columns={"id_solicitud_estudio_mamografia"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxSolicitudEstudioMamografiaSintomatologiaRepository")
 */
class ImgSolicitudEstudioMamografiaSintomatologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_solicitud_estudio_mamografia_sintomatologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dolor_o_malestar", type="string", nullable=false)
     */
    private $dolorOMalestar = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="masa_o_abultamiento", type="string", nullable=false)
     */
    private $masaOAbultamiento = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="retraccion_del_pezon", type="string", nullable=false)
     */
    private $retraccionDelPezon = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="lesion_en_piel_o_engrosamiento", type="string", nullable=false)
     */
    private $lesionEnPielOEngrosamiento = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="manchas_o_cambio_coloracion", type="string", nullable=false)
     */
    private $manchasOCambioColoracion = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="comezon", type="string", nullable=false)
     */
    private $comezon = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="secrecion", type="string", nullable=false)
     */
    private $secrecion = 'N';

    /**
     * @var \ImgSolicitudEstudioMamografia
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudioMamografia", inversedBy="solicitudEstudioMamografiaSintomatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_mamografia", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioMamografia;

    public function __toString()
    {
    /*
     * Relativo al malestar o problema presentado en cada mama, ninguna o ambas
     */
        return 'Dolor o malestar en mama: ' . $this->getMeaningTextByCode($this->dolorOMalestar);
    }

    /*
     * significado del código char(1)
     */
    public function getMeaningTextByCode($code)
    {
    /*
     * Retornar la descripción que representa el código, Mama Izquierda|Derecha|Ambas|Ninguna
     */
        return $code === 'I' ? 'Izquierda'
            : ($code === 'D' ? 'Derecha'
                : ($code === 'A' ? 'Izquierda y Derecha' : 'Ninguna'));
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
     * Set dolorOMalestar
     *
     * @param string $dolorOMalestar
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setDolorOMalestar($dolorOMalestar)
    {
        $this->dolorOMalestar = $dolorOMalestar;

        return $this;
    }

    /**
     * Get dolorOMalestar
     *
     * @return string 
     */
    public function getDolorOMalestar()
    {
        return $this->dolorOMalestar;
    }

    /**
     * Set masaOAbultamiento
     *
     * @param string $masaOAbultamiento
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setMasaOAbultamiento($masaOAbultamiento)
    {
        $this->masaOAbultamiento = $masaOAbultamiento;

        return $this;
    }

    /**
     * Get masaOAbultamiento
     *
     * @return string 
     */
    public function getMasaOAbultamiento()
    {
        return $this->masaOAbultamiento;
    }

    /**
     * Set retraccionDelPezon
     *
     * @param string $retraccionDelPezon
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setRetraccionDelPezon($retraccionDelPezon)
    {
        $this->retraccionDelPezon = $retraccionDelPezon;

        return $this;
    }

    /**
     * Get retraccionDelPezon
     *
     * @return string 
     */
    public function getRetraccionDelPezon()
    {
        return $this->retraccionDelPezon;
    }

    /**
     * Set lesionEnPielOEngrosamiento
     *
     * @param string $lesionEnPielOEngrosamiento
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setLesionEnPielOEngrosamiento($lesionEnPielOEngrosamiento)
    {
        $this->lesionEnPielOEngrosamiento = $lesionEnPielOEngrosamiento;

        return $this;
    }

    /**
     * Get lesionEnPielOEngrosamiento
     *
     * @return string 
     */
    public function getLesionEnPielOEngrosamiento()
    {
        return $this->lesionEnPielOEngrosamiento;
    }

    /**
     * Set manchasOCambioColoracion
     *
     * @param string $manchasOCambioColoracion
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setManchasOCambioColoracion($manchasOCambioColoracion)
    {
        $this->manchasOCambioColoracion = $manchasOCambioColoracion;

        return $this;
    }

    /**
     * Get manchasOCambioColoracion
     *
     * @return string 
     */
    public function getManchasOCambioColoracion()
    {
        return $this->manchasOCambioColoracion;
    }

    /**
     * Set comezon
     *
     * @param string $comezon
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setComezon($comezon)
    {
        $this->comezon = $comezon;

        return $this;
    }

    /**
     * Get comezon
     *
     * @return string 
     */
    public function getComezon()
    {
        return $this->comezon;
    }

    /**
     * Set secrecion
     *
     * @param string $secrecion
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setSecrecion($secrecion)
    {
        $this->secrecion = $secrecion;

        return $this;
    }

    /**
     * Get secrecion
     *
     * @return string 
     */
    public function getSecrecion()
    {
        return $this->secrecion;
    }

    /**
     * Set idSolicitudEstudioMamografia
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioMamografia $idSolicitudEstudioMamografia
     * @return ImgSolicitudEstudioMamografiaSintomatologia
     */
    public function setIdSolicitudEstudioMamografia(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudioMamografia $idSolicitudEstudioMamografia = null)
    {
        $this->idSolicitudEstudioMamografia = $idSolicitudEstudioMamografia;

        return $this;
    }

    /**
     * Get idSolicitudEstudioMamografia
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioMamografia 
     */
    public function getIdSolicitudEstudioMamografia()
    {
        return $this->idSolicitudEstudioMamografia;
    }
}
