<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgExpedienteFicticio
 *
 * @ORM\Table(name="img_expediente_ficticio", uniqueConstraints={@ORM\UniqueConstraint(name="idx_numero_expediente_ficticio", columns={"id_establecimiento", "numero"})}, indexes={@ORM\Index(name="IDX_521FC2EF7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_521FC2EFD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\RyxExpedienteFicticioRepository")
 */
class ImgExpedienteFicticio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_expediente_ficticio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=12, nullable=true)
     */
    private $numero;

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
     * @var string
     *
     * @ORM\Column(name="nombre_ficticio", type="string", length=75, nullable=true)
     */
    private $nombreFicticio = 'Paciente desconocido';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristicas", type="string", length=255, nullable=true)
     */
    private $caracteristicas = 'El paciente se encuentra inconsciente';

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;


    public function __toString()
    {
        return $this->nombreFicticio . ' - ' . $this->numero;
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
     * Set numero
     *
     * @param string $numero
     * @return ImgExpedienteFicticio
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return ImgExpedienteFicticio
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
     * @return ImgExpedienteFicticio
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
     * Set nombreFicticio
     *
     * @param string $nombreFicticio
     * @return ImgExpedienteFicticio
     */
    public function setNombreFicticio($nombreFicticio)
    {
        $this->nombreFicticio = $nombreFicticio;

        return $this;
    }

    /**
     * Get nombreFicticio
     *
     * @return string 
     */
    public function getNombreFicticio()
    {
        return $this->nombreFicticio;
    }

    /**
     * Set caracteristicas
     *
     * @param string $caracteristicas
     * @return ImgExpedienteFicticio
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    /**
     * Get caracteristicas
     *
     * @return string 
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     * @return ImgExpedienteFicticio
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
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     * @return ImgExpedienteFicticio
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
