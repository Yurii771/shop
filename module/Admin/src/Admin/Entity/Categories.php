<<<<<<< HEAD
<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="parent_name", columns={"parent_id"})})
 * @ORM\Entity
 */
class Categories
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \Admin\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;



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
     * Set name
     *
     * @param string $name
     *
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parent
     *
     * @param \Admin\Entity\Categories $parent
     *
     * @return Categories
     */
    public function setParent(\Admin\Entity\Categories $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Admin\Entity\Categories
     */
    public function getParent()
    {
        return $this->parent;
    }
}
=======
<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="parent_name", columns={"parent_id"})})
 * @ORM\Entity
 */
class Categories
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \Admin\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;



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
     * Set name
     *
     * @param string $name
     *
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parent
     *
     * @param \Admin\Entity\Categories $parent
     *
     * @return Categories
     */
    public function setParent(\Admin\Entity\Categories $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Admin\Entity\Categories
     */
    public function getParent()
    {
        return $this->parent;
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
>>>>>>> refs/remotes/origin/master
