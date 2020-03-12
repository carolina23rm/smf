<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_list")
     */
    public function list(){
        $nombre = "Carolina";
        $numero = rand(0,60);
        return $this->render('blog/blog.html.twig', [
            'nombre' => $nombre,
            'numero' => $numero
        ]);
    }
    
    /**
     * @Route("/blog1", name="blog_World")
     */
    public function World(){
        $frase = "Hola mundo";
        return $this->render('blog/world.html.twig', [
            'frase' => $frase,
        ]);
    }
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
