<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxCtlPatronDiagnostico
 *
 * @ORM\Table(name="ryx_ctl_patron_diagnostico", uniqueConstraints={@ORM\UniqueConstraint(name="idx_codigo_patron_diagnostico_establecimiento", columns={"codigo", "id_establecimiento"})}, indexes={@ORM\Index(name="IDX_2EC2B493992127D5", columns={"id_area_servicio_diagnostico"}), @ORM\Index(name="IDX_2EC2B493592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_2EC2B4937DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_2EC2B49329CF97D1", columns={"id_radiologo_define"}), @ORM\Index(name="IDX_2EC2B493D426DB54", columns={"id_tipo_resultado"}), @ORM\Index(name="IDX_2EC2B493AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_2EC2B493D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxCtlPatronDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_ctl_patron_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hallazgos", type="text", nullable=true)
     */
    private $hallazgos;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="text", nullable=true)
     */
    private $conclusion;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     */
    private $recomendaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="indicaciones_generales", type="string", length=255, nullable=true)
     */
    private $indicacionesGenerales;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     */
    private $fechaHoraReg = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

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
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_registra", referencedColumnName="id")
     * })
     */
    private $idEmpleadoRegistra;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_define", referencedColumnName="id")
     * })
     */
    private $idRadiologoDefine;

    /**
     * @var \RyxCtlTipoRespuestaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlTipoRespuestaRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_resultado", referencedColumnName="id")
     * })
     */
    private $idTipoResultado;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;


}
