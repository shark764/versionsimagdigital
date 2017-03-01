<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgSolicitudEstudioComplementario
 *
 * @ORM\Table(name="img_solicitud_estudio_complementario", indexes={@ORM\Index(name="IDX_B9037825992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_B90378259A3949E3", columns={"id_establecimiento_solicitado"}), @ORM\Index(name="IDX_B9037825AB124167", columns={"id_estado_solicitud"}), @ORM\Index(name="IDX_B9037825F485B2E3", columns={"id_estudio_padre"}), @ORM\Index(name="IDX_B90378257E7CB1E8", columns={"id_prioridad_atencion"}), @ORM\Index(name="IDX_B90378254E924116", columns={"id_radiologo_solicita"}), @ORM\Index(name="IDX_B90378256AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_B9037825D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxSolicitudEstudioComplementarioRepository")
 */
class ImgSolicitudEstudioComplementario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_solicitud_estudio_complementario_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="datetime", nullable=true)
     */
    private $fechaSolicitud = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=255, nullable=true)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones_estudio", type="text", nullable=true)
     */
    private $indicacionesEstudio;

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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_solicitado", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoSolicitado;

    /**
     * @var \ImgCtlEstadoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlEstadoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_solicitud", referencedColumnName="id")
     * })
     */
    private $idEstadoSolicitud;

    /**
     * @var \ImgEstudioPaciente
     *
     * @ORM\ManyToOne(targetEntity="ImgEstudioPaciente", inversedBy="estudioEstudiosComplementarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio_padre", referencedColumnName="id")
     * })
     */
    private $idEstudioPadre;

    /**
     * @var \ImgCtlPrioridadAtencion
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlPrioridadAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prioridad_atencion", referencedColumnName="id")
     * })
     */
    private $idPrioridadAtencion;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_solicita", referencedColumnName="id")
     * })
     */
    private $idRadiologoSolicita;

    /**
     * @var \ImgSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="ImgSolicitudEstudio", inversedBy="solicitudEstudioSolicitudesEstudioComplementario")
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
     */
    private $idUserReg;


    /**
     * @ORM\ManyToMany(targetEntity="ImgCtlProyeccion")
     * @ORM\JoinTable(name="img_solicitud_estudio_complementario_proyeccion",
     *      joinColumns={@ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_proyeccion_solicitada", referencedColumnName="id")}
     * )
     */
    private $solicitudEstudioComplementarioProyeccion;


    /**
     * @ORM\OneToMany(targetEntity="ImgProcedimientoRealizado", mappedBy="idSolicitudEstudioComplementario", cascade={"all"}, orphanRemoval=true)
     */
    private $complementarioExamenes;


    /**
     * @ORM\OneToMany(targetEntity="ImgPendienteRealizacion", mappedBy="idSolicitudEstudioComplementario", cascade={"all"}, orphanRemoval=true)
     */
    private $complementarioExamenPendienteRealizar;


    public function __toString()
    {
        return '' . $this->idRadiologoSolicita . ' :: ' . $this->idEstudioPadre;
    }


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
     * @return ImgSolicitudEstudioComplementario
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
     * @return ImgSolicitudEstudioComplementario
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
     * @return ImgSolicitudEstudioComplementario
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
     * @return ImgSolicitudEstudioComplementario
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
     * @return ImgSolicitudEstudioComplementario
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlEstadoSolicitud $idEstadoSolicitud
     * @return ImgSolicitudEstudioComplementario
     */
    public function setIdEstadoSolicitud(\Minsal\SimagdBundle\Entity\ImgCtlEstadoSolicitud $idEstadoSolicitud = null)
    {
        $this->idEstadoSolicitud = $idEstadoSolicitud;

        return $this;
    }

    /**
     * Get idEstadoSolicitud
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlEstadoSolicitud 
     */
    public function getIdEstadoSolicitud()
    {
        return $this->idEstadoSolicitud;
    }

    /**
     * Set idEstudioPadre
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudioPadre
     * @return ImgSolicitudEstudioComplementario
     */
    public function setIdEstudioPadre(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudioPadre = null)
    {
        $this->idEstudioPadre = $idEstudioPadre;

        return $this;
    }

    /**
     * Get idEstudioPadre
     *
     * @return \Minsal\SimagdBundle\Entity\ImgEstudioPaciente 
     */
    public function getIdEstudioPadre()
    {
        return $this->idEstudioPadre;
    }

    /**
     * Set idPrioridadAtencion
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion $idPrioridadAtencion
     * @return ImgSolicitudEstudioComplementario
     */
    public function setIdPrioridadAtencion(\Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion $idPrioridadAtencion = null)
    {
        $this->idPrioridadAtencion = $idPrioridadAtencion;

        return $this;
    }

    /**
     * Get idPrioridadAtencion
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion 
     */
    public function getIdPrioridadAtencion()
    {
        return $this->idPrioridadAtencion;
    }

    /**
     * Set idRadiologoSolicita
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoSolicita
     * @return ImgSolicitudEstudioComplementario
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
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio $idSolicitudEstudio
     * @return ImgSolicitudEstudioComplementario
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
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return ImgSolicitudEstudioComplementario
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlProyeccion $solicitudEstudioComplementarioProyeccion
     * @return ImgSolicitudEstudioComplementario
     */
    public function addSolicitudEstudioComplementarioProyeccion(\Minsal\SimagdBundle\Entity\ImgCtlProyeccion $solicitudEstudioComplementarioProyeccion)
    {
        $this->solicitudEstudioComplementarioProyeccion[] = $solicitudEstudioComplementarioProyeccion;

        return $this;
    }

    /**
     * Remove solicitudEstudioComplementarioProyeccion
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlProyeccion $solicitudEstudioComplementarioProyeccion
     */
    public function removeSolicitudEstudioComplementarioProyeccion(\Minsal\SimagdBundle\Entity\ImgCtlProyeccion $solicitudEstudioComplementarioProyeccion)
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
     * @param \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $complementarioExamenes
     * @return ImgSolicitudEstudioComplementario
     */
    public function addComplementarioExamene(\Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $complementarioExamenes)
    {
        $this->complementarioExamenes[] = $complementarioExamenes;

        return $this;
    }

    /**
     * Remove complementarioExamenes
     *
     * @param \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $complementarioExamenes
     */
    public function removeComplementarioExamene(\Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $complementarioExamenes)
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
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $complementarioExamenPendienteRealizar
     * @return ImgSolicitudEstudioComplementario
     */
    public function addComplementarioExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $complementarioExamenPendienteRealizar)
    {
        $this->complementarioExamenPendienteRealizar[] = $complementarioExamenPendienteRealizar;

        return $this;
    }

    /**
     * Remove complementarioExamenPendienteRealizar
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $complementarioExamenPendienteRealizar
     */
    public function removeComplementarioExamenPendienteRealizar(\Minsal\SimagdBundle\Entity\ImgPendienteRealizacion $complementarioExamenPendienteRealizar)
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
