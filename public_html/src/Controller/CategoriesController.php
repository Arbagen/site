<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends Controller
{
    /**
     * @Route("/categories", name="categories.all")
     */
    public function index()
    {
        $title = 'Categories';
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();
        return $this->render('@site/categories/index.html.twig', [
          'title' => $title,
          'categories' => $categories,
        ]);
    }
    
    /**
     * @Route("/categories/new", name="categories.new")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $title = 'New category';
        $em = $this->getDoctrine()->getManager();
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('categories.all');
        }
        return $this->render('@site/categories/new.html.twig', [
          'form' => $form->createView(),
          'category' => $category,
          'title' => $title,
        ]);
    }
    
    /**
     * @Route("/categories/edit/{id}", name="categories.edit")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Category                      $category
     * @ParamConverter("category", class="App\Entity\Category")
     * @return Response*
     */
    public function edit(Request $request, Category $category)
    {
        $title = 'Edit category';
        $em = $this->getDoctrine()->getManager();
        $params = $request->request->all();
        if ($params) {
            $em->flush();
        }
        return $this->render('@site/categories/edit.html.twig', [
          'title' => $title,
          'category' => $category,
        ]);
    }
}
