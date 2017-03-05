<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxSolicitudEstudioMamografia
 *
 * @ORM\Table(name="ryx_solicitud_estudio_mamografia", indexes={@ORM\Index(name="IDX_5046AB08992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_5046AB086AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_5046AB0815EA100E", columns={"id_tipo_mamografia"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxSolicitudEstudioMamografiaRepository")
 */
class RyxSolicitudEstudioMamografia implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_mamografia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_presento_menarquia", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edadPresentoMenarquia = 15;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usa_hormonas", type="boolean", nullable=true)
     */
    private $usaHormonas = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usa_anticonceptivos", type="boolean", nullable=true)
     */
    private $usaAnticonceptivos = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="antecedentes_familiares_cancer_mama", type="boolean", nullable=true)
     */
    private $antecedentesFamiliaresCancerMama = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mamografias_previas", type="boolean", nullable=true)
     */
    private $mamografiasPrevias = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_presento_menopausia", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edadPresentoMenopausia = 40;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tiene_ovarios", type="boolean", nullable=true)
     */
    private $tieneOvarios = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usa_tsh", type="boolean", nullable=true)
     */
    private $usaTsh = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="antecedentes_personales_cancer_mama", type="boolean", nullable=true)
     */
    private $antecedentesPersonalesCancerMama = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_resultado", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaResultado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="embarazo", type="boolean", nullable=true)
     */
    private $embarazo = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_primer_embarazo", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edadPrimerEmbarazo = 25;

    /**
     * @var integer
     *
     * @ORM\Column(name="abortos", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $abortos = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="partos", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $partos = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="cesareas", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $cesareas = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="cirugias_previas", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $cirugiasPrevias;

    /**
     * @var boolean
     *
     * @ORM\Column(name="implantes", type="boolean", nullable=true)
     */
    private $implantes = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disminucion", type="boolean", nullable=true)
     */
    private $disminucion = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mastectomia", type="boolean", nullable=true)
     */
    private $mastectomia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cuadrantectomia", type="boolean", nullable=true)
     */
    private $cuadrantectomia = false;

    /**
     * @var string
     *
     * @ORM\Column(name="patologias", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $patologias;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $observaciones;

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
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio", inversedBy="solicitudEstudioMamografia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudio;

    /**
     * @var \RyxCtlTipoMamografia
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlTipoMamografia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_mamografia", referencedColumnName="id")
     * })
     */
    private $idTipoMamografia;

    /**
     * @ORM\OneToMany(targetEntity="RyxSolicitudEstudioMamografiaSintomatologia", mappedBy="idSolicitudEstudioMamografia", cascade={"all"}, orphanRemoval=true)
     */
    private $solicitudEstudioMamografiaSintomatologia;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solicitudEstudioMamografiaSintomatologia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        /*
         * Extensión de la solicitud exclusiva para estudios de mama
         */
        return $this->idSolicitudEstudio ? mb_strtoupper(trim($this->idSolicitudEstudio), 'utf-8') . ' - ' . mb_strtoupper(trim($this->idTipoMamografia), 'utf-8') : '';
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
     * Set edadPresentoMenarquia
     *
     * @param integer $edadPresentoMenarquia
     * @return RyxSolicitudEstudioMamografia
     */
    public function setEdadPresentoMenarquia($edadPresentoMenarquia)
    {
        $this->edadPresentoMenarquia = $edadPresentoMenarquia;

        return $this;
    }

    /**
     * Get edadPresentoMenarquia
     *
     * @return integer 
     */
    public function getEdadPresentoMenarquia()
    {
        return $this->edadPresentoMenarquia;
    }

    /**
     * Set usaHormonas
     *
     * @param boolean $usaHormonas
     * @return RyxSolicitudEstudioMamografia
     */
    public function setUsaHormonas($usaHormonas)
    {
        $this->usaHormonas = $usaHormonas;

        return $this;
    }

    /**
     * Get usaHormonas
     *
     * @return boolean 
     */
    public function getUsaHormonas()
    {
        return $this->usaHormonas;
    }

    /**
     * Set usaAnticonceptivos
     *
     * @param boolean $usaAnticonceptivos
     * @return RyxSolicitudEstudioMamografia
     */
    public function setUsaAnticonceptivos($usaAnticonceptivos)
    {
        $this->usaAnticonceptivos = $usaAnticonceptivos;

        return $this;
    }

    /**
     * Get usaAnticonceptivos
     *
     * @return boolean 
     */
    public function getUsaAnticonceptivos()
    {
        return $this->usaAnticonceptivos;
    }

    /**
     * Set antecedentesFamiliaresCancerMama
     *
     * @param boolean $antecedentesFamiliaresCancerMama
     * @return RyxSolicitudEstudioMamografia
     */
    public function setAntecedentesFamiliaresCancerMama($antecedentesFamiliaresCancerMama)
    {
        $this->antecedentesFamiliaresCancerMama = $antecedentesFamiliaresCancerMama;

        return $this;
    }

    /**
     * Get antecedentesFamiliaresCancerMama
     *
     * @return boolean 
     */
    public function getAntecedentesFamiliaresCancerMama()
    {
        return $this->antecedentesFamiliaresCancerMama;
    }

    /**
     * Set mamografiasPrevias
     *
     * @param boolean $mamografiasPrevias
     * @return RyxSolicitudEstudioMamografia
     */
    public function setMamografiasPrevias($mamografiasPrevias)
    {
        $this->mamografiasPrevias = $mamografiasPrevias;

        return $this;
    }

    /**
     * Get mamografiasPrevias
     *
     * @return boolean 
     */
    public function getMamografiasPrevias()
    {
        return $this->mamografiasPrevias;
    }

    /**
     * Set edadPresentoMenopausia
     *
     * @param integer $edadPresentoMenopausia
     * @return RyxSolicitudEstudioMamografia
     */
    public function setEdadPresentoMenopausia($edadPresentoMenopausia)
    {
        $this->edadPresentoMenopausia = $edadPresentoMenopausia;

        return $this;
    }

    /**
     * Get edadPresentoMenopausia
     *
     * @return integer 
     */
    public function getEdadPresentoMenopausia()
    {
        return $this->edadPresentoMenopausia;
    }

    /**
     * Set tieneOvarios
     *
     * @param boolean $tieneOvarios
     * @return RyxSolicitudEstudioMamografia
     */
    public function setTieneOvarios($tieneOvarios)
    {
        $this->tieneOvarios = $tieneOvarios;

        return $this;
    }

    /**
     * Get tieneOvarios
     *
     * @return boolean 
     */
    public function getTieneOvarios()
    {
        return $this->tieneOvarios;
    }

    /**
     * Set usaTsh
     *
     * @param boolean $usaTsh
     * @return RyxSolicitudEstudioMamografia
     */
    public function setUsaTsh($usaTsh)
    {
        $this->usaTsh = $usaTsh;

        return $this;
    }

    /**
     * Get usaTsh
     *
     * @return boolean 
     */
    public function getUsaTsh()
    {
        return $this->usaTsh;
    }

    /**
     * Set antecedentesPersonalesCancerMama
     *
     * @param boolean $antecedentesPersonalesCancerMama
     * @return RyxSolicitudEstudioMamografia
     */
    public function setAntecedentesPersonalesCancerMama($antecedentesPersonalesCancerMama)
    {
        $this->antecedentesPersonalesCancerMama = $antecedentesPersonalesCancerMama;

        return $this;
    }

    /**
     * Get antecedentesPersonalesCancerMama
     *
     * @return boolean 
     */
    public function getAntecedentesPersonalesCancerMama()
    {
        return $this->antecedentesPersonalesCancerMama;
    }

    /**
     * Set fechaResultado
     *
     * @param \DateTime $fechaResultado
     * @return RyxSolicitudEstudioMamografia
     */
    public function setFechaResultado($fechaResultado)
    {
        $this->fechaResultado = $fechaResultado;

        return $this;
    }

    /**
     * Get fechaResultado
     *
     * @return \DateTime 
     */
    public function getFechaResultado()
    {
        return $this->fechaResultado;
    }

    /**
     * Set embarazo
     *
     * @param boolean $embarazo
     * @return RyxSolicitudEstudioMamografia
     */
    public function setEmbarazo($embarazo)
    {
        $this->embarazo = $embarazo;

        return $this;
    }

    /**
     * Get embarazo
     *
     * @return boolean 
     */
    public function getEmbarazo()
    {
        return $this->embarazo;
    }

    /**
     * Set edadPrimerEmbarazo
     *
     * @param integer $edadPrimerEmbarazo
     * @return RyxSolicitudEstudioMamografia
     */
    public function setEdadPrimerEmbarazo($edadPrimerEmbarazo)
    {
        $this->edadPrimerEmbarazo = $edadPrimerEmbarazo;

        return $this;
    }

    /**
     * Get edadPrimerEmbarazo
     *
     * @return integer 
     */
    public function getEdadPrimerEmbarazo()
    {
        return $this->edadPrimerEmbarazo;
    }

    /**
     * Set abortos
     *
     * @param integer $abortos
     * @return RyxSolicitudEstudioMamografia
     */
    public function setAbortos($abortos)
    {
        $this->abortos = $abortos;

        return $this;
    }

    /**
     * Get abortos
     *
     * @return integer 
     */
    public function getAbortos()
    {
        return $this->abortos;
    }

    /**
     * Set partos
     *
     * @param integer $partos
     * @return RyxSolicitudEstudioMamografia
     */
    public function setPartos($partos)
    {
        $this->partos = $partos;

        return $this;
    }

    /**
     * Get partos
     *
     * @return integer 
     */
    public function getPartos()
    {
        return $this->partos;
    }

    /**
     * Set cesareas
     *
     * @param integer $cesareas
     * @return RyxSolicitudEstudioMamografia
     */
    public function setCesareas($cesareas)
    {
        $this->cesareas = $cesareas;

        return $this;
    }

    /**
     * Get cesareas
     *
     * @return integer 
     */
    public function getCesareas()
    {
        return $this->cesareas;
    }

    /**
     * Set cirugiasPrevias
     *
     * @param string $cirugiasPrevias
     * @return RyxSolicitudEstudioMamografia
     */
    public function setCirugiasPrevias($cirugiasPrevias)
    {
        $this->cirugiasPrevias = $cirugiasPrevias;

        return $this;
    }

    /**
     * Get cirugiasPrevias
     *
     * @return string 
     */
    public function getCirugiasPrevias()
    {
        return $this->cirugiasPrevias;
    }

    /**
     * Set implantes
     *
     * @param boolean $implantes
     * @return RyxSolicitudEstudioMamografia
     */
    public function setImplantes($implantes)
    {
        $this->implantes = $implantes;

        return $this;
    }

    /**
     * Get implantes
     *
     * @return boolean 
     */
    public function getImplantes()
    {
        return $this->implantes;
    }

    /**
     * Set disminucion
     *
     * @param boolean $disminucion
     * @return RyxSolicitudEstudioMamografia
     */
    public function setDisminucion($disminucion)
    {
        $this->disminucion = $disminucion;

        return $this;
    }

    /**
     * Get disminucion
     *
     * @return boolean 
     */
    public function getDisminucion()
    {
        return $this->disminucion;
    }

    /**
     * Set mastectomia
     *
     * @param boolean $mastectomia
     * @return RyxSolicitudEstudioMamografia
     */
    public function setMastectomia($mastectomia)
    {
        $this->mastectomia = $mastectomia;

        return $this;
    }

    /**
     * Get mastectomia
     *
     * @return boolean 
     */
    public function getMastectomia()
    {
        return $this->mastectomia;
    }

    /**
     * Set cuadrantectomia
     *
     * @param boolean $cuadrantectomia
     * @return RyxSolicitudEstudioMamografia
     */
    public function setCuadrantectomia($cuadrantectomia)
    {
        $this->cuadrantectomia = $cuadrantectomia;

        return $this;
    }

    /**
     * Get cuadrantectomia
     *
     * @return boolean 
     */
    public function getCuadrantectomia()
    {
        return $this->cuadrantectomia;
    }

    /**
     * Set patologias
     *
     * @param string $patologias
     * @return RyxSolicitudEstudioMamografia
     */
    public function setPatologias($patologias)
    {
        $this->patologias = $patologias;

        return $this;
    }

    /**
     * Get patologias
     *
     * @return string 
     */
    public function getPatologias()
    {
        return $this->patologias;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return RyxSolicitudEstudioMamografia
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
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return RyxSolicitudEstudioMamografia
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
     * Set idSolicitudEstudio
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio $idSolicitudEstudio
     * @return RyxSolicitudEstudioMamografia
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
     * Set idTipoMamografia
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlTipoMamografia $idTipoMamografia
     * @return RyxSolicitudEstudioMamografia
     */
    public function setIdTipoMamografia(\Minsal\SimagdBundle\Entity\RyxCtlTipoMamografia $idTipoMamografia = null)
    {
        $this->idTipoMamografia = $idTipoMamografia;

        return $this;
    }

    /**
     * Get idTipoMamografia
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlTipoMamografia 
     */
    public function getIdTipoMamografia()
    {
        return $this->idTipoMamografia;
    }

    /**
     * Add solicitudEstudioMamografiaSintomatologia
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografiaSintomatologia $solicitudEstudioMamografiaSintomatologia
     * @return RyxSolicitudEstudioMamografia
     */
    public function addSolicitudEstudioMamografiaSintomatologium(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografiaSintomatologia $solicitudEstudioMamografiaSintomatologia)
    {
        $this->solicitudEstudioMamografiaSintomatologia[] = $solicitudEstudioMamografiaSintomatologia;

        return $this;
    }

    /**
     * Remove solicitudEstudioMamografiaSintomatologia
     *
     * @param \Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografiaSintomatologia $solicitudEstudioMamografiaSintomatologia
     */
    public function removeSolicitudEstudioMamografiaSintomatologium(\Minsal\SimagdBundle\Entity\RyxSolicitudEstudioMamografiaSintomatologia $solicitudEstudioMamografiaSintomatologia)
    {
        $this->solicitudEstudioMamografiaSintomatologia->removeElement($solicitudEstudioMamografiaSintomatologia);
    }

    /**
     * Get solicitudEstudioMamografiaSintomatologia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudEstudioMamografiaSintomatologia()
    {
        return $this->solicitudEstudioMamografiaSintomatologia;
    }
}
