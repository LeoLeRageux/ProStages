<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="pro_stages_accueil")
     */
    public function index()
    {
        return $this->render('pro_stages/index.html.twig');
    }

    /**
     * @Route("/entreprises", name="pro_stages_entreprises")
     */
    public function afficherEntreprises()
    {
        return $this->render('pro_stages/afficherEntreprises.html.twig');
    }

    /**
     * @Route("/formations", name="pro_stages_formations")
     */
    public function afficherFormations()
    {
        return $this->render('pro_stages/afficherFormations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="pro_stages_stages")
     */
    public function afficherStages($id)
    {
        return $this->render('pro_stages/afficherStages.html.twig',['id'=>$id]);
    }
}
