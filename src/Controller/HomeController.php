<?php
namespace App\Controller;

use App\Entity\Team;
use Symfony\Component\HttpFoundation\Request;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Service\DataBaseServices;
use App\Form\TeamCrudType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
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
    public function index(Request $request)
    {
        $newTeam = new Team;
        $form = $this->createForm(TeamCrudType::class, $newTeam);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->db->insertATeam($newTeam->getName());
        }
        $content = $this->twig->render("HomePage/home.html.twig",
            [
                'teams' => $this->db->getAllTeams(),
                'form' => $form->createView()
            ]);
        return new Response($content);
    }




}