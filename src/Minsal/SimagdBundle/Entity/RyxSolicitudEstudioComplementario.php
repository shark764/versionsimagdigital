<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxSolicitudEstudioComplementario
 *
 * @ORM\Table(name="ryx_solicitud_estudio_complementario", indexes={@ORM\Index(name="IDX_AE38E690992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_AE38E6909A3949E3", columns={"id_establecimiento_solicitado"}), @ORM\Index(name="IDX_AE38E690AB124167", columns={"id_estado_solicitud"}), @ORM\Index(name="IDX_AE38E690F485B2E3", columns={"id_estudio_padre"}), @ORM\Index(name="IDX_AE38E6907E7CB1E8", columns={"id_prioridad_atencion"}), @ORM\Index(name="IDX_AE38E6904E924116", columns={"id_radiologo_solicita"}), @ORM\Index(name="IDX_AE38E6906AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_AE38E690D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxSolicitudEstudioComplementarioRepository")
 */
class RyxSolicitudEstudioComplementario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_complementario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaSolicitud = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones_estudio", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $indicacionesEstudio;

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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_solicitado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimientoSolicitado;

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
     * @var \RyxEstudioPorImagenes
     *
     * @ORM\ManyToOne(targetEntity="RyxEstudioPorImagenes", inversedBy="estudioEstudiosComplementarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio_padre", referencedColumnName="id")
     * })
     */
    private $idEstudioPadre;

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
     *   @ORM\JoinColumn(name="id_radiologo_solicita", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idRadiologoSolicita;

    /**
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio", inversedBy="solicitudEstudioSolicitudesEstudioComplementario")
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
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idUserReg;

    /**
     * @ORM\ManyToMany(targetEntity="RyxCtlProyeccionRadiologica")
     * @ORM\JoinTable(name="ryx_solicitud_estudio_complementario_proyeccion",
     *      joinColumns={@ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_proyeccion_solicitada", referencedColumnName="id")}
     * )
     */
    private $solicitudEstudioComplementarioProyeccion;

    /**
     * @ORM\OneToMany(targetEntity="RyxProcedimientoRadiologicoRealizado", mappedBy="idSolicitudEstudioComplementario", cascade={"all"}, orphanRemoval=true)
     */
    private $complementarioExamenes;

    /**
     * @ORM\OneToMany(targetEntity="RyxExamenPendienteRealizacion", mappedBy="idSolicitudEstudioComplementario", cascade={"all"}, orphanRemoval=true)
     */
    private $complementarioExamenPendienteRealizar;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solicitudEstudioComplementarioProyeccion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->complementarioExamenes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->complementarioExamenPendienteRealizar = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->idRadiologoSolicita . ' :: ' . $this->idEstudioPadre;
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


    /**
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     * @return RyxSolicitudEstudioComplementario
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime 
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set justificacion
     *
     * @param string $justificacion
     * @return RyxSolicitudEstudioComplementario
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string 
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set indicacionesEstudio
     *
     * @param string $indicacionesEstudio
     * @return RyxSolicitudEstudioComplementario
     */
    public function setIndicacionesEstudio($indicacionesEstudio)
    {
        $this->indicacionesEstudio = $indicacionesEstudio;

        return $this;
    }

    /**
     * Get indicacionesEstudio
     *
     * @return string 
     */
    public function getIndicacionesEstudio()
    {
        return $this->indicacionesEstudio;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return RyxSolicitudEstudioComplementario
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
     * Set idEstablecimientoSolicitado
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoSolicitado
     * @return RyxSolicitudEstudioComplementario
     */
    public function setIdEstablecimientoSolicitado(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoSolicitado = null)
    {
        $this->idEstablecimientoSolicitado = $idEstablecimientoSolicitado;

        return $this;
    }

    /**
     * Get idEstablecimientoSolicitado
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdEstablecimientoSolicitado()
    {
        return $this->idEstablecimientoSolicitado;
    }

    /**
     * Set idEstadoSolicitud
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlEstadoSolicitud $idEstadoSolicitud
     * @return RyxSolicitudEstudioComplementario
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
     * Set idEstudioPadre
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $idEstudioPadre
     * @return RyxSolicitudEstudioComplementario
     */
    public function setIdEstudioPadre(\Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $idEstudioPadre = null)
    {
        $this->idEstudioPadre = $idEstudioPadre;

        return $this;
    }

    /**
     * Get idEstudioPadre
     *
     * @return \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes 
     */
    public function getIdEstudioPadre()
    {
        return $this->idEstudioPadre;
    }

    /**
     * Set idPrioridadAtencion
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlPrioridadAtencionPaciente $idPrioridadAtencion
     * @return RyxSolicitudEstudioComplementario
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
     * Set idRadiologoSolicita
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoSolicita
     * @return RyxSolicitudEstudioComplementario
     */
    public function setIdRadiologoSolicita(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoSolicita = null)
    {
        $this->idRadiologoSolicita = $idRadiologoSolicita;

        return $this;
    }

    /**
     * Get idRadiologoSolicita
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoSolicita()
    {
        return $this->idRadiologoSolicita;
    }

    /**
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio
     * @return RyxSolicitudEstudioComplementario
     */
    public function setIdSolicitudEstudio(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio = null)
    {
        $this->idSolicitudEstudio = $idSolicitudEstudio;

        return $this;
    }

    /**
     * Get idSolicitudEstudio
     *
     * @return \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio 
     */
    public function getIdSolicitudEstudio()
    {
        return $this->idSolicitudEstudio;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return RyxSolicitudEstudioComplementario
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
     * Add solicitudEstudioComplementarioProyeccion
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioComplementarioProyeccion
     * @return RyxSolicitudEstudioComplementario
     */
    public function addSolicitudEstudioComplementarioProyeccion(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioComplementarioProyeccion)
    {
        $this->solicitudEstudioComplementarioProyeccion[] = $solicitudEstudioComplementarioProyeccion;

        return $this;
    }

    /**
     * Remove solicitudEstudioComplementarioProyeccion
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioComplementarioProyeccion
     */
    public function removeSolicitudEstudioComplementarioProyeccion(\Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica $solicitudEstudioComplementarioProyeccion)
    {
        $this->solicitudEstudioComplementarioProyeccion->removeElement($solicitudEstudioComplementarioProyeccion);
    }

    /**
     * Get solicitudEstudioComplementarioProyeccion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioComplementarioProyeccion()
    {
        return $this->solicitudEstudioComplementarioProyeccion;
    }

    /**
     * Add complementarioExamenes
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $complementarioExamenes
     * @return RyxSolicitudEstudioComplementario
     */
    public function addComplementarioExamene(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $complementarioExamenes)
    {
        $this->complementarioExamenes[] = $complementarioExamenes;

        return $this;
    }

    /**
     * Remove complementarioExamenes
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $complementarioExamenes
     */
    public function removeComplementarioExamene(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $complementarioExamenes)
    {
        $this->complementarioExamenes->removeElement($complementarioExamenes);
    }

    /**
     * Get complementarioExamenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComplementarioExamenes()
    {
        return $this->complementarioExamenes;
    }

    /**
     * Add complementarioExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $complementarioExamenPendienteRealizar
     * @return RyxSolicitudEstudioComplementario
     */
    public function addComplementarioExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $complementarioExamenPendienteRealizar)
    {
        $this->complementarioExamenPendienteRealizar[] = $complementarioExamenPendienteRealizar;

        return $this;
    }

    /**
     * Remove complementarioExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $complementarioExamenPendienteRealizar
     */
    public function removeComplementarioExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion $complementarioExamenPendienteRealizar)
    {
        $this->complementarioExamenPendienteRealizar->removeElement($complementarioExamenPendienteRealizar);
    }

    /**
     * Get complementarioExamenPendienteRealizar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComplementarioExamenPendienteRealizar()
    {
        return $this->complementarioExamenPendienteRealizar;
    }
}
