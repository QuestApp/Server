<?php

namespace QuestServer\QuestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use QuestServer\QuestBundle\Entity\QuestionType;
use QuestServer\QuestBundle\Form\QuestionTypeType;

/**
 * QuestionType controller.
 *
 */
class QuestionTypeController extends Controller
{

    /**
     * Lists all QuestionType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QuestServerQuestBundle:QuestionType')->findAll();

        return $this->render('QuestServerQuestBundle:QuestionType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new QuestionType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new QuestionType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_questiontype_show', array('id' => $entity->getId())));
        }

        return $this->render('QuestServerQuestBundle:QuestionType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a QuestionType entity.
    *
    * @param QuestionType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(QuestionType $entity)
    {
        $form = $this->createForm(new QuestionTypeType(), $entity, array(
            'action' => $this->generateUrl('admin_questiontype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new QuestionType entity.
     *
     */
    public function newAction()
    {
        $entity = new QuestionType();
        $form   = $this->createCreateForm($entity);

        return $this->render('QuestServerQuestBundle:QuestionType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a QuestionType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QuestServerQuestBundle:QuestionType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QuestServerQuestBundle:QuestionType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing QuestionType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QuestServerQuestBundle:QuestionType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QuestServerQuestBundle:QuestionType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a QuestionType entity.
    *
    * @param QuestionType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(QuestionType $entity)
    {
        $form = $this->createForm(new QuestionTypeType(), $entity, array(
            'action' => $this->generateUrl('admin_questiontype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing QuestionType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QuestServerQuestBundle:QuestionType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_questiontype_edit', array('id' => $id)));
        }

        return $this->render('QuestServerQuestBundle:QuestionType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a QuestionType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QuestServerQuestBundle:QuestionType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find QuestionType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_questiontype'));
    }

    /**
     * Creates a form to delete a QuestionType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_questiontype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
