<?php
namespace App\Controller;

Use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig=$twig;
    }

    public function index()
    {
        $content = $this->twig->render("HomePage/home.html.twig");
        return new Response($content);
    }




}