<?php
session_start();

$zalogowano = $_SESSION['zalogowano'] ?? false;

if ($zalogowano) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $poprawneEmail = "login";
    $poprawneHaslo = "123";

    if ($email === $poprawneEmail && $password === $poprawneHaslo) {
        $_SESSION['zalogowano'] = true;
        session_regenerate_id(true);
        header("Location: index.php");
        exit;
    } else {
        $bladLogowania = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styl3.css">
    <title>Projekt PHP - Logowanie</title>
</head>
<body>
<form method="post" action="login.php">
    <h1>Logowanie</h1>

    <?php if (isset($bladLogowania) && $bladLogowania): ?>
        <p class="error">Błąd logowania. Spróbuj ponownie.</p>
    <?php endif; ?>

    <label for="email" placeholder="Email to hej">E-mail:</label>
    <input placeholder="Wpisz: login" type="text" id="email" name="email">

    <label for="password" title="Hasło to 123">Hasło:</label>
    <input placeholder="Wpisz: 123" type="password" id="password" name="password">

    <button type="submit" name="submit">Zaloguj się</button>
</form>

</body>
</html>
