<?php
session_start();

$zalogowano = $_SESSION['zalogowano'] ?? false;

$email = "login";
$haslo = "123";

function zaloguj($login, $password) {
    global $email, $haslo;

    if ($login === $email && $password === $haslo) {
        $_SESSION['zalogowano'] = true;
        session_regenerate_id(true);
    }
}

function wyloguj() {
    $_SESSION = array();
    session_destroy();
}

function wymagaj_logowania() {
    global $zalogowano;

    if (!$zalogowano) {
        header("Location: login.php");
        exit;
    }
}

if (isset($_POST['submit'])) {
    $login = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    zaloguj($login, $password);
}

wymagaj_logowania();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styl1.css">
    <title>PHP Aplikacja</title>
</head>
<body>
    <h1>PHP Aplikacja</h1>
    <div class="divuno">
    <h1>Witaj na stronie zalogowanego użytkownika!</h1>
    <p>Tutaj znajduje się zawartość dostępna tylko dla zalogowanych użytkowników.</p>
        <h2>Przykład: Zmienne</h2>
        <?php
    $dane_osobowe = array(
            "osoba1" => array("Imię" => "Filip", "Nazwisko" => "Serwatka", "Wiek" => 17),
            "osoba2" => array("Imię" => "Jan", "Nazwisko" => "Żaba", "Wiek" => 19),
            "osoba3" => array("Imię" => "Milosz", "Nazwisko" => "Wąs", "Wiek" => 28),
        );

        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr>";
        foreach ($dane_osobowe["osoba1"] as $fs => $ilosc) {
            echo "<th style='background-color: #000000; padding: 8px;'>$fs</th>";
        }
        echo "</tr>";
        foreach ($dane_osobowe as $osoba) {
            echo "<tr>";
            foreach ($osoba as $dane) {
                echo "<td style='padding: 8px;'>$dane</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>


        <h2>Przykład: Funkcje</h2>
    
        <form action="" method="post">
            <label for="dataur"><h4>Podaj datę urodzenia, a program obliczy ile masz lat:</h4></label>
            <input type="date" id="dataur" name="dataur" required><br>
            <br>
            <input type="submit" value="Oblicz wiek">
        </form>
        <?php
        function liczWiek($dataur) {
            $data = new DateTime($dataur);
            $dzisdata = new DateTime();
            $wiek = $dzisdata->diff($data);
            $wiekogol = $wiek->y;
            return $wiekogol;
        }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $dataur = $_POST["dataur"];
                $wiekogol = liczWiek($dataur);
                echo "Wiek wynosi $wiekogol lat.";
             
            }
        
?>    

        <h2>Przykład: Pętle</h2>
        <label><h4>Pętla generuję losowe liczby od 0 do 0.9</h4></label>
        <?php
        while (true) {
            $liczba = mt_rand() / mt_getrandmax();  
            if ($liczba > 0.9) {
                break; 
            }
        }
        $liczba = number_format($liczba, 10, '.', '');
        echo "$liczba <br>";
?>


        <h2>Przykład: Obsługa Formularzy</h2>
    <form action="submit.php" method="post" onsubmit="return walidacja()">
        <label for="name">Imię:</label>
        <input type="text" id="imie" name="name">
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <br>
        <input type="submit" value="Wyślij">
    </form>

        <h2>Przykład: PlikCookie</h2>
        <?php
            if (!isset($_COOKIE["powiedzile"])) {
                setcookie("powiedzile", 1, time() + (3600), "/");
                $powiedzile = 1;
            } else {
                $powiedzile = $_COOKIE["powiedzile"] + 1;
                setcookie("powiedzile", $powiedzile, time() + (3600), "/");
            }
?>
        <p>Ile razy wszedłeś na stronę: <?php echo $powiedzile; ?></p>
        <form method="post" action="logout.php">
        <button type="submit" name="submit">Wyloguj się</button>
        </form>
    </div>
    <script>
        function walidacja() {
            var imie = document.getElementById('imie').value;
            var email = document.getElementById('email').value;
            if (imie.trim().length < 2) {
                alert('Imię musi zawierać co najmniej dwa znaki.');
                return false;
            }
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Proszę podać poprawny adres e-mail.');
                return false;
            }

            if (imie.trim() === '' || email.trim() === '') {
                alert('Proszę wypełnić wszystkie pola.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
