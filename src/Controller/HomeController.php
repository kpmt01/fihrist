<?php

namespace App\Controller;

use App\Entity\Addresses;
use App\Entity\User;
use App\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index() {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $data = array(
            'controller_name' => 'HomeController',
            'users' => $users
        );

        return $this->render('home/index.html.twig', $data);
    }

    /**
     * @Route("/sendmail/{id}", name="sendmail")
     */
    public function sendmail(int $id,  \Swift_Mailer $mailer) {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $message = (new \Swift_Message('Halo'))
            ->setFrom('from@emrem.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView('emails/test.html.twig', ['name' => $user->getUsername()]),
                'text/html'
            );

        $sendmail = $mailer->send($message);


        return $this->redirectToRoute('getaddresses', array('id' => $id, 'process' => $sendmail));
    }

}
