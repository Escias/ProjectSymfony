<?php
namespace App\Controller;

use App\Entity\Team;
use Symfony\Component\HttpFoundation\Request;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Service\DataBaseServices;
use App\Form\TeamAddType;
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
        $formAdd = $this->createForm(TeamAddType::class, $newTeam);
        $formAdd->handleRequest($request);
        if ($formAdd->isSubmitted() && $formAdd->isValid()) {
            $this->db->insertATeam($newTeam->getName());
        }

        $content = $this->twig->render("HomePage/home.html.twig",
            [
                'teams' => $this->db->getAllTeams(),
                'formAdd' => $formAdd->createView(),
            ]);
        return new Response($content);
    }

    /**
     * @Route("/team/delete")
     */
    public function deleteTeam(Request $request)
    {
        $this->db->deleteATeam($request->get('id'));
        return $this->redirectToRoute('app_home_index');
    }
}