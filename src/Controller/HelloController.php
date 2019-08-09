<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */


    public function index()
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'http://www.omdbapi.com/?apikey=5a61096e&s=snatch');
        // var_dump($response->toArray());
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        
        

        // $title = $content['Title'];
        // $image = $content['Poster'];
        // $description = $content['Plot'];
        // $release_date = $content['Released'];
        // $year = $content['Year'];
        // $type = $content['Type'];
        
        return $this->render('hello/index.html.twig', [
            'contents' => $content['Search']
                // 'controller_name' => 'HelloController',
                // 'poster_path' => $image,
                // 'title_movie' => $title,
                // 'content' => $description,
                // 'release_date' => $release_date
                // 'year' => $year,
                // 'type' => $type
            ]);
        }
}
