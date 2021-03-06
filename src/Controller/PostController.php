<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('post/home.html.twig', [
            'bg_image' => 'clean/assets/img/home-bg.jpg',
        ]);
    }

    /**
     * @Route("/post/{id}", name="post_view", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function view($id): Response
    {
        return $this->render('post/view.html.twig', [
            'bg_image' => 'clean/assets/img/post-bg.jpg',
            'id' => $id,
            'post' => [
                'title' => 'Symfony is the best !',
                'description' => 'Hundreds of carefully written documentation pages covering all Symfony features exist and they are FREE and open-source licensed!',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum enim lectus, a cursus lacus imperdiet ac. Etiam lorem est, facilisis sed justo sed, consectetur volutpat sapien. Quisque non venenatis tortor. Fusce eu orci ipsum. Suspendisse at dapibus nisl. Donec lacinia ligula a faucibus rhoncus. Nullam in sodales purus, consectetur finibus est. Duis sollicitudin dapibus risus, a pellentesque sapien accumsan ut. Morbi porta scelerisque dolor, eget imperdiet velit malesuada et. Quisque rhoncus posuere libero id vehicula. Fusce vel malesuada massa, eget ullamcorper nisl. Suspendisse maximus venenatis sem.'
            ]
        ]);
    }
}
