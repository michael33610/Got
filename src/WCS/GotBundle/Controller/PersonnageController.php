<?php

	namespace WCS\GotBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use WCS\GotBundle\Entity\Personnage;
	use WCS\GotBundle\Entity\Royaume;
	use WCS\GotBundle\Form\PersonnageType;
	use Symfony\Component\HttpFoundation\Request;

	use WCS\GotBundle\Service\SlugService;

	class PersonnageController extends Controller
	{
		public function addAction(Request $request)
		{
	// je crée un nouvel élève 
		$personnage = new Personnage();


	//pour traiter avec form
	    $form = $this->createForm(PersonnageType::class, $personnage);    
	    // $form contient maintenant notre formulaire, on peut le manipuler comme précédemment

	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
	        $em = $this->getDoctrine()->getManager();


//pour pouvoir utiliser le service !!!!! outil pour utiliser le service
			$slugifyer = $this->get('WCS.SlugService');

			$personnage->setSlugPer($slugifyer->slugify($personnage->getNom()));


	        $em->persist($personnage);
	        $em->flush();

	        //return $this->redirectToRoute('homepage');
	    }
	    return $this->render('WCSGotBundle:Personnage:Personnage/add.html.twig', array(
	        'form' => $form->createView()
	    ));


	    public function editAction(Request $request)
		{
	// je crée un nouvel élève 
		//$personnage = new Personnage();


	//pour traiter avec form
	    $form = $this->createForm(PersonnageType::class, $personnage);    
	    // $form contient maintenant notre formulaire, on peut le manipuler comme précédemment

	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {

//pour pouvoir utiliser le service !!!!! outil pour utiliser le service
			$slugifyer = $this->get('WCS.SlugService');

			$personnage->setSlugPer($slugifyer->slugify($personnage->getNom()));


	        $em = $this->getDoctrine()->getManager();
	        //$em->persist($personnage);
	        $em->flush();

	        //return $this->redirectToRoute('homepage');
	    }
	    return $this->render('WCSGotBundle:Personnage:Personnage/add.html.twig', array(
	        'form' => $form->createView()
	    ));


	}





		public function showAction($id, Request $request)
		{
			$em = $this->getDoctrine()->getManager();
			$personnage=$em->getRepository('WCSGotBundle:Personnage')->find($id);

			$form = $this->createForm(PersonnageType::class, $personnage); 
			$form->handleRequest($request);


		    if ($form->isSubmitted() && $form->isValid()) {
		        $em = $this->getDoctrine()->getManager();
		        $em->persist($personnage);
		        $em->flush();

		        return $this->redirectToRoute('homepage');
		    }
			return $this->render('WCSGotBundle:Personnage:Personnage/show.html.twig', array(
		            
					"personnage"=>$personnage,
					"form" => $form->createView()

			));


	    // $form contient maintenant notre formulaire, on peut le manipuler comme précédemment


			/*
			$em = $this->getDoctrine()->getManager();
			$personnage=$em->getRepository('WCSGotBundle:Personnage')->find($id);

			$personnage->getPrenom();
			$personnage->getNom();
			$personnage->getSexe();

			return $this->render('WCSGotBundle:Personnage:Personnage/show.html.twig', array(
	            
				"personnage"=>$personnage

				));
				*/
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
