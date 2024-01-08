<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require_once __DIR__ . '/../bootstrap.php';

	function optionsCatalogue (Request $request, Response $response, $args) {
	    
	    // Evite que le front demande une confirmation à chaque modification
	    $response = $response->withHeader("Access-Control-Max-Age", 600);
	    
	    return addHeaders ($response);
	}

	function hello(Request $request, Response $response, $args) {
	    $array = [];
	    $array ["nom"] = $args ['name'];
	    $response->getBody()->write(json_encode ($array));
	    return $response;
	}

	function  getSearchCalatogue (Request $request, Response $response, $args) {
		
		global $entityManager;
	    $filtre = $args['filtre'];	

		$productRepository = $entityManager->getRepository('Product');
		$products = $productRepository->findAll();

		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $filtre["price"])) { 
			$err = true; 
		}  

		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $filtre["category"])) { 
			$err = true; 
		}  

		if (!$err) {
			if($filtre){
				$products = $productRepository->findBy(array('price' => $filtre["price"]));
				$products += $productRepository->findBy(array('category' =>$filtre["category"]));
				$response->getBody()->write(json_encode(array_values($products)));
			} else {
				$response->getBody()->write(json_encode($products));
			}
		}
		else{
			$response = $response->withStatus(500);
		}
		return addHeaders($response);
	}

	// API Nécessitant un Jwt valide
	function getCatalogue (Request $request, Response $response, $args) {

		global $entityManager;
		$productsRepository = $entityManager->getRepository('Product');
		$products = $productsRepository->findAll();

		$flux = $products;

	    $response->getBody()->write(json_encode($flux));
	    
	    return addHeaders ($response);
	}

	function optionsUtilisateur (Request $request, Response $response, $args) {
	    
	    // Evite que le front demande une confirmation à chaque modification
	    $response = $response->withHeader("Access-Control-Max-Age", 600);
	    
	    return addHeaders ($response);
	}

	function createUser(Request $request, Response $response, $args){

		global $entityManager;

		$payload = $request->getParsedBody();
		$err = false;

		$nom = $body['nom'] ?? "";
		$prenom = $body['prenom'] ?? "";
		$adresse = $body['adresse'] ?? "";
		$codepostal = $body['codepostal'] ?? "";
		$ville = $body['ville'] ?? "";
		$email = $body['email'] ?? "";
		$sexe = $body['sexe'] ?? "";
		$login = $body['login'] ?? "";
		$password = $body['password'] ?? "";
		$telephone = $body['telephone'] ?? "";

		$prenom = $payload['prenom'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $prenom)) { 
			$err = true; 
		}  

		$nom = $payload['nom'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $nom)) { 
			$err = true; 
		}  

		$adresse = $payload['adresse'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $adresse)) { 
			$err = true; 
		}  

		$codepostal = $payload['codepostal'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $codepostal)) { 
			$err = true; 
		}  

		$ville = $payload['ville'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $ville)) { 
			$err = true; 
		}  

		$email = $payload['email'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $email)) { 
			$err = true; 
		}  

		$sexe = $payload['sexe'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $sexe)) { 
			$err = true; 
		}  

		$telephone = $payload['telephone'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $telephone)) { 
			$err = true; 
		}  

		$login = $payload['login'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $login)) { 
			$err = true; 
		}  

		$password = $payload['password'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $password)) { 
			$err = true; 
		}  

		if (!$err) {

			error_log(print_r($entityManager, true));
			$utilisateur = new Utilisateurs;
			$utilisateur->setPrenom($prenom);
			$utilisateur->setNom($nom);
			$utilisateur->setAdresse($adresse);
			$utilisateur->setCodepostal($codepostal);
			$utilisateur->setVille($ville);
			$utilisateur->setEmail($email);
			$utilisateur->setSexe($sexe);
			$utilisateur->setLogin($login);
			$utilisateur->setPassword($password);
			$utilisateur->setTelephone($telephone);

			$entityManager->persist($utilisateur);
			$entityManager->flush();
		}
		else{
			return $response->withStatus(401); 
		}
		return addHeaders($response);
	}

	// API Nécessitant un Jwt valide
	function getUtilisateur (Request $request, Response $response, $args) {
	    
	    $payload = getJWTToken($request);
	    $login  = $payload->userid;
		
		$utilisateursRepository = $entityManager->getRepository('Utilisateurs');

		$utilisateur = $utilisateursRepository->findBy(array('login' => $login));
		
		$flux = $utilisateur;
	    
	    $response->getBody()->write(json_encode($flux));
	    
	    return addHeaders ($response);
	}

	// APi d'authentification générant un JWT
	function postLogin (Request $request, Response $response, $args) {  

		global $entityManager;

		$payload = $request->getParsedBody();
		
		$login = $payload['login'];
		$password = $payload['password'];

		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $login)) { 
			$err = true; 
		}  

		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $password)) { 
			$err = true; 
		}  

		$utilisateursRepository = $entityManager->getRepository('Utilisateurs');

		$utilisateur = $utilisateursRepository->findBy(array('login' => $login, 'password' =>$password));
	
		if ($utilisateur!=null || $err) {

			$flux = $utilisateur;
			
			$response = createJwT ($response);
			$response->getBody()->write(json_encode($flux ));
			
			return addHeaders ($response);
		}
		else {
			$response->getBody()->write('{"error":"Invalid credentials"}');
			return $response->withStatus(401); 
		}
	}

