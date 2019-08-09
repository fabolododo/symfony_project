<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'http://www.omdbapi.com/?apikey=5a61096e&t=Star-Wars:-Episode-V');
        // var_dump($response->toArray());
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]


        return $this->render('list/index.html.twig', [
            'controller_name' => 'ListController',
            'content' => $content
        ]);
    }
}
