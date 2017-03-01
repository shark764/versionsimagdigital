<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxLecturaPendienteTranscripcion
 *
 * @ORM\Table(name="ryx_lectura_pendiente_transcripcion", indexes={@ORM\Index(name="IDX_5809D741408A6B12", columns={"id_asigna_transcriptor"}), @ORM\Index(name="IDX_5809D7417DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_5809D74118971421", columns={"id_lectura"}), @ORM\Index(name="IDX_5809D741CC6E65C8", columns={"id_transcriptor_asignado"})})
 * @ORM\Entity
 */
class RyxLecturaPendienteTranscripcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_lectura_pendiente_transcripcion_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="fue_impugnado", type="boolean", nullable=true)
     */
    private $fueImpugnado = false;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_transcriptor", referencedColumnName="id")
     * })
     */
    private $idAsignaTranscriptor;

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
     * @var \RyxLecturaRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxLecturaRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lectura", referencedColumnName="id")
     * })
     */
    private $idLectura;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_transcriptor_asignado", referencedColumnName="id")
     * })
     */
    private $idTranscriptorAsignado;


}
