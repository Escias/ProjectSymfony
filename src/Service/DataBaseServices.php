<?php


namespace App\Service;


use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

class DataBaseServices
{
    /**
     * @var EntityManagerInterface
     */
    public $em;

    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAllTeams()
    {
        /**
         * @var TeamRepository $teams
         */
        $teams = $this->em->getRepository(Team::class);
        return $teams->findAll();
    }

    public function getTeamProjectsId(int $id){
        $repo =$this->em->getRepository(Team::class);
        return $repo->find($id);
    }
}