<?php
namespace Entities;

use Fram\Entity;

class Player extends Entity
{
	protected 	$pseudo,
				$passh,
				$email;
	
	const PSEUDO_INVALIDE = 1;
	const PASS_INVALIDE = 2;
	const EMAIL_INVALIDE = 3;
	
	public function isNotEmpty()
	{
		return !(empty($this->pseudo) || empty($this->passh) || empty($this->email)) ;
	}
	
	// SETTERS //
	
	public function setPseudo($pseudo)
	{
		if (!is_string($pseudo) || empty($pseudo))
		{
			$this->erreurs[] = self::PSEUDO_INVALIDE;
		}
		
		$this->pseudo = $pseudo;
	}
	
	public function setPassh($passh)
	{
		if (!is_string($passh) || empty($passh))
		{
			$this->erreurs[] = self::PASS_INVALIDE;
		}
		
		$this->passh = $passh;
	}
	
	public function setEmail($email)
	{
		if (!is_string($email) || empty($email) || !preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
		{
			$this->erreurs[] = self::EMAIL_INVALIDE;
		}
		
		$this->email = $email;
	}
	
	
	// GETTERS //
	
	public function pseudo() {return $this->pseudo;}
	public function passh() {return $this->passh;}
	public function email() {return $this->email;}

	
	
}