<?php

namespace Pladuch\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogoTrabajosTraduccion
 *
 * @ORM\Table(name="catalogo_trabajos_traduccion", indexes={@ORM\Index(name="FK_DESCRIPCIONTRABAJOS_TRADUCCION", columns={"catalogotrabajos_id"})})
 * @ORM\Entity
 */
class CatalogoTrabajosTraduccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idioma_id", type="integer", nullable=false)
     */
    private $idiomaId;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \CatalogoTrabajos
     *
     * @ORM\ManyToOne(targetEntity="CatalogoTrabajos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="catalogotrabajos_id", referencedColumnName="id")
     * })
     */
    private $catalogotrabajos;



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
     * Set idiomaId
     *
     * @param integer $idiomaId
     * @return CatalogoTrabajosTraduccion
     */
    public function setIdiomaId($idiomaId)
    {
        $this->idiomaId = $idiomaId;

        return $this;
    }

    /**
     * Get idiomaId
     *
     * @return integer 
     */
    public function getIdiomaId()
    {
        return $this->idiomaId;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CatalogoTrabajosTraduccion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set catalogotrabajos
     *
     * @param \Pladuch\DataBundle\Entity\CatalogoTrabajos $catalogotrabajos
     * @return CatalogoTrabajosTraduccion
     */
    public function setCatalogotrabajos(\Pladuch\DataBundle\Entity\CatalogoTrabajos $catalogotrabajos = null)
    {
        $this->catalogotrabajos = $catalogotrabajos;

        return $this;
    }

    /**
     * Get catalogotrabajos
     *
     * @return \Pladuch\DataBundle\Entity\CatalogoTrabajos 
     */
    public function getCatalogotrabajos()
    {
        return $this->catalogotrabajos;
    }
}
