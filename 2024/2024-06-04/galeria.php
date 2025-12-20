<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'galeria');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Galeria</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Zdjęcia</h1>
    </header>

    <aside class="lewy">
        <h2>Tematy zdjęć</h2>
        <ol>
            <li>Zwierzęta</li>
            <li>Krajobrazy</li>
            <li>Miasta</li>
            <li>Przyroda</li>
            <li>Samochody</li>
        </ol>
    </aside>

    <section class="srodek">
        <?php
            $zapytanie = 'SELECT `zdjecia`.`plik`, `zdjecia`.`tytul`, `zdjecia`.`polubienia`, `autorzy`.`imie`, `autorzy`.`nazwisko` FROM `zdjecia` JOIN `autorzy` ON `zdjecia`.`autorzy_id` = `autorzy`.`id` ORDER BY `autorzy`.`nazwisko` ASC;';
            $wynik = mysqli_query($polaczenie, $zapytanie);
            while($row = mysqli_fetch_assoc($wynik)) {
                echo '<div>';
                echo '<img src="' . $row['plik'] . '">';
                echo '<h3>' . $row['tytul'] . '</h3>';
                if($row['polubienia'] > 40) {
                    echo '<p>Autor: ' . $row['imie'] . ' ' . $row['nazwisko'] . '.<br>Wiele osób polubiło ten obraz</p>';
                } else {
                    echo '<p>Autor: ' . $row['imie'] . ' ' . $row['nazwisko'] . '</p>';
                }
                echo '<a href="' . $row['plik'] . '" download>Pobierz</a>';
                echo '</div>';
            }
        ?>
    </section>

    <aside class="prawy">
        <h2>Najbardziej lubiane</h2>
        <?php
            $zapytanie = 'SELECT `tytul`, `plik` FROM `zdjecia` WHERE `polubienia` >= 100;';
            $wynik = mysqli_fetch_assoc(mysqli_query($polaczenie, $zapytanie));
            echo '<img src="' . $wynik['plik'] . '" alt="' . $wynik['tytul'] . '">';
        ?>
        <strong>Zobacz wszystkie nasze zdjęcia</strong>
    </aside>

    <footer>
        <h5>Stronę wykonał: XXXXXXXXXXXXX</h5>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>