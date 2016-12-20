<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlTipoResultado
 *
 * @ORM\Table(name="img_ctl_tipo_resultado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_tipo_resultado", columns={"codigo"})})
 * @ORM\Entity
 */
class ImgCtlTipoResultado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_tipo_resultado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tipo", type="string", length=50, nullable=false)
     */
    private $nombreTipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indeterminado", type="boolean", nullable=true)
     */
    private $indeterminado = false;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="estilo_presentacion", type="string", nullable=true)
     */
    private $estiloPresentacion = 'primary-v2';
    
    public function __toString() {
        return $this->nombreTipo ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombreTipo), 'utf-8') : '';
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
     * Set nombreTipo
     *
     * @param string $nombreTipo
     * @return ImgCtlTipoResultado
     */
    public function setNombreTipo($nombreTipo)
    {
        $this->nombreTipo = $nombreTipo;

        return $this;
    }

    /**
     * Get nombreTipo
     *
     * @return string 
     */
    public function getNombreTipo()
    {
        return $this->nombreTipo;
    }

    /**
     * Set indeterminado
     *
     * @param boolean $indeterminado
     * @return ImgCtlTipoResultado
     */
    public function setIndeterminado($indeterminado)
    {
        $this->indeterminado = $indeterminado;

        return $this;
    }

    /**
     * Get indeterminado
     *
     * @return boolean 
     */
    public function getIndeterminado()
    {
        return $this->indeterminado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ImgCtlTipoResultado
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
     * @return ImgCtlTipoResultado
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
     * @return ImgCtlTipoResultado
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
