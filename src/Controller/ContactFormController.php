<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ContactForm;
use App\Entity\Department;
use App\Form\Type\ContactType;
use App\Mail\MailerEngineInterface;
use App\Repository\DepartmentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        DepartmentRepository $repository,
        ManagerRegistry $registry,
        MailerEngineInterface $mailerEngine,
    ): Response
    {
        // Get all departments to add in select form
        $deps = Department::formatForForm($repository->getAll());

        // Init form
        $contact = new ContactForm();
        $form = $this->createForm(ContactType::class, $contact);

        // Add department select in form
        $form->add('department', ChoiceType::class, [
            'choices'  => $deps,
        ]);

        // Add submit button to form
        $form->add('save', SubmitType::class, ['label' => 'Envoyer']);

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
            $to = $repository->find($contact->getDepartment())->getMailResponsable();
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