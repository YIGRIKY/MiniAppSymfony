<?php


namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class AdminPostController extends AdminBaseController
{

    /**
     * @Route ("/admin/post", name="admin_post")
     */
    public function index()
    {
        $post = $this->getDoctrine()->getRepository(Post::class)
            ->findAll();

        $forRender = parent::renderDefault();
        $forRender['title'] = 'Посты';
        $forRender['post'] = $post;
        return $this->render('admin/post/index.html.twig', $forRender);
    }

    /**
     * @Route ("/admin/post/create", name="admin_post_create")
     * @param Request $request
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $post->setCreateAtValue();
            $post->setUpdateAtValue();
            $post->setIsPublished();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Пост добавлен');
            return $this->redirectToRoute('admin_post');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Создание поста';
        $forRender['form'] = $form->createView();
        return $this->render('admin/post/form.html.twig', $forRender);
    }
}