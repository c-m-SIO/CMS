<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            TextEditorField::new('description'),
            AssociationField::new('categories')->setFormTypeOption('choice_label', 'titre')->setLabel('Categorie'),
            AssociationField::new('page')->setFormTypeOption('choice_label', 'titre')->setLabel('Page'),
            AssociationField::new('tags')->setFormTypeOption('choice_label', 'nom')->setLabel('Tag'),
            TextField::new('meta'),
        ];

        $user = $this->getUser();
        $isAdmin = in_array('ROLE_ADMIN', $user->getRoles(), true);
        $statutField = ChoiceField::new('statutModeration')
        ->setChoices(['En attente' => 'en_attente', 'Approuvé' => 'OK', 'Rejeté' => 'rejete'])
        ->setRequired(true);

    if ($isAdmin) {
        array_push($fields, $statutField);
    }
        return $fields;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('titre')
            ->add('page')
            ->add('categories')
            ->add('tags')
        ;
    }
}
