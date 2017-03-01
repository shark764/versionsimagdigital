<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxLecturaRadiologica
 *
 * @ORM\Table(name="ryx_lectura_radiologica", indexes={@ORM\Index(name="IDX_A2CC7AB6890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_A2CC7AB67DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_A2CC7AB6D93DAF86", columns={"id_estado_lectura"}), @ORM\Index(name="IDX_A2CC7AB66196B359", columns={"id_estudio"}), @ORM\Index(name="IDX_A2CC7AB633CCFAF2", columns={"id_expediente_ficticio"}), @ORM\Index(name="IDX_A2CC7AB6701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_A2CC7AB6F80B40A", columns={"id_patron_asociado"}), @ORM\Index(name="IDX_A2CC7AB663643B18", columns={"id_radiologo_designado_aprobacion"}), @ORM\Index(name="IDX_A2CC7AB64E924116", columns={"id_radiologo_solicita"}), @ORM\Index(name="IDX_A2CC7AB6526C8D52", columns={"id_solicitud_diagnostico"}), @ORM\Index(name="IDX_A2CC7AB6D426DB54", columns={"id_tipo_resultado"}), @ORM\Index(name="IDX_A2CC7AB6CC6E65C8", columns={"id_transcriptor_asignado"}), @ORM\Index(name="IDX_A2CC7AB6D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxLecturaRadiologica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_lectura_radiologica_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="correlativo", type="string", nullable=true)
     */
    private $correlativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_lectura", type="datetime", nullable=true)
     */
    private $fechaLectura = '(now())::timestamp(0) without time zone';

    /**
     * @var boolean
     *
     * @ORM\Column(name="lectura_remota", type="boolean", nullable=true)
     */
    private $lecturaRemota = false;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones", type="string", length=255, nullable=true)
     */
    private $indicaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var boolean
     *
     * @ORM\Column(name="solicitada_por_radiologo", type="boolean", nullable=true)
     */
    private $solicitadaPorRadiologo = false;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

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
     * @var \RyxCtlEstadoLectura
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoLectura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_lectura", referencedColumnName="id")
     * })
     */
    private $idEstadoLectura;

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
     * @var \RyxExpedienteFicticio
     *
     * @ORM\ManyToOne(targetEntity="RyxExpedienteFicticio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente_ficticio", referencedColumnName="id")
     * })
     */
    private $idExpedienteFicticio;

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
     * @var \RyxCtlPatronDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlPatronDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patron_asociado", referencedColumnName="id")
     * })
     */
    private $idPatronAsociado;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_designado_aprobacion", referencedColumnName="id")
     * })
     */
    private $idRadiologoDesignadoAprobacion;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_solicita", referencedColumnName="id")
     * })
     */
    private $idRadiologoSolicita;

    /**
     * @var \RyxSolicitudDiagnosticoPostEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudDiagnosticoPostEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_diagnostico", referencedColumnName="id")
     * })
     */
    private $idSolicitudDiagnostico;

    /**
     * @var \RyxCtlTipoRespuestaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlTipoRespuestaRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_resultado", referencedColumnName="id")
     * })
     */
    private $idTipoResultado;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_transcriptor_asignado", referencedColumnName="id")
     * })
     */
    private $idTranscriptorAsignado;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;


}
