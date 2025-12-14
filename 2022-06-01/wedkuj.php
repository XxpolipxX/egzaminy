<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'wedkowanie');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wędkowanie</title>
    <link rel="stylesheet" href="styl_1.css">
</head>
<body>
    <header>
        <h1>Portal dla wędkarzy</h1>
    </header>

    <aside class="lewy">
        <section class="pierwszy">
            <h3>Ryby zamieszkujące rzeki</h3>
            <ol>
                <?php
                    $zapytanie = 'SELECT `ryby`.`nazwa`, `lowisko`.`akwen`, `lowisko`.`wojewodztwo` FROM `ryby` JOIN `lowisko` ON `ryby`.`id` = `lowisko`.`Ryby_id` WHERE `lowisko`.`rodzaj` = 3;';
                    $wynik = mysqli_query($polaczenie, $zapytanie);

                    while($row = mysqli_fetch_array($wynik)) {
                        echo '<li>' . $row['nazwa'] . ' pływa w rzecze ' . $row['akwen'] . ', ' . $row['wojewodztwo'] . '</li>';
                    }
                ?>
            </ol>
        </section>

        <section class="drugi">
            <h3>Ryby drapieżne naszych wód</h3>
            <table>
                <tr>
                    <th>L.p.</th>
                    <th>Gatunek</th>
                    <th>Występowanie</th>
                </tr>
                <?php
                    $zapytanie = 'SELECT `id`, `nazwa`, `wystepowanie` FROM `ryby` WHERE `styl_zycia` = 1;';
                    $wynik = mysqli_query($polaczenie, $zapytanie);

                    while($row = mysqli_fetch_array($wynik)) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['nazwa'] . '</td>';
                        echo '<td>' . $row['wystepowanie'] . '</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </section>
    </aside>
    <aside class="prawy">
        <img src="./ryba1.jpg" alt="Sum"><br>
        <a href="./kwerendy.txt">Pobierz kwerendy</a>
    </aside>

    <footer>
        <p>Stronę wykonał: XXXXXXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>