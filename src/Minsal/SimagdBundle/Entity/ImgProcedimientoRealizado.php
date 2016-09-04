<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgProcedimientoRealizado
 *
 * @ORM\Table(name="img_procedimiento_realizado", indexes={@ORM\Index(name="IDX_863F6B935BBAAD2F", columns={"id_cita_programada"}), @ORM\Index(name="IDX_863F6B93DD66500E", columns={"id_tecnologo_realiza"}), @ORM\Index(name="IDX_863F6B937DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_863F6B93282A2E1B", columns={"id_estado_procedimiento_realizado"}), @ORM\Index(name="IDX_863F6B9360C0CAA5", columns={"id_registra_emergencia"}), @ORM\Index(name="IDX_863F6B93F0951F8F", columns={"id_solicitud_estudio_complementario"}), @ORM\Index(name="IDX_863F6B936AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_863F6B93AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_863F6B93D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\ProcedimientoRealizadoRepository")
 */
class ImgProcedimientoRealizado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_procedimiento_realizado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_atendido", type="datetime", nullable=true)
     */
    private $fechaAtendido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_realizado", type="datetime", nullable=true)
     */
    private $fechaRealizado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_procesado", type="datetime", nullable=true)
     */
    private $fechaProcesado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_almacenado", type="datetime", nullable=true)
     */
    private $fechaAlmacenado;

    /**
     * @var string
     *
     * @ORM\Column(name="equipo_utilizado", type="string", length=100, nullable=true)
     */
    private $equipoUtilizado;

    /**
     * @var string
     *
     * @ORM\Column(name="tecnica_utilizada", type="string", length=150, nullable=true)
     */
    private $tecnicaUtilizada;

    /**
     * @var string
     *
     * @ORM\Column(name="hipotesis_diagnostica", type="string", length=150, nullable=true)
     */
    private $hipotesisDiagnostica;

    /**
     * @var string
     *
     * @ORM\Column(name="incidencias", type="string", length=255, nullable=true)
     */
    private $incidencias;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fecha_nacimiento_indeterminada", type="boolean", nullable=true)
     */
    private $fechaNacimientoIndeterminada = false;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="sala_realizado", type="string", length=50, nullable=true)
     */
    private $salaRealizado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro = '(now())::timestamp(0) without time zone';

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_emergencia", type="boolean", nullable=true)
     */
    private $esEmergencia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_complementario", type="boolean", nullable=true)
     */
    private $esComplementario = false;

    /**
     * @var \ImgCita
     *
     * @ORM\ManyToOne(targetEntity="ImgCita", inversedBy="citaProcedimientosRealizados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cita_programada", referencedColumnName="id")
     * })
     */
    private $idCitaProgramada;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tecnologo_realiza", referencedColumnName="id")
     * })
     */
    private $idTecnologoRealiza;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \ImgCtlEstadoProcedimientoRealizado
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlEstadoProcedimientoRealizado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_procedimiento_realizado", referencedColumnName="id")
     * })
     */
    private $idEstadoProcedimientoRealizado;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_registra_emergencia", referencedColumnName="id")
     * })
     */
    private $idRegistraEmergencia;

    /**
     * @var \ImgSolicitudEstudioComplementario
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudioComplementario", inversedBy="complementarioExamenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;

    /**
     * @var \ImgSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudio", inversedBy="solicitudEstudioProcedimientosRealizados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudio;

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
     */
    private $idUserReg;

    /**
     * @ORM\OneToMany(targetEntity="ImgMaterialUtilizado", mappedBy="idProcedimientoRealizado", cascade={"all"}, orphanRemoval=true)
     */
    private $materialUtilizadoV2;


    /**
     * @ORM\OneToMany(targetEntity="ImgEstudioPaciente", mappedBy="idProcedimientoRealizado", cascade={"all"}, orphanRemoval=true)
     */
    private $examenEstudio;


    /**
     * @ORM\OneToMany(targetEntity="ImgPendienteRealizacion", mappedBy="idProcedimientoIniciado", cascade={"all"}, orphanRemoval=true)
     */
    private $examenPendienteRealizar;



    public function __toString() {
        return $this->idSolicitudEstudio . ' :: ' . $this->idEstadoProcedimientoRealizado;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materialUtilizadoV2 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examenEstudio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examenPendienteRealizar = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fechaAtendido
     *
     * @param \DateTime $fechaAtendido
     * @return ImgProcedimientoRealizado
     */
    public function setFechaAtendido($fechaAtendido)
    {
        $this->fechaAtendido = $fechaAtendido;

        return $this;
    }

    /**
     * Get fechaAtendido
     *
     * @return \DateTime 
     */
    public function getFechaAtendido()
    {
        return $this->fechaAtendido;
    }

    /**
     * Set fechaRealizado
     *
     * @param \DateTime $fechaRealizado
     * @return ImgProcedimientoRealizado
     */
    public function setFechaRealizado($fechaRealizado)
    {
        $this->fechaRealizado = $fechaRealizado;

        return $this;
    }

    /**
     * Get fechaRealizado
     *
     * @return \DateTime 
     */
    public function getFechaRealizado()
    {
        return $this->fechaRealizado;
    }

    /**
     * Set fechaProcesado
     *
     * @param \DateTime $fechaProcesado
     * @return ImgProcedimientoRealizado
     */
    public function setFechaProcesado($fechaProcesado)
    {
        $this->fechaProcesado = $fechaProcesado;

        return $this;
    }

    /**
     * Get fechaProcesado
     *
     * @return \DateTime 
     */
    public function getFechaProcesado()
    {
        return $this->fechaProcesado;
    }

    /**
     * Set fechaAlmacenado
     *
     * @param \DateTime $fechaAlmacenado
     * @return ImgProcedimientoRealizado
     */
    public function setFechaAlmacenado($fechaAlmacenado)
    {
        $this->fechaAlmacenado = $fechaAlmacenado;

        return $this;
    }

    /**
     * Get fechaAlmacenado
     *
     * @return \DateTime 
     */
    public function getFechaAlmacenado()
    {
        return $this->fechaAlmacenado;
    }

    /**
     * Set equipoUtilizado
     *
     * @param string $equipoUtilizado
     * @return ImgProcedimientoRealizado
     */
    public function setEquipoUtilizado($equipoUtilizado)
    {
        $this->equipoUtilizado = $equipoUtilizado;

        return $this;
    }

    /**
     * Get equipoUtilizado
     *
     * @return string 
     */
    public function getEquipoUtilizado()
    {
        return $this->equipoUtilizado;
    }

    /**
     * Set tecnicaUtilizada
     *
     * @param string $tecnicaUtilizada
     * @return ImgProcedimientoRealizado
     */
    public function setTecnicaUtilizada($tecnicaUtilizada)
    {
        $this->tecnicaUtilizada = $tecnicaUtilizada;

        return $this;
    }

    /**
     * Get tecnicaUtilizada
     *
     * @return string 
     */
    public function getTecnicaUtilizada()
    {
        return $this->tecnicaUtilizada;
    }

    /**
     * Set hipotesisDiagnostica
     *
     * @param string $hipotesisDiagnostica
     * @return ImgProcedimientoRealizado
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
     * Set incidencias
     *
     * @param string $incidencias
     * @return ImgProcedimientoRealizado
     */
    public function setIncidencias($incidencias)
    {
        $this->incidencias = $incidencias;

        return $this;
    }

    /**
     * Get incidencias
     *
     * @return string 
     */
    public function getIncidencias()
    {
        return $this->incidencias;
    }

    /**
     * Set fechaNacimientoIndeterminada
     *
     * @param boolean $fechaNacimientoIndeterminada
     * @return ImgProcedimientoRealizado
     */
    public function setFechaNacimientoIndeterminada($fechaNacimientoIndeterminada)
    {
        $this->fechaNacimientoIndeterminada = $fechaNacimientoIndeterminada;

        return $this;
    }

    /**
     * Get fechaNacimientoIndeterminada
     *
     * @return boolean 
     */
    public function getFechaNacimientoIndeterminada()
    {
        return $this->fechaNacimientoIndeterminada;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return ImgProcedimientoRealizado
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set salaRealizado
     *
     * @param string $salaRealizado
     * @return ImgProcedimientoRealizado
     */
    public function setSalaRealizado($salaRealizado)
    {
        $this->salaRealizado = $salaRealizado;

        return $this;
    }

    /**
     * Get salaRealizado
     *
     * @return string 
     */
    public function getSalaRealizado()
    {
        return $this->salaRealizado;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return ImgProcedimientoRealizado
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set esEmergencia
     *
     * @param boolean $esEmergencia
     * @return ImgProcedimientoRealizado
     */
    public function setEsEmergencia($esEmergencia)
    {
        $this->esEmergencia = $esEmergencia;

        return $this;
    }

    /**
     * Get esEmergencia
     *
     * @return boolean 
     */
    public function getEsEmergencia()
    {
        return $this->esEmergencia;
    }

    /**
     * Set esComplementario
     *
     * @param boolean $esComplementario
     * @return ImgProcedimientoRealizado
     */
    public function setEsComplementario($esComplementario)
    {
        $this->esComplementario = $esComplementario;

        return $this;
    }

    /**
     * Get esComplementario
     *
     * @return boolean 
     */
    public function getEsComplementario()
    {
        return $this->esComplementario;
    }

    /**
     * Set idCitaProgramada
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCita $idCitaProgramada
     * @return ImgProcedimientoRealizado
     */
    public function setIdCitaProgramada(\Minsal\SimagdBundle\Entity\ImgCita $idCitaProgramada = null)
    {
        $this->idCitaProgramada = $idCitaProgramada;

        return $this;
    }

    /**
     * Get idCitaProgramada
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCita 
     */
    public function getIdCitaProgramada()
    {
        return $this->idCitaProgramada;
    }

    /**
     * Set idTecnologoRealiza
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoRealiza
     * @return ImgProcedimientoRealizado
     */
    public function setIdTecnologoRealiza(\Minsal\SiapsBundle\Entity\MntEmpleado $idTecnologoRealiza = null)
    {
        $this->idTecnologoRealiza = $idTecnologoRealiza;

        return $this;
    }

    /**
     * Get idTecnologoRealiza
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdTecnologoRealiza()
    {
        return $this->idTecnologoRealiza;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgProcedimientoRealizado
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set idEstadoProcedimientoRealizado
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlEstadoProcedimientoRealizado $idEstadoProcedimientoRealizado
     * @return ImgProcedimientoRealizado
     */
    public function setIdEstadoProcedimientoRealizado(\Minsal\SimagdBundle\Entity\ImgCtlEstadoProcedimientoRealizado $idEstadoProcedimientoRealizado = null)
    {
        $this->idEstadoProcedimientoRealizado = $idEstadoProcedimientoRealizado;

        return $this;
    }

    /**
     * Get idEstadoProcedimientoRealizado
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlEstadoProcedimientoRealizado 
     */
    public function getIdEstadoProcedimientoRealizado()
    {
        return $this->idEstadoProcedimientoRealizado;
    }

    /**
     * Set idRegistraEmergencia
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRegistraEmergencia
     * @return ImgProcedimientoRealizado
     */
    public function setIdRegistraEmergencia(\Minsal\SiapsBundle\Entity\MntEmpleado $idRegistraEmergencia = null)
    {
        $this->idRegistraEmergencia = $idRegistraEmergencia;

        return $this;
    }

    /**
     * Get idRegistraEmergencia
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRegistraEmergencia()
    {
        return $this->idRegistraEmergencia;
    }

    /**
     * Set idSolicitudEstudioComplementario
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $idSolicitudEstudioComplementario
     * @return ImgProcedimientoRealizado
     */
    public function setIdSolicitudEstudioComplementario(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $idSolicitudEstudioComplementario = null)
    {
        $this->idSolicitudEstudioComplementario = $idSolicitudEstudioComplementario;

        return $this;
    }

    /**
     * Get idSolicitudEstudioComplementario
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario 
     */
    public function getIdSolicitudEstudioComplementario()
    {
        return $this->idSolicitudEstudioComplementario;
    }

    /**
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio
     * @return ImgProcedimientoRealizado
     */
    public function setIdSolicitudEstudio(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio = null)
    {
        $this->idSolicitudEstudio = $idSolicitudEstudio;

        return $this;
    }

    /**
     * Get idSolicitudEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio 
     */
    public function getIdSolicitudEstudio()
    {
        return $this->idSolicitudEstudio;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return ImgProcedimientoRealizado
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
     * @return ImgProcedimientoRealizado
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
     * Add materialUtilizadoV2
     *
     * @param \Minsal\SimagdBundle\Entity\ImgMaterialUtilizado $materialUtilizadoV2
     * @return ImgProcedimientoRealizado
     */
    public function addMaterialUtilizadoV2(\Minsal\SimagdBundle\Entity\ImgMaterialUtilizado $materialUtilizadoV2)
    {
        $this->materialUtilizadoV2[] = $materialUtilizadoV2;

        return $this;
    }

    /**
     * Remove materialUtilizadoV2
     *
     * @param \Minsal\SimagdBundle\Entity\ImgMaterialUtilizado $materialUtilizadoV2
     */
    public function removeMaterialUtilizadoV2(\Minsal\SimagdBundle\Entity\ImgMaterialUtilizado $materialUtilizadoV2)
    {
        $this->materialUtilizadoV2->removeElement($materialUtilizadoV2);
    }

    /**
     * Get materialUtilizadoV2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaterialUtilizadoV2()
    {
        return $this->materialUtilizadoV2;
    }

    /**
     * Add examenEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $examenEstudio
     * @return ImgProcedimientoRealizado
     */
    public function addExamenEstudio(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $examenEstudio)
    {
        $this->examenEstudio[] = $examenEstudio;

        return $this;
    }

    /**
     * Remove examenEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $examenEstudio
     */
    public function removeExamenEstudio(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $examenEstudio)
    {
        $this->examenEstudio->removeElement($examenEstudio);
    }

    /**
     * Get examenEstudio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamenEstudio()
    {
        return $this->examenEstudio;
    }

    /**
     * Add examenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $examenPendienteRealizar
     * @return ImgProcedimientoRealizado
     */
    public function addExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $examenPendienteRealizar)
    {
        $this->examenPendienteRealizar[] = $examenPendienteRealizar;

        return $this;
    }

    /**
     * Remove examenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $examenPendienteRealizar
     */
    public function removeExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $examenPendienteRealizar)
    {
        $this->examenPendienteRealizar->removeElement($examenPendienteRealizar);
    }

    /**
     * Get examenPendienteRealizar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamenPendienteRealizar()
    {
        return $this->examenPendienteRealizar;
    }
    
    public function getStudyCustomDescription()
    {
        $description    = '';
        $study_request  = $this->idSolicitudEstudio;
        if ($study_request !== null) {
            foreach ($study_request->getSolicitudEstudioProyeccion() as $projection_examined)  {
                $description    .= mb_strtoupper(trim($projection_examined->getNombre()), 'utf-8') . ', ';
            }
        }
        return trim($description, '\t\n , \t\n');
    }
}
