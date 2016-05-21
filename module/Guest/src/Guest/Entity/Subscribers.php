<?php

namespace Guest\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscribers
 *
 * @ORM\Table(name="subscribers")
 * @ORM\Entity
 */
class Subscribers
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
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;



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
     * Set email
     *
     * @param string $email
     *
     * @return Subscribers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    public function exchangeArray($data){
        foreach ($data as $key => $val) {
            if(property_exists($this, $key)){
                $this->$key = ($val !== null) ? $val : null;
            }
        }
    }
    
}
