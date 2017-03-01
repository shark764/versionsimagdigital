<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxEstudioPendienteLectura
 *
 * @ORM\Table(name="ryx_estudio_pendiente_lectura", indexes={@ORM\Index(name="IDX_3EC4D3688AAAED82", columns={"id_asigna_radiologo"}), @ORM\Index(name="IDX_3EC4D3687DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_3EC4D3686196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_3EC4D368C7F5B193", columns={"id_radiologo_anexa"}), @ORM\Index(name="IDX_3EC4D3686E8C181B", columns={"id_radiologo_asignado"}), @ORM\Index(name="IDX_3EC4D368526C8D52", columns={"id_solicitud_diagnostico"})})
 * @ORM\Entity
 */
class RyxEstudioPendienteLectura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_estudio_pendiente_lectura_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso_lista", type="datetime", nullable=true)
     */
    private $fechaIngresoLista = '(now())::timestamp(0) without time zone';

    /**
     * @var boolean
     *
     * @ORM\Column(name="solicitud_post_estudio", type="boolean", nullable=true)
     */
    private $solicitudPostEstudio = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="anexado_por_radiologo", type="boolean", nullable=true)
     */
    private $anexadoPorRadiologo = false;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_radiologo", referencedColumnName="id")
     * })
     */
    private $idAsignaRadiologo;

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
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_anexa", referencedColumnName="id")
     * })
     */
    private $idRadiologoAnexa;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_asignado", referencedColumnName="id")
     * })
     */
    private $idRadiologoAsignado;

    /**
     * @var \RyxSolicitudDiagnosticoPostEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudDiagnosticoPostEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_diagnostico", referencedColumnName="id")
     * })
     */
    private $idSolicitudDiagnostico;


}
