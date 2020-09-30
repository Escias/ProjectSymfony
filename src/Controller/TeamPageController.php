<?php

namespace App\Controller;

Use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class TeamPageController
{
    /**
     * @var Environment
     */
    private $twig;


    public function index()
    {
        $content = $this->twig->render("TeamPage/TeamDetails.html.twig");
        return new Response($content);
    }

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

}