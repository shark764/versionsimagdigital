<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxSolicitudEstudio
 *
 * @ORM\Table(name="ryx_solicitud_estudio", indexes={@ORM\Index(name="IDX_FB3FA449992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_FB3FA4498627A85B", columns={"id_aten_area_mod_estab"}), @ORM\Index(name="IDX_FB3FA449890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_FB3FA4499C29FA00", columns={"id_establecimiento_diagnosticante"}), @ORM\Index(name="IDX_FB3FA44950AC6C0", columns={"id_establecimiento_referido"}), @ORM\Index(name="IDX_FB3FA449AB124167", columns={"id_estado_solicitud"}), @ORM\Index(name="IDX_FB3FA44933CCFAF2", columns={"id_expediente_ficticio"}), @ORM\Index(name="IDX_FB3FA449701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_FB3FA44933DDBCDD", columns={"id_forma_contacto"}), @ORM\Index(name="IDX_FB3FA4491F3E256A", columns={"id_contacto_paciente"}), @ORM\Index(name="IDX_FB3FA4497E7CB1E8", columns={"id_prioridad_atencion"}), @ORM\Index(name="IDX_FB3FA4495DA5A9A5", columns={"id_radiologo_agrega_indicaciones"}), @ORM\Index(name="IDX_FB3FA449F8EAA696", columns={"id_solicitudestudios"}), @ORM\Index(name="IDX_FB3FA449AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_FB3FA449D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxSolicitudEstudioRepository")
 */
class RyxSolicitudEstudio implements EntityInterface
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $datosClinicos;

    /**
     * @var string
     *
     * @ORM\Column(name="consulta_por", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $consultaPor;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_clinico", type="string", length=50, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $estadoClinico;

    /**
     * @var string
     *
     * @ORM\Column(name="hipotesis_diagnostica", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $hipotesisDiagnostica;

    /**
     * @var string
     *
     * @ORM\Column(name="investigando", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $investigando;

    /**
     * @var string
     *
     * @ORM\Column(name="antecedentes_clinicos_relevantes", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $antecedentesClinicosRelevantes;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_medica", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $justificacionMedica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     * @Assert\DateTime()
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $justificacionReferencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_proxima_consulta", type="date", nullable=true)
     * @Assert\Date()
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $contacto = 'No posee';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_contacto", type="string", length=75, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombreContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones_medico_radiologo", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $indicacionesMedicoRadiologo;

    /**
     * @var \CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAreaServicioDiagnostico;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aten_area_mod_estab", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAtenAreaModEstab;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEmpleado;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_diagnosticante", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoDiagnosticante;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_referido", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimientoReferido;

    /**
     * @var \RyxCtlEstadoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_solicitud", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @var \Minsal\SiapsBundle\Entity\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
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
     * @var \Minsal\SiapsBundle\Entity\CtlParentesco
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlParentesco")
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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idPrioridadAtencion;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_agrega_indicaciones", referencedColumnName="id")
     * })
     */
    private $idRadiologoAgregaIndicaciones;

    /**
     * @var \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SeguimientoBundle\Entity\SecSolicitudestudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitudestudios", referencedColumnName="id")
     * })
     */
    private $idSolicitudestudios;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idUserReg;

    /**
     * @ORM\ManyToMany(targetEntity="RyxCtlProyeccionRadiologica")
     * @ORM\JoinTable(name="ryx_solicitud_estudio_proyeccion",
     *      joinColumns={@ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_proyeccion_solicitada", referencedColumnName="id")}
     * )
     */
    private $solicitudEstudioProyeccion;

    /**
     * @ORM\OneToMany(targetEntity="RyxCitaProgramada", mappedBy="idSolicitudEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $solicitudEstudioCitas;

    /**
     * @ORM\OneToMany(targetEntity="RyxProcedimientoRadiologicoRealizado", mappedBy="idSolicitudEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $solicitudEstudioProcedimientosRealizados;

    /**
     * @ORM\OneToMany(targetEntity="RyxSolicitudEstudioComplementario", mappedBy="idSolicitudEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $solicitudEstudioSolicitudesEstudioComplementario;

    /**
     * @ORM\OneToMany(targetEntity="RyxSolicitudDiagnosticoPostEstudio", mappedBy="idSolicitudEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $solicitudEstudioSolicitudesDiagnostico;

    /**
     * @ORM\OneToMany(targetEntity="RyxExamenPendienteRealizacion", mappedBy="idSolicitudEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $solicitudEstudioExamenPendienteRealizar;

    /**
     * @ORM\OneToMany(targetEntity="RyxSolicitudEstudioMamografia", mappedBy="idSolicitudEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $solicitudEstudioMamografia;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solicitudEstudioProyeccion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitudEstudioCitas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitudEstudioProcedimientosRealizados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitudEstudioSolicitudesEstudioComplementario = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitudEstudioSolicitudesDiagnostico = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitudEstudioExamenPendienteRealizar = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solicitudEstudioMamografia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        if ($this->idExpediente)
        {
            return 'Solicitud de: ' . $this->idExpediente->getNumero() . ' / ' . $this->idExpediente->getIdPaciente() . ' / ' . $this->datosClinicos;
        } elseif ($this->idExpedienteFicticio)
        {
            return 'Solicitud de: ' . $this->idExpedienteFicticio->getNumero() . ' / ' . $this->idExpedienteFicticio->getNombreFicticio() . ' / ' . $this->datosClinicos;
        } else {
            return $this->datosClinicos ? $this->datosClinicos : '';
        }
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
    
    public function getStudyCustomDescription()
    {
        $description    = '';
        foreach ($this->getSolicitudEstudioProyeccion() as $projection_examined)  {
            $description    .= mb_strtoupper(trim($projection_examined->getNombre()), 'utf-8') . ', ';
        }
        return trim($description, '\t\n , \t\n');
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
     * Set datosClinicos
     *
     * @param string $datosClinicos
     * @return RyxSolicitudEstudio
     */
    public function setDatosClinicos($datosClinicos)
    {
        $this->datosClinicos = $datosClinicos;

        return $this;
    }

    /**
     * Get datosClinicos
     *
     * @return string 
     */
    public function getDatosClinicos()
    {
        return $this->datosClinicos;
    }

    /**
     * Set consultaPor
     *
     * @param string $consultaPor
     * @return RyxSolicitudEstudio
     */
    public function setConsultaPor($consultaPor)
    {
        $this->consultaPor = $consultaPor;

        return $this;
    }

    /**
     * Get consultaPor
     *
     * @return string 
     */
    public function getConsultaPor()
    {
        return $this->consultaPor;
    }

    /**
     * Set estadoClinico
     *
     * @param string $estadoClinico
     * @return RyxSolicitudEstudio
     */
    public function setEstadoClinico($estadoClinico)
    {
        $this->estadoClinico = $estadoClinico;

        return $this;
    }

    /**
     * Get estadoClinico
     *
     * @return string 
     */
    public function getEstadoClinico()
    {
        return $this->estadoClinico;
    }

    /**
     * Set hipotesisDiagnostica
     *
     * @param string $hipotesisDiagnostica
     * @return RyxSolicitudEstudio
     */
    public function setHipotesisDiagnostica($hipotesisDiagnostica)
    {
        $this->hipotesisDiagnostica = $hipotesisDiagnostica;

        return $this;
    }

    /**
     * Get hipotesisDiagnostica
     *
     * @return string 
     */
    public function getHipotesisDiagnostica()
    {
        return $this->hipotesisDiagnostica;
    }

    /**
     * Set investigando
     *
     * @param string $investigando
     * @return RyxSolicitudEstudio
     */
    public function setInvestigando($investigando)
    {
        $this->investigando = $investigando;

        return $this;
    }

    /**
     * Get investigando
     *
     * @return string 
     */
    public function getInvestigando()
    {
        return $this->investigando;
    }

    /**
     * Set antecedentesClinicosRelevantes
     *
     * @param string $antecedentesClinicosRelevantes
     * @return RyxSolicitudEstudio
     */
    public function setAntecedentesClinicosRelevantes($antecedentesClinicosRelevantes)
    {
        $this->antecedentesClinicosRelevantes = $antecedentesClinicosRelevantes;

        return $this;
    }

    /**
     * Get antecedentesClinicosRelevantes
     *
     * @return string 
     */
    public function getAntecedentesClinicosRelevantes()
    {
        return $this->antecedentesClinicosRelevantes;
    }

    /**
     * Set justificacionMedica
     *
     * @param string $justificacionMedica
     * @return RyxSolicitudEstudio
     */
    public function setJustificacionMedica($justificacionMedica)
    {
        $this->justificacionMedica = $justificacionMedica;

        return $this;
    }

    /**
     * Get justificacionMedica
     *
     * @return string 
     */
    public function getJustificacionMedica()
    {
        return $this->justificacionMedica;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return RyxSolicitudEstudio
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set referirPaciente
     *
     * @param boolean $referirPaciente
     * @return RyxSolicitudEstudio
     */
    public function setReferirPaciente($referirPaciente)
    {
        $this->referirPaciente = $referirPaciente;

        return $this;
    }

    /**
     * Get referirPaciente
     *
     * @return boolean 
     */
    public function getReferirPaciente()
    {
        return $this->referirPaciente;
    }

    /**
     * Set justificacionReferencia
     *
     * @param string $justificacionReferencia
     * @return RyxSolicitudEstudio
     */
    public function setJustificacionReferencia($justificacionReferencia)
    {
        $this->justificacionReferencia = $justificacionReferencia;

        return $this;
    }

    /**
     * Get justificacionReferencia
     *
     * @return string 
     */
    public function getJustificacionReferencia()
    {
        return $this->justificacionReferencia;
    }

    /**
     * Set fechaProximaConsulta
     *
     * @param \DateTime $fechaProximaConsulta
     * @return RyxSolicitudEstudio
     */
    public function setFechaProximaConsulta($fechaProximaConsulta)
    {
        $this->fechaProximaConsulta = $fechaProximaConsulta;

        return $this;
    }

    /**
     * Get fechaProximaConsulta
     *
     * @return \DateTime 
     */
    public function getFechaProximaConsulta()
    {
        return $this->fechaProximaConsulta;
    }

    /**
     * Set requiereCita
     *
     * @param boolean $requiereCita
     * @return RyxSolicitudEstudio
     */
    public function setRequiereCita($requiereCita)
    {
        $this->requiereCita = $requiereCita;

        return $this;
    }

    /**
     * Get requiereCita
     *
     * @return boolean 
     */
    public function getRequiereCita()
    {
        return $this->requiereCita;
    }

    /**
     * Set requiereDiagnostico
     *
     * @param boolean $requiereDiagnostico
     * @return RyxSolicitudEstudio
     */
    public function setRequiereDiagnostico($requiereDiagnostico)
    {
        $this->requiereDiagnostico = $requiereDiagnostico;

        return $this;
    }

    /**
     * Get requiereDiagnostico
     *
     * @return boolean 
     */
    public function getRequiereDiagnostico()
    {
        return $this->requiereDiagnostico;
    }

    /**
     * Set justificacionDiagnostico
     *
     * @param string $justificacionDiagnostico
     * @return RyxSolicitudEstudio
     */
    public function setJustificacionDiagnostico($justificacionDiagnostico)
    {
        $this->justificacionDiagnostico = $justificacionDiagnostico;

        return $this;
    }

    /**
     * Get justificacionDiagnostico
     *
     * @return string 
     */
    public function getJustificacionDiagnostico()
    {
        return $this->justificacionDiagnostico;
    }

    /**
     * Set pacienteAmbulatorio
     *
     * @param boolean $pacienteAmbulatorio
     * @return RyxSolicitudEstudio
     */
    public function setPacienteAmbulatorio($pacienteAmbulatorio)
    {
        $this->pacienteAmbulatorio = $pacienteAmbulatorio;

        return $this;
    }

    /**
     * Get pacienteAmbulatorio
     *
     * @return boolean 
     */
    public function getPacienteAmbulatorio()
    {
        return $this->pacienteAmbulatorio;
    }

    /**
     * Set numeroSala
     *
     * @param integer $numeroSala
     * @return RyxSolicitudEstudio
     */
    public function setNumeroSala($numeroSala)
    {
        $this->numeroSala = $numeroSala;

        return $this;
    }

    /**
     * Get numeroSala
     *
     * @return integer 
     */
    public function getNumeroSala()
    {
        return $this->numeroSala;
    }

    /**
     * Set numeroCama
     *
     * @param integer $numeroCama
     * @return RyxSolicitudEstudio
     */
    public function setNumeroCama($numeroCama)
    {
        $this->numeroCama = $numeroCama;

        return $this;
    }

    /**
     * Get numeroCama
     *
     * @return integer 
     */
    public function getNumeroCama()
    {
        return $this->numeroCama;
    }

    /**
     * Set pacienteDesconocido
     *
     * @param boolean $pacienteDesconocido
     * @return RyxSolicitudEstudio
     */
    public function setPacienteDesconocido($pacienteDesconocido)
    {
        $this->pacienteDesconocido = $pacienteDesconocido;

        return $this;
    }

    /**
     * Get pacienteDesconocido
     *
     * @return boolean 
     */
    public function getPacienteDesconocido()
    {
        return $this->pacienteDesconocido;
    }

    /**
     * Set pesoActualLb
     *
     * @param string $pesoActualLb
     * @return RyxSolicitudEstudio
     */
    public function setPesoActualLb($pesoActualLb)
    {
        $this->pesoActualLb = $pesoActualLb;

        return $this;
    }

    /**
     * Get pesoActualLb
     *
     * @return string 
     */
    public function getPesoActualLb()
    {
        return $this->pesoActualLb;
    }

    /**
     * Set pesoActualKg
     *
     * @param string $pesoActualKg
     * @return RyxSolicitudEstudio
     */
    public function setPesoActualKg($pesoActualKg)
    {
        $this->pesoActualKg = $pesoActualKg;

        return $this;
    }

    /**
     * Get pesoActualKg
     *
     * @return string 
     */
    public function getPesoActualKg()
    {
        return $this->pesoActualKg;
    }

    /**
     * Set tallaPaciente
     *
     * @param string $tallaPaciente
     * @return RyxSolicitudEstudio
     */
    public function setTallaPaciente($tallaPaciente)
    {
        $this->tallaPaciente = $tallaPaciente;

        return $this;
    }

    /**
     * Get tallaPaciente
     *
     * @return string 
     */
    public function getTallaPaciente()
    {
        return $this->tallaPaciente;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     * @return RyxSolicitudEstudio
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string 
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set nombreContacto
     *
     * @param string $nombreContacto
     * @return RyxSolicitudEstudio
     */
    public function setNombreContacto($nombreContacto)
    {
        $this->nombreContacto = $nombreContacto;

        return $this;
    }

    /**
     * Get nombreContacto
     *
     * @return string 
     */
    public function getNombreContacto()
    {
        return $this->nombreContacto;
    }

    /**
     * Set indicacionesMedicoRadiologo
     *
     * @param string $indicacionesMedicoRadiologo
     * @return RyxSolicitudEstudio
     */
    public function setIndicacionesMedicoRadiologo($indicacionesMedicoRadiologo)
    {
        $this->indicacionesMedicoRadiologo = $indicacionesMedicoRadiologo;

        return $this;
    }

    /**
     * Get indicacionesMedicoRadiologo
     *
     * @return string 
     */
    public function getIndicacionesMedicoRadiologo()
    {
        return $this->indicacionesMedicoRadiologo;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return RyxSolicitudEstudio
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
     * Set idAtenAreaModEstab
     *
     * @param \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab
     * @return RyxSolicitudEstudio
     */
    public function setIdAtenAreaModEstab(\Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idAtenAreaModEstab = null)
    {
        $this->idAtenAreaModEstab = $idAtenAreaModEstab;

        return $this;
    }

    /**
     * Get idAtenAreaModEstab
     *
     * @return \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab 
     */
    public function getIdAtenAreaModEstab()
    {
        return $this->idAtenAreaModEstab;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return RyxSolicitudEstudio
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    /**
     * Set idEstablecimientoDiagnosticante
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoDiagnosticante
     * @return RyxSolicitudEstudio
     */
    public function setIdEstablecimientoDiagnosticante(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoDiagnosticante = null)
    {
        $this->idEstablecimientoDiagnosticante = $idEstablecimientoDiagnosticante;

        return $this;
    }

    /**
     * Get idEstablecimientoDiagnosticante
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstablecimientoDiagnosticante()
    {
        return $this->idEstablecimientoDiagnosticante;
    }

    /**
     * Set idEstablecimientoReferido
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoReferido
     * @return RyxSolicitudEstudio
     */
    public function setIdEstablecimientoReferido(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoReferido = null)
    {
        $this->idEstablecimientoReferido = $idEstablecimientoReferido;

        return $this;
    }

    /**
     * Get idEstablecimientoReferido
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstablecimientoReferido()
    {
        return $this->idEstablecimientoReferido;
    }

    /**
     * Set idEstadoSolicitud
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlEstadoSolicitud $idEstadoSolicitud
     * @return RyxSolicitudEstudio
     */
    public function setIdEstadoSolicitud(\Minsal\SimagdBundle\Entity\RyxCtlEstadoSolicitud $idEstadoSolicitud = null)
    {
        $this->idEstadoSolicitud = $idEstadoSolicitud;

        return $this;
    }

    /**
     * Get idEstadoSolicitud
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlEstadoSolicitud 
     */
    public function getIdEstadoSolicitud()
    {
        return $this->idEstadoSolicitud;
    }

    /**
     * Set idExpedienteFicticio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExpedienteFicticio $idExpedienteFicticio
     * @return RyxSolicitudEstudio
     */
    public function setIdExpedienteFicticio(\Minsal\SimagdBundle\Entity\RyxExpedienteFicticio $idExpedienteFicticio = null)
    {
        $this->idExpedienteFicticio = $idExpedienteFicticio;

        return $this;
    }

    /**
     * Get idExpedienteFicticio
     *
     * @return \Minsal\SimagdBundle\Entity\RyxExpedienteFicticio 
     */
    public function getIdExpedienteFicticio()
    {
        return $this->idExpedienteFicticio;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return RyxSolicitudEstudio
     */
    public function setIdExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $idExpediente = null)
    {
        $this->idExpediente = $idExpediente;

        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente 
     */
    public function getIdExpediente()
    {
        return $this->idExpediente;
    }

    /**
     * Set idFormaContacto
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlFormaContacto $idFormaContacto
     * @return RyxSolicitudEstudio
     */
    public function setIdFormaContacto(\Minsal\SimagdBundle\Entity\RyxCtlFormaContacto $idFormaContacto = null)
    {
        $this->idFormaContacto = $idFormaContacto;

        return $this;
    }

    /**
     * Get idFormaContacto
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlFormaContacto 
     */
    public function getIdFormaContacto()
    {
        return $this->idFormaContacto;
    }

    /**
     * Set idContactoPaciente
     *
     * @param \Minsal\SiapsBundle\Entity\CtlParentesco $idContactoPaciente
     * @return RyxSolicitudEstudio
     */
    public function setIdContactoPaciente(\Minsal\SiapsBundle\Entity\CtlParentesco $idContactoPaciente = null)
    {
        $this->idContactoPaciente = $idContactoPaciente;

        return $this;
    }

    /**
     * Get idContactoPaciente
     *
     * @return \Minsal\SiapsBundle\Entity\CtlParentesco 
     */
    public function getIdContactoPaciente()
    {
        return $this->idContactoPaciente;
    }

    /**
     * Set idPrioridadAtencion
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlPrioridadAtencionPaciente $idPrioridadAtencion
     * @return RyxSolicitudEstudio
     */
    public function setIdPrioridadAtencion(\Minsal\SimagdBundle\Entity\RyxCtlPrioridadAtencionPaciente $idPrioridadAtencion = null)
    {
        $this->idPrioridadAtencion = $idPrioridadAtencion;

        return $this;
    }

    /**
     * Get idPrioridadAtencion
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlPrioridadAtencionPaciente 
     */
    public function getIdPrioridadAtencion()
    {
        return $this->idPrioridadAtencion;
    }

    /**
     * Set idRadiologoAgregaIndicaciones
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAgregaIndicaciones
     * @return RyxSolicitudEstudio
     */
    public function setIdRadiologoAgregaIndicaciones(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAgregaIndicaciones = null)
    {
        $this->idRadiologoAgregaIndicaciones = $idRadiologoAgregaIndicaciones;

        return $this;
    }

    /**
     * Get idRadiologoAgregaIndicaciones
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoAgregaIndicaciones()
    {
        return $this->idRadiologoAgregaIndicaciones;
    }

    /**
     * Set idSolicitudestudios
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios $idSolicitudestudios
     * @return RyxSolicitudEstudio
     */
    public function setIdSolicitudestudios(\Minsal\SeguimientoBundle\Entity\SecSolicitudestudios $idSolicitudestudios = null)
    {
        $this->idSolicitudestudios = $idSolicitudestudios;

        return $this;
    }

    /**
     * Get idSolicitudestudios
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios 
     */
    public function getIdSolicitudestudios()
    {
        return $this->idSolicitudestudios;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxSolicitudEstudio
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return RyxSolicitudEstudio
     */
    public function setIdUserReg(\Application\Sonata\UserBundle\Entity\User $idUserReg = null)
    {
        $this->idUserReg = $idUserReg;

        return $this;
    }

    /**
     * Get idUserReg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdUserReg()
    {
        return $this->idUserReg;
    }

    /**
     * Add solicitudEstudioProyeccion
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioProyeccion
     * @return RyxSolicitudEstudio
     */
    public function addSolicitudEstudioProyeccion(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioProyeccion)
    {
        $this->solicitudEstudioProyeccion[] = $solicitudEstudioProyeccion;

        return $this;
    }

    /**
     * Remove solicitudEstudioProyeccion
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioProyeccion
     */
    public function removeSolicitudEstudioProyeccion(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioProyeccion)
    {
        $this->solicitudEstudioProyeccion->removeElement($solicitudEstudioProyeccion);
    }

    /**
     * Get solicitudEstudioProyeccion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioProyeccion()
    {
        return $this->solicitudEstudioProyeccion;
    }

    /**
     * Add solicitudEstudioCitas
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCitaProgramada $solicitudEstudioCitas
     * @return RyxSolicitudEstudio
     */
    public function addSolicitudEstudioCita(\Minsal\SimagdBundle\Entity\RyxCitaProgramada $solicitudEstudioCitas)
    {
        $this->solicitudEstudioCitas[] = $solicitudEstudioCitas;

        return $this;
    }

    /**
     * Remove solicitudEstudioCitas
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCitaProgramada $solicitudEstudioCitas
     */
    public function removeSolicitudEstudioCita(\Minsal\SimagdBundle\Entity\RyxCitaProgramada $solicitudEstudioCitas)
    {
        $this->solicitudEstudioCitas->removeElement($solicitudEstudioCitas);
    }

    /**
     * Get solicitudEstudioCitas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioCitas()
    {
        return $this->solicitudEstudioCitas;
    }

    /**
     * Add solicitudEstudioProcedimientosRealizados
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $solicitudEstudioProcedimientosRealizados
     * @return RyxSolicitudEstudio
     */
    public function addSolicitudEstudioProcedimientosRealizado(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $solicitudEstudioProcedimientosRealizados)
    {
        $this->solicitudEstudioProcedimientosRealizados[] = $solicitudEstudioProcedimientosRealizados;

        return $this;
    }

    /**
     * Remove solicitudEstudioProcedimientosRealizados
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $solicitudEstudioProcedimientosRealizados
     */
    public function removeSolicitudEstudioProcedimientosRealizado(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $solicitudEstudioProcedimientosRealizados)
    {
        $this->solicitudEstudioProcedimientosRealizados->removeElement($solicitudEstudioProcedimientosRealizados);
    }

    /**
     * Get solicitudEstudioProcedimientosRealizados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioProcedimientosRealizados()
    {
        return $this->solicitudEstudioProcedimientosRealizados;
    }

    /**
     * Add solicitudEstudioSolicitudesEstudioComplementario
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $solicitudEstudioSolicitudesEstudioComplementario
     * @return RyxSolicitudEstudio
     */
    public function addSolicitudEstudioSolicitudesEstudioComplementario(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $solicitudEstudioSolicitudesEstudioComplementario)
    {
        $this->solicitudEstudioSolicitudesEstudioComplementario[] = $solicitudEstudioSolicitudesEstudioComplementario;

        return $this;
    }

    /**
     * Remove solicitudEstudioSolicitudesEstudioComplementario
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $solicitudEstudioSolicitudesEstudioComplementario
     */
    public function removeSolicitudEstudioSolicitudesEstudioComplementario(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $solicitudEstudioSolicitudesEstudioComplementario)
    {
        $this->solicitudEstudioSolicitudesEstudioComplementario->removeElement($solicitudEstudioSolicitudesEstudioComplementario);
    }

    /**
     * Get solicitudEstudioSolicitudesEstudioComplementario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioSolicitudesEstudioComplementario()
    {
        return $this->solicitudEstudioSolicitudesEstudioComplementario;
    }

    /**
     * Add solicitudEstudioSolicitudesDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $solicitudEstudioSolicitudesDiagnostico
     * @return RyxSolicitudEstudio
     */
    public function addSolicitudEstudioSolicitudesDiagnostico(\Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $solicitudEstudioSolicitudesDiagnostico)
    {
        $this->solicitudEstudioSolicitudesDiagnostico[] = $solicitudEstudioSolicitudesDiagnostico;

        return $this;
    }

    /**
     * Remove solicitudEstudioSolicitudesDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $solicitudEstudioSolicitudesDiagnostico
     */
    public function removeSolicitudEstudioSolicitudesDiagnostico(\Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $solicitudEstudioSolicitudesDiagnostico)
    {
        $this->solicitudEstudioSolicitudesDiagnostico->removeElement($solicitudEstudioSolicitudesDiagnostico);
    }

    /**
     * Get solicitudEstudioSolicitudesDiagnostico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioSolicitudesDiagnostico()
    {
        return $this->solicitudEstudioSolicitudesDiagnostico;
    }

    /**
     * Add solicitudEstudioExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $solicitudEstudioExamenPendienteRealizar
     * @return RyxSolicitudEstudio
     */
    public function addSolicitudEstudioExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $solicitudEstudioExamenPendienteRealizar)
    {
        $this->solicitudEstudioExamenPendienteRealizar[] = $solicitudEstudioExamenPendienteRealizar;

        return $this;
    }

    /**
     * Remove solicitudEstudioExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $solicitudEstudioExamenPendienteRealizar
     */
    public function removeSolicitudEstudioExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $solicitudEstudioExamenPendienteRealizar)
    {
        $this->solicitudEstudioExamenPendienteRealizar->removeElement($solicitudEstudioExamenPendienteRealizar);
    }

    /**
     * Get solicitudEstudioExamenPendienteRealizar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioExamenPendienteRealizar()
    {
        return $this->solicitudEstudioExamenPendienteRealizar;
    }

    /**
     * Add solicitudEstudioMamografia
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografia $solicitudEstudioMamografia
     * @return RyxSolicitudEstudio
     */
    public function addSolicitudEstudioMamografium(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografia $solicitudEstudioMamografia)
    {
        $this->solicitudEstudioMamografia[] = $solicitudEstudioMamografia;

        return $this;
    }

    /**
     * Remove solicitudEstudioMamografia
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografia $solicitudEstudioMamografia
     */
    public function removeSolicitudEstudioMamografium(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografia $solicitudEstudioMamografia)
    {
        $this->solicitudEstudioMamografia->removeElement($solicitudEstudioMamografia);
    }

    /**
     * Get solicitudEstudioMamografia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioMamografia()
    {
        return $this->solicitudEstudioMamografia;
    }
}
