<?php
namespace App\Controller;

use App\Entity\Team;
use App\Service\ApiServices;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Service\DataBaseServices;

class ProjectDetailsController
{
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

    public function __construct(Environment $twig, DataBaseServices $db,ApiServices $api)
    {
        $this->twig = $twig;
        $this->db = $db;
        $this->api=$api;
    }

    /**
     * @Route("/project/{id}")
     */
    public function index(int $id)
    {
        $mergeRequests=$this->api->getAllMergeRequestsByProjectId($id);
        $content = $this->twig->render("ProjectPage/projectdetail.html.twig",
            [
                "mergeRequests"=>$mergeRequests,
            ]);
        return new Response($content);
    }
}