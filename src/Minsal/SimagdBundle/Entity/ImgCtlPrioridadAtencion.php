<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlPrioridadAtencion
 *
 * @ORM\Table(name="img_ctl_prioridad_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_prioridad_atencion", columns={"codigo"})})
 * @ORM\Entity(repositoryClass="Minsal\SimagdBundle\Repository\PrioridadAtencionRepository")
 */
class ImgCtlPrioridadAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_prioridad_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */
    private $nombre = 'Normal';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=true)
     */
    private $descripcion = 'Paciente puede esperar para ser atendido';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=false)
     */
    private $codigo = 'NRM';

    /**
     * @var string
     *
     * @ORM\Column(name="estilo_presentacion", type="string", nullable=true)
     */
    private $estiloPresentacion = 'success-v2';


    public function __toString() {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
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
     * Set nombre
     *
     * @param string $nombre
     * @return ImgCtlPrioridadAtencion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ImgCtlPrioridadAtencion
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
     * Set codigo
     *
     * @param string $codigo
     * @return ImgCtlPrioridadAtencion
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set estiloPresentacion
     *
     * @param string $estiloPresentacion
     * @return ImgCtlPrioridadAtencion
     */
    public function setEstiloPresentacion($estiloPresentacion)
    {
        $this->estiloPresentacion = $estiloPresentacion;

        return $this;
    }

    /**
     * Get estiloPresentacion
     *
     * @return string 
     */
    public function getEstiloPresentacion()
    {
        return $this->estiloPresentacion;
    }
}
