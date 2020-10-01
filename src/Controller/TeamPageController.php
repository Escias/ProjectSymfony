<?php

namespace App\Controller;

use App\Service\ApiServices;
use App\Service\DataBaseServices;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class TeamPageController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var ApiServices
     */
    private $api;
    /**
     * @var DataBaseServices
     */
    private $db;


    /**
     * @Route("/team/{id}")
     */
    public function index(int $id)
    {
        $projectList=[];
        $teamProjectsIds= $this->db->getTeamProjectsId($id)->getListProject();
        foreach($teamProjectsIds as $id){
            array_push($projectList,$this->api->getProjectById($id));
    }
        $content = $this->twig->render("TeamPage/TeamDetails.html.twig",
        [
            "teamProjects"=>$projectList,
            "id"=>$id,
        ]);
        return new Response($content);
    }

    public function __construct(Environment $twig,ApiServices $api,DataBaseServices $db)
    {
        $this->twig = $twig;
        $this->api=$api;
        $this->db=$db;
    }

}