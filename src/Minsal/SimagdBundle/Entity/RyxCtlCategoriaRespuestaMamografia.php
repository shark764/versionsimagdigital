<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlCategoriaRespuestaMamografia
 *
 * @ORM\Table(name="ryx_ctl_categoria_respuesta_mamografia", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_categoria_resultado_mamografia", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_10AC4AB03B0C60A0", columns={"id_categoria_padre"})})
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $definicion;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_predictivo_positivo", type="string", length=25, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $valorPredictivoPositivo;

    /**
     * @var string
     *
     * @ORM\Column(name="sugerencia", type="string", length=50, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $sugerencia;

    /**
     * @var string
     *
     * @ORM\Column(name="seguimiento", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
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
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
    /**
     * Text converter for the Entity (Second form).
     */
    public function getPresentacionEntidad()
    {
    }
    
    /**
     * Text converter for the Entity (Third form).
     */
    public function getFormatoPresentacionEntidad()
    {
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

}