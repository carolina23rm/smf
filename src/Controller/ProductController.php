<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends AbstractController
{
    
    
    /**
     * @Route("/product/add", name="create_product")
     */
    public function createProduct(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName($_POST['producto']);
        $product->setPrice($_POST['precio']);
        $product->setDescription($_POST['descrip']);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        
        return $this->render('product/product.html.twig', [
            'controller_name' => 'ProductController',
            'idProducto' => $product->getId(),
            'nombreP' => $product->getName(),
            'precioP' => $product->getPrice(),
            'desP' => $product->getDescription(),
        ]);
    }
    /**
    * @Route("/product/{id}", name="product_show")
    */
    public function show($id)
    {
        $id = $_POST['id'];
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            return $this->render('product/error.html.twig');
        }

        return $this->render('product/product.html.twig', [
            'controller_name' => 'ProductController',
            'idProducto' => $product->getId(),
            'nombreP' => $product->getName(),
            'precioP' => $product->getPrice(),
            'desP' => $product->getDescription(),
        ]);
    
    }
    
    /**
    * @Route("/product/edit/{id}")
    */
   public function update($id)
    {
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
        

        if (!$product) {
            return $this->render('product/error.html.twig');
        }

        $product->setName($_POST['producto']);
        $product->setPrice($_POST['precio']);
        $product->setDescription($_POST['descrip']);
        $entityManager->flush();

        return $this->render('product/product.html.twig', [
            'controller_name' => 'ProductController',
            'idProducto' => $product->getId(),
            'nombreP' => $product->getName(),
            'precioP' => $product->getPrice(),
            'desP' => $product->getDescription(),
        ]);
        

    
    }
    
        /**
    * @Route("/product/Formedit/{id}")
    */
   public function FormUpdate($id)
    {
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
        

        if (!$product) {
            return $this->render('product/error.html.twig');
        }

        return $this->render('product/editar.html.twig', [
            'controller_name' => 'ProductController',
            'idProducto' => $product->getId(),
            'nombreP' => $product->getName(),
            'precioP' => $product->getPrice(),
            'desP' => $product->getDescription(),
        ]);
        

    
    }
    
    
    /**
    * @Route("/product/delete/{id}")
    */
    public function delete($id){
        
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->render('product/error.html.twig');
        }
        
        $entityManager->remove($product);
        $entityManager->flush();
        
        return $this->render('product/delete.html.twig');
        
    }
    
    /**
    * @Route("/list")
    */
    
    public function list(){
        
        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(Product::class)->findAll();
            
            for ($i = 0; $i < count($product); $i++){
                $array = array(
                    'id' => $product[$i]->getId()
                );
                    
                
                return $this->render('product/list.html.twig', [
                    'controller_name' => 'ProductController',
                    'array' =>$product
                ]);
            }
                
    }
    
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
