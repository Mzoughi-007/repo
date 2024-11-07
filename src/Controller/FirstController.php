<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route("/first")] 
class FirstController extends AbstractController
{
   #[Route('/index', name: 'first_index')]
    public function index(): Response // Type de retour : Response, utilisé pour retourner une réponse HTTP
    {
        // La méthode render pointe vers le dossier templates et rend le template Twig
        return $this->render('first/index.html.twig', [ // Chemin relatif au dossier templates//le nom doit etre unique!!!!!!
            'controller_name' => 'FirstController', // Variable passée au template Twig
            'name' => 'chiraz', // Variable passée au template Twig
            'last_name' => 'mzoughi', // Variable passée au template Twig
        ]);
    }
    
    #[Route('/show/{name}', name: 'first_show')]
    public function show($name):response
    {
        return $this->render('first/show.html.twig',[
            'n' => $name,
        ]);
    }
    
    #[Route('/redirect', name: 'first_redirect')]
    public function redirect1(): Response
    {
        return $this->redirectToRoute('first_index');
    }

    #[Route('/redirection', name: 'first_redirection')]
    public function redirect2(): Response
    {
        return $this->redirectToRoute('first_show', ['name' => 'link  ']);
    }
    #[Route('/{name}')]
    public function show2($name):response
    {
        return $this->render('first/show2.html.twig',[
            'page' =>$name
        ]);
    }

}
