<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxSolicitudEstudioMamografiaSintomatologia
 *
 * @ORM\Table(name="ryx_solicitud_estudio_mamografia_sintomatologia", indexes={@ORM\Index(name="IDX_FE16792D1D6974AC", columns={"id_solicitud_estudio_mamografia"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudioMamografiaSintomatologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_mamografia_sintomatologia_id_seq", allocationSize=1, initialValue=1)
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
     * @var \RyxSolicitudEstudioMamografia
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudioMamografia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_mamografia", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioMamografia;

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