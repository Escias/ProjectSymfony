<?php

namespace App\Form;

use App\Service\ApiServices;
use App\Service\DataBaseServices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TeamAddForm extends AbstractType
{
    /**
     * @var DataBaseServices
     */
    private $db;
    private $api;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $project = $this->api->getAllProjects();
        $builder
            ->add('Team', ChoiceType::class, [
                'choices'  => [
                    'team'=>'1',
                    'boo'=>'2',
                ],
            ])
            ->add('Project', ChoiceType::class, [
                'choices'  => [
                    $project,
                ],
            ])
        ;
    }

    public function __construct(ApiServices $api)
    {
        $this->api = $api;
    }
}