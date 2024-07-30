<?php

namespace App\Controller;

use App\Entity\BarangKeluar;
use App\Form\BarangKeluarType;
use App\Repository\BarangKeluarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/barang_keluar')]
class BarangKeluarController extends AbstractController
{
    #[Route('/', name: 'app_barang_keluar_index', methods: ['GET'])]
    public function index(BarangKeluarRepository $barangKeluarRepository): Response
    {
        return $this->render('barang_keluar/index.html.twig', [
            'barang_keluars' => $barangKeluarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_barang_keluar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $barangKeluar = new BarangKeluar();
        $form = $this->createForm(BarangKeluarType::class, $barangKeluar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($barangKeluar);
            $entityManager->flush();

            return $this->redirectToRoute('app_barang_keluar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('barang_keluar/new.html.twig', [
            'barang_keluar' => $barangKeluar,
            'form' => $form,
        ]);
    }

    #[Route('/{id_keluar}', name: 'app_barang_keluar_show', methods: ['GET'])]
    public function show(BarangKeluar $barangKeluar): Response
    {
        return $this->render('barang_keluar/show.html.twig', [
            'barang_keluar' => $barangKeluar,
        ]);
    }

    #[Route('/{id_keluar}/edit', name: 'app_barang_keluar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BarangKeluar $barangKeluar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BarangKeluarType::class, $barangKeluar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_barang_keluar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('barang_keluar/edit.html.twig', [
            'barang_keluar' => $barangKeluar,
            'form' => $form,
        ]);
    }

    #[Route('/{id_keluar}', name: 'app_barang_keluar_delete', methods: ['POST'])]
    public function delete(Request $request, BarangKeluar $barangKeluar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barangKeluar->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($barangKeluar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_barang_keluar_index', [], Response::HTTP_SEE_OTHER);
    }
}
