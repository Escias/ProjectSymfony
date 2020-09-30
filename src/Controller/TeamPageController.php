<?php
namespace App\Controller;
use App\Entity\Articles;
use App\Form\Form;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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