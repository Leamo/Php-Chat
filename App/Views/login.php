<h1>Connexion</h1>
<?php if (isset($error_login)): ?>
	<p class="error"><?= $error_login; ?>
<?php endif ?>
<form method="post">
	<input type="text" name="username" required="true">
	<input type="text" name="passwd" required="true">
	<input type="submit" name="login" value="Connexion">
</form>


<h2>S'inscrire</h2>
<?php if (isset($error_subscribe)): ?>
	<p class="error"><?= $error_subscribe; ?>
<?php endif ?>
<form method="post">
	<input type="text" name="username" required="true">
	<input type="password" name="passwd" required="true">
	<input type="password" name="passwd2" required="true">
	<input type="submit" name="subscribe" value="Connexion">
</form>