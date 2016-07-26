<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Entity\Lessons;
use AdminBundle\Form\LessonsType;

/**
 * Lessons controller.
 *
 * @Route("/lessons")
 */
class LessonsController extends Controller
{
    /**
     * Lists all Lessons entities.
     *
     * @Route("/", name="lessons_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lessons = $em->getRepository('AdminBundle:Lessons')->findAll();

        return $this->render('lessons/index.html.twig', array(
            'lessons' => $lessons,
        ));
    }

    /**
     * Creates a new Lessons entity.
     *
     * @Route("/new", name="lessons_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lesson = new Lessons();
        $form = $this->createForm('AdminBundle\Form\LessonsType', $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            return $this->redirectToRoute('lessons_show', array('id' => $lesson->getId()));
        }

        return $this->render('lessons/new.html.twig', array(
            'lesson' => $lesson,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Lessons entity.
     *
     * @Route("/{id}", name="lessons_show")
     * @Method("GET")
     */
    public function showAction(Lessons $lesson)
    {
        $deleteForm = $this->createDeleteForm($lesson);

        return $this->render('lessons/show.html.twig', array(
            'lesson' => $lesson,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Lessons entity.
     *
     * @Route("/{id}/edit", name="lessons_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lessons $lesson)
    {
        $deleteForm = $this->createDeleteForm($lesson);
        $editForm = $this->createForm('AdminBundle\Form\LessonsType', $lesson);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            return $this->redirectToRoute('lessons_edit', array('id' => $lesson->getId()));
        }

        return $this->render('lessons/edit.html.twig', array(
            'lesson' => $lesson,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Lessons entity.
     *
     * @Route("/{id}", name="lessons_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lessons $lesson)
    {
        $form = $this->createDeleteForm($lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lesson);
            $em->flush();
        }

        return $this->redirectToRoute('lessons_index');
    }

    /**
     * Creates a form to delete a Lessons entity.
     *
     * @param Lessons $lesson The Lessons entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lessons $lesson)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lessons_delete', array('id' => $lesson->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
