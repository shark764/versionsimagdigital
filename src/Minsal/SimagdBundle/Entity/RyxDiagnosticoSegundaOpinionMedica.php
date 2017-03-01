<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxDiagnosticoSegundaOpinionMedica
 *
 * @ORM\Table(name="ryx_diagnostico_segunda_opinion_medica", indexes={@ORM\Index(name="IDX_F185AA86838319BF", columns={"id_diagnostico"}), @ORM\Index(name="IDX_F185AA86890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_F185AA867DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_F185AA869FA5140", columns={"id_tipo_nota_diagnostico"}), @ORM\Index(name="IDX_F185AA86D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxDiagnosticoSegundaOpinionMedica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_diagnostico_segunda_opinion_medica_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=true)
     */
    private $contenido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_emision", type="datetime", nullable=true)
     */
    private $fechaEmision = '(now())::timestamp(0) without time zone';

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \RyxDiagnosticoRadiologico
     *
     * @ORM\ManyToOne(targetEntity="RyxDiagnosticoRadiologico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diagnostico", referencedColumnName="id")
     * })
     */
    private $idDiagnostico;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

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
     * @var \RyxCtlTipoOpinionMedicaDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlTipoOpinionMedicaDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_nota_diagnostico", referencedColumnName="id")
     * })
     */
    private $idTipoNotaDiagnostico;

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
