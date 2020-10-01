<?php

namespace App\Controller;

use App\Entity\Team;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Service\DataBaseServices;

class AdminPageController{

    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var DataBaseServices
     */
    private $db;

    /**
     * @Route("/")
     */
    public function index()
    {
        $titles = [
            'team' => 'Team',
            'project' => 'Project',
            'member' => 'Member',
        ];
        $contenu = [
            [
                'team' => '1',
                'project' => [
                    'Project 1',
                    'Project 3',
                ],
                'member' => [
                    'Anis',
                    'Eliott',
                ],
            ],
            [
                'team' => '1',
                'project' => [
                    'Project 1',
                    'Project 2',
                ],
                'member' => [
                    'Axel',
                    'Jimmy',
                ],
            ]
        ];

        $team = $this->db->em->getRepository(Team::class);
        $team1 = $team->find(2);
        $team1->setListProject([1,2]);

        $this->db->em->persist($team1);
        $this->db->em->flush();


        $content = $this->twig->render("AdminPage/admin.html.twig",
            [
                'titles'=>$titles,
                'entities'=>$contenu,
            ]);
        return new Response($content);
    }

    public function __construct(Environment $twig, DataBaseServices $db)
    {
        $this->twig = $twig;
        $this->db = $db;
    }
}