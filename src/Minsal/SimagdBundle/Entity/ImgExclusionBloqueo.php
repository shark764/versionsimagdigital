<?php

namespace Minsal\SimagdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImgExclusionBloqueo
 *
 * @ORM\Table(name="img_exclusion_bloqueo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_radiologo_bloqueo", columns={"id_radiologo_excluido", "id_bloqueo_agenda"})}, indexes={@ORM\Index(name="IDX_4778C24037A05A00", columns={"id_bloqueo_agenda"}), @ORM\Index(name="IDX_4778C240B781D14A", columns={"id_radiologo_excluido"})})
 * @ORM\Entity
 */
class ImgExclusionBloqueo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="img_exclusion_bloqueo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \ImgBloqueoAgenda
     *
     * @ORM\ManyToOne(targetEntity="ImgBloqueoAgenda", inversedBy="bloqueoExclusionesBloqueo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bloqueo_agenda", referencedColumnName="id")
     * })
     */
    private $idBloqueoAgenda;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_radiologo_excluido", referencedColumnName="id")
     * })
     */
    private $idRadiologoExcluido;


    public function __toString() {
        return '' . $this->$idBloqueoAgenda . ' :: ' . $this->$idRadiologoExcluido;
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
     * Set idBloqueoAgenda
     *
     * @param \Minsal\SimagdBundle\Entity\ImgBloqueoAgenda $idBloqueoAgenda
     * @return ImgExclusionBloqueo
     */
    public function setIdBloqueoAgenda(\Minsal\SimagdBundle\Entity\ImgBloqueoAgenda $idBloqueoAgenda = null)
    {
        $this->idBloqueoAgenda = $idBloqueoAgenda;

        return $this;
    }

    /**
     * Get idBloqueoAgenda
     *
     * @return \Minsal\SimagdBundle\Entity\ImgBloqueoAgenda 
     */
    public function getIdBloqueoAgenda()
    {
        return $this->idBloqueoAgenda;
    }

    /**
     * Set idRadiologoExcluido
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoExcluido
     * @return ImgExclusionBloqueo
     */
    public function setIdRadiologoExcluido(\Minsal\SiapsBundle\Entity\MntEmpleado $idRadiologoExcluido = null)
    {
        $this->idRadiologoExcluido = $idRadiologoExcluido;

        return $this;
    }

    /**
     * Get idRadiologoExcluido
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getIdRadiologoExcluido()
    {
        return $this->idRadiologoExcluido;
    }
}
