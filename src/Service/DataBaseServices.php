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
  
    public function insertATeam($name)
    {
        $team = new Team;
        $team->setName($name);
        $this->em->persist($team);
        $this->em->flush();
    }

    public function insertProjectToTeam($projectid, $teamid){
        $teams = $this->em->getRepository(Team::class);
        $team = $teams->find($teamid);
        $list = $team->getListProject();
        if ($list){
            array_push($list, (int)$projectid);
        }else{
            $list = [(int)$projectid];
        }
        $team->setListProject($list);
        $this->em->persist($team);
        $this->em->flush();
    }

    public function deleteProjectToTeam(){

    }

    public function deleteATeam($id)
    {
        $teams = $this->em->getRepository(Team::class);

        /**
         * @var TeamRepository $teams
         */
        $team = $teams->find($id);
        $this->em->remove($team);
        $this->em->flush();
    }
}