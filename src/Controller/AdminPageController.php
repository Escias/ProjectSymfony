<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamAddForm;
use App\Service\ApiServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Service\DataBaseServices;
use Symfony\Component\HttpFoundation\Request;

class AdminPageController extends AbstractController {

    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var DataBaseServices
     */
    private $db;
    /**
     * @var ApiServices
     */
    private $api;
    private $em;

    /**
     * @Route("/admin")
     */
    public function index(Request $request)
    {
        $titles = [
          'Team',
          'Project(s)',
        ];

        $teams = $this->db->getAllTeams();

        $listTeamProjects = [];
        foreach ($teams as $idObject){
            foreach ($idObject as $id){
                array_push($listTeamProjects, $this->db->getTeamProjectsId($id));
            }
        }


        $project = $this->api->getAllProjects();
        $item = [];
        foreach ($project as $value){
            array_push($item, $value["name"]);
        }

        $content = $this->twig->render("AdminPage/admin.html.twig",
            [
                "teams" => $teams,
                "projects" => $project,
                "titles" => $titles,
                'listTeams' => $teams,
                'projectTeams' => $listTeamProjects
            ]);
        return new Response($content);
    }

    /**
     * @Route("/addProjectToTeam")
     */
    public function addProjectToTeam(Request $request){
        $this->db->insertProjectToTeam($request->get("project"), $request->get("team"));
        return $this->redirectToRoute('app_home_index');
    }

    public function __construct(Environment $twig, DataBaseServices $db, ApiServices $api, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->db = $db;
        $this->api = $api;
        $this->em = $em;
    }
}