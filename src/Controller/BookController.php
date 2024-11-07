<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BookRepository;

#[Route('/book', name: 'app_book')]
class BookController extends AbstractController
{
    #[Route('/index', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route ('/add',name:"book_add")]
    public function addAuthor(ManagerRegistry $manager, Request $request):Response{
        $em = $manager->getManager();
        $book = new Book();
        //appel au formulaire : 
        $form = $this->createForm(BookType::class,$book);
        $form->handleRequest($request);//récupérer les informations
        if($form->isSubmitted())
        {
            $em -> persist($book);//créer les requettes SQL
            $em -> flush();//changement de la bd
            return $this->redirectToRoute("book/add.html.twig");
        }
        return $this->render('book/add.html.twig',[
            "form" => $form,
        ]);

    }

}
