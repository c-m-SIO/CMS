<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('titre'),
            TextEditorField::new('contenu')->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h2'],
                ],
                'css' => [
                    'attachment' => 'admin_file_field_attachment',
                ],
                
            ]),
            AssociationField::new('article')->setFormTypeOption('choice_label', 'titre')->setLabel('article'),
            TextField::new('statut'),
        ];
        
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('titre')
            ->add('contenu')
            ->add('article')
            ->add('statut')
            
        ;
    }
    
}
