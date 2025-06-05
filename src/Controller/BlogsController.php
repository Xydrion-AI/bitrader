<?php

namespace App\Controller;

use App\Entity\Blogs;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\BlogsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogsController extends AbstractController
{
    #[Route('/blogs', name: 'blogs')]
    public function index(BlogsRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $query = $repository->findAllPaginatedQuery();

        $blogs = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('pages/blogs/blogs.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    #[Route('/blog_sidebar', name: 'blog_sidebar')]
    public function blogSide(): Response
    {
        return $this->render('pages/blogs/blog-sidebar.html.twig', [
            'controller_name' => 'BlogsController',
        ]);
    }

    #[Route('/blog/{slug}', name: 'blog_details')]
    public function show(string $slug, Request $request, EntityManagerInterface $em): Response
    {
        $blog = $em->getRepository(Blogs::class)->findOneBy(['slug' => $slug]);

        if (!$blog) {
            throw $this->createNotFoundException('Blog not found');
        }

        $comment = new Comment();
        $comment->setBlog($blog);
        $comment->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Commentaire ajouté avec succès !');
            return $this->redirectToRoute('blog_details', ['slug' => $slug]);
        }

        return $this->render('pages/blogs/blog-details.html.twig', [
            'blog' => $blog,
            'commentForm' => $form->createView(),
        ]);
    }
}
