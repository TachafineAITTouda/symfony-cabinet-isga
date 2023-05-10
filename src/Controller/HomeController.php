<?php

namespace App\Controller;

use App\Entity\Medecin;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response
    {
        // ajouter un medecin avec le 
        return $this->render('home/index.html.twig', [
            'titre' => 'Accueil', 
        ]);
    }
    /**
     * @Route("/{nom}-{matricule}-{specialite}", name="app_creation_medecin")
     */
    public function index($nom,$matricule,$specialite, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $medecin = new Medecin();
        $medecin->setNom($nom);
        $medecin->setMatricule($matricule);
        $medecin->setSpacialite($specialite);

        $em = $managerRegistry->getManager();
        $em->persist($medecin);
        $em->flush();

        dd($medecin);




        // ajouter un medecin avec le 
        return $this->render('home/index.html.twig', [
            'titre' => 'Accueil', 
            'nom' => $nom,
            'matricule' => $matricule,
            'specialite' => $specialite

        ]);
    }

    /**
     * @Route("/medecin/{medecin}", name="app_afficher_medecin")
     */

    public function afficherMedecin(Medecin $medecin): Response
    {
        // $medecin = $managerRegistry->getRepository(Medecin::class)->find($id);
        // dd(( $medecin));
        return $this->render('home/afficherMedecin.html.twig', [
            'titre' => 'Medecin#' . $medecin->getId(), 
            'medecin' => $medecin
        ]);


    }
}
