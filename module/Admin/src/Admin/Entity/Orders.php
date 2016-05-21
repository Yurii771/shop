<?php
<<<<<<< HEAD

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

=======
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="delivery_id", columns={"delivery_id"}), @ORM\Index(name="payment_id", columns={"payment_id"}), @ORM\Index(name="order_status_id", columns={"order_status_id"}), @ORM\Index(name="city_id", columns={"city_id"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
<<<<<<< HEAD

    /**
     * @var string
     *
     * @ORM\Column(name="order", type="text", length=65535, nullable=false)
     */
    private $order;
=======
    /**
     * @var string
     *
     * @ORM\Column(name="order_list", type="text", length=65535, nullable=false)
     */
    private $orderList;
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b

    /**
     * @var string
     *
     * @ORM\Column(name="customer_name", type="string", length=255, nullable=false)
     */
    private $customerName;
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * @var string
     *
     * @ORM\Column(name="customer_surname", type="string", length=255, nullable=false)
     */
    private $customerSurname;
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255, nullable=false)
     */
    private $adress;
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * @var string
     *
     * @ORM\Column(name="customer_email", type="string", length=255, nullable=false)
     */
    private $customerEmail;
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * @var string
     *
     * @ORM\Column(name="customer_phone", type="string", length=30, nullable=false)
     */
    private $customerPhone;

    /**
<<<<<<< HEAD
     * @var \Admin\Entity\Cities
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Cities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    private $city;

    /**
=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
     * @var \Admin\Entity\Payment
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Payment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     * })
     */
    private $payment;
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * @var \Admin\Entity\Delivery
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Delivery")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="delivery_id", referencedColumnName="id")
     * })
     */
    private $delivery;
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * @var \Admin\Entity\OrderStatus
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\OrderStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_status_id", referencedColumnName="id")
     * })
     */
    private $orderStatus;

<<<<<<< HEAD
=======
    /**
     * @var \Admin\Entity\Cities
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Cities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    private $city;

>>>>>>> d30082abfebca2d3a837423a96083542415bd16b


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
<<<<<<< HEAD

    /**
     * Set order
     *
     * @param string $order
     *
     * @return Orders
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

=======
    /**
     * Set orderList
     *
     * @param string $orderList
     *
     * @return Orders
     */
    public function setOrderList($orderList)
    {
        $this->orderList = $orderList;

        return $this;
    }
    /**
     * Get orderList
     *
     * @return string
     */
    public function getOrderList()
    {
        return $this->orderList;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Set customerName
     *
     * @param string $customerName
     *
     * @return Orders
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get customerName
     *
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Set customerSurname
     *
     * @param string $customerSurname
     *
     * @return Orders
     */
    public function setCustomerSurname($customerSurname)
    {
        $this->customerSurname = $customerSurname;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get customerSurname
     *
     * @return string
     */
    public function getCustomerSurname()
    {
        return $this->customerSurname;
    }
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Orders
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     *
     * @return Orders
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get customerEmail
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     *
     * @return Orders
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get customerPhone
     *
     * @return string
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
<<<<<<< HEAD
     * Set city
     *
     * @param \Admin\Entity\Cities $city
     *
     * @return Orders
     */
    public function setCity(\Admin\Entity\Cities $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Admin\Entity\Cities
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
     * Set payment
     *
     * @param \Admin\Entity\Payment $payment
     *
     * @return Orders
     */
    public function setPayment(\Admin\Entity\Payment $payment = null)
    {
        $this->payment = $payment;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get payment
     *
     * @return \Admin\Entity\Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Set delivery
     *
     * @param \Admin\Entity\Delivery $delivery
     *
     * @return Orders
     */
    public function setDelivery(\Admin\Entity\Delivery $delivery = null)
    {
        $this->delivery = $delivery;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get delivery
     *
     * @return \Admin\Entity\Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
<<<<<<< HEAD

=======
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Set orderStatus
     *
     * @param \Admin\Entity\OrderStatus $orderStatus
     *
     * @return Orders
     */
    public function setOrderStatus(\Admin\Entity\OrderStatus $orderStatus = null)
    {
        $this->orderStatus = $orderStatus;
<<<<<<< HEAD

        return $this;
    }

=======
        return $this;
    }
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
    /**
     * Get orderStatus
     *
     * @return \Admin\Entity\OrderStatus
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }
<<<<<<< HEAD
}

=======

    /**
     * Set city
     *
     * @param \Admin\Entity\Cities $city
     *
     * @return Orders
     */
    public function setCity(\Admin\Entity\Cities $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Admin\Entity\Cities
     */
    public function getCity()
    {
        return $this->city;
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
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
