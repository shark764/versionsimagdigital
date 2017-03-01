<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxDiagnosticoRadiologico
 *
 * @ORM\Table(name="ryx_diagnostico_radiologico", indexes={@ORM\Index(name="IDX_84921FBF890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_84921FBF22BF8FB7", columns={"id_estado_diagnostico"}), @ORM\Index(name="IDX_84921FBF18971421", columns={"id_lectura"}), @ORM\Index(name="IDX_84921FBF9DF124FC", columns={"id_patron_aplicado"}), @ORM\Index(name="IDX_84921FBFD4D28F5A", columns={"id_radiologo_aprueba"}), @ORM\Index(name="IDX_84921FBFAC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_84921FBFD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class RyxDiagnosticoRadiologico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_diagnostico_radiologico_id_seq", allocationSize=1, initialValue=1)
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_transcrito", type="datetime", nullable=true)
     */
    private $fechaTranscrito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_corregido", type="datetime", nullable=true)
     */
    private $fechaCorregido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobado", type="datetime", nullable=true)
     */
    private $fechaAprobado;

    /**
     * @var string
     *
     * @ORM\Column(name="errores", type="text", nullable=true)
     */
    private $errores;

    /**
     * @var string
     *
     * @ORM\Column(name="incidencias", type="string", length=255, nullable=true)
     */
    private $incidencias;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     */
    private $recomendaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro = '(now())::timestamp(0) without time zone';

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
     * @var \RyxCtlEstadoDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlEstadoDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_diagnostico", referencedColumnName="id")
     * })
     */
    private $idEstadoDiagnostico;

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
     * @var \RyxCtlPatronDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlPatronDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patron_aplicado", referencedColumnName="id")
     * })
     */
    private $idPatronAplicado;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_aprueba", referencedColumnName="id")
     * })
     */
    private $idRadiologoAprueba;

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
