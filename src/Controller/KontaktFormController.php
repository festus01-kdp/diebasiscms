<?php

namespace App\Controller;

use App\Form\KontaktdiebasisType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class KontaktFormController extends AbstractController
{
    public function showKontaktForm(Request $request, MailerInterface $mailer): Response
    {
        $kontaktFormular = $this->createForm(KontaktdiebasisType::class);

        $kontaktFormular->handleRequest($request);

        if ($kontaktFormular->getClickedButton() === $kontaktFormular->get('abbruch')){
            return $this->redirect('/matthiasheine');
        }

        if ($kontaktFormular->isSubmitted() && $kontaktFormular->isValid()) {

            if ($kontaktFormular->getClickedButton() === $kontaktFormular->get('senden')){

                $formDaten = $request->request->all();
                // In $formdaten[kontakt_form] stehen die Daten
                // kontakt_form wird vom System vorgegeben
                // Warum ???
                /** TODO
                 *  Daten auswerten und versenden
                 */
                $this->sendEmail($formDaten, $mailer);


                return $this->redirect('matthiasheine', 302);
            }


        }

        return $this->render('pages/kontaktform.html.twig', [
            'kontaktformular' => $kontaktFormular->createView()
        ]);

    }

    private function sendEmail(array $formDaten, MailerInterface $mailer)
    {

        $nachricht =
<<< HTML
            <p>
                <strong>Absender:</strong> {$formDaten['kontakt_form']['email']}
            </p>
            <p>
                <strong>Nachricht:</strong> {$formDaten['kontakt_form']['nachricht']}
            </p>
            <hr>
            <p>Ende der Nachricht</p>
HTML;

        $email = (new Email())
            // from ist in mailer.yaml global definiert
            ->to('klaus-dieter.pernak@gmx.de')
            ->replyTo('noreply@sulucms.org')
            ->subject('Anfrage Kontakformular')
            ->text($formDaten['kontakt_form']['nachricht'])
            ->html($nachricht);

        $mailer->send($email);
    }
}