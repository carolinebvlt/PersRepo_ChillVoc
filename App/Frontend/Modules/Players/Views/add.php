
<p> Bienvenue ! <br />
Veuillez remplir ce formulaire pour créer un compte : </p>

<form action="" method="post">

 <?= isset($erreurs) && in_array(\Entities\Player::PSEUDO_INVALIDE, $erreurs) ? 'Le pseudo est invalide.<br />' : '' ?>

<label for="pseudo">Pseudo :</label>
<input type="text" name="pseudo" id="pseudo"/> <br />

<?= isset($erreurs) && in_array(\Entities\Player::PASS_INVALIDE, $erreurs) ? 'Le mdp est invalide.<br />' : '' ?>

<label for="pass">Mot de passe :</label>
<input type="password" name="pass" id="pass"/> <br />

<?= isset($erreurs) && in_array(\Entities\Player::EMAIL_INVALIDE, $erreurs) ? 'L\'email est invalide.<br />' : '' ?>

<label for="email">E-mail :</label>
<input type="text" name="email" id="email"/> <br />

<input type="submit" value="S'inscrire"/>
</form>