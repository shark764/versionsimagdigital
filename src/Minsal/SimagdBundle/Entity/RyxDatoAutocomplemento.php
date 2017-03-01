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


}
