<?php

namespace QuestServer\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LandingController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QuestServerQuestBundle:Quest')->findAll();

        return $this->render('QuestServerFrontendBundle:Landing:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
