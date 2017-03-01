<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxDiagnosticoPendienteValidacion
 *
 * @ORM\Table(name="ryx_diagnostico_pendiente_validacion", indexes={@ORM\Index(name="IDX_84FBD63DC6991215", columns={"id_asigna_validador"}), @ORM\Index(name="IDX_84FBD63D838319BF", columns={"id_diagnostico"}), @ORM\Index(name="IDX_84FBD63D7DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_84FBD63D6E8C181B", columns={"id_radiologo_asignado"})})
 * @ORM\Entity
 */
class RyxDiagnosticoPendienteValidacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_diagnostico_pendiente_validacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso_lista", type="datetime", nullable=true)
     */
    private $fechaIngresoLista = '(now())::timestamp(0) without time zone';

    /**
     * @var boolean
     *
     * @ORM\Column(name="fue_corregido", type="boolean", nullable=true)
     */
    private $fueCorregido = false;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_validador", referencedColumnName="id")
     * })
     */
    private $idAsignaValidador;

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
     *   @ORM\JoinColumn(name="id_radiologo_asignado", referencedColumnName="id")
     * })
     */
    private $idRadiologoAsignado;


}
