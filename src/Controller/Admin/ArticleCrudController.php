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


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    
    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            TextEditorField::new('description'),
            AssociationField::new('categories')->setFormTypeOption('choice_label', 'titre')->setLabel('Categorie'),
            AssociationField::new('page')->setFormTypeOption('choice_label', 'titre')->setLabel('Page'),
            AssociationField::new('tags')->setFormTypeOption('choice_label', 'nom')->setLabel('Tag'),
            TextField::new('meta')
        ];
    }
    
}
