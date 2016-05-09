<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cllg
 *
 * @ORM\Table(name="cllg")
 * @ORM\Entity
 */
class Cllg
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
     * @var string
     *
     * @ORM\Column(name="categories_id", type="integer", nullable=false)
     */
    private $categories_id;

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
     * Set categories_id
     *
     * @param string $categories_id
     *
     * @return Cllg
     */
    public function setCategories_id($categories_id)
    {
        $this->categories_id = $categories_id;

        return $this;
    }

    /**
     * Get categories_id
     *
     * @return string
     */
    public function getCategories_id()
    {
        return $this->categories_id;
    }

    public function exchangeArray($data)
    {
            foreach ($data as $key => $val){
                    if(property_exists($this, $key)){
                            $this->$key = ($val) ? $val : null;
                    }
            }
    }
	
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
