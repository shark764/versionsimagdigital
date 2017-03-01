<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxSolicitudEstudioMamografia
 *
 * @ORM\Table(name="ryx_solicitud_estudio_mamografia", indexes={@ORM\Index(name="IDX_5046AB08992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_5046AB086AAA01BF", columns={"id_solicitud_estudio"}), @ORM\Index(name="IDX_5046AB0815EA100E", columns={"id_tipo_mamografia"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudioMamografia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_mamografia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_presento_menarquia", type="smallint", nullable=true)
     */
    private $edadPresentoMenarquia = '15';

    /**
     * @var boolean
     *
     * @ORM\Column(name="usa_hormonas", type="boolean", nullable=true)
     */
    private $usaHormonas = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usa_anticonceptivos", type="boolean", nullable=true)
     */
    private $usaAnticonceptivos = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="antecedentes_familiares_cancer_mama", type="boolean", nullable=true)
     */
    private $antecedentesFamiliaresCancerMama = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mamografias_previas", type="boolean", nullable=true)
     */
    private $mamografiasPrevias = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_presento_menopausia", type="smallint", nullable=true)
     */
    private $edadPresentoMenopausia = '40';

    /**
     * @var boolean
     *
     * @ORM\Column(name="tiene_ovarios", type="boolean", nullable=true)
     */
    private $tieneOvarios = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usa_tsh", type="boolean", nullable=true)
     */
    private $usaTsh = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="antecedentes_personales_cancer_mama", type="boolean", nullable=true)
     */
    private $antecedentesPersonalesCancerMama = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_resultado", type="datetime", nullable=true)
     */
    private $fechaResultado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="embarazo", type="boolean", nullable=true)
     */
    private $embarazo = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_primer_embarazo", type="smallint", nullable=true)
     */
    private $edadPrimerEmbarazo = '25';

    /**
     * @var integer
     *
     * @ORM\Column(name="abortos", type="smallint", nullable=true)
     */
    private $abortos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="partos", type="smallint", nullable=true)
     */
    private $partos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cesareas", type="smallint", nullable=true)
     */
    private $cesareas = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="cirugias_previas", type="text", nullable=true)
     */
    private $cirugiasPrevias;

    /**
     * @var boolean
     *
     * @ORM\Column(name="implantes", type="boolean", nullable=true)
     */
    private $implantes = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disminucion", type="boolean", nullable=true)
     */
    private $disminucion = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mastectomia", type="boolean", nullable=true)
     */
    private $mastectomia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cuadrantectomia", type="boolean", nullable=true)
     */
    private $cuadrantectomia = false;

    /**
     * @var string
     *
     * @ORM\Column(name="patologias", type="text", nullable=true)
     */
    private $patologias;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

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
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudio;

    /**
     * @var \RyxCtlTipoMamografia
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlTipoMamografia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_mamografia", referencedColumnName="id")
     * })
     */
    private $idTipoMamografia;


}
