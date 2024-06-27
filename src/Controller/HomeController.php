<?php

namespace App\Controller;

use App\Repository\UniteHebergementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, UniteHebergementRepository $uniteHebergementRepository): Response
    {
        //chevk if there is submitted data
        if ($request->isMethod('POST')) {
            //get the data
            $data = $request->request->all();
            $units = $uniteHebergementRepository->getFreeUnites($data['debut'], $data['fin'], $data['nbAdulte'] + $data['nbEnfant']);
            //return the result
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'units' => $units
            ]);
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
