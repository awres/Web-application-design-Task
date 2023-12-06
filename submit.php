<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styl2fs.css">
    <title>Formularz PHP</title>
</head>
<body>

<div class="divek">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        echo "<h3>Otrzymano dane: <br> Imie: {$name} <br> Email: {$email}</h3>";
    }
    ?>
    <a href="./index.php"><input type="submit" value="Powrót"></a>
</div>

</body>
</html>
