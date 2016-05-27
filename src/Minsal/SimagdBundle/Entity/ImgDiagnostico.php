<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgDiagnostico
 *
 * @ORM\Table(name="img_diagnostico", indexes={@ORM\Index(name="IDX_15C1D2C6890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_15C1D2C622BF8FB7", columns={"id_estado_diagnostico"}), @ORM\Index(name="IDX_15C1D2C618971421", columns={"id_lectura"}), @ORM\Index(name="IDX_15C1D2C69DF124FC", columns={"id_patron_aplicado"}), @ORM\Index(name="IDX_15C1D2C6D4D28F5A", columns={"id_radiologo_aprueba"}), @ORM\Index(name="IDX_15C1D2C6AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_15C1D2C6D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\DiagnosticoRepository")
 */
class ImgDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hallazgos", type="text", nullable=true)
     */
    private $hallazgos;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="text", nullable=true)
     */
    private $conclusion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_transcrito", type="datetime", nullable=true)
     */
    private $fechaTranscrito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_corregido", type="datetime", nullable=true)
     */
    private $fechaCorregido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobado", type="datetime", nullable=true)
     */
    private $fechaAprobado;

    /**
     * @var string
     *
     * @ORM\Column(name="errores", type="text", nullable=true)
     */
    private $errores;

    /**
     * @var string
     *
     * @ORM\Column(name="incidencias", type="string", length=255, nullable=true)
     */
    private $incidencias;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     */
    private $recomendaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro = '(now())::timestamp(0) without time zone';

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

    /**
     * @var \ImgCtlEstadoDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlEstadoDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_diagnostico", referencedColumnName="id")
     * })
     */
    private $idEstadoDiagnostico;

    /**
     * @var \ImgLectura
     *
     * @ORM\ManyToOne(targetEntity="ImgLectura", inversedBy="lecturaDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     */
    private $idLectura;

    /**
     * @var \ImgCtlPatronDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlPatronDiagnostico")
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
     */
    private $idUserReg;



    /**
     * @ORM\OneToMany(targetEntity="ImgNotaDiagnostico", mappedBy="idDiagnostico", cascade={"all"}, orphanRemoval=true)
     */
    private $notasDiagnostico;

    /**
     * @ORM\OneToMany(targetEntity="ImgPendienteValidacion", mappedBy="idDiagnostico", cascade={"all"}, orphanRemoval=true)
     */
    private $diagnosticoPendienteValidar;


    public function __toString() {
        return 'Transcripción de: ' . $this->idLectura . ' :: ' . $this->idEstadoDiagnostico;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notasDiagnostico = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diagnosticoPendienteValidar = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @param \Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico $idEstadoDiagnostico
     * @return ImgDiagnostico
     */
    public function setIdEstadoDiagnostico(\Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico $idEstadoDiagnostico = null)
    {
        $this->idEstadoDiagnostico = $idEstadoDiagnostico;

        return $this;
    }

    /**
     * Get idEstadoDiagnostico
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico 
     */
    public function getIdEstadoDiagnostico()
    {
        return $this->idEstadoDiagnostico;
    }

    /**
     * Set idLectura
     *
     * @param \Minsal\SimagdBundle\Entity\ImgLectura $idLectura
     * @return ImgDiagnostico
     */
    public function setIdLectura(\Minsal\SimagdBundle\Entity\ImgLectura $idLectura = null)
    {
        $this->idLectura = $idLectura;

        return $this;
    }

    /**
     * Get idLectura
     *
     * @return \Minsal\SimagdBundle\Entity\ImgLectura 
     */
    public function getIdLectura()
    {
        return $this->idLectura;
    }

    /**
     * Set idPatronAplicado
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico $idPatronAplicado
     * @return ImgDiagnostico
     */
    public function setIdPatronAplicado(\Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico $idPatronAplicado = null)
    {
        $this->idPatronAplicado = $idPatronAplicado;

        return $this;
    }

    /**
     * Get idPatronAplicado
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico 
     */
    public function getIdPatronAplicado()
    {
        return $this->idPatronAplicado;
    }

    /**
     * Set idRadiologoAprueba
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoAprueba
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @return ImgDiagnostico
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
     * @param \Minsal\SimagdBundle\Entity\ImgNotaDiagnostico $notasDiagnostico
     * @return ImgDiagnostico
     */
    public function addNotasDiagnostico(\Minsal\SimagdBundle\Entity\ImgNotaDiagnostico $notasDiagnostico)
    {
        $this->notasDiagnostico[] = $notasDiagnostico;

        return $this;
    }

    /**
     * Remove notasDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\ImgNotaDiagnostico $notasDiagnostico
     */
    public function removeNotasDiagnostico(\Minsal\SimagdBundle\Entity\ImgNotaDiagnostico $notasDiagnostico)
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
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteValidacion $diagnosticoPendienteValidar
     * @return ImgDiagnostico
     */
    public function addDiagnosticoPendienteValidar(\Minsal\SimagdBundle\Entity\ImgPendienteValidacion $diagnosticoPendienteValidar)
    {
        $this->diagnosticoPendienteValidar[] = $diagnosticoPendienteValidar;

        return $this;
    }

    /**
     * Remove diagnosticoPendienteValidar
     *
     * @param \Minsal\SimagdBundle\Entity\ImgPendienteValidacion $diagnosticoPendienteValidar
     */
    public function removeDiagnosticoPendienteValidar(\Minsal\SimagdBundle\Entity\ImgPendienteValidacion $diagnosticoPendienteValidar)
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
