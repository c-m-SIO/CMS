<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            SlugField::new('slug')->setTargetFieldName('titre'),
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
            TextField::new('meta'),
            AssociationField::new('galeries')
                ->setFormTypeOption('by_reference', false)
                ->setFormTypeOption('multiple', true) 
                ->setLabel('Galeries')
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('titre')
            ->add('contenu')
            ->add('meta')
            ->add('galeries')
        ;
    }
    
}
