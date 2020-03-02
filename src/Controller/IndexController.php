<?php


namespace App\Controller;


use App\Mercure\CookieGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @route("/", name="home")
     *
     * @param CookieGenerator $cookieGenerator
     * @return Response
     */
    public function __invoke(CookieGenerator $cookieGenerator):Response
    {
        $response = $this->render('default/index.html.twig', []);
        $response->headers->setCookie($cookieGenerator->generate());

        return $response;
    }
}
