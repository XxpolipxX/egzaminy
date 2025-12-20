<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'hodowla');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Hodowla świnek morskich</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Hodowla świnek morskich - zamów świnkowe maluszki</h1>
    </header>

    <nav>
        <a href="./peruwianka.php">Rasa Peruwianka</a>
        <a href="./american.php">Rasa American</a>
        <a href="./crested.php">Rasa Crested</a>
    </nav>

    <main>
        <img src="./american.jpg" alt="Świnka morska rasy american">
        <?php
            $zapytanie = 'SELECT DISTINCT `swinki`.`data_ur`, `swinki`.`miot`, `rasy`.`rasa` FROM `swinki` JOIN `rasy` ON `swinki`.`rasy_id` = `rasy`.`id` WHERE `rasy`.`id` = 6;';
            $wynik = mysqli_query($polaczenie, $zapytanie);
            while($row = mysqli_fetch_assoc($wynik)) {
                echo '<h2>Rasa: ' . $row['rasa'] . '</h2>';
                echo '<p>Data urodzenia: ' . $row['data_ur'] . '</p>';
                echo '<p>Oznaczenie miotu: ' . $row['miot'] . '</p>';
            }
        ?>
        <hr>
        <h2>Świnki w tym miocie</h2>
        <?php
            $zapytanie = 'SELECT `imie`, `cena`, `opis` FROM `swinki` WHERE `rasy_id` = 6;';
            $wynik = mysqli_query($polaczenie, $zapytanie);
            while($row = mysqli_fetch_assoc($wynik)) {
                echo '<h3>' . $row['imie'] . ' - ' . $row['cena'] . ' zł</h3>';
                echo '<p>' . $row['opis'] . '</p>';
            }
        ?>
    </main>

    <aside>
        <h3>Poznaj wszystkie rasy świnek morskich</h3>
        <ol>
            <?php
                $zapytanie = 'SELECT `rasa` FROM `rasy`;';
                $wynik = mysqli_query($polaczenie, $zapytanie);
                while($row = mysqli_fetch_assoc($wynik)) {
                    echo '<li>' . $row['rasa'] . '</li>';
                }
            ?>
        </ol>
    </aside>

    <footer>
        <p>Stronę wykonał: XXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>