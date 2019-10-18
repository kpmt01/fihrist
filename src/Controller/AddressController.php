<?php

namespace App\Controller;

use App\Entity\Addresses;
use App\Entity\User;
use App\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    /**
     * @Route("/newaddress/{id}", name="newaddress")
     */
    public function newaddress(Request $request, int $id){
        $data = array();
        $data['user'] = $this->getDoctrine()->getRepository(User::class)->find($id);
        $address = new Addresses();
        $address->setUser($data['user']);
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $address = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($address);
            $entityManager->flush();
            return $this->redirectToRoute('getaddresses', array('id' => $data['user']->getId(), 'process' => (boolean)$entityManager));
        }

        $data['form'] = $form->createView();
        return $this->render('address/newaddress.html.twig', $data);
    }

    /**
     * @Route("/getaddresses/{id}", name="getaddresses")
     */
    public function getaddresses(int $id) {
        $data = array();
        $data['user'] = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('address/getaddresses.html.twig', $data);

    }

    /**
     * @Route("/removeaddress/{id}", name="removeaddress")
     */
    public function removeaddress(int $id) {
        $address = $this->getDoctrine()->getRepository(Addresses::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $adrs = $em->getRepository(Addresses::class)->find($id);
        $em->remove($adrs);
        $em->flush();

        return $this->redirectToRoute('getaddresses', array('id' => $address->getUser()->getId(), 'process' => (boolean)$adrs));
    }
}
