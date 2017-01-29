<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgCtlTipoNotaDiagnostico
 *
 * @ORM\Table(name="img_ctl_tipo_nota_diagnostico", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_tipo_nota_diagnostico", columns={"codigo"})})
 * @ORM\Entity
 */
class ImgCtlTipoNotaDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_ctl_tipo_nota_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tipo", type="string", nullable=false)
     */
    private $nombreTipo;

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
     * @return ImgCtlTipoNotaDiagnostico
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
     * Set codigo
     *
     * @param string $codigo
     * @return ImgCtlTipoNotaDiagnostico
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
     * @return ImgCtlTipoNotaDiagnostico
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
