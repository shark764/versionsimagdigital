<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxEstudioPorImagenes
 *
 * @ORM\Table(name="ryx_estudio_por_imagenes", indexes={@ORM\Index(name="IDX_AB43E1E67DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_AB43E1E6F485B2E3", columns={"id_estudio_padre"}), @ORM\Index(name="IDX_AB43E1E6701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_AB43E1E633CCFAF2", columns={"id_expediente_ficticio"}), @ORM\Index(name="IDX_AB43E1E69E9497EB", columns={"id_procedimiento_realizado"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxEstudioPorImagenesRepository")
 */
class RyxEstudioPorImagenes implements EntityInterface
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
     * @Assert\DateTime()
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $servidor = 'MINSAL';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="eliminado_en_pacs", type="boolean", nullable=true)
     */
    private $eliminadoEnPacs = false;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimiento;

    /**
     * @var \RyxEstudioPorImagenes
     *
     * @ORM\ManyToOne(targetEntity="RyxEstudioPorImagenes", inversedBy="estudioEstudiosConsecuentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio_padre", referencedColumnName="id")
     * })
     */
    private $idEstudioPadre;

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
     * @ORM\ManyToOne(targetEntity="RyxProcedimientoRadiologicoRealizado", inversedBy="examenEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_realizado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idProcedimientoRealizado;

    /**
     * @ORM\OneToMany(targetEntity="RyxSolicitudEstudioComplementario", mappedBy="idEstudioPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioEstudiosComplementarios;

    /**
     * @ORM\OneToMany(targetEntity="RyxSolicitudDiagnosticoPostEstudio", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioSolicitudesDiagnostico;

    /**
     * @ORM\OneToMany(targetEntity="RyxLecturaRadiologica", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioLecturasRealizadas;

    /**
     * @ORM\OneToMany(targetEntity="RyxLecturaEstudio", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioLecturaEstudio;

    /**
     * @ORM\OneToMany(targetEntity="RyxEstudioPendienteLectura", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioPendienteLectura;

    /**
     * @ORM\OneToMany(targetEntity="RyxEstudioPorImagenes", mappedBy="idEstudioPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioEstudiosConsecuentes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estudioEstudiosComplementarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estudioSolicitudesDiagnostico = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estudioLecturasRealizadas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estudioLecturaEstudio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estudioPendienteLectura = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estudioEstudiosConsecuentes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        if ($this->idProcedimientoRealizado->getEsComplementario())
        {
            return 'Estudio de: ' . $this->idProcedimientoRealizado->getIdSolicitudEstudioComplementario()->getIdAreaServicioDiagnostico();
        }
        else
        {
            return 'Estudio de: ' . $this->idProcedimientoRealizado->getIdSolicitudEstudio()->getIdAreaServicioDiagnostico();
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
     * Set fechaEstudio
     *
     * @param \DateTime $fechaEstudio
     * @return RyxEstudioPorImagenes
     */
    public function setFechaEstudio($fechaEstudio)
    {
        $this->fechaEstudio = $fechaEstudio;

        return $this;
    }

    /**
     * Get fechaEstudio
     *
     * @return \DateTime 
     */
    public function getFechaEstudio()
    {
        return $this->fechaEstudio;
    }

    /**
     * Set estudioUid
     *
     * @param string $estudioUid
     * @return RyxEstudioPorImagenes
     */
    public function setEstudioUid($estudioUid)
    {
        $this->estudioUid = $estudioUid;

        return $this;
    }

    /**
     * Get estudioUid
     *
     * @return string 
     */
    public function getEstudioUid()
    {
        return $this->estudioUid;
    }

    /**
     * Set seriesUid
     *
     * @param string $seriesUid
     * @return RyxEstudioPorImagenes
     */
    public function setSeriesUid($seriesUid)
    {
        $this->seriesUid = $seriesUid;

        return $this;
    }

    /**
     * Get seriesUid
     *
     * @return string 
     */
    public function getSeriesUid()
    {
        return $this->seriesUid;
    }

    /**
     * Set servidor
     *
     * @param string $servidor
     * @return RyxEstudioPorImagenes
     */
    public function setServidor($servidor)
    {
        $this->servidor = $servidor;

        return $this;
    }

    /**
     * Get servidor
     *
     * @return string 
     */
    public function getServidor()
    {
        return $this->servidor;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return RyxEstudioPorImagenes
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set eliminadoEnPacs
     *
     * @param boolean $eliminadoEnPacs
     * @return RyxEstudioPorImagenes
     */
    public function setEliminadoEnPacs($eliminadoEnPacs)
    {
        $this->eliminadoEnPacs = $eliminadoEnPacs;

        return $this;
    }

    /**
     * Get eliminadoEnPacs
     *
     * @return boolean 
     */
    public function getEliminadoEnPacs()
    {
        return $this->eliminadoEnPacs;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxEstudioPorImagenes
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
     * Set idEstudioPadre
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $idEstudioPadre
     * @return RyxEstudioPorImagenes
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
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return RyxEstudioPorImagenes
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
     * Set idExpedienteFicticio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxExpedienteFicticio $idExpedienteFicticio
     * @return RyxEstudioPorImagenes
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
     * Set idProcedimientoRealizado
     *
     * @param \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $idProcedimientoRealizado
     * @return RyxEstudioPorImagenes
     */
    public function setIdProcedimientoRealizado(\Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado $idProcedimientoRealizado = null)
    {
        $this->idProcedimientoRealizado = $idProcedimientoRealizado;

        return $this;
    }

    /**
     * Get idProcedimientoRealizado
     *
     * @return \Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado 
     */
    public function getIdProcedimientoRealizado()
    {
        return $this->idProcedimientoRealizado;
    }

    /**
     * Add estudioEstudiosComplementarios
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $estudioEstudiosComplementarios
     * @return RyxEstudioPorImagenes
     */
    public function addEstudioEstudiosComplementario(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $estudioEstudiosComplementarios)
    {
        $this->estudioEstudiosComplementarios[] = $estudioEstudiosComplementarios;

        return $this;
    }

    /**
     * Remove estudioEstudiosComplementarios
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $estudioEstudiosComplementarios
     */
    public function removeEstudioEstudiosComplementario(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario $estudioEstudiosComplementarios)
    {
        $this->estudioEstudiosComplementarios->removeElement($estudioEstudiosComplementarios);
    }

    /**
     * Get estudioEstudiosComplementarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudioEstudiosComplementarios()
    {
        return $this->estudioEstudiosComplementarios;
    }

    /**
     * Add estudioSolicitudesDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $estudioSolicitudesDiagnostico
     * @return RyxEstudioPorImagenes
     */
    public function addEstudioSolicitudesDiagnostico(\Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $estudioSolicitudesDiagnostico)
    {
        $this->estudioSolicitudesDiagnostico[] = $estudioSolicitudesDiagnostico;

        return $this;
    }

    /**
     * Remove estudioSolicitudesDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $estudioSolicitudesDiagnostico
     */
    public function removeEstudioSolicitudesDiagnostico(\Minsal\SimagdBundle\Entity\RyxSolicitudDiagnosticoPostEstudio $estudioSolicitudesDiagnostico)
    {
        $this->estudioSolicitudesDiagnostico->removeElement($estudioSolicitudesDiagnostico);
    }

    /**
     * Get estudioSolicitudesDiagnostico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudioSolicitudesDiagnostico()
    {
        return $this->estudioSolicitudesDiagnostico;
    }

    /**
     * Add estudioLecturasRealizadas
     *
     * @param \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $estudioLecturasRealizadas
     * @return RyxEstudioPorImagenes
     */
    public function addEstudioLecturasRealizada(\Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $estudioLecturasRealizadas)
    {
        $this->estudioLecturasRealizadas[] = $estudioLecturasRealizadas;

        return $this;
    }

    /**
     * Remove estudioLecturasRealizadas
     *
     * @param \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $estudioLecturasRealizadas
     */
    public function removeEstudioLecturasRealizada(\Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $estudioLecturasRealizadas)
    {
        $this->estudioLecturasRealizadas->removeElement($estudioLecturasRealizadas);
    }

    /**
     * Get estudioLecturasRealizadas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudioLecturasRealizadas()
    {
        return $this->estudioLecturasRealizadas;
    }

    /**
     * Add estudioLecturaEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxLecturaEstudio $estudioLecturaEstudio
     * @return RyxEstudioPorImagenes
     */
    public function addEstudioLecturaEstudio(\Minsal\SimagdBundle\Entity\RyxLecturaEstudio $estudioLecturaEstudio)
    {
        $this->estudioLecturaEstudio[] = $estudioLecturaEstudio;

        return $this;
    }

    /**
     * Remove estudioLecturaEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxLecturaEstudio $estudioLecturaEstudio
     */
    public function removeEstudioLecturaEstudio(\Minsal\SimagdBundle\Entity\RyxLecturaEstudio $estudioLecturaEstudio)
    {
        $this->estudioLecturaEstudio->removeElement($estudioLecturaEstudio);
    }

    /**
     * Get estudioLecturaEstudio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudioLecturaEstudio()
    {
        return $this->estudioLecturaEstudio;
    }

    /**
     * Add estudioPendienteLectura
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPendienteLectura $estudioPendienteLectura
     * @return RyxEstudioPorImagenes
     */
    public function addEstudioPendienteLectura(\Minsal\SimagdBundle\Entity\RyxEstudioPendienteLectura $estudioPendienteLectura)
    {
        $this->estudioPendienteLectura[] = $estudioPendienteLectura;

        return $this;
    }

    /**
     * Remove estudioPendienteLectura
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPendienteLectura $estudioPendienteLectura
     */
    public function removeEstudioPendienteLectura(\Minsal\SimagdBundle\Entity\RyxEstudioPendienteLectura $estudioPendienteLectura)
    {
        $this->estudioPendienteLectura->removeElement($estudioPendienteLectura);
    }

    /**
     * Get estudioPendienteLectura
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudioPendienteLectura()
    {
        return $this->estudioPendienteLectura;
    }

    /**
     * Add estudioEstudiosConsecuentes
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $estudioEstudiosConsecuentes
     * @return RyxEstudioPorImagenes
     */
    public function addEstudioEstudiosConsecuente(\Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $estudioEstudiosConsecuentes)
    {
        $this->estudioEstudiosConsecuentes[] = $estudioEstudiosConsecuentes;

        return $this;
    }

    /**
     * Remove estudioEstudiosConsecuentes
     *
     * @param \Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $estudioEstudiosConsecuentes
     */
    public function removeEstudioEstudiosConsecuente(\Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes $estudioEstudiosConsecuentes)
    {
        $this->estudioEstudiosConsecuentes->removeElement($estudioEstudiosConsecuentes);
    }

    /**
     * Get estudioEstudiosConsecuentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudioEstudiosConsecuentes()
    {
        return $this->estudioEstudiosConsecuentes;
    }
}
