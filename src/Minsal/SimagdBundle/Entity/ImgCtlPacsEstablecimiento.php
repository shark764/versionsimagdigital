<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlPacsEstablecimiento
 *
 * @ORM\Table(name="img_ctl_pacs_establecimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_nombre_conexion_pacs", columns={"nombre_conexion"})}, indexes={@ORM\Index(name="IDX_83F55087DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_83F550825D64570", columns={"id_motor"}), @ORM\Index(name="IDX_83F5508AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_83F5508D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\PacsEstablecimientoRepository")
 */
class ImgCtlPacsEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_pacs_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_conexion", type="string", nullable=true)
     */
    private $nombreConexion = 'conn_pacsdb_local';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=255, nullable=false)
     */
    private $clave;

    /**
     * @var integer
     *
     * @ORM\Column(name="puerto", type="integer", nullable=false)
     */
    private $puerto = '5432';

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", nullable=false)
     */
    private $host;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_estudio", type="smallint", nullable=true)
     */
    private $duracionEstudio = '48';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_base_datos", type="string", nullable=false)
     */
    private $nombreBaseDatos = 'dcm4chee';

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     */
    private $fechaHoraReg = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;

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
     * @var \ImgCtlMotorBd
     *
     * @ORM\ManyToOne(targetEntity="ImgCtlMotorBd")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_motor", referencedColumnName="id")
     * })
     */
    private $idMotor;

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


    public function __toString() {
        return 'Conexión PACS: ' . $this->nombreConexion . ' : ' . $this->ip ;
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
     * Set nombreConexion
     *
     * @param string $nombreConexion
     * @return ImgCtlPacsEstablecimiento
     */
    public function setNombreConexion($nombreConexion)
    {
        $this->nombreConexion = $nombreConexion;

        return $this;
    }

    /**
     * Get nombreConexion
     *
     * @return string 
     */
    public function getNombreConexion()
    {
        return $this->nombreConexion;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return ImgCtlPacsEstablecimiento
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return ImgCtlPacsEstablecimiento
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set clave
     *
     * @param string $clave
     * @return ImgCtlPacsEstablecimiento
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set puerto
     *
     * @param integer $puerto
     * @return ImgCtlPacsEstablecimiento
     */
    public function setPuerto($puerto)
    {
        $this->puerto = $puerto;

        return $this;
    }

    /**
     * Get puerto
     *
     * @return integer 
     */
    public function getPuerto()
    {
        return $this->puerto;
    }

    /**
     * Set host
     *
     * @param string $host
     * @return ImgCtlPacsEstablecimiento
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string 
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set duracionEstudio
     *
     * @param integer $duracionEstudio
     * @return ImgCtlPacsEstablecimiento
     */
    public function setDuracionEstudio($duracionEstudio)
    {
        $this->duracionEstudio = $duracionEstudio;

        return $this;
    }

    /**
     * Get duracionEstudio
     *
     * @return integer 
     */
    public function getDuracionEstudio()
    {
        return $this->duracionEstudio;
    }

    /**
     * Set nombreBaseDatos
     *
     * @param string $nombreBaseDatos
     * @return ImgCtlPacsEstablecimiento
     */
    public function setNombreBaseDatos($nombreBaseDatos)
    {
        $this->nombreBaseDatos = $nombreBaseDatos;

        return $this;
    }

    /**
     * Get nombreBaseDatos
     *
     * @return string 
     */
    public function getNombreBaseDatos()
    {
        return $this->nombreBaseDatos;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return ImgCtlPacsEstablecimiento
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     * @return ImgCtlPacsEstablecimiento
     */
    public function setFechaHoraReg($fechaHoraReg)
    {
        $this->fechaHoraReg = $fechaHoraReg;

        return $this;
    }

    /**
     * Get fechaHoraReg
     *
     * @return \DateTime 
     */
    public function getFechaHoraReg()
    {
        return $this->fechaHoraReg;
    }

    /**
     * Set fechaHoraMod
     *
     * @param \DateTime $fechaHoraMod
     * @return ImgCtlPacsEstablecimiento
     */
    public function setFechaHoraMod($fechaHoraMod)
    {
        $this->fechaHoraMod = $fechaHoraMod;

        return $this;
    }

    /**
     * Get fechaHoraMod
     *
     * @return \DateTime 
     */
    public function getFechaHoraMod()
    {
        return $this->fechaHoraMod;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgCtlPacsEstablecimiento
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
     * Set idMotor
     *
     * @param \Minsal\SimagdBundle\Entity\ImgCtlMotorBd $idMotor
     * @return ImgCtlPacsEstablecimiento
     */
    public function setIdMotor(\Minsal\SimagdBundle\Entity\ImgCtlMotorBd $idMotor = null)
    {
        $this->idMotor = $idMotor;

        return $this;
    }

    /**
     * Get idMotor
     *
     * @return \Minsal\SimagdBundle\Entity\ImgCtlMotorBd 
     */
    public function getIdMotor()
    {
        return $this->idMotor;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return ImgCtlPacsEstablecimiento
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
     * @return ImgCtlPacsEstablecimiento
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
}