<?php

namespace Acme\UserBundle\Controller;

use Acme\YahooBundle\Exception\InvalidResponseException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\UserBundle\Entity\PortfolioItem;
use Acme\UserBundle\Form\PortfolioItemType;

/**
 * PortfolioItem controller.
 *
 * @Route("/portfolio")
 */
class PortfolioItemController extends Controller
{

    /**
     * Lists all PortfolioItem entities.
     *
     * @Route("/", name="portfolio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UserBundle:PortfolioItem')->findByUser($this->getUser());

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PortfolioItem entity.
     *
     * @Route("/", name="portfolio_create")
     * @Method("POST")
     * @Template("UserBundle:PortfolioItem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PortfolioItem();

        // Setup user
        $entity->setUser($this->getUser());

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('portfolio'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PortfolioItem entity.
     *
     * @param PortfolioItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PortfolioItem $entity)
    {
        $form = $this->createForm(new PortfolioItemType(), $entity, array(
            'action' => $this->generateUrl('portfolio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Add'));

        return $form;
    }

    /**
     * Displays a form to create a new PortfolioItem entity.
     *
     * @Route("/AddItem", name="portfolio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PortfolioItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PortfolioItem entity.
     *
     * @Route("/{id}", name="portfolio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:PortfolioItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortfolioItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PortfolioItem entity.
     *
     * @Route("/EditItem/{id}", name="portfolio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:PortfolioItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortfolioItem entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a PortfolioItem entity.
    *
    * @param PortfolioItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PortfolioItem $entity)
    {
        $form = $this->createForm(new PortfolioItemType(), $entity, array(
            'action' => $this->generateUrl('portfolio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PortfolioItem entity.
     *
     * @Route("/{id}", name="portfolio_update")
     * @Method("PUT")
     * @Template("UserBundle:PortfolioItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:PortfolioItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortfolioItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('portfolio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PortfolioItem entity.
     *
     * @Route("/{id}", name="portfolio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserBundle:PortfolioItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PortfolioItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('portfolio'));
    }

    /**
     * Creates a form to delete a PortfolioItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('portfolio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
