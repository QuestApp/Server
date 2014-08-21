<?php
namespace QuestServer\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations\View;

class QuestsController extends FOSRestController
{

    /**
     * @ApiDoc(
     *  description="Retrieve all Quests",
     *  section="Quests"
     * )
     */
    public function getQuestsAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $quests = $em->getRepository('QuestServerQuestBundle:Quest')->findAll();

        $data = array();
        foreach ($quests as $quest) {
            $data[] = $this->formatQuest($quest);
        }

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Retrieve one quest",
     *  section="Quests"
     * )
     */
    public function getQuestAction($questID)
    {
        $em = $this->getDoctrine()->getManager();
        
        $quest = $em->getRepository('QuestServerQuestBundle:Quest')->find($questID);

        $data              = $this->formatQuest($quest);
        $data['questions'] = count($quest->getQuestions());

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    private function formatQuest($entity){
        $data = array();

        $data['id']             = $entity->getID();
        $data['name']           = $entity->getName();
        $data['description']    = $entity->getDescription();
        $data['valid_from']     = $entity->getValidFrom();
        $data['valid_untill']   = $entity->getValidUntill();
        $data['allow_resubmit'] = $entity->getAllowResubmit();

        return $data;
    }

}