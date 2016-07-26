<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Entity\Roles;
use AdminBundle\Form\RolesType;

/**
 * Roles controller.
 *
 * @Route("/roles")
 */
class RolesController extends Controller
{
    /**
     * Lists all Roles entities.
     *
     * @Route("/", name="roles_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $roles = $em->getRepository('AdminBundle:Roles')->findAll();

        return $this->render('roles/index.html.twig', array(
            'roles' => $roles,
        ));
    }

    /**
     * Creates a new Roles entity.
     *
     * @Route("/new", name="roles_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $role = new Roles();
        $form = $this->createForm('AdminBundle\Form\RolesType', $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            return $this->redirectToRoute('roles_show', array('id' => $role->getId()));
        }

        return $this->render('roles/new.html.twig', array(
            'role' => $role,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Roles entity.
     *
     * @Route("/{id}", name="roles_show")
     * @Method("GET")
     */
    public function showAction(Roles $role)
    {
        $deleteForm = $this->createDeleteForm($role);

        return $this->render('roles/show.html.twig', array(
            'role' => $role,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Roles entity.
     *
     * @Route("/{id}/edit", name="roles_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Roles $role)
    {
        $deleteForm = $this->createDeleteForm($role);
        $editForm = $this->createForm('AdminBundle\Form\RolesType', $role);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            return $this->redirectToRoute('roles_edit', array('id' => $role->getId()));
        }

        return $this->render('roles/edit.html.twig', array(
            'role' => $role,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Roles entity.
     *
     * @Route("/{id}", name="roles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Roles $role)
    {
        $form = $this->createDeleteForm($role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($role);
            $em->flush();
        }

        return $this->redirectToRoute('roles_index');
    }

    /**
     * Creates a form to delete a Roles entity.
     *
     * @param Roles $role The Roles entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Roles $role)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('roles_delete', array('id' => $role->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
