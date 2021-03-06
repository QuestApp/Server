<?php

namespace QuestServer\QuestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use QuestServer\QuestBundle\Entity\Question;
use QuestServer\QuestBundle\Form\QuestionType;

/**
 * Question controller.
 *
 */
class QuestionController extends Controller
{

    /**
     * Lists all Question entities.
     *
     */
    public function indexAction($questID)
    {
        $em = $this->getDoctrine()->getManager();

        $quest = $em->getRepository('QuestServerQuestBundle:Quest')->find($questID);
        if (!$quest) 
            throw $this->createNotFoundException('Unable to find Quest entity.');

        $entities = $em->getRepository('QuestServerQuestBundle:Question')->findBy(array('quest' => $quest));

        return $this->render('QuestServerQuestBundle:Question:index.html.twig', array(
            'entities' => $entities,
            'quest' => $quest
        ));
    }
    /**
     * Creates a new Question entity.
     *
     */
    public function createAction(Request $request, $questID)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Question();

        $quest = $em->getRepository('QuestServerQuestBundle:Quest')->find($questID);
        if (!$quest) 
            throw $this->createNotFoundException('Unable to find Quest entity.');
        $entity->setQuest($quest);

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_question_show', array('id' => $entity->getId(), 'questID' => $entity->getQuest()->getId())));
        }

        return $this->render('QuestServerQuestBundle:Question:new.html.twig', array(
            'entity' => $entity,
            'quest' => $quest,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Question entity.
    *
    * @param Question $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Question $entity)
    {
        $form = $this->createForm(new QuestionType(), $entity, array(
            'action' => $this->generateUrl('admin_question_create', array('questID' => $entity->getQuest()->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Question entity.
     *
     */
    public function newAction($questID)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Question();

        $quest = $em->getRepository('QuestServerQuestBundle:Quest')->find($questID);
        if (!$quest) 
            throw $this->createNotFoundException('Unable to find Quest entity.');
        $entity->setQuest($quest);

        $form   = $this->createCreateForm($entity);

        return $this->render('QuestServerQuestBundle:Question:new.html.twig', array(
            'entity' => $entity,
            'quest' => $quest,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Question entity.
     *
     */
    public function showAction($questID, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QuestServerQuestBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QuestServerQuestBundle:Question:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Question entity.
     *
     */
    public function editAction($questID, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QuestServerQuestBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QuestServerQuestBundle:Question:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Question entity.
    *
    * @param Question $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Question $entity)
    {
        $form = $this->createForm(new QuestionType(), $entity, array(
            'action' => $this->generateUrl('admin_question_update', array('id' => $entity->getId(), 'questID' => $entity->getQuest()->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Question entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QuestServerQuestBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_question_edit', array('id' => $id)));
        }

        return $this->render('QuestServerQuestBundle:Question:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Question entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QuestServerQuestBundle:Question')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Question entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_question', array('questID' => $entity->getQuest()->getId())));
    }

    /**
     * Creates a form to delete a Question entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_question_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
