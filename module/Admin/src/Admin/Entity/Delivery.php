<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery")
 * @ORM\Entity
 */
class Delivery
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
     * @ORM\Column(name="delivery_type", type="string", length=255, nullable=false)
     */
    private $deliveryType;



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
     * Set deliveryType
     *
     * @param string $deliveryType
     *
     * @return Delivery
     */
    public function setDeliveryType($deliveryType)
    {
        $this->deliveryType = $deliveryType;

        return $this;
    }

    /**
     * Get deliveryType
     *
     * @return string
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
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
