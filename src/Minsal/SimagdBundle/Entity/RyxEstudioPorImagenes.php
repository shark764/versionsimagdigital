<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxEstudioPorImagenes
 *
 * @ORM\Table(name="ryx_estudio_por_imagenes", indexes={@ORM\Index(name="IDX_AB43E1E67DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_AB43E1E6F485B2E3", columns={"id_estudio_padre"}), @ORM\Index(name="IDX_AB43E1E6701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_AB43E1E633CCFAF2", columns={"id_expediente_ficticio"}), @ORM\Index(name="IDX_AB43E1E69E9497EB", columns={"id_procedimiento_realizado"})})
 * @ORM\Entity
 */
class RyxEstudioPorImagenes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_estudio_por_imagenes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_estudio", type="datetime", nullable=true)
     */
    private $fechaEstudio = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="estudio_uid", type="text", nullable=false)
     */
    private $estudioUid;

    /**
     * @var string
     *
     * @ORM\Column(name="series_uid", type="text", nullable=false)
     */
    private $seriesUid;

    /**
     * @var string
     *
     * @ORM\Column(name="servidor", type="string", nullable=true)
     */
    private $servidor = 'MINSAL';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="eliminado_en_pacs", type="boolean", nullable=true)
     */
    private $eliminadoEnPacs = false;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \RyxEstudioPorImagenes
     *
     * @ORM\ManyToOne(targetEntity="RyxEstudioPorImagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio_padre", referencedColumnName="id")
     * })
     */
    private $idEstudioPadre;

    /**
     * @var \MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

    /**
     * @var \RyxExpedienteFicticio
     *
     * @ORM\ManyToOne(targetEntity="RyxExpedienteFicticio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente_ficticio", referencedColumnName="id")
     * })
     */
    private $idExpedienteFicticio;

    /**
     * @var \RyxProcedimientoRadiologicoRealizado
     *
     * @ORM\ManyToOne(targetEntity="RyxProcedimientoRadiologicoRealizado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_realizado", referencedColumnName="id")
     * })
     */
    private $idProcedimientoRealizado;


}
