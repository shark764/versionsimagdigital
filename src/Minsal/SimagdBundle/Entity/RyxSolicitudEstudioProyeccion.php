<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RyxSolicitudEstudioProyeccion
 *
 * @ORM\Table(name="ryx_solicitud_estudio_proyeccion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_solicitud_estudio_proyeccion", columns={"id_solicitud_estudio", "id_proyeccion_solicitada"})}, indexes={@ORM\Index(name="IDX_26885BF5CA460C63", columns={"id_proyeccion_solicitada"}), @ORM\Index(name="IDX_26885BF56AAA01BF", columns={"id_solicitud_estudio"})})
 * @ORM\Entity
 */
class RyxSolicitudEstudioProyeccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ryx_solicitud_estudio_proyeccion_id_seq", allocationSize=1, initialValue=1)
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
     * @var \RyxSolicitudEstudio
     *
     * @ORM\ManyToOne(targetEntity="RyxSolicitudEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_estudio", referencedColumnName="id")
     * })
     */
    private $idSolicitudEstudio;


}
