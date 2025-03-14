<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Page;
use App\Form\PageType;

class SecurityController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Security $security): RedirectResponse
    {
        // Vérifie si l'utilisateur est authentifié
        if ($security->getUser()) {
            // Si l'utilisateur est connecté, redirige vers la page /articles
            return $this->redirectToRoute('app_page_index'); // Assurez-vous que la route 'app_articles' existe
        }
        
        // Si l'utilisateur n'est pas connecté, redirige vers la page de login
        return $this->redirectToRoute('app_login'); // Assurez-vous que la route 'app_login' existe
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    
     
}
