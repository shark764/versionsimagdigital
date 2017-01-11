<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlEstadoSolicitud
 *
 * @ORM\Table(name="img_ctl_estado_solicitud", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_estado_solicitud", columns={"codigo"})})
 * @ORM\Entity
 */
class ImgCtlEstadoSolicitud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_estado_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_estado", type="string", nullable=false)
     */
    private $nombreEstado;

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

    /**
     * @var integer
     *
     * @ORM\Column(name="porcentaje_avance", type="smallint", nullable=false)
     */
    private $porcentajeAvance = '0';


    public function __toString() {
        return $this->nombreEstado ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombreEstado), 'utf-8') : '';
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
     * Set nombreEstado
     *
     * @param string $nombreEstado
     * @return ImgCtlEstadoSolicitud
     */
    public function setNombreEstado($nombreEstado)
    {
        $this->nombreEstado = $nombreEstado;

        return $this;
    }

    /**
     * Get nombreEstado
     *
     * @return string
     */
    public function getNombreEstado()
    {
        return $this->nombreEstado;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return ImgCtlEstadoSolicitud
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
     * @return ImgCtlEstadoSolicitud
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

    /**
     * Set porcentajeAvance
     *
     * @param integer $porcentajeAvance
     * @return ImgCtlEstadoSolicitud
     */
    public function setPorcentajeAvance($porcentajeAvance)
    {
        $this->porcentajeAvance = $porcentajeAvance;

        return $this;
    }

    /**
     * Get porcentajeAvance
     *
     * @return integer
     */
    public function getPorcentajeAvance()
    {
        return $this->porcentajeAvance;
    }
}
