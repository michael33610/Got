<?php

	namespace WCS\GotBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use WCS\GotBundle\Entity\Personnage;
	use WCS\GotBundle\Entity\Royaume;

	class PersonnageController extends Controller
	{
		public function addAction($prenom, $nom, $sexe, $royaume, $bio = 'Lorem ipsum')
		{
			$em = $this->getDoctrine()->getManager();
			$o_royaume = $em->getRepository('WCSGotBundle:Royaume')->find($royaume);

	// je crée un nouvel élève 
			$personnage = new Personnage();

	// J’assigne des valeurs à mes propriétés
			$personnage->setPrenom($prenom);
			$personnage->setNom($nom);
			$personnage->setSexe($sexe);
			$personnage->setBio($bio);
			$personnage->setRoyaume($o_royaume);

	// prise en compte de l’objet par Doctrine (pas de requete SQL)
			$em->persist($personnage);

	// Doctrine fait les requêtes nécessaire sur tous les objets pris en compte dans le script (ici il exécute un INSERT)
			$em->flush();

			return $this->render('WCSGotBundle:Personnage:Personnage/add.html.twig', array(
	            // ...
				));
		}


		public function showAction($id)
		{
			$em = $this->getDoctrine()->getManager();
			$personnage=$em->getRepository('WCSGotBundle:Personnage')->find($id);

			$personnage->getPrenom();
			$personnage->getNom();
			$personnage->getSexe();

			return $this->render('WCSGotBundle:Personnage:Personnage/show.html.twig', array(
	            
				"personnage"=>$personnage

				));
		}


		public function listAction($sexe){
			$em = $this->getDoctrine()->getManager();
			$personnages=$em->getRepository('WCSGotBundle:Personnage')->findBysexe($sexe);
/*
			foreach ($personnages as $personnage) {
				
				echo($personnage->getNom()."<br>");
			}
*/
			return $this->render('WCSGotBundle:Personnage:Personnage/list.html.twig', array("personnages"=>$personnages));

		}


		public function changeAction($id_personnage, $id_royaume){

			$em = $this->getDoctrine()->getManager();

			$o_personnage = $em->getRepository('WCSGotBundle:Personnage')->find($id_personnage);
			//var_dump ($o_personnage->getRoyaume());

//
			$o_ancien_royaume = $o_personnage->getRoyaume();


			$o_nouveau_royaume = $em->getRepository('WCSGotBundle:Royaume')->find($id_royaume);

if ($o_ancien_royaume===$o_nouveau_royaume){
	// echo "<br>pb de royaume<br>";
} else {
	// echo "<br>j'ai deux royaume<br>";
}

			$o_personnage->setRoyaume($o_nouveau_royaume);

			$em->persist($o_personnage);
			$em->flush();

			//persistance de la donnee

			/**/
			return $this->render('WCSGotBundle:Personnage:Personnage/change.html.twig', array(
				"personnage"=>$o_personnage,
				"ancien_royaume"=>$o_ancien_royaume,
				));
			/**/
				/*
			return $this->render('WCSGotBundle:Personnage:Personnage/change.html.twig', array(
				"personnage"=>$o_personnage,
				"ancien_personnage"=>$o_ancien_personnage,
				));
				*/

		}

	}
