<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxBloqueoAgenda
 *
 * @ORM\Table(name="img_bloqueo_agenda", indexes={@ORM\Index(name="IDX_DC5C2770992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_DC5C2770592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_DC5C27707DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_DC5C277032E38BF3", columns={"id_radiologo_bloqueo"}), @ORM\Index(name="IDX_DC5C2770AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_DC5C2770D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxBloqueoAgendaRepository")
 */
class RyxBloqueoAgenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_bloqueo_agenda_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=75, nullable=true)
     */
    private $titulo = 'Horario Bloqueado';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion = 'Este horario se encuentra bloqueado, no puede programar citas en este intervalo';

    /**
     * @var boolean
     *
     * @ORM\Column(name="dia_completo", type="boolean", nullable=true)
     */
    private $diaCompleto = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=false)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time", nullable=false)
     */
    private $horaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=15, nullable=true)
     */
    private $color = 'yellow';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ultima_edicion", type="datetime", nullable=true)
     */
    private $fechaUltimaEdicion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="superposicion", type="boolean", nullable=true)
     */
    private $superposicion = false;

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_registra", referencedColumnName="id")
     * })
     */
    private $idEmpleadoRegistra;

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_bloqueo", referencedColumnName="id")
     * })
     */
    private $idRadiologoBloqueo;

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
     * @ORM\OneToMany(targetEntity="ImgExclusionBloqueo", mappedBy="idBloqueoAgenda", cascade={"all"}, orphanRemoval=true)
     */
    private $bloqueoExclusionesBloqueo;

    public function __toString()
    {
        return $this->titulo;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bloqueoExclusionesBloqueo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return RyxBloqueoAgenda
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return RyxBloqueoAgenda
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RyxBloqueoAgenda
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set diaCompleto
     *
     * @param boolean $diaCompleto
     * @return RyxBloqueoAgenda
     */
    public function setDiaCompleto($diaCompleto)
    {
        $this->diaCompleto = $diaCompleto;

        return $this;
    }

    /**
     * Get diaCompleto
     *
     * @return boolean 
     */
    public function getDiaCompleto()
    {
        return $this->diaCompleto;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return RyxBloqueoAgenda
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return RyxBloqueoAgenda
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return RyxBloqueoAgenda
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     * @return RyxBloqueoAgenda
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime 
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return RyxBloqueoAgenda
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set fechaUltimaEdicion
     *
     * @param \DateTime $fechaUltimaEdicion
     * @return RyxBloqueoAgenda
     */
    public function setFechaUltimaEdicion($fechaUltimaEdicion)
    {
        $this->fechaUltimaEdicion = $fechaUltimaEdicion;

        return $this;
    }

    /**
     * Get fechaUltimaEdicion
     *
     * @return \DateTime 
     */
    public function getFechaUltimaEdicion()
    {
        return $this->fechaUltimaEdicion;
    }

    /**
     * Set superposicion
     *
     * @param boolean $superposicion
     * @return RyxBloqueoAgenda
     */
    public function setSuperposicion($superposicion)
    {
        $this->superposicion = $superposicion;

        return $this;
    }

    /**
     * Get superposicion
     *
     * @return boolean 
     */
    public function getSuperposicion()
    {
        return $this->superposicion;
    }

    /**
     * Set idAreaServicioDiagnostico
     *
     * @param \Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico $idAreaServicioDiagnostico
     * @return RyxBloqueoAgenda
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
     * Set idEmpleadoRegistra
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleadoRegistra
     * @return RyxBloqueoAgenda
     */
    public function setIdEmpleadoRegistra(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleadoRegistra = null)
    {
        $this->idEmpleadoRegistra = $idEmpleadoRegistra;

        return $this;
    }

    /**
     * Get idEmpleadoRegistra
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdEmpleadoRegistra()
    {
        return $this->idEmpleadoRegistra;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return RyxBloqueoAgenda
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
     * Set idRadiologoBloqueo
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoBloqueo
     * @return RyxBloqueoAgenda
     */
    public function setIdRadiologoBloqueo(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoBloqueo = null)
    {
        $this->idRadiologoBloqueo = $idRadiologoBloqueo;

        return $this;
    }

    /**
     * Get idRadiologoBloqueo
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoBloqueo()
    {
        return $this->idRadiologoBloqueo;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     * @return RyxBloqueoAgenda
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
     * @return RyxBloqueoAgenda
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
     * Add bloqueoExclusionesBloqueo
     *
     * @param \Minsal\SimagdBundle\Entity\ImgExclusionBloqueo $bloqueoExclusionesBloqueo
     * @return RyxBloqueoAgenda
     */
    public function addBloqueoExclusionesBloqueo(\Minsal\SimagdBundle\Entity\ImgExclusionBloqueo $bloqueoExclusionesBloqueo)
    {
        $this->bloqueoExclusionesBloqueo[] = $bloqueoExclusionesBloqueo;

        return $this;
    }

    /**
     * Remove bloqueoExclusionesBloqueo
     *
     * @param \Minsal\SimagdBundle\Entity\ImgExclusionBloqueo $bloqueoExclusionesBloqueo
     */
    public function removeBloqueoExclusionesBloqueo(\Minsal\SimagdBundle\Entity\ImgExclusionBloqueo $bloqueoExclusionesBloqueo)
    {
        $this->bloqueoExclusionesBloqueo->removeElement($bloqueoExclusionesBloqueo);
    }

    /**
     * Get bloqueoExclusionesBloqueo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBloqueoExclusionesBloqueo()
    {
        return $this->bloqueoExclusionesBloqueo;
    }
}
