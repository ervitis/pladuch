<?php

namespace Pladuch\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogoMaterialesTraduccion
 *
 * @ORM\Table(name="catalogo_materiales_traduccion", indexes={@ORM\Index(name="FK_DESCRIPCIONMATERIALES_TRADUCCION", columns={"catalogomateriales_id"})})
 * @ORM\Entity
 */
class CatalogoMaterialesTraduccion
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
     * @var \CatalogoMateriales
     *
     * @ORM\ManyToOne(targetEntity="CatalogoMateriales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="catalogomateriales_id", referencedColumnName="id")
     * })
     */
    private $catalogomateriales;



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
     * @return CatalogoMaterialesTraduccion
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
     * @return CatalogoMaterialesTraduccion
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
     * Set catalogomateriales
     *
     * @param \Pladuch\DataBundle\Entity\CatalogoMateriales $catalogomateriales
     * @return CatalogoMaterialesTraduccion
     */
    public function setCatalogomateriales(\Pladuch\DataBundle\Entity\CatalogoMateriales $catalogomateriales = null)
    {
        $this->catalogomateriales = $catalogomateriales;

        return $this;
    }

    /**
     * Get catalogomateriales
     *
     * @return \Pladuch\DataBundle\Entity\CatalogoMateriales 
     */
    public function getCatalogomateriales()
    {
        return $this->catalogomateriales;
    }
}
