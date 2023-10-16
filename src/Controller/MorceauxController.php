<?php

namespace App\Controller;

use App\Entity\Morceaux;
use App\Form\MorceauxType;
use App\Repository\MorceauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class MorceauxController extends AbstractController
{
    #[Route('/morceaux', name: 'morceaux.index', methods: ['GET'])]
    public function index(MorceauxRepository $repository,
    PaginatorInterface $paginator, Request $request): Response
    {   
        $morceaux = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('morceaux/index.html.twig', [
            'morceaux' => $morceaux
        ]);
    }

    #[Route('/morceaux/nouveau', 'morceaux.new', methods : ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $morceaux = new Morceaux();

        $form = $this->createForm(MorceauxType::class, $morceaux);
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            $morceaux = $form->getData();

            $manager->persist($morceaux);
            $manager->flush();

            return $this->redirectToRoute('morceaux.index');
        }

        return $this->render('morceaux/new.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/morceaux/supprime/{id}', 'morceaux.delete', methods : ['GET'])]
    public function delete(EntityManagerInterface $manager,Morceaux $morceaux):Response {
        $manager->remove($morceaux);
        $manager->flush();

        return $this->redirectToRoute('morceaux.index');
    }

}
