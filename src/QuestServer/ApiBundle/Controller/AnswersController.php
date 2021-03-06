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
        elseif($question->getAnswertype() == 'pic'){
			if(isset($_FILES['value'])){
				$targetdir = '/tmp/';
				$targetname= rand(1000000000,9999999999).'.'.pathinfo($_FILES['value']['name'], PATHINFO_EXTENSION);
				$targetpath = $targetdir.$targetname;
			
				move_uploaded_file($_FILES['value']['tmp_name'],$targetpath);
			
				$value = $targetname;				
			}else{
				throw $this->createNotFoundException('No file was uploaded');
			}
		}else
			throw $this->createNotFoundException('No value was set');

        $entity->setValue($value);

        if(!$existingAnswer)
            $entity->setUser($user);

        if($question->getQuest()->getAllowResubmit() == false)
            if($existingAnswer)
                $notauth = 'You are not allowed to resubmit answers';
            else
                $em->persist($entity);    
        else
            $em->persist($entity);

        $em->flush();

        if(isset($notauth))
            $view = $this->view(array("message"=>"NOTALLOWED","value"=>"$notauth"), 400);
        elseif(isset($err))
            $view = $this->view(array("message"=>"ERROR","value"=>"$err"), 500);
        else
            $view = $this->view(array("message"=>"OK","value"=>"$value"), 200);

        return $this->handleView($view);
    }

}