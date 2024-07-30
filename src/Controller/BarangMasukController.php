<?php

namespace App\Controller;

use App\Entity\BarangMasuk;
use App\Form\BarangMasukType;
use App\Repository\BarangMasukRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/barang_masuk')]
class BarangMasukController extends AbstractController
{
    #[Route('/', name: 'app_barang_masuk_index', methods: ['GET'])]
    public function index(BarangMasukRepository $barangMasukRepository): Response
    {
        return $this->render('barang_masuk/index.html.twig', [
            'barang_masuks' => $barangMasukRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_barang_masuk_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $barangMasuk = new BarangMasuk();
        $form = $this->createForm(BarangMasukType::class, $barangMasuk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($barangMasuk);
            $entityManager->flush();

            return $this->redirectToRoute('app_barang_masuk_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('barang_masuk/new.html.twig', [
            'barang_masuk' => $barangMasuk,
            'form' => $form,
        ]);
    }

    #[Route('/{id_masuk}', name: 'app_barang_masuk_show', methods: ['GET'])]
    public function show(BarangMasuk $barangMasuk): Response
    {
        return $this->render('barang_masuk/show.html.twig', [
            'barang_masuk' => $barangMasuk,
        ]);
    }

    #[Route('/{id_masuk}/edit', name: 'app_barang_masuk_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BarangMasuk $barangMasuk, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BarangMasukType::class, $barangMasuk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_barang_masuk_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('barang_masuk/edit.html.twig', [
            'barang_masuk' => $barangMasuk,
            'form' => $form,
        ]);
    }

    #[Route('/{id_masuk}', name: 'app_barang_masuk_delete', methods: ['POST'])]
    public function delete(Request $request, BarangMasuk $barangMasuk, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barangMasuk->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($barangMasuk);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_barang_masuk_index', [], Response::HTTP_SEE_OTHER);
    }
}
