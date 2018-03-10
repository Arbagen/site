<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FileRemover;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\FileUploader;

/**
 * Class ProductsController
 *
 * @package App\Controller
 */
class ProductsController extends Controller
{
    /**
     * @Route("/products", name="products.all")
     */
    public function index()
    {
        $title = 'All products';
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->findAll();
        return $this->render('@site/products/index.html.twig', [
            'products' => $products,
            'title' => $title
        ]);
    }
    
    /**
     * @Route("/products/new", name="products.new")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $title = 'New product';
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $projectDir = $this->getParameter('project_dir');
            $productImagesDir = $this->getParameter('uploads_dir') . 'images/products/';
            $fileUploader = new FileUploader($projectDir . $productImagesDir);
            foreach ($product->getImagesToUpload() as $image) {
                $pathOnServer = $fileUploader->upload($image);
                if (file_exists($pathOnServer)) {
                    $relativePath = str_replace($projectDir, '', $pathOnServer);
                    $newImage = new Image($relativePath);
                    $product->addImage($newImage);
                }
            }
            $em->flush();
            return $this->redirectToRoute('products.all');
        }
        return $this->render('@site/products/new.html.twig', [
          'form' => $form->createView(),
          'title' => $title
        ]);
    }
    
    /**
     * @Route("/products/remove", name="products.remove")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Service\FileRemover                  $fileRemover
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove(Request $request, FileRemover $fileRemover)
    {
        $productId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($productId);
        if ($product) {
            $em->remove($product);
            foreach ($product->getImages() as $image) {
                $fileRemover->removeFile($image->getPath());
            }
            $em->flush();
        }
        return $this->redirectToRoute('products.all');
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Product                       $product
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/products/edit/{id}", name="products.edit")
     * @ParamConverter("product", class="App\Entity\Product")
     *
     */
    public function edit(Request $request, Product $product)
    {
        $title = 'Edit product';
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projectDir = $this->getParameter('project_dir');
            $productImagesDir = $this->getParameter('uploads_dir') . 'images/products/';
            $fileUploader = new FileUploader($projectDir . $productImagesDir);
            foreach ($product->getImagesToUpload() as $image) {
                $pathOnServer = $fileUploader->upload($image);
                if (file_exists($pathOnServer)) {
                    $relativePath = str_replace($projectDir, '', $pathOnServer);
                    $newImage = new Image($relativePath);
                    $product->addImage($newImage);
                }
            }
            $em->flush();
        }
        $images = $product->getImages();
        return $this->render('@site/products/edit.html.twig', [
          'form' => $form->createView(),
          'images' => $images,
          'title' => $title
        ]);
    }
}
