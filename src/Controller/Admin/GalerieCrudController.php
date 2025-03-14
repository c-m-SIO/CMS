<?php

namespace App\Controller\Admin;

use App\Entity\Galerie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class GalerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Galerie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('description'),
            AssociationField::new('images')
                ->setFormTypeOption('by_reference', false)
                ->setFormTypeOption('multiple', true) 
                ->setLabel('Images'),
            AssociationField::new('pages')
            ->setFormTypeOption('by_reference', false)
            ->setFormTypeOption('multiple', true) 
            ->setLabel('Pages')
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('titre')
            ->add('description')
            ->add('images')
            ->add('pages')
        ;
    }
    
}
