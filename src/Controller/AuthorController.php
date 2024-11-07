<?php

namespace App\Controller;
#copy this
use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
##################
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route("/author")]
class AuthorController extends AbstractController
{
    #[Route('/index', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route ('/show/{name}')]
    public function showAuthor($name):response{
        return $this->render('author/author.html.twig',[
            "name" => $name
        ]);
    }
    #[Route ('/list',name:"author_list")]
    public function list():response{
        $authors = [
            array('id' =>1, 'picture' => 'pic1.jpg','username'=> 'victor_hugo', 'email'=> 'victor.hugo@gmail.com','nb_book'=>300),
            array('id' =>2, 'picture' => 'pic2.jpg','username'=> 'shakespear', 'email'=> 'shakespear@gmail.com','nb_book'=>1200),
            array('id' =>3, 'picture' => 'pic3.jpg','username'=> 'victor_hugo', 'email'=> 'paolo.choelo@gmail.com','nb_book'=>550)
        ];
        return $this->render('author/list.html.twig', [
            'authors'=> $authors
        ]);
            
    }
    #[Route ('/list2',name:"author_list2")]
    public function listDb(ManagerRegistry $doctrine):Response {
        $repo = $doctrine->getRepository(Author::class);
        $list = $repo->findAll();//liaison avec la db
        return $this->render('author/list3.html.twig',[
            "list" => $list,
        ]) ;
    }
    #[Route ('/list3',name:"author_list3")]
    public function listDb3(AuthorRepository $repo):Response {
        //$list = $repo->findAll();//liaison avec la db
        //au lieu d'utiliser findAll
        $list = $repo->orderlistQB();
        return $this->render('author/list3.html.twig',[
            "list" => $list,
        ]) ;
    }
    #[Route ('/list4',name:"author_more1")]
    public function less10(AuthorRepository $repo):Response {
        //$list = $repo->findAll();//liaison avec la db
        //au lieu d'utiliser findAll
        $list = $repo->showMoreThan10();
        return $this->render('author/list3.html.twig',[
            "list" => $list,
        ]) ;
    }
    #[Route('/list5', name: 'author_more')]
    public function more(ManagerRegistry $doctrine, Request $request): Response {
        $repo = $doctrine->getRepository(Author::class);
        $value = $request->get("nbbooks");
        if($value === NULL){
            $list = $repo->findAll();
        }else{
        $list = $repo->showMoreThanNb($value); 
        }

        return $this->render('author/list3.html.twig', [
            "list" => $list,
        ]);
    }
    
    
#[Route('/interval', name: 'author_interval')]
public function intervalBooks(ManagerRegistry $doctrine, Request $request): Response {
    $repo = $doctrine->getRepository(Author::class); 
    $max = $request->get("max");
    $min = $request->get("min");

    if ($max === null || $min === null) {
        $list = $repo->findAll(); // Fetch all if no interval is provided
    } else {
        $list = $repo->showInterval($min,$max); // Cast to integers
    }

    return $this->render('author/interval.html.twig', [
        'list' => $list,
    ]);
}


    
    #[Route ('/details/{id}',name:"author_details")]
    public function details(AuthorRepository $repo,$id):Response {
        $id = $repo->find($id);//liaison avec la db
        return $this->render('author/details.html.twig',[
            "author" => $id,
        ]) ;
    }
    
    #[Route ('/details2/{id}',name:"author_details2")]
    public function details2($id):Response {
        return $this->render('author/details2.html.twig',[
            "author" => $id,
        ]) ;
    }

    #[Route('/details3/{id}', name: "author_details3")]
    public function details3(Author $author): Response {
    return $this->render('author/details.html.twig', [
        "author" => $author,
    ]);
    }




    #[Route ('/addAuthorStatic',name:"addAuthorStatic")]
    public function Add(ManagerRegistry $em):Response {
        $manager = $em->getManager();
        $author = new Author();
        $author -> setUsername("George Chaulet");
        $author -> setEmailAddress("george@gmail.com");
        $author -> setNbBooks(28);
        $manager -> persist($author);//insert
        $manager -> flush();//ajout dans la base de données
        return new Response("author added successfully");
    }
    #[Route ('/formulaire',name:"formulaire")]
    public function addAuthor(ManagerRegistry $manager, Request $request):Response{
        $em = $manager->getManager();
        $author = new Author();
        //appel au formulaire : 
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);//récupérer les informations
        if($form->isSubmitted())
        {
            $em -> persist($author);
            $em -> flush();
            return $this->redirectToRoute("author_list2");
        }
        return $this->render('author/form.html.twig',[
            "form" => $form,
        ]);

    }
    #[Route ('/update/{id}',name:"author_update")]
    public function updateAuthor(ManagerRegistry $manager, Request $request,$id,AuthorRepository $repo):Response{
        $em = $manager->getManager();
        $author = $repo->find($id);
        //appel au formulaire : 
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);//récupérer les informations
        if($form->isSubmitted())
        {
            $em -> persist($author);
            $em -> flush();
            return $this->redirectToRoute("author_list2");
        }
        return $this->render('author/form.html.twig',[
            "form" => $form,
        ]);

    }
    #[Route ('/delete/{id}',name:"delete_author")]
    public function deleteAuthor(ManagerRegistry $manager,Author$author):Response{
        $em = $manager->getManager();
        $em -> remove($author);
        $em -> flush();//modification de la base de données
        return $this->redirectToRoute("author_list2");
    }



    
    
}
