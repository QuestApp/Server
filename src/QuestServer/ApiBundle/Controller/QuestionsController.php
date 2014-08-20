<?php
namespace QuestServer\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations\View;

class QuestionsController extends FOSRestController
{

    /**
     * @ApiDoc(
     *  description="Retrieve all Quests",
     *  section="Questions"
     * )
     */
    public function getQuestionsAction($questID)
    {
        $em = $this->getDoctrine()->getManager();
        
        $questions = $em->getRepository('QuestServerQuestBundle:Question')->findBy(array('quest' => $questID));

        $data = array();
        foreach ($questions as $question) {
            $data[] = $this->formatQuestion($question);
        }

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Retrieve one quest",
     *  section="Questions"
     * )
     */
    public function getQuestionAction($questID, $questionID)
    {
        $em = $this->getDoctrine()->getManager();
        
        $question = $em->getRepository('QuestServerQuestBundle:Question')->find($questionID);

        $data = $this->formatQuestion($question);

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    private function formatQuestion($entity){
        $data = array();

        $data['id']              = $entity->getID();
        $data['summary']         = $entity->getSummary();
        $data['location_human']  = $entity->getLocationHuman();
        $data['location_coord']  = $entity->getLocationCoord();

        $data['question_type']['id']     = $entity->getQuestiontype()->getID();
        $data['question_type']['name']   = $entity->getQuestiontype()->getName();
        $data['question_type']['icon']   = $entity->getQuestiontype()->getIcon();

        $data['answer_type']     = $entity->getAnswertype();

        return $data;
    }

}