<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SimagdBundle\Entity\EntityInterface;

/**
 * RyxDiagnosticoRadiologico
 *
 * @ORM\Table(name="ryx_diagnostico_radiologico", indexes={@ORM\Index(name="IDX_84921FBF890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_84921FBF22BF8FB7", columns={"id_estado_diagnostico"}), @ORM\Index(name="IDX_84921FBF18971421", columns={"id_lectura"}), @ORM\Index(name="IDX_84921FBF9DF124FC", columns={"id_patron_aplicado"}), @ORM\Index(name="IDX_84921FBFD4D28F5A", columns={"id_radiologo_aprueba"}), @ORM\Index(name="IDX_84921FBFAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_84921FBFD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxDiagnosticoRadiologicoRepository")
 */
class RyxDiagnosticoRadiologico implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_diagnostico_radiologico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hallazgos", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $hallazgos;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $conclusion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_transcrito", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaTranscrito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_corregido", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaCorregido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobado", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaAprobado;

    /**
     * @var string
     *
     * @ORM\Column(name="errores", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $errores;

    /**
     * @var string
     *
     * @ORM\Column(name="incidencias", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $incidencias;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $recomendaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaRegistro = '(now())::timestamp(0) without time zone';

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
     * @var \RyxCtlEstadoDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_diagnostico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstadoDiagnostico;

    /**
     * @var \RyxLecturaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxLecturaRadiologica", inversedBy="lecturaDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     */
    private $idLectura;

    /**
     * @var \RyxCtlPatronDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlPatronDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patron_aplicado", referencedColumnName="id")
     * })
     */
    private $idPatronAplicado;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_aprueba", referencedColumnName="id")
     * })
     */
    private $idRadiologoAprueba;

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
     * @ORM\OneToMany(targetEntity="RyxDiagnosticoSegundaOpinionMedica", mappedBy="idDiagnostico", cascade={"all"}, orphanRemoval=true)
     */
    private $notasDiagnostico;

    /**
     * @ORM\OneToMany(targetEntity="RyxDiagnosticoPendienteValidacion", mappedBy="idDiagnostico", cascade={"all"}, orphanRemoval=true)
     */
    private $diagnosticoPendienteValidar;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notasDiagnostico = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diagnosticoPendienteValidar = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return 'Transcripción de: ' . $this->idLectura . ' :: ' . $this->idEstadoDiagnostico;
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
     * Set hallazgos
     *
     * @param string $hallazgos
     * @return RyxDiagnosticoRadiologico
     */
    public function setHallazgos($hallazgos)
    {
        $this->hallazgos = $hallazgos;

        return $this;
    }

    /**
     * Get hallazgos
     *
     * @return string 
     */
    public function getHallazgos()
    {
        return $this->hallazgos;
    }

    /**
     * Set conclusion
     *
     * @param string $conclusion
     * @return RyxDiagnosticoRadiologico
     */
    public function setConclusion($conclusion)
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    /**
     * Get conclusion
     *
     * @return string 
     */
    public function getConclusion()
    {
        return $this->conclusion;
    }

    /**
     * Set fechaTranscrito
     *
     * @param \DateTime $fechaTranscrito
     * @return RyxDiagnosticoRadiologico
     */
    public function setFechaTranscrito($fechaTranscrito)
    {
        $this->fechaTranscrito = $fechaTranscrito;

        return $this;
    }

    /**
     * Get fechaTranscrito
     *
     * @return \DateTime 
     */
    public function getFechaTranscrito()
    {
        return $this->fechaTranscrito;
    }

    /**
     * Set fechaCorregido
     *
     * @param \DateTime $fechaCorregido
     * @return RyxDiagnosticoRadiologico
     */
    public function setFechaCorregido($fechaCorregido)
    {
        $this->fechaCorregido = $fechaCorregido;

        return $this;
    }

    /**
     * Get fechaCorregido
     *
     * @return \DateTime 
     */
    public function getFechaCorregido()
    {
        return $this->fechaCorregido;
    }

    /**
     * Set fechaAprobado
     *
     * @param \DateTime $fechaAprobado
     * @return RyxDiagnosticoRadiologico
     */
    public function setFechaAprobado($fechaAprobado)
    {
        $this->fechaAprobado = $fechaAprobado;

        return $this;
    }

    /**
     * Get fechaAprobado
     *
     * @return \DateTime 
     */
    public function getFechaAprobado()
    {
        return $this->fechaAprobado;
    }

    /**
     * Set errores
     *
     * @param string $errores
     * @return RyxDiagnosticoRadiologico
     */
    public function setErrores($errores)
    {
        $this->errores = $errores;

        return $this;
    }

    /**
     * Get errores
     *
     * @return string 
     */
    public function getErrores()
    {
        return $this->errores;
    }

    /**
     * Set incidencias
     *
     * @param string $incidencias
     * @return RyxDiagnosticoRadiologico
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return RyxDiagnosticoRadiologico
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
     * Set recomendaciones
     *
     * @param string $recomendaciones
     * @return RyxDiagnosticoRadiologico
     */
    public function setRecomendaciones($recomendaciones)
    {
        $this->recomendaciones = $recomendaciones;

        return $this;
    }

    /**
     * Get recomendaciones
     *
     * @return string 
     */
    public function getRecomendaciones()
    {
        return $this->recomendaciones;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return RyxDiagnosticoRadiologico
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
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return RyxDiagnosticoRadiologico
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
     * Set idEstadoDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlEstadoDiagnostico $idEstadoDiagnostico
     * @return RyxDiagnosticoRadiologico
     */
    public function setIdEstadoDiagnostico(\Minsal\SimagdBundle\Entity\RyxCtlEstadoDiagnostico $idEstadoDiagnostico = null)
    {
        $this->idEstadoDiagnostico = $idEstadoDiagnostico;

        return $this;
    }

    /**
     * Get idEstadoDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlEstadoDiagnostico 
     */
    public function getIdEstadoDiagnostico()
    {
        return $this->idEstadoDiagnostico;
    }

    /**
     * Set idLectura
     *
     * @param \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $idLectura
     * @return RyxDiagnosticoRadiologico
     */
    public function setIdLectura(\Minsal\SimagdBundle\Entity\RyxLecturaRadiologica $idLectura = null)
    {
        $this->idLectura = $idLectura;

        return $this;
    }

    /**
     * Get idLectura
     *
     * @return \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica 
     */
    public function getIdLectura()
    {
        return $this->idLectura;
    }

    /**
     * Set idPatronAplicado
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlPatronDiagnostico $idPatronAplicado
     * @return RyxDiagnosticoRadiologico
     */
    public function setIdPatronAplicado(\Minsal\SimagdBundle\Entity\RyxCtlPatronDiagnostico $idPatronAplicado = null)
    {
        $this->idPatronAplicado = $idPatronAplicado;

        return $this;
    }

    /**
     * Get idPatronAplicado
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlPatronDiagnostico 
     */
    public function getIdPatronAplicado()
    {
        return $this->idPatronAplicado;
    }

    /**
     * Set idRadiologoAprueba
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAprueba
     * @return RyxDiagnosticoRadiologico
     */
    public function setIdRadiologoAprueba(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAprueba = null)
    {
        $this->idRadiologoAprueba = $idRadiologoAprueba;

        return $this;
    }

    /**
     * Get idRadiologoAprueba
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoAprueba()
    {
        return $this->idRadiologoAprueba;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxDiagnosticoRadiologico
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
     * @return RyxDiagnosticoRadiologico
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
     * Add notasDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxDiagnosticoSegundaOpinionMedica $notasDiagnostico
     * @return RyxDiagnosticoRadiologico
     */
    public function addNotasDiagnostico(\Minsal\SimagdBundle\Entity\RyxDiagnosticoSegundaOpinionMedica $notasDiagnostico)
    {
        $this->notasDiagnostico[] = $notasDiagnostico;

        return $this;
    }

    /**
     * Remove notasDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\RyxDiagnosticoSegundaOpinionMedica $notasDiagnostico
     */
    public function removeNotasDiagnostico(\Minsal\SimagdBundle\Entity\RyxDiagnosticoSegundaOpinionMedica $notasDiagnostico)
    {
        $this->notasDiagnostico->removeElement($notasDiagnostico);
    }

    /**
     * Get notasDiagnostico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotasDiagnostico()
    {
        return $this->notasDiagnostico;
    }

    /**
     * Add diagnosticoPendienteValidar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxDiagnosticoPendienteValidacion $diagnosticoPendienteValidar
     * @return RyxDiagnosticoRadiologico
     */
    public function addDiagnosticoPendienteValidar(\Minsal\SimagdBundle\Entity\RyxDiagnosticoPendienteValidacion $diagnosticoPendienteValidar)
    {
        $this->diagnosticoPendienteValidar[] = $diagnosticoPendienteValidar;

        return $this;
    }

    /**
     * Remove diagnosticoPendienteValidar
     *
     * @param \Minsal\SimagdBundle\Entity\RyxDiagnosticoPendienteValidacion $diagnosticoPendienteValidar
     */
    public function removeDiagnosticoPendienteValidar(\Minsal\SimagdBundle\Entity\RyxDiagnosticoPendienteValidacion $diagnosticoPendienteValidar)
    {
        $this->diagnosticoPendienteValidar->removeElement($diagnosticoPendienteValidar);
    }

    /**
     * Get diagnosticoPendienteValidar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticoPendienteValidar()
    {
        return $this->diagnosticoPendienteValidar;
    }
}
