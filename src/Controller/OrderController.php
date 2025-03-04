<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {}

    #[Route('/order/add', name: 'order_add', methods: ['POST', 'GET'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Order $order */
            $order = $form->getData();

            $this->manager->persist($order);
            $this->manager->flush();

            return $this->redirect('/');
        }


        return $this->render('order/form.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/order/update/{id}', name: 'order_update', methods: ['POST', 'GET'])]
    public function update(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Order $order */
            $order = $form->getData();

            $this->manager->persist($order);
            $this->manager->flush();

            return $this->redirectToRoute('order_read', ['id' => $order->getId()]);
        }

        return $this->render('order/form.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/order/{id}', name: 'order_read', methods: 'GET')]
    public function read(Order $order): Response
    {
        return $this->render('order/index.html.twig', [
            'order' => $order,
        ]);
    }
}
