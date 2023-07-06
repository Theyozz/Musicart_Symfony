<?php

namespace App\Controller;

use App\Entity\NFTCollection;
use App\Form\NFTCollectionType;
use App\Repository\NFTCollectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/n/f/t/collection')]
class NFTCollectionController extends AbstractController
{
    #[Route('/', name: 'app_n_f_t_collection_index', methods: ['GET'])]
    public function index(NFTCollectionRepository $nFTCollectionRepository): Response
    {
        return $this->render('nft_collection/index.html.twig', [
            'n_f_t_collections' => $nFTCollectionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_n_f_t_collection_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NFTCollectionRepository $nFTCollectionRepository): Response
    {
        $nFTCollection = new NFTCollection();
        $form = $this->createForm(NFTCollectionType::class, $nFTCollection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nFTCollectionRepository->save($nFTCollection, true);

            return $this->redirectToRoute('app_n_f_t_collection_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nft_collection/new.html.twig', [
            'n_f_t_collection' => $nFTCollection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_n_f_t_collection_show', methods: ['GET'])]
    public function show(NFTCollection $nFTCollection): Response
    {
        return $this->render('nft_collection/show.html.twig', [
            'n_f_t_collection' => $nFTCollection,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_n_f_t_collection_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NFTCollection $nFTCollection, NFTCollectionRepository $nFTCollectionRepository): Response
    {
        $form = $this->createForm(NFTCollectionType::class, $nFTCollection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nFTCollectionRepository->save($nFTCollection, true);

            return $this->redirectToRoute('app_n_f_t_collection_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nft_collection/edit.html.twig', [
            'n_f_t_collection' => $nFTCollection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_n_f_t_collection_delete', methods: ['POST'])]
    public function delete(Request $request, NFTCollection $nFTCollection, NFTCollectionRepository $nFTCollectionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nFTCollection->getId(), $request->request->get('_token'))) {
            $nFTCollectionRepository->remove($nFTCollection, true);
        }

        return $this->redirectToRoute('app_n_f_t_collection_index', [], Response::HTTP_SEE_OTHER);
    }
}
