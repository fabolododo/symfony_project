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
        $title_choice = ['death-proof','fight-club','v-for-vendetta','star-wars:-episode-IV','star-wars:-episode-V','Avengers:-EndGame'];
        $resultat = [];
        for ($i = 0; $i < count($title_choice); $i++){
            $httpClient = HttpClient::create();
            $response = $httpClient->request('GET', 'http://www.omdbapi.com/?apikey=5a61096e&t='.$title_choice[$i]);
            // var_dump($response->toArray());
            $statusCode = $response->getStatusCode();
            // $statusCode = 200
            $contentType = $response->getHeaders()['content-type'][0];
            // $contentType = 'application/json'
            $content = $response->getContent();
            // $content = '{"id":521583, "name":"symfony-docs", ...}'
            $content = $response->toArray();
            // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

            array_push($resultat,$content);
        }

        return $this->render('list/list.html.twig', [
            'controller_name' => 'ListController',
            'resultat' => $resultat
        ]);
    }
}
