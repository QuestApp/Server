<?php

namespace QuestServer\QuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 */
class Question
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $locationHuman;

    /**
     * @var string
     */
    private $locationCoord;

    /**
     * @var string
     */
    private $summary;


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
     * Set locationHuman
     *
     * @param string $locationHuman
     * @return Question
     */
    public function setLocationHuman($locationHuman)
    {
        $this->locationHuman = $locationHuman;

        return $this;
    }

    /**
     * Get locationHuman
     *
     * @return string 
     */
    public function getLocationHuman()
    {
        return $this->locationHuman;
    }

    /**
     * Set locationCoord
     *
     * @param string $locationCoord
     * @return Question
     */
    public function setLocationCoord($locationCoord)
    {
        $this->locationCoord = $locationCoord;

        return $this;
    }

    /**
     * Get locationCoord
     *
     * @return string 
     */
    public function getLocationCoord()
    {
        return $this->locationCoord;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Question
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }
    /**
     * @var \QuestServer\QuestBundle\Entity\Quest
     */
    private $quest;


    /**
     * Set quest
     *
     * @param \QuestServer\QuestBundle\Entity\Quest $quest
     * @return Question
     */
    public function setQuest(\QuestServer\QuestBundle\Entity\Quest $quest = null)
    {
        $this->quest = $quest;

        return $this;
    }

    /**
     * Get quest
     *
     * @return \QuestServer\QuestBundle\Entity\Quest 
     */
    public function getQuest()
    {
        return $this->quest;
    }
    /**
     * @var \QuestServer\QuestBundle\Entity\QuestionType
     */
    private $questiontype;


    /**
     * Set questiontype
     *
     * @param \QuestServer\QuestBundle\Entity\QuestionType $questiontype
     * @return Question
     */
    public function setQuestiontype(\QuestServer\QuestBundle\Entity\QuestionType $questiontype = null)
    {
        $this->questiontype = $questiontype;

        return $this;
    }

    /**
     * Get questiontype
     *
     * @return \QuestServer\QuestBundle\Entity\QuestionType 
     */
    public function getQuestiontype()
    {
        return $this->questiontype;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $answers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answers
     *
     * @param \QuestServer\QuestBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\QuestServer\QuestBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \QuestServer\QuestBundle\Entity\Answer $answers
     */
    public function removeAnswer(\QuestServer\QuestBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
    /**
     * @var string
     */
    private $answertype;


    /**
     * Set answertype
     *
     * @param string $answertype
     * @return Question
     */
    public function setAnswertype($answertype)
    {
        $this->answertype = $answertype;

        return $this;
    }

    /**
     * Get answertype
     *
     * @return string 
     */
    public function getAnswertype()
    {
        if($this->answertype != null)
            return $this->answertype;
        else
            return false;    }
}
