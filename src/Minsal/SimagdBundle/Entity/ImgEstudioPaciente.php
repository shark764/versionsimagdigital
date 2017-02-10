<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgEstudioPaciente
 *
 * @ORM\Table(name="img_estudio_paciente", indexes={@ORM\Index(name="IDX_20B8CA257DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_20B8CA25F485B2E3", columns={"id_estudio_padre"}), @ORM\Index(name="IDX_20B8CA25701624C4", columns={"id_expediente"}), @ORM\Index(name="IDX_20B8CA2533CCFAF2", columns={"id_expediente_ficticio"}), @ORM\Index(name="IDX_20B8CA259E9497EB", columns={"id_procedimiento_realizado"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxEstudioPorImagenesRepository")
 */
class ImgEstudioPaciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_estudio_paciente_id_seq", allocationSize=1, initialValue=1)
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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \ImgEstudioPaciente
     *
     * @ORM\ManyToOne(targetEntity="ImgEstudioPaciente", inversedBy="estudioEstudiosConsecuentes")
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
     * @var \ImgExpedienteFicticio
     *
     * @ORM\ManyToOne(targetEntity="ImgExpedienteFicticio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente_ficticio", referencedColumnName="id")
     * })
     */
    private $idExpedienteFicticio;

    /**
     * @var \ImgProcedimientoRealizado
     *
     * @ORM\ManyToOne(targetEntity="ImgProcedimientoRealizado", inversedBy="examenEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedimiento_realizado", referencedColumnName="id")
     * })
     */
    private $idProcedimientoRealizado;


    /**
     * @ORM\OneToMany(targetEntity="ImgSolicitudEstudioComplementario", mappedBy="idEstudioPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioEstudiosComplementarios;


    /**
     * @ORM\OneToMany(targetEntity="ImgSolicitudDiagnostico", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioSolicitudesDiagnostico;


    /**
     * @ORM\OneToMany(targetEntity="ImgLectura", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioLecturasRealizadas;


    /**
     * @ORM\OneToMany(targetEntity="ImgLecturaEstudio", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioLecturaEstudio;


    /**
     * @ORM\OneToMany(targetEntity="ImgPendienteLectura", mappedBy="idEstudio", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioPendienteLectura;


    /**
     * @ORM\OneToMany(targetEntity="ImgEstudioPaciente", mappedBy="idEstudioPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $estudioEstudiosConsecuentes;



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
     * @return ImgEstudioPaciente
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
     * @return ImgEstudioPaciente
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
     * @return ImgEstudioPaciente
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
     * @return ImgEstudioPaciente
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
     * @return ImgEstudioPaciente
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
     * @return ImgEstudioPaciente
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
     * @return ImgEstudioPaciente
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
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $idEstudioPadre
     * @return ImgEstudioPaciente
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
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     * @return ImgEstudioPaciente
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
     * @param \Minsal\SimagdBundle\Entity\ImgExpedienteFicticio $idExpedienteFicticio
     * @return ImgEstudioPaciente
     */
    public function setIdExpedienteFicticio(\Minsal\SimagdBundle\Entity\ImgExpedienteFicticio $idExpedienteFicticio = null)
    {
        $this->idExpedienteFicticio = $idExpedienteFicticio;

        return $this;
    }

    /**
     * Get idExpedienteFicticio
     *
     * @return \Minsal\SimagdBundle\Entity\ImgExpedienteFicticio 
     */
    public function getIdExpedienteFicticio()
    {
        return $this->idExpedienteFicticio;
    }

    /**
     * Set idProcedimientoRealizado
     *
     * @param \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $idProcedimientoRealizado
     * @return ImgEstudioPaciente
     */
    public function setIdProcedimientoRealizado(\Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado $idProcedimientoRealizado = null)
    {
        $this->idProcedimientoRealizado = $idProcedimientoRealizado;

        return $this;
    }

    /**
     * Get idProcedimientoRealizado
     *
     * @return \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado 
     */
    public function getIdProcedimientoRealizado()
    {
        return $this->idProcedimientoRealizado;
    }

    /**
     * Add estudioEstudiosComplementarios
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $estudioEstudiosComplementarios
     * @return ImgEstudioPaciente
     */
    public function addEstudioEstudiosComplementario(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $estudioEstudiosComplementarios)
    {
        $this->estudioEstudiosComplementarios[] = $estudioEstudiosComplementarios;

        return $this;
    }

    /**
     * Remove estudioEstudiosComplementarios
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $estudioEstudiosComplementarios
     */
    public function removeEstudioEstudiosComplementario(\Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario $estudioEstudiosComplementarios)
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
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico $estudioSolicitudesDiagnostico
     * @return ImgEstudioPaciente
     */
    public function addEstudioSolicitudesDiagnostico(\Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico $estudioSolicitudesDiagnostico)
    {
        $this->estudioSolicitudesDiagnostico[] = $estudioSolicitudesDiagnostico;

        return $this;
    }

    /**
     * Remove estudioSolicitudesDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico $estudioSolicitudesDiagnostico
     */
    public function removeEstudioSolicitudesDiagnostico(\Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico $estudioSolicitudesDiagnostico)
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
     * @param \Minsal\SimagdBundle\Entity\ImgLectura $estudioLecturasRealizadas
     * @return ImgEstudioPaciente
     */
    public function addEstudioLecturasRealizada(\Minsal\SimagdBundle\Entity\ImgLectura $estudioLecturasRealizadas)
    {
        $this->estudioLecturasRealizadas[] = $estudioLecturasRealizadas;

        return $this;
    }

    /**
     * Remove estudioLecturasRealizadas
     *
     * @param \Minsal\SimagdBundle\Entity\ImgLectura $estudioLecturasRealizadas
     */
    public function removeEstudioLecturasRealizada(\Minsal\SimagdBundle\Entity\ImgLectura $estudioLecturasRealizadas)
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
     * @param \Minsal\SimagdBundle\Entity\ImgLecturaEstudio $estudioLecturaEstudio
     * @return ImgEstudioPaciente
     */
    public function addEstudioLecturaEstudio(\Minsal\SimagdBundle\Entity\ImgLecturaEstudio $estudioLecturaEstudio)
    {
        $this->estudioLecturaEstudio[] = $estudioLecturaEstudio;

        return $this;
    }

    /**
     * Remove estudioLecturaEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\ImgLecturaEstudio $estudioLecturaEstudio
     */
    public function removeEstudioLecturaEstudio(\Minsal\SimagdBundle\Entity\ImgLecturaEstudio $estudioLecturaEstudio)
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
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteLectura $estudioPendienteLectura
     * @return ImgEstudioPaciente
     */
    public function addEstudioPendienteLectura(\Minsal\SimagdBundle\Entity\ImgPendienteLectura $estudioPendienteLectura)
    {
        $this->estudioPendienteLectura[] = $estudioPendienteLectura;

        return $this;
    }

    /**
     * Remove estudioPendienteLectura
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteLectura $estudioPendienteLectura
     */
    public function removeEstudioPendienteLectura(\Minsal\SimagdBundle\Entity\ImgPendienteLectura $estudioPendienteLectura)
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
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudioEstudiosConsecuentes
     * @return ImgEstudioPaciente
     */
    public function addEstudioEstudiosConsecuente(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudioEstudiosConsecuentes)
    {
        $this->estudioEstudiosConsecuentes[] = $estudioEstudiosConsecuentes;

        return $this;
    }

    /**
     * Remove estudioEstudiosConsecuentes
     *
     * @param \Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudioEstudiosConsecuentes
     */
    public function removeEstudioEstudiosConsecuente(\Minsal\SimagdBundle\Entity\ImgEstudioPaciente $estudioEstudiosConsecuentes)
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
