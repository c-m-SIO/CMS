<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Page;
use App\Entity\Commentaire;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;


#[Route('/article')]
final class ArticleController extends AbstractController
{
    #[Route(name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_article_show', methods: ['GET', 'POST'])]
    public function show(string $slug, Article $article, ArticleRepository $articleRepository, EntityManagerInterface $entityManager, request $request, Security $security, CommentaireRepository $commentaireRepository): Response
    {
        $article = $articleRepository->getArticleBySlug($slug);
        $commentaire = new Commentaire();
        $commentaire->setArticle($article);
        $commentaire->setDate(new \DateTime());;
        $commentaire->setRedacteur($security->getUser());
        $commentaire->setStatut("En attente de validation");
        $form = $this->createForm(CommentaireType::class, $commentaire,  );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {          
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_show', ['slug'=> $slug], Response::HTTP_SEE_OTHER);
        }


        return $this->render('article/show.html.twig', [
            'article' => $article,
            'commentaires' => $commentaireRepository->getCommentairesbyArticleId($article->getId()),
            'form' => $form,
        ]);
    }

    // #[Route('/{slug}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    // public function edit(string $slug,  Request $request, Article $article, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(ArticleType::class, $article);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('article/edit.html.twig', [
    //         'article' => $article,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_article_delete', methods: ['POST'])]
    // public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->getPayload()->getString('_token'))) {
    //         $entityManager->remove($article);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    // }
}
