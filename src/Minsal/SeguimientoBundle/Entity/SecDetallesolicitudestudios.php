<?php

namespace Minsal\SeguimientoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecDetallesolicitudestudios
 *
 * @ORM\Table(name="sec_detallesolicitudestudios", indexes={@ORM\Index(name="IDX_B983B70C730CF75F", columns={"idempleado"}), @ORM\Index(name="IDX_B983B70C75BB31F7", columns={"idestablecimiento"}), @ORM\Index(name="IDX_B983B70C87364D84", columns={"idestablecimientoexterno"}), @ORM\Index(name="IDX_B983B70C2AB3F305", columns={"estadodetalle"}), @ORM\Index(name="IDX_B983B70C35F12240", columns={"idexamen"}), @ORM\Index(name="IDX_B983B70C13B895A1", columns={"idusuarioreg"}), @ORM\Index(name="IDX_B983B70CB1B94CA1", columns={"idorigenmuestra"}), @ORM\Index(name="IDX_B983B70CF06DFE3D", columns={"idsolicitudestudio"}), @ORM\Index(name="IDX_B983B70CDAB57264", columns={"idtipomuestra"})})
 * @ORM\Entity
 */
class SecDetallesolicitudestudios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sec_detallesolicitudestudios_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="indicacion", type="string", length=250, nullable=true)
     */
    private $indicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=250, nullable=true)
     */
    private $observacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="date", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idempleado", referencedColumnName="id")
     * })
     */
    private $idempleado;

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
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idestablecimientoexterno", referencedColumnName="id")
     * })
     */
    private $idestablecimientoexterno;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstadoServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstadoServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadodetalle", referencedColumnName="id")
     * })
     */
    private $estadodetalle;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idexamen", referencedColumnName="id")
     * })
     */
    private $idexamen;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    // /**
    //  * @var \MntOrigenmuestra
    //  *
    //  * @ORM\ManyToOne(targetEntity="MntOrigenmuestra")
    //  * @ORM\JoinColumns({
    //  *   @ORM\JoinColumn(name="idorigenmuestra", referencedColumnName="id")
    //  * })
    //  */
    // private $idorigenmuestra;

    /**
     * @var \SecSolicitudestudios
     *
     * @ORM\ManyToOne(targetEntity="SecSolicitudestudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsolicitudestudio", referencedColumnName="id")
     * })
     */
    private $idsolicitudestudio;

    // /**
    //  * @var \LabTipomuestra
    //  *
    //  * @ORM\ManyToOne(targetEntity="LabTipomuestra")
    //  * @ORM\JoinColumns({
    //  *   @ORM\JoinColumn(name="idtipomuestra", referencedColumnName="id")
    //  * })
    //  */
    // private $idtipomuestra;
    
    public function __toString()
    {
        return (string) $this->idexamen ? : '';
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
     * Set indicacion
     *
     * @param string $indicacion
     * @return SecDetallesolicitudestudios
     */
    public function setIndicacion($indicacion)
    {
        $this->indicacion = $indicacion;

        return $this;
    }

    /**
     * Get indicacion
     *
     * @return string 
     */
    public function getIndicacion()
    {
        return $this->indicacion;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return SecDetallesolicitudestudios
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     * @return SecDetallesolicitudestudios
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
     * Set idempleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idempleado
     * @return SecDetallesolicitudestudios
     */
    public function setIdempleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idempleado = null)
    {
        $this->idempleado = $idempleado;

        return $this;
    }

    /**
     * Get idempleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdempleado()
    {
        return $this->idempleado;
    }

    /**
     * Set idestablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimiento
     * @return SecDetallesolicitudestudios
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
     * Set idestablecimientoexterno
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoexterno
     * @return SecDetallesolicitudestudios
     */
    public function setIdestablecimientoexterno(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idestablecimientoexterno = null)
    {
        $this->idestablecimientoexterno = $idestablecimientoexterno;

        return $this;
    }

    /**
     * Get idestablecimientoexterno
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getIdestablecimientoexterno()
    {
        return $this->idestablecimientoexterno;
    }

    /**
     * Set estadodetalle
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstadoServicioDiagnostico $estadodetalle
     * @return SecDetallesolicitudestudios
     */
    public function setEstadodetalle(\Minsal\SiapsBundle\Entity\CtlEstadoServicioDiagnostico $estadodetalle = null)
    {
        $this->estadodetalle = $estadodetalle;

        return $this;
    }

    /**
     * Get estadodetalle
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstadoServicioDiagnostico 
     */
    public function getEstadodetalle()
    {
        return $this->estadodetalle;
    }

    /**
     * Set idexamen
     *
     * @param \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento $idexamen
     * @return SecDetallesolicitudestudios
     */
    public function setIdexamen(\Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento $idexamen = null)
    {
        $this->idexamen = $idexamen;

        return $this;
    }

    /**
     * Get idexamen
     *
     * @return \Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento 
     */
    public function getIdexamen()
    {
        return $this->idexamen;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     * @return SecDetallesolicitudestudios
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
     * Set idsolicitudestudio
     *
     * @param \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios $idsolicitudestudio
     * @return SecDetallesolicitudestudios
     */
    public function setIdsolicitudestudio(\Minsal\SeguimientoBundle\Entity\SecSolicitudestudios $idsolicitudestudio = null)
    {
        $this->idsolicitudestudio = $idsolicitudestudio;

        return $this;
    }

    /**
     * Get idsolicitudestudio
     *
     * @return \Minsal\SeguimientoBundle\Entity\SecSolicitudestudios 
     */
    public function getIdsolicitudestudio()
    {
        return $this->idsolicitudestudio;
    }
}
