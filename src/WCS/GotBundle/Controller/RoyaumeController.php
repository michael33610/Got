<?php

namespace WCS\GotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WCS\GotBundle\Entity\Royaume;

class RoyaumeController extends Controller
{
    public function addAction($nom,$capitale,$nbHabitant)
    {



        $em = $this->getDoctrine()->getManager();

    // je crée un nouveau royaume 
            $royaume = new Royaume();

    // J’assigne des valeurs à mes propriétés
            $royaume->setNom($nom);
            $royaume->setCapitale($capitale);
            $royaume->setNbHabitant($nbHabitant);
            

    // prise en compte de l’objet par Doctrine (pas de requete SQL)
            $em->persist($royaume);

    // Doctrine fait les requêtes nécessaire sur tous les objets pris en compte dans le script (ici il exécute un INSERT)
            $em->flush();

        return $this->render('WCSGotBundle:Royaume:add.html.twig', array(
            // ...
        ));
    }

    public function showAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $royaume=$em->getRepository('WCSGotBundle:Royaume')->find($id);
        return $this->render('WCSGotBundle:Royaume:show.html.twig', array(

            "royaume"=>$royaume
            // ...
        ));
    }

}
