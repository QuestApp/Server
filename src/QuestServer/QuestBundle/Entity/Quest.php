<?php

namespace QuestServer\QuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quest
 */
class Quest
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $validFrom;

    /**
     * @var \DateTime
     */
    private $validUntill;


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
     * @return Quest
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
     * Set description
     *
     * @param string $description
     * @return Quest
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set validFrom
     *
     * @param \DateTime $validFrom
     * @return Quest
     */
    public function setValidFrom($validFrom)
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * Get validFrom
     *
     * @return \DateTime 
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * Set validUntill
     *
     * @param \DateTime $validUntill
     * @return Quest
     */
    public function setValidUntill($validUntill)
    {
        $this->validUntill = $validUntill;

        return $this;
    }

    /**
     * Get validUntill
     *
     * @return \DateTime 
     */
    public function getValidUntill()
    {
        return $this->validUntill;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $questions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add questions
     *
     * @param \QuestServer\QuestBundle\Entity\Question $questions
     * @return Quest
     */
    public function addQuestion(\QuestServer\QuestBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \QuestServer\QuestBundle\Entity\Question $questions
     */
    public function removeQuestion(\QuestServer\QuestBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }
    /**
     * @var string
     */
    private $allowResubmit;


    /**
     * Set allowResubmit
     *
     * @param string $allowResubmit
     * @return Quest
     */
    public function setAllowResubmit($allowResubmit)
    {
        $this->allowResubmit = $allowResubmit;

        return $this;
    }

    /**
     * Get allowResubmit
     *
     * @return string 
     */
    public function getAllowResubmit()
    {
        if($this->allowResubmit != null)
            return $this->allowResubmit;
        else
            return false;
    }
}
