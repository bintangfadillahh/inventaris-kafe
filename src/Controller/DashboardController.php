<?php

namespace App\Controller;

use App\Entity\Barang;
use App\Form\BarangType;
use App\Repository\BarangRepository;
use App\Repository\BarangMasukRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard_index', methods: ['GET'])]
    public function index(BarangRepository $barangRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'barangs' => $barangRepository->findAll(),
        ]);
    }

    #[Route('/barang', name:'app_dashboard_barang', methods: ['GET'])]
    public function barang(BarangMasukRepository $barangMasukRepository): Response
    {
        return $this->render('dashboard/barang.html.twig', [
            'barangs' => $barangMasukRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_dashboard_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Barang $barang = null): Response
    {
        $barang = new Barang();
        $form = $this->createForm(BarangType::class, $barang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($barang);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dashboard/new.html.twig', [
            'barang' => $barang,
            'form' => $form,
        ]);
    }

    #[Route('/{id_barang}', name: 'app_dashboard_show', methods: ['GET'])]
    public function show(Barang $barang): Response
    {
        if (!$barang) {
            throw $this->createNotFoundException('The barang does not exist');
        }

        return $this->render('dashboard/show.html.twig', [
            'barang' => $barang,
        ]);
    }

    #[Route('/{id_barang}/edit', name: 'app_dashboard_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Barang $barang, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BarangType::class, $barang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dashboard/edit.html.twig', [
            'barang' => $barang,
            'form' => $form,
        ]);
    }

    #[Route('/{id_barang}', name: 'app_dashboard_delete', methods: ['POST'])]
    public function delete(Request $request, Barang $barang, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barang->getIdBarang(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($barang);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_index', [], Response::HTTP_SEE_OTHER);
    }
}
