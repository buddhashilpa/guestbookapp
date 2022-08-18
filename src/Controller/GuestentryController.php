<?php

namespace App\Controller;

use App\Entity\Guestentry;
use App\Form\GuestentryType;
use App\Repository\GuestentryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guestentry")
 */
class GuestentryController extends AbstractController
{
    /**
     * @Route("/", name="app_guestentry_index", methods={"GET"})
     */
    public function index(GuestentryRepository $guestentryRepository): Response
    {
        return $this->render('guestentry/index.html.twig', [
            'guestentries' => $guestentryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_guestentry_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GuestentryRepository $guestentryRepository): Response
    {
        $guestentry = new Guestentry();
        $form = $this->createForm(GuestentryType::class, $guestentry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            //$id = $user->getUserIdentifier();

            $guestentry->setUser($user);
            $guestentryRepository->add($guestentry, true);

            return $this->redirectToRoute('app_guestentry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guestentry/new.html.twig', [
            'guestentry' => $guestentry,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guestentry_show", methods={"GET"})
     */
    public function show(Guestentry $guestentry): Response
    {
        return $this->render('guestentry/show.html.twig', [
            'guestentry' => $guestentry,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_guestentry_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Guestentry $guestentry, GuestentryRepository $guestentryRepository): Response
    {
        $form = $this->createForm(GuestentryType::class, $guestentry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guestentryRepository->add($guestentry, true);

            return $this->redirectToRoute('app_guestentry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guestentry/edit.html.twig', [
            'guestentry' => $guestentry,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guestentry_delete", methods={"POST"})
     */
    public function delete(Request $request, Guestentry $guestentry, GuestentryRepository $guestentryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guestentry->getId(), $request->request->get('_token'))) {
            $guestentryRepository->remove($guestentry, true);
        }

        return $this->redirectToRoute('app_guestentry_index', [], Response::HTTP_SEE_OTHER);
    }
}
