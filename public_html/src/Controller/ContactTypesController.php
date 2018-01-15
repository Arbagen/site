<?php

namespace App\Controller;

use App\Entity\ContactType;
use App\Entity\Image;
use App\Form\ContactTypeType;
use App\Service\FileRemover;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactTypesController
 *
 * @package App\Controller
 */
class ContactTypesController extends Controller
{
    /**
     * @Route("/contact/types", name="contact.types.all")
     */
    public function index()
    {
        $title = 'Contact Types';
        $em = $this->getDoctrine()->getManager();
        $contactTypes = $em->getRepository(ContactType::class)->findAll();
        return $this->render('@site/contactTypes/index.html.twig', [
          'title' => $title,
          'contactTypes' => $contactTypes,
        ]);
    }
    
    /**
     * @Route("/contact/types/new", name="contact.types.new")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $title = 'New contact type';
        $em = $this->getDoctrine()->getManager();
        $contactType = new ContactType();
        $form = $this->createForm(ContactTypeType::class, $contactType);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contactType);
            $logo = $contactType->getUploadedFile();
            if ($logo) {
                $projectDir = $this->getParameter('project_dir');
                $contactLogosDir = $this->getParameter('contact_logos_dir');
                $fileUploader = new FileUploader($projectDir . $contactLogosDir);
                $pathOnServer = $fileUploader->upload($logo);
                if (file_exists($pathOnServer)) {
                    $relativePath = str_replace($projectDir, '', $pathOnServer);
                    $newImage = new Image($relativePath);
                    $em->persist($newImage);
                    $contactType->setLogo($newImage);
                }
            }
            $em->flush();
            return $this->redirectToRoute('contact.types.all');
        }
        return $this->render('@site/contactTypes/new.html.twig', [
          'form' => $form->createView(),
          'title' => $title,
        ]);
    }
    
    /**
     * @Route("/contact/types/edit/{id}", name="contact.types.edit")
     * @ParamConverter("contactType", class="App\Entity\ContactType")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\ContactType                   $contactType
     *
     * @param \App\Service\FileRemover                  $fileRemover
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, ContactType $contactType, FileRemover $fileRemover)
    {
        $title = 'Edit contact type';
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ContactTypeType::class, $contactType);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $logo = $contactType->getUploadedFile();
            if ($logo) {
                $projectDir = $this->getParameter('project_dir');
                $contactLogosDir = $this->getParameter('contact_logos_dir');
                $fileUploader = new FileUploader($projectDir . $contactLogosDir);
                $pathOnServer = $fileUploader->upload($logo);
                if (file_exists($pathOnServer)) {
                    $relativePath = str_replace($projectDir, '', $pathOnServer);
                    $newImage = new Image($relativePath);
                    $em->persist($newImage);
                    $fileRemover->removeFile($contactType->getLogo()->getPath());
                    $contactType->setLogo($newImage);
                }
            }
            $em->flush();
        }
        return $this->render('@site/contactTypes/edit.html.twig', [
          'form' => $form->createView(),
          'contactType' => $contactType,
          'title' => $title,
        ]);
    }
    
    /**
     * @Route("/contact/types/remove", name="contact.types.remove")
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @param \App\Service\FileRemover                  $fileRemover
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request, FileRemover $fileRemover)
    {
        $contactTypeId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $contactType = $em->getRepository(ContactType::class)->find($contactTypeId);
        if ($contactType) {
            $projectDir = $this->getParameter('project_dir');
            $fileRemover->removeFile($contactType->getLogo()->getPath());
            $em->remove($contactType);
            $em->flush();
        }
        return $this->redirectToRoute('contact.types.all');
    }
}
