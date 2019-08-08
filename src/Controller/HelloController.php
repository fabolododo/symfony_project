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
        $response = $httpClient->request('GET', 'https://api.themoviedb.org/3/movie/22?api_key=0688017ac447dbc1d2a3f034474c1fc8&language=en-US
        ');
        // var_dump($response->toArray());
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        $title = $content["original_title"];
        $image = "https://image.tmdb.org/t/p/w500".$content["poster_path"];
        $description = $content["overview"];
        $release_date = $content["release_date"];

        
        return $this->render('hello/index.html.twig', [
                'controller_name' => 'HelloController',
                'poster_path' => $image,
                'title_movie' => $title,
                'content' => $description,
                'release_date' => $release_date
            ]);
        }
}
