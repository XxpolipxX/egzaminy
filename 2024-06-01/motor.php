<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'motory');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Motocykle</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <img src="./motor.png" alt="motocykl">

    <header>
        <h1>Motocykle - moja pasja</h1>
    </header>

    <aside class="lewy">
        <h2>Gdzie pojechać?</h2>
        <dl>
            <?php
                $zapytanie = 'SELECT `wycieczki`.`nazwa`, `wycieczki`.`opis`, `wycieczki`.`poczatek`, `zdjecia`.`zrodlo` FROM `wycieczki` JOIN `zdjecia` ON `wycieczki`.`zdjecia_id` = `zdjecia`.`id`;';
                $wynik = mysqli_query($polaczenie, $zapytanie);

                while($row = mysqli_fetch_assoc($wynik)) {
                    echo '<dt>' . $row['nazwa'] . ', rozpoczyna się w ' . $row['poczatek'] . ', <a href="' . $row['zrodlo'] . '">zobacz zdjęcie</a></dt>';
                    echo '<dd>' . $row['opis'] . '</dd>';
                }
            ?>
        </dl>
    </aside>

    <aside class="prawy">
        <h2>Co kupić?</h2>
        <ol>
            <li>Honda CBR125R</li>
            <li>Yamaha YBR125</li>
            <li>Honda VFR800i</li>
            <li>Honda CBR1100XX</li>
            <li>BMW R1200GS LC</li>
        </ol>
    </aside>

    <aside class="prawy">
        <h2>Statystyki</h2>
        <p>
            Wpisanych wycieczek: 
            <?php
                $zapytanie = 'SELECT COUNT(`id`) FROM `wycieczki`;';
                $wynik = mysqli_fetch_assoc(mysqli_query($polaczenie, $zapytanie));
                echo $wynik['COUNT(`id`)'];
            ?>
        </p>
        <p>Użytkowników forum: 200</p>
        <p>Przesłanych zdjęć: 1300</p>
    </aside>

    <footer>
        <p>Stronę wykonał: XXXXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>