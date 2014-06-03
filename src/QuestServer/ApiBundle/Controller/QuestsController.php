<?php
namespace QuestServer\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

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

        $view = $this->view($quests, 200);

        return $this->handleView($view);
    }

}