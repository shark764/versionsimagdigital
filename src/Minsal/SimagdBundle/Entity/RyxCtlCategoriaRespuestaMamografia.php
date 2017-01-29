<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlCategoriaRespuestaMamografia
 *
 * @ORM\Table(name="ryx_ctl_categoria_respuesta_mamografia", uniqueConstraints={@ORM\UniqueConstraint(name="idx_ryx_codigo_categoria_respuesta_mamografia", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_10AC4AB03B0C60A0", columns={"id_categoria_padre"})})
 * @ORM\Entity
 */
class RyxCtlCategoriaRespuestaMamografia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_categoria_respuesta_mamografia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=10, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria", type="smallint", nullable=false)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
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
     * @ORM\Column(name="definicion", type="string", length=255, nullable=true)
     */
    private $definicion;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_predictivo_positivo", type="string", length=25, nullable=true)
     */
    private $valorPredictivoPositivo;

    /**
     * @var string
     *
     * @ORM\Column(name="sugerencia", type="string", length=50, nullable=true)
     */
    private $sugerencia;

    /**
     * @var string
     *
     * @ORM\Column(name="seguimiento", type="string", length=255, nullable=true)
     */
    private $seguimiento;

    /**
     * @var \RyxCtlCategoriaRespuestaMamografia
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlCategoriaRespuestaMamografia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria_padre", referencedColumnName="id")
     * })
     */
    private $idCategoriaPadre;



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
     * @return RyxCtlCategoriaRespuestaMamografia
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
     * Set categoria
     *
     * @param integer $categoria
     * @return RyxCtlCategoriaRespuestaMamografia
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RyxCtlCategoriaRespuestaMamografia
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
     * @return RyxCtlCategoriaRespuestaMamografia
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
     * Set definicion
     *
     * @param string $definicion
     * @return RyxCtlCategoriaRespuestaMamografia
     */
    public function setDefinicion($definicion)
    {
        $this->definicion = $definicion;

        return $this;
    }

    /**
     * Get definicion
     *
     * @return string 
     */
    public function getDefinicion()
    {
        return $this->definicion;
    }

    /**
     * Set valorPredictivoPositivo
     *
     * @param string $valorPredictivoPositivo
     * @return RyxCtlCategoriaRespuestaMamografia
     */
    public function setValorPredictivoPositivo($valorPredictivoPositivo)
    {
        $this->valorPredictivoPositivo = $valorPredictivoPositivo;

        return $this;
    }

    /**
     * Get valorPredictivoPositivo
     *
     * @return string 
     */
    public function getValorPredictivoPositivo()
    {
        return $this->valorPredictivoPositivo;
    }

    /**
     * Set sugerencia
     *
     * @param string $sugerencia
     * @return RyxCtlCategoriaRespuestaMamografia
     */
    public function setSugerencia($sugerencia)
    {
        $this->sugerencia = $sugerencia;

        return $this;
    }

    /**
     * Get sugerencia
     *
     * @return string 
     */
    public function getSugerencia()
    {
        return $this->sugerencia;
    }

    /**
     * Set seguimiento
     *
     * @param string $seguimiento
     * @return RyxCtlCategoriaRespuestaMamografia
     */
    public function setSeguimiento($seguimiento)
    {
        $this->seguimiento = $seguimiento;

        return $this;
    }

    /**
     * Get seguimiento
     *
     * @return string 
     */
    public function getSeguimiento()
    {
        return $this->seguimiento;
    }

    /**
     * Set idCategoriaPadre
     *
     * @param \Minsal\SimagdBundle\Entity\RyxCtlCategoriaRespuestaMamografia $idCategoriaPadre
     * @return RyxCtlCategoriaRespuestaMamografia
     */
    public function setIdCategoriaPadre(\Minsal\SimagdBundle\Entity\RyxCtlCategoriaRespuestaMamografia $idCategoriaPadre = null)
    {
        $this->idCategoriaPadre = $idCategoriaPadre;

        return $this;
    }

    /**
     * Get idCategoriaPadre
     *
     * @return \Minsal\SimagdBundle\Entity\RyxCtlCategoriaRespuestaMamografia 
     */
    public function getIdCategoriaPadre()
    {
        return $this->idCategoriaPadre;
    }
}
