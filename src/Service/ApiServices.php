<?php


namespace App\Service;

use Gitlab\Client;
use phpDocumentor\Reflection\Project;
use phpDocumentor\Reflection\Types\Integer;

class ApiServices
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function getAllProjects()
    {
        return $this->client->projects()->all(['owned' => true]);
    }

    public function getProjectById(int $id){
        return $this->client->projects()->show($id);
    }

    public function getAllMergeRequestsByProjectId(int $id)
    {
        return $this->client->mergeRequests()->all($id);
    }

    public function getAllDiscussionsByMergeRequestId(int $project_id, $merge_request_id)
    {
        return $this->client->mergeRequests()->showDiscussions($project_id, $merge_request_id);
    }

        // var_dump(); //this get an array of all mr of a project
        // "title" "upvotes" "downvotes" "labels" "description"
}