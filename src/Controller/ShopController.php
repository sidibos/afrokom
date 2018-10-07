<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\ShopType;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shop")
 */
class ShopController extends AbstractController
{
    /**
     * @Route("/", name="shop_index", methods="GET")
     */
    public function index(ShopRepository $shopRepository): Response
    {
        return $this->render('shop/index.html.twig', ['shops' => $shopRepository->findAll()]);
    }

    /**
     * @Route("/new", name="shop_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $shop = new Shop();
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();

            return $this->redirectToRoute('shop_index');
        }

        return $this->render('shop/new.html.twig', [
            'shop' => $shop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Display all products from this shop.
     *
     * @Route("/{slug}/products", name="shop_products")
     */
    public function shopProducts($slug)
    {
        $repository = $this->getDoctrine()->getRepository(Shop::class);
        $shop = $repository->findOneBy(['slug'=>$slug]);

        if (!$shop) {
            throw $this->createNotFoundException('The shop does not exist');
        }

        return $this->render('shop/products.html.twig', [
            'shop' => $shop,
        ]);
    }

    /**
     * @Route("/{id}", name="shop_show", methods="GET")
     */
    public function show(Shop $shop): Response
    {
        return $this->render('shop/show.html.twig', ['shop' => $shop]);
    }

    /**
     * @Route("/{id}/edit", name="shop_edit", methods="GET|POST")
     */
    public function edit(Request $request, Shop $shop): Response
    {
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shop_edit', ['id' => $shop->getId()]);
        }

        return $this->render('shop/edit.html.twig', [
            'shop' => $shop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shop_delete", methods="DELETE")
     */
    public function delete(Request $request, Shop $shop): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shop->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shop);
            $em->flush();
        }

        return $this->redirectToRoute('shop_index');
    }
}
