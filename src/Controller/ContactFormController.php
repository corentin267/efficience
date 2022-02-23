<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\Type\ContactType;
use App\Mail\MailerEngineInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactFormController
 * @package App\Controller
 */
class ContactFormController extends AbstractController
{
    /**
    * Route to form contact
    * @Route("/")
    */
    public function create(
        Request $request,
        ManagerRegistry $registry,
        MailerEngineInterface $mailerEngine,
    ): Response
    {
        // Init form
        $contact = new ContactForm();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        // Check if form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // get data from form
            $contact = $form->getData();

            // add data to database
            $em = $registry->getManager();
            $em->persist($contact);
            $em->flush();

            // get department selected and find in db the mail of the responsable of the department
            $to = $contact->getDepartment()->getMailResponsable();
            $subject = 'Nouvelle fiche contact';
            $content = $contact->toString();
            // send mail with data
            $mailerEngine->sendText([$to], $subject, $content);

            // display message in front
            $this->addFlash('success', 'Votre message est envoyé !');
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}