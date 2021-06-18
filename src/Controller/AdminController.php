<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Form\CategoryFormType;
use App\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/category/add", name="add_category")
     */
    public function addCategory(Request $request): Response
    {
        $category = new Category(); // on peut passer des paramètres pour le costructeur au moment de l'instanciation
        // création du formulaire, instantiation de la classe + le formulaire
        // dd($category);
        $form = $this->createForm(CategoryFormType::class, $category);
        // repère les infos de la requête reçu par l'injection de dépendance
        $form->handleRequest($request);
        // dd($form);
        // test du l'envoi du formulaire et les contraintes de validation
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // appelle le model avec l'entityManager de Doctrine, ce mecanisme sait faire de requêtes

            $em->persist($category); //rendre les données persistantes de l'instance
            $em->flush(); // un commit dans mysql qui analyse la transaction de deux coté
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/category/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/add", name="add_post")
     */
    public function addPost(Request $request): Response
    {
        $post = new Post(); // on peut passer des paramètres pour le costructeur au moment de l'instanciation
        // création du formulaire, instantiation de la classe + le formulaire
        $form = $this->createForm(PostFormType::class, $post);
        // repère les infos de la requête reçu par l'injection de dépendance
        $form->handleRequest($request);

        // test du l'envoi du formulaire et les contraintes de validation
        if ($form->isSubmitted() && $form->isValid()) {

            // initialisation des valeurs par défaut 
            $post->setUser($this->getUser()); // user connecté
            $post->setActive(false); // article non activé
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('admin/post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
