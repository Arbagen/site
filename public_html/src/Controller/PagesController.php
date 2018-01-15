<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PageController
 *
 * @package App\Controller
 */
class PagesController extends Controller
{
    
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepageAction()
    {
        $title = 'Homepage';
        return $this->render('@site/pages/homepage.html.twig', [
          'title' => $title,
        ]);
    }
    
    /**
     * @Route("/about", name="about")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        $title = 'About Us';
        return $this->render('@site/pages/about.html.twig', [
          'title' => $title,
        ]);
    }
    /**
     * @Route("/contacts", name="contacts")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactsAction()
    {
        $title = 'Contact Us';
        $map = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5491.9920703683465!2d30.686223790575646!3d46.508188856960885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c62e3756431ebd%3A0x506428d537752fec!2sShkodovaya+hora+St%2C+3%2C+Odesa%2C+Odessa+Oblast%2C+65000!5e0!3m2!1sen!2sua!4v1515956237291";
    
        return $this->render('@site/pages/contacts.html.twig', [
          'title' => $title,
          'map_src' => $map,
        ]);
    }
}