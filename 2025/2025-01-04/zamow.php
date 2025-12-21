<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'obuwie');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Obuwie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Obuwie męskie</h1>
    </header>

    <main>
        <h2>Zamówienie</h2>
        <?php
            if(
                array_key_exists('model', $_POST) && $_POST['model'] != '' &&
                array_key_exists('rozmiar', $_POST) && $_POST['rozmiar'] != '' &&
                array_key_exists('liczba-par', $_POST) && $_POST['liczba-par'] != ''
            ) {
                $model = $_POST['model'];
                $rozmiar = $_POST['rozmiar'];
                $liczbaPar = $_POST['liczba-par'];
                $zapytanie = 'SELECT `buty`.`nazwa`, `buty`.`cena`, `produkt`.`kolor`, `produkt`.`kod_produktu`, `produkt`.`material`, `produkt`.`nazwa_pliku` FROM `buty` JOIN `produkt` ON `buty`.`model` = `produkt`.`model` WHERE `produkt`.`model` = "' . $model . '";';
                $wynik = mysqli_query($polaczenie, $zapytanie);
                while($row = mysqli_fetch_assoc($wynik)) {
                    echo '<img src="' . $row['nazwa_pliku'] . '" alt="but męski">';
                    echo '<h2>' . $row['nazwa'] . '</h2>';
                    echo '<p>cena za ' . $liczbaPar . ' par: ' . ($liczbaPar * $row['cena']) . ' zł</p>';
                    echo '<p>Szczegóły produktu: ' . $row['kolor'] . ', ' . $row['material'] . '</p>';
                    echo '<p>Rozmiar: ' . $rozmiar . '</p>';
                }
            }
        ?>
        <a href="./index.php">Strona główna</a>
    </main>

    <footer>
        <p>Autor strony: XXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>