<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecHistorialClinico
 *
 * @ORM\Table(name="sec_historial_clinico", indexes={@ORM\Index(name="fki_mnt_aten_area_mod_estab_sec_historial_clinico", columns={"idsubservicio"}), @ORM\Index(name="fki_fos_user_user_sec_historial_clinico", columns={"idusuarioreg"}), @ORM\Index(name="IDX_B5886216890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_B5886216445651A7", columns={"id_numero_expediente"}), @ORM\Index(name="IDX_B588621675BB31F7", columns={"idestablecimiento"}), @ORM\Index(name="IDX_B588621643F314A6", columns={"idnumeroexp"})})
 * @ORM\Entity
 */
class SecHistorialClinico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_historial_clinico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="datosclinicos", type="string", length=200, nullable=true)
     */
    private $datosclinicos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaconsulta", type="date", nullable=true)
     */
    private $fechaconsulta;

    /**
     * @var string
     *
     * @ORM\Column(name="empleado", type="string", length=7, nullable=true)
     */
    private $empleado;

    /**
     * @var string
     *
     * @ORM\Column(name="seguimientoconsultaext", type="string", nullable=true)
     */
    private $seguimientoconsultaext;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var string
     *
     * @ORM\Column(name="piloto", type="string", nullable=true)
     */
    private $piloto;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddress", type="string", length=15, nullable=true)
     */
    private $ipaddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="idmodalidad", type="integer", nullable=true)
     */
    private $idmodalidad;

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
     * @var \Minsal\SiapsBundle\Entity\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_numero_expediente", referencedColumnName="id")
     * })
     */
    private $idNumeroExpediente;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAtenAreaModEstab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsubservicio", referencedColumnName="id")
     * })
     */
    private $idsubservicio;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimiento", referencedColumnName="id")
     * })
     */
    private $idestablecimiento;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idnumeroexp", referencedColumnName="numero")
     * })
     */
    private $idnumeroexp;

    public function __toString() {
        return $this->idNumeroExpediente . ' :: ' . $this->piloto . ' :: ' . $this->idsubservicio;
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
     * Set datosclinicos
     *
     * @param string $datosclinicos
     * @return SecHistorialClinico
     */
    public function setDatosclinicos($datosclinicos)
    {
        $this->datosclinicos = $datosclinicos;

        return $this;
    }

    /**
     * Get datosclinicos
     *
     * @return string 
     */
    public function getDatosclinicos()
    {
        return $this->datosclinicos;
    }

    /**
     * Set fechaconsulta
     *
     * @param \DateTime $fechaconsulta
     * @return SecHistorialClinico
     */
    public function setFechaconsulta($fechaconsulta)
    {
        $this->fechaconsulta = $fechaconsulta;

        return $this;
    }

    /**
     * Get fechaconsulta
     *
     * @return \DateTime 
     */
    public function getFechaconsulta()
    {
        return $this->fechaconsulta;
    }

    /**
     * Set empleado
     *
     * @param string $empleado
     * @return SecHistorialClinico
     */
    public function setEmpleado($empleado)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return string 
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set seguimientoconsultaext
     *
     * @param string $seguimientoconsultaext
     * @return SecHistorialClinico
     */
    public function setSeguimientoconsultaext($seguimientoconsultaext)
    {
        $this->seguimientoconsultaext = $seguimientoconsultaext;

        return $this;
    }

    /**
     * Get seguimientoconsultaext
     *
     * @return string 
     */
    public function getSeguimientoconsultaext()
    {
        return $this->seguimientoconsultaext;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return SecHistorialClinico
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime 
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set piloto
     *
     * @param string $piloto
     * @return SecHistorialClinico
     */
    public function setPiloto($piloto)
    {
        $this->piloto = $piloto;

        return $this;
    }

    /**
     * Get piloto
     *
     * @return string 
     */
    public function getPiloto()
    {
        return $this->piloto;
    }

    /**
     * Set ipaddress
     *
     * @param string $ipaddress
     * @return SecHistorialClinico
     */
    public function setIpaddress($ipaddress)
    {
        $this->ipaddress = $ipaddress;

        return $this;
    }

    /**
     * Get ipaddress
     *
     * @return string 
     */
    public function getIpaddress()
    {
        return $this->ipaddress;
    }

    /**
     * Set idmodalidad
     *
     * @param integer $idmodalidad
     * @return SecHistorialClinico
     */
    public function setIdmodalidad($idmodalidad)
    {
        $this->idmodalidad = $idmodalidad;

        return $this;
    }

    /**
     * Get idmodalidad
     *
     * @return integer 
     */
    public function getIdmodalidad()
    {
        return $this->idmodalidad;
    }

    /**
     * Set idEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado
     * @return SecHistorialClinico
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
     * Set idNumeroExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idNumeroExpediente
     * @return SecHistorialClinico
     */
    public function setIdNumeroExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $idNumeroExpediente = null)
    {
        $this->idNumeroExpediente = $idNumeroExpediente;

        return $this;
    }

    /**
     * Get idNumeroExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente 
     */
    public function getIdNumeroExpediente()
    {
        return $this->idNumeroExpediente;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return SecHistorialClinico
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = null)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set idsubservicio
     *
     * @param \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idsubservicio
     * @return SecHistorialClinico
     */
    public function setIdsubservicio(\Minsal\SiapsBundle\Entity\MntAtenAreaModEstab $idsubservicio = null)
    {
        $this->idsubservicio = $idsubservicio;

        return $this;
    }

    /**
     * Get idsubservicio
     *
     * @return \Minsal\SiapsBundle\Entity\MntAtenAreaModEstab 
     */
    public function getIdsubservicio()
    {
        return $this->idsubservicio;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return SecHistorialClinico
     */
    public function setIdestablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento = null)
    {
        $this->idestablecimiento = $idestablecimiento;

        return $this;
    }

    /**
     * Get idestablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdestablecimiento()
    {
        return $this->idestablecimiento;
    }

    /**
     * Set idnumeroexp
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idnumeroexp
     * @return SecHistorialClinico
     */
    public function setIdnumeroexp(\Minsal\SiapsBundle\Entity\MntExpediente $idnumeroexp = null)
    {
        $this->idnumeroexp = $idnumeroexp;

        return $this;
    }

    /**
     * Get idnumeroexp
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente 
     */
    public function getIdnumeroexp()
    {
        return $this->idnumeroexp;
    }
}
