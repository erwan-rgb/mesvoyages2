<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VisiteRepository;





/**
 * Description of AccueilController
 *
 * @author erwme
 */

class AccueilController extends AbstractController {
    
    private $repository;
    
    public function __construct(VisiteRepository $repository){
        $this->repository = $repository;
    }
  
    #[Route('/', name: 'accueil')]
    public function index(): Response{
        $visites = $this->repository->findAllLasted(2);
        return $this->render("pages/accueil.html.twig", [
            'visites' => $visites
        ]);
    }
}
