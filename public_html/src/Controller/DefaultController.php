<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class DefaultController
{
    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function main()
    {
        $number = mt_rand(0, 100);
    
        return new Response(
          '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}