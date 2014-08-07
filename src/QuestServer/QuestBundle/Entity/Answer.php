<?php

namespace QuestServer\QuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 */
class Answer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $value;


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
     * Set value
     *
     * @param string $value
     * @return Answer
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * @var \QuestServer\QuestBundle\Entity\Question
     */
    private $question;


    /**
     * Set question
     *
     * @param \QuestServer\QuestBundle\Entity\Question $question
     * @return Answer
     */
    public function setQuestion(\QuestServer\QuestBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \QuestServer\QuestBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
