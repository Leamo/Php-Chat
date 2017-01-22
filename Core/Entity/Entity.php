<?php
namespace Core\Entity;

class Entity {

	public function __construct(array $donnees = []) {
		$this->hydrate($donnees);
	}

	public function hydrate(array $donnees)
	{
  		foreach ($donnees as $key => $value) {
		    // On récupère le nom du setter correspondant à l'attribut.
		    $method = 'set'.ucfirst($key);
        
		    // Si le setter correspondant existe.
		    if (method_exists($this, $method)) {
		      // On appelle le setter.
		      $this->$method($value);
		    }
  		}
  	}
}