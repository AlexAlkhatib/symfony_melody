<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact.index')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer
        ): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form-> isSubmitted() && $form->isValid()){
            $manager->persist($contact);
            $manager->flush();

            $email = (new Email())
            ->from($contact -> getEmail())
            ->to('symfony_melody@gmail.com')
            ->subject($contact->getSubject())
            ->html($contact->getMessage());


        $mailer->send($email);

            return $this->redirectToRoute('morceaux.index');
        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
       ] );
    }}