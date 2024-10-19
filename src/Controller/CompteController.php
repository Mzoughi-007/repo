<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Form\CompteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


#[Route("/compte")]
class CompteController extends AbstractController
{
    #[Route('/index', name: 'app_compte')]
    public function index(): Response
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }


    
    #[Route ('/formulaire',name:"formulaire")]
    public function addAuthor(ManagerRegistry $manager, Request $request):Response{
        $em = $manager->getManager();
        $compte = new Compte();
        //appel au formulaire : 
        $form = $this->createForm(CompteType::class,$author);
        $form->handleRequest($request);//récupérer les informations
        if($form->isSubmitted() )
        {
            
            $em -> persist($compte);
            $em -> flush();
            return $this->redirectToRoute("client_list");
        }
        return $this->render('client/form.html.twig',[
            "form" => $form,
        ]);

    }
}
