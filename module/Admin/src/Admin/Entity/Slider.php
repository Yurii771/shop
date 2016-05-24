<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slider
 *
 * @ORM\Table(name="slider")
 * @ORM\Entity
 */
class Slider
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
     * @ORM\Column(name="img_way", type="string", length=500, nullable=false)
     */
    private $img_way;

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
     * Set img_way
     *
     * @param string $img_way
     *
     * @return Slider
     */
    public function setImg_way($img_way)
    {
        $this->img_way = $img_way;

        return $this;
    }

    /**
     * Get img_way
     *
     * @return string
     */
    public function getImg_way()
    {
        return $this->img_way;
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
