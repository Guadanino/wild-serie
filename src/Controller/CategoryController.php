<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index');
        }


        return $this->render('category/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findBy(
            ['name' => $categoryName]);

        $programs = $programRepository->findBy(
            ['category' => $category],
            ['id' => 'DESC'],
            limit:3
        );

        if (!$category)
        {
            throw $this->createNotFoundException(
                'Aucune Catégorie avec le numero : ' .$category['id']. ' trouvé dans la table'
            );
        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);
    }








}
