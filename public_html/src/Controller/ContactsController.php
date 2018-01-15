<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactsController
 *
 * @package App\Controller
 */
class ContactsController extends Controller
{
    /**
     * @Route("/contacts", name="contacts.all")
     */
    public function index()
    {
        $title = 'Contacts';
        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository(Contact::class)->findAll();
        return $this->render('@site/contacts/index.html.twig', [
          'title' => $title,
          'contacts' => $contacts,
        ]);
    }
    
    /**
     * @Route("/contacts/new", name="contacts.new")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $title = 'New contact';
        $em = $this->getDoctrine()->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('contacts.all');
        }
        return $this->render('@site/contacts/new.html.twig', [
          'form' => $form->createView(),
          'title' => $title,
        ]);
    }
    
    /**
     * @Route("/contacts/edit/{id}", name="contacts.edit")
     * @ParamConverter("contact", class="App\Entity\Contact")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Contact                       $contact
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Contact $contact)
    {
        $title = 'Edit contact';
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
        }
        return $this->render('@site/contacts/edit.html.twig', [
          'form' => $form->createView(),
          'contact' => $contact,
          'title' => $title,
        ]);
    }
    
    /**
     * @Route("/contacts/remove", name="contacts.remove")
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove(Request $request)
    {
        $contactId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository(Contact::class)->find($contactId);
        if ($contact) {
            $em->remove($contact);
            $em->flush();
        }
        return $this->redirectToRoute('contacts.all');
    }
}
