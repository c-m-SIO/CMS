<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Galerie;
use App\Entity\Page;
use App\Entity\Image;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Tag;


#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('app_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    #[Route('/admin/article', name: 'admin_article')]
    public function indexArticle(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(ArticleCrudController::class)->generateUrl());
    }

    #[Route('/admin/galerie', name: 'admin_galerie')]
    public function indexGalerie(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(GalerieCrudController::class)->generateUrl());
    }

    #[Route('/admin/image', name: 'admin_image')]
    public function indexImage(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(ImageCrudController::class)->generateUrl());
    }

    #[Route('/admin/page', name: 'admin_page')]
    public function indexPage(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(PageCrudController::class)->generateUrl());
    }

    #[Route('/admin/tag', name: 'admin_tag')]
    public function indexTag(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(TagCrudController::class)->generateUrl());
    }

    #[Route('/admin/commentaire', name: 'admin_commentaire')]
    public function indexCommentaire(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(CommentaireCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CMS');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Utilisateurs', 'fa fa-user');
        yield MenuItem::linkToCrud('Galerie', 'fa fa-folder-open', Galerie::class);
        yield MenuItem::linkToCrud('Page', 'fa fa-pencil-square-o', Page::class);
        yield MenuItem::linkToCrud('Image', 'fa fa-picture-o', Image::class);
        yield MenuItem::linkToCrud('Article', 'fa fa-newspaper-o', Article::class);
        yield MenuItem::linkToCrud('Categorie', 'fa-solid fa-ticket', Categorie::class);
        yield MenuItem::linkToCrud('Tag', 'fa fa-tag', Tag::class);
        yield MenuItem::linkToCrud('Commentaire', 'fa fa-comments', Commentaire::class);
    }
}
