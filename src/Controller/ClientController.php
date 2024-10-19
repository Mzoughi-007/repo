<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\FormeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

#[Route("/client")]
class ClientController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    
    #[Route ('/list',name:"client_list")]
    public function listDb(ManagerRegistry $doctrine):Response {
        $repo = $doctrine->getRepository(Client::class);
        $list = $repo->findAll();//liaison avec la db
        return $this->render('client/list.html.twig',[
            "list" => $list,
        ]) ;
    }

    #[Route ('/formulaire',name:"formulaire_cient")]
    public function addAuthor(ManagerRegistry $manager, Request $request):Response{
        $em = $manager->getManager();
        $author = new Client();
        //appel au formulaire : 
        $form = $this->createForm(FormeType::class,$author);
        $form->handleRequest($request);//récupérer les informations
        if($form->isSubmitted())
        {
            $em -> persist($author);
            $em -> flush();
            return $this->redirectToRoute("client_list");
        }
        return $this->render('client/form.html.twig',[
            "form" => $form,
        ]);

    }
}
