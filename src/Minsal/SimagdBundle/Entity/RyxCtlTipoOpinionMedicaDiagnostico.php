<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlTipoOpinionMedicaDiagnostico
 *
 * @ORM\Table(name="ryx_ctl_tipo_opinion_medica_diagnostico", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_tipo_nota_diagnostico", columns={"codigo"})})
 * @ORM\Entity
 */
class RyxCtlTipoOpinionMedicaDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_tipo_opinion_medica_diagnostico_id_seq", allocationSize=1, initialValue=1)
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


}
