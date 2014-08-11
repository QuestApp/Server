<?php
namespace QuestServer\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations\View;

use QuestServer\QuestBundle\Entity\Answer;

class AnswersController extends FOSRestController
{

    /**
     * @ApiDoc(
     *  description="Submit an answer to a question",
     *  section="Questions"
     * )
     */
    public function getAnswerAction($questID, $questionID)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.context')->getToken()->getUser();

        $answer = $em->getRepository('QuestServerQuestBundle:Answer')->findOneBy(array('question'=>$questionID, 'user'=>$user));

        if($answer)
            $data = array('value' => $answer->getValue());
        else
            throw $this->createNotFoundException('No answer set yet');

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Submit an answer to a question",
     *  section="Questions"
     * )
     */
    public function postAnswerAction($questID, $questionID)
    {
        $em = $this->getDoctrine()->getManager();
        
        $question = $em->getRepository('QuestServerQuestBundle:Question')->find($questionID);

        $user = $this->get('security.context')->getToken()->getUser();

        $existingAnswer = $em->getRepository('QuestServerQuestBundle:Answer')->findOneBy(array('question'=>$questionID, 'user'=>$user));

        if($existingAnswer != false)
            $entity = $existingAnswer;
        else
            $entity = new Answer();

        $entity->setQuestion($question);

        $val = $this->get('request')->request->get('value');
        if($val)
            $value = $val;
        else
            throw $this->createNotFoundException('No value was set');

        $entity->setValue($value);

        if(!$existingAnswer)
            $entity->setUser($user);

        $em->persist($entity);
        $em->flush();

        $view = $this->view(array("message"=>"OK","value"=>"$value"), 200);

        return $this->handleView($view);
    }

}