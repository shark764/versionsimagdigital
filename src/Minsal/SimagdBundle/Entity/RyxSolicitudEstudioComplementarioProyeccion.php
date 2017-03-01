<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxSolicitudEstudioComplementarioProyeccion
 *
 * @ORM\Table(name="ryx_solicitud_estudio_complementario_proyeccion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_solicitud_estudio_complementario_proyeccion", columns={"id_solicitud_estudio_complementario", "id_proyeccion_solicitada"})}, indexes={@ORM\Index(name="IDX_B172CA3DCA460C63", columns={"id_proyeccion_solicitada"}), @ORM\Index(name="IDX_B172CA3DF0951F8F", columns={"id_solicitud_estudio_complementario"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudioComplementarioProyeccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_complementario_proyeccion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="vistas_requeridas", type="smallint", nullable=true)
     */
    private $vistasRequeridas = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="dimensiones", type="string", length=25, nullable=true)
     */
    private $dimensiones;

    /**
     * @var string
     *
     * @ORM\Column(name="otras_especificaciones", type="string", length=100, nullable=true)
     */
    private $otrasEspecificaciones;

    /**
     * @var \RyxCtlProyeccionRadiologica
     *
     * @ORM\ManyToOne(targetEntity="RyxCtlProyeccionRadiologica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proyeccion_solicitada", referencedColumnName="id")
     * })
     */
    private $idProyeccionSolicitada;

    /**
     * @var \RyxSolicitudEstudioComplementario
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudioComplementario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio_complementario", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudioComplementario;


}
