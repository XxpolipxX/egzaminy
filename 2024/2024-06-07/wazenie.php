<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'wazenietirow');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ważenie samochodów ciężarowych</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="pierwszy">
        <h1>Ważenie pojazdów we Wrocławiu</h1>
    </header>

    <header class="drugi">
        <img src="./obraz1.png" alt="waga">
    </header>

    <aside class="lewy">
        <h2>Lokalizacje wag</h2>
        <ol>
            <?php
                $zapytanie = 'SELECT `ulica` FROM `lokalizacje`;';
                $wynik = mysqli_query($polaczenie, $zapytanie);
                while($row = mysqli_fetch_assoc($wynik)) {
                    echo '<li>ulica ' . $row['ulica'] . '</li>';
                }
            ?>
        </ol>
        <h2>Kontakt</h2>
        <a href="mailto:wazenie@wroclaw.pl">napisz</a>
    </aside>

    <section>
        <h2>Alerty</h2>
        <table>
            <tr>
                <th>rejestracja</th>
                <th>ulica</th>
                <th>waga</th>
                <th>dzień</th>
                <th>czas</th>
            </tr>
            <?php
                $zapytanie = 'SELECT `wagi`.`rejestracja`, `wagi`.`waga`, `wagi`.`dzien`, `wagi`.`czas`, `lokalizacje`.`ulica` FROM `wagi` JOIN `lokalizacje` ON `wagi`.`lokalizacje_id` = `lokalizacje`.`id` WHERE `wagi`.`waga` > 5;';
                $wynik = mysqli_query($polaczenie, $zapytanie);
                while($row = mysqli_fetch_assoc($wynik)) {
                    echo '<tr>';
                    echo '<td>' . $row['rejestracja'] . '</td>';
                    echo '<td>' . $row['ulica'] . '</td>';
                    echo '<td>' . $row['waga'] . '</td>';
                    echo '<td>' . $row['dzien'] . '<td>';
                    echo '<td>' . $row['czas'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
        <?php
            $zapytanie = 'INSERT INTO `wagi`(`id`, `lokalizacje_id`, `waga`, `rejestracja`, `dzien`, `czas`) VALUES (NULL, 5, FLOOR(RAND() * 10) + 1, "DW12345", CURRENT_DATE, CURRENT_TIME);';
            mysqli_query($polaczenie, $zapytanie);
            header('Refresh: 10');
        ?>
    </section>

    <aside class="prawy">
        <img src="./obraz2.jpg" alt="tir">
    </aside>

    <footer>
        <p>Stronę wykonał: XXXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>