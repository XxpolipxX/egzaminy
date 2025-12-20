<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'kupauto');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Komis aut</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1><em>KupAuto!</em> Internetowy Komis Samochodowy</h1>
    </header>

    <main class="pierwszy">
        <?php
            $zapytanie = 'SELECT `model`, `rocznik`, `przebieg`, `paliwo`, `cena`, `zdjecie` FROM `samochody` WHERE `id` = 10;';
            $wynik = mysqli_fetch_assoc(mysqli_query($polaczenie, $zapytanie));
            echo '<img src="' . $wynik['zdjecie'] . '" alt="oferta dnia">';
            echo '<h4>Oferta Dnia: Toyota ' . $wynik['model'] . '</h4>';
            echo '<p>Rocznik: ' . $wynik['rocznik'] . ', przebieg: ' . $wynik['przebieg'] . ', rodzaj paliwa: ' . $wynik['paliwo'] . '</p>';
            echo '<h4>Cena: ' . $wynik['cena'] . '</h4>';
        ?>
    </main>

    <main>
        <h2>Oferty Wyróżnione</h2>
        <?php
            $zapytanie = 'SELECT `marki`.`nazwa`, `samochody`.`model`, `samochody`.`rocznik`, `samochody`.`cena`, `samochody`.`zdjecie` FROM `marki` JOIN `samochody` ON `marki`.`id` = `samochody`.`marki_id` WHERE `samochody`.`wyrozniony` = 1 LIMIT 4;';
            $wynik = mysqli_query($polaczenie, $zapytanie);
            while($row = mysqli_fetch_assoc($wynik)) {
                echo '<div style="display: inline-block;">';
                echo '<img src="' . $row['zdjecie'] . '" alt="' . $row['model'] . '">';
                echo '<p>Rocznik: ' . $row['rocznik'] . '</p>';
                echo '<h4>Cena: ' . $row['cena'] . '</h4>';
                echo '</div>';
            }
        ?>
    </main>

    <main>
        <h2>Wybierz markę</h2>
        <form method="post">
            <select name="marka" id="marka">
                <?php
                    $zapytanie = 'SELECT `nazwa` FROM `marki`;';
                    $wynik = mysqli_query($polaczenie, $zapytanie);
                    while($row = mysqli_fetch_assoc($wynik)) {
                        echo '<option>' . $row['nazwa'] . '</option>';
                    }
                ?>
                <input type="submit" value="Wyszukaj">
            </select>
        </form>
        <?php
            if(array_key_exists('marka', $_POST) && $_POST['marka'] != '') {
                $marka = $_POST['marka'];
                $zapytanie = 'SELECT `samochody`.`model`, `samochody`.`cena`, `samochody`.`zdjecie` FROM `samochody`, `marki` WHERE `samochody`.`marki_id` = `marki`.`id` AND `marki`.`nazwa` = "' . $marka . '";';
                $wynik = mysqli_query($polaczenie, $zapytanie);
                while($row = mysqli_fetch_assoc($wynik)) {
                    echo '<div style="display: inline-block;">';
                    echo '<img src="' . $row['zdjecie'] . '" alt="' . $row['model'] . '">';
                    echo '<h4>' . $marka . ' ' . $row['model'] . '</h4>';
                    echo '<h4>Cena: ' . $row['cena'] . '</h4>';
                    echo '</div>';
                }
            }
        ?>
    </main>

    <footer>
        <p>Stronę wykonał: XXXXXXXXXXX</p>
        <p><a href="http://firmy.pl/komis">Znajdź nas także</a></p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>