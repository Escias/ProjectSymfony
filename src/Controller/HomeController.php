<?php
namespace App\Controller;

use App\Entity\Team;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Service\DataBaseServices;

class HomeController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var DataBaseServices
     */
    private $db;

    public function __construct(Environment $twig, DataBaseServices $db)
    {
        $this->twig = $twig;
        $this->db = $db;
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        $content = $this->twig->render("HomePage/home.html.twig",
            [
                'teams' => $this->db->getAllTeams(),
            ]);
        return new Response($content);
    }


}