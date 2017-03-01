<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxSolicitudEstudio
 *
 * @ORM\Table(name="ryx_solicitud_estudio", indexes={@ORM\Index(name="IDX_FB3FA449992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_FB3FA4498627A85B", columns={"id_aten_area_mod_estab"}), @ORM\Index(name="IDX_FB3FA449890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_FB3FA4499C29FA00", columns={"id_establecimiento_diagnosticante"}), @ORM\Index(name="IDX_FB3FA44950AC6C0", columns={"id_establecimiento_referido"}), @ORM\Index(name="IDX_FB3FA449AB124167", columns={"id_estado_solicitud"}), @ORM\Index(name="IDX_FB3FA44933CCFAF2", columns={"id_expediente_ficticio"}), @ORM\Index(name="IDX_FB3FA449701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_FB3FA44933DDBCDD", columns={"id_forma_contacto"}), @ORM\Index(name="IDX_FB3FA4491F3E256A", columns={"id_contacto_paciente"}), @ORM\Index(name="IDX_FB3FA4497E7CB1E8", columns={"id_prioridad_atencion"}), @ORM\Index(name="IDX_FB3FA4495DA5A9A5", columns={"id_radiologo_agrega_indicaciones"}), @ORM\Index(name="IDX_FB3FA449F8EAA696", columns={"id_solicitudestudios"}), @ORM\Index(name="IDX_FB3FA449AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_FB3FA449D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_clinicos", type="string", length=150, nullable=true)
     */
    private $datosClinicos;

    /**
     * @var string
     *
     * @ORM\Column(name="consulta_por", type="string", length=255, nullable=true)
     */
    private $consultaPor;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_clinico", type="string", length=50, nullable=true)
     */
    private $estadoClinico;

    /**
     * @var string
     *
     * @ORM\Column(name="hipotesis_diagnostica", type="string", length=100, nullable=true)
     */
    private $hipotesisDiagnostica;

    /**
     * @var string
     *
     * @ORM\Column(name="investigando", type="string", length=150, nullable=true)
     */
    private $investigando;

    /**
     * @var string
     *
     * @ORM\Column(name="antecedentes_clinicos_relevantes", type="text", nullable=true)
     */
    private $antecedentesClinicosRelevantes;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_medica", type="string", length=150, nullable=true)
     */
    private $justificacionMedica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion = '(now())::timestamp(0) without time zone';

    /**
     * @var boolean
     *
     * @ORM\Column(name="referir_paciente", type="boolean", nullable=true)
     */
    private $referirPaciente = false;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_referencia", type="string", length=255, nullable=true)
     */
    private $justificacionReferencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_proxima_consulta", type="date", nullable=true)
     */
    private $fechaProximaConsulta;

    /**
     * @var boolean
     *
     * @ORM\Column(name="requiere_cita", type="boolean", nullable=true)
     */
    private $requiereCita = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="requiere_diagnostico", type="boolean", nullable=true)
     */
    private $requiereDiagnostico = false;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_diagnostico", type="string", length=255, nullable=true)
     */
    private $justificacionDiagnostico;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paciente_ambulatorio", type="boolean", nullable=true)
     */
    private $pacienteAmbulatorio = true;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_sala", type="integer", nullable=true)
     */
    private $numeroSala;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_cama", type="integer", nullable=true)
     */
    private $numeroCama;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paciente_desconocido", type="boolean", nullable=true)
     */
    private $pacienteDesconocido = false;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_actual_lb", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $pesoActualLb;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_actual_kg", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $pesoActualKg;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_paciente", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $tallaPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=75, nullable=true)
     */
    private $contacto = 'No posee';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_contacto", type="string", length=75, nullable=true)
     */
    private $nombreContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones_medico_radiologo", type="text", nullable=true)
     */
    private $indicacionesMedicoRadiologo;

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
     * @var \MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aten_area_mod_estab", referencedColumnName="id")
     * })
     */
    private $idAtenAreaModEstab;

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
     *   @ORM\JoinColumn(name="id_establecimiento_diagnosticante", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoDiagnosticante;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_referido", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoReferido;

    /**
     * @var \RyxCtlEstadoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_solicitud", referencedColumnName="id")
     * })
     */
    private $idEstadoSolicitud;

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
     * @var \RyxCtlFormaContacto
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlFormaContacto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_forma_contacto", referencedColumnName="id")
     * })
     */
    private $idFormaContacto;

    /**
     * @var \CtlParentesco
     *
     * @ORM\ManyToOne(targetEntity="CtlParentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contacto_paciente", referencedColumnName="id")
     * })
     */
    private $idContactoPaciente;

    /**
     * @var \RyxCtlPrioridadAtencionPaciente
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlPrioridadAtencionPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prioridad_atencion", referencedColumnName="id")
     * })
     */
    private $idPrioridadAtencion;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_agrega_indicaciones", referencedColumnName="id")
     * })
     */
    private $idRadiologoAgregaIndicaciones;

    /**
     * @var \SecSolicitudestudios
     *
     * @ORM\ManyToOne(targetEntity="SecSolicitudestudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitudestudios", referencedColumnName="id")
     * })
     */
    private $idSolicitudestudios;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

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
