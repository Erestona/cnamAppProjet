<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
include ./bootstrap.php;

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
		
	    $filtre = $args['filtre'];	

		$productRepository = $entityManager->getRepository('product');
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
				$response->getBody()->write($products);
			}
		}
		else{
			$response = $response->withStatus(500);
		}
		return addHeaders($response);
	}

	// API Nécessitant un Jwt valide
	function getCatalogue (Request $request, Response $response, $args) {

		$productsRepository = $entityManager->getRepository('product');
		$products = $productsRepository->findAll();

		$flux = $products;

	    $response->getBody()->write($flux);
	    
	    return addHeaders ($response);
	}

	function optionsUtilisateur (Request $request, Response $response, $args) {
	    
	    // Evite que le front demande une confirmation à chaque modification
	    $response = $response->withHeader("Access-Control-Max-Age", 600);
	    
	    return addHeaders ($response);
	}

	function createUser(Request $request, Response $response, $args){

		
		$payload = $request->getParsedBody();
		
		$firstname = $payload['firstname'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $firstname)) { 
			$err = true; 
		}  

		$lastname = $payload['lastname'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $lastname)) { 
			$err = true; 
		}  

		$adress = $payload['adress'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $adress)) { 
			$err = true; 
		}  

		$postalcode = $payload['postalcode'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $postalcode)) { 
			$err = true; 
		}  

		$city = $payload['city'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $city)) { 
			$err = true; 
		}  

		$email = $payload['email'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $email)) { 
			$err = true; 
		}  

		$sex = $payload['sex'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $sex)) { 
			$err = true; 
		}  

		$phonenumber = $payload['phonenumber'];
		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $phonenumber)) { 
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
			$utilisateur->setPrenom($firstname);
			$utilisateur->setNom($lastname);
			$utilisateur->setAdresse($adress);
			$utilisateur->setCodepostal($postalcode);
			$utilisateur->setVille($city);
			$utilisateur->setEmail($email);
			$utilisateur->setSexe($sex);
			$utilisateur->setLogin($login);
			$utilisateur->setPassword($password);
			$utilisateur->setTelephone($phonenumber);

			$entityManager->persist($utilisateur);
			$entityManager->flush();

		}
		else{
			return $response->withStatus(401); 
		}
	}

	// API Nécessitant un Jwt valide
	function getUtilisateur (Request $request, Response $response, $args) {
	    
	    $payload = getJWTToken($request);
	    $login  = $payload->userid;
		
		$utilisateursRepository = $entityManager->getRepository('product');

		$utilisateur = $utilisateursRepository->findBy(array('login' => $login));
		
		$flux = $utilisateur;
	    
	    $response->getBody()->write($flux);
	    
	    return addHeaders ($response);
	}

	// APi d'authentification générant un JWT
	function postLogin (Request $request, Response $response, $args) {  

		$payload = $request->getParsedBody();

		$login = $payload['login'];
		$password = $payload['password'];

		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $login)) { 
			$err = true; 
		}  

		if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ '-âêîôûäëïöüàæçéèœùÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{1,50}$/u", $password)) { 
			$err = true; 
		}  

		$utilisateursRepository = $entityManager->getRepository('product');

		$utilisateur = $utilisateursRepository->findBy(array('login' => $login, 'password' =>$password));
	
		if ($utilisateur!=null || $err) {

			$flux = $utilisateur;
			
			$response = createJwT ($response);
			$response->getBody()->write($flux );
			
			return addHeaders ($response);
		}
		else {
			$response->getBody()->write('{"error":"Invalid credentials"}');
			return $response->withStatus(401); 
		}
	}

