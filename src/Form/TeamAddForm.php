<?php

namespace App\Form;

use App\Entity\Team;
use App\Service\ApiServices;
use App\Service\DataBaseServices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class TeamAddForm extends AbstractType
{
    /**
     * @var DataBaseServices
     */
    private $db;
    private $api;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**$teams = $this->db->getAllTeams();
        var_dump($teams[0]);
        $boo = [];
        foreach ($teams as $value){
            array_push($boo, $value);
        }
        $boo = array_flip($boo);*/

        $project = $this->api->getAllProjects();
        $item = [];
        foreach ($project as $value){
            array_push($item, $value);
        }
        //$item = array_flip($item);

        $builder
            ->add('Team', ChoiceType::class, [
                'choices'  => [
                    'jjje'=>'1',
                ],
            ])
            ->add('Project', ChoiceType::class, [
                'choices'  => [
                    $item,
                ],
            ])
        ;
    }

    public function __construct(ApiServices $api, DataBaseServices $db)
    {
        $this->api = $api;
        $this->db = $db;
    }
}