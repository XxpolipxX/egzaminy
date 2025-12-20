<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'rzeki');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Poziomy rzek</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <img src="./obraz1.png" alt="Mapa Polski">
    </header>

    <header>
        <h1>Rzeki w województwie dolnośląskim</h1>
    </header>

    <nav>
        <form method="post">
            <label class="pole-opcji" for="wszystkie"><input type="radio" value="wszystkie" name="radio" id="wszystkie">Wszystkie</label>
            <label class="pole-opcji" for="ostrzegawczy"><input type="radio" value="ostrzegawczy" name="radio" id="ostrzegawczy">Ponad stan ostrzegawczy</label>
            <label class="pole-opcji" for="alarmowy"><input type="radio" value="alarmowy" name="radio" id="alarmowy">Ponad stan alarmowy</label>
            <input type="submit" value="Pokaż">
        </form>
    </nav>

    <aside class="lewy">
        <h3>Stany na dzień 2022-05-05</h3>
        <table>
            <tr>
                <th>Wodomierz</th>
                <th>Rzeka</th>
                <th>Ostrzegawczy</th>
                <th>Alarmowy</th>
                <th>Aktualny</th>
            </tr>
            <?php
                if(array_key_exists('radio', $_POST) && $_POST['radio'] != '') {
                    $opcja = $_POST['radio'];
                    $zapytanie = '';
                    if($opcja == 'wszystkie') {
                        $zapytanie = 'SELECT `wodowskazy`.`nazwa`, `wodowskazy`.`rzeka`, `wodowskazy`.`stanOstrzegawczy`, `wodowskazy`.`stanAlarmowy`, `pomiary`.`stanWody` FROM `wodowskazy` JOIN `pomiary` ON `wodowskazy`.`id` = `pomiary`.`wodowskazy_id` WHERE `pomiary`.`dataPomiaru` = "2022-05-05";';
                    } elseif($opcja == 'ostrzegawczy') {
                        $zapytanie = 'SELECT `wodowskazy`.`nazwa`, `wodowskazy`.`rzeka`, `wodowskazy`.`stanOstrzegawczy`, `wodowskazy`.`stanAlarmowy`, `pomiary`.`stanWody` FROM `wodowskazy` JOIN `pomiary` ON `wodowskazy`.`id` = `pomiary`.`wodowskazy_id` WHERE `pomiary`.`dataPomiaru` = "2022-05-05" AND `pomiary`.`stanWody` > `wodowskazy`.`stanOstrzegawczy`;';
                    } elseif($opcja == 'alarmowy') {
                        $zapytanie = 'SELECT `wodowskazy`.`nazwa`, `wodowskazy`.`rzeka`, `wodowskazy`.`stanOstrzegawczy`, `wodowskazy`.`stanAlarmowy`, `pomiary`.`stanWody` FROM `wodowskazy` JOIN `pomiary` ON `wodowskazy`.`id` = `pomiary`.`wodowskazy_id` WHERE `pomiary`.`dataPomiaru` = "2022-05-05" AND `pomiary`.`stanWody` > `wodowskazy`.`stanAlarmowy`;';
                    }
                    $wynik = mysqli_query($polaczenie, $zapytanie);
                    while($row = mysqli_fetch_assoc($wynik)) {
                        echo '<tr>';
                        echo '<td>' . $row['nazwa'] . '</td>';
                        echo '<td>' . $row['rzeka'] . '</td>';
                        echo '<td>' . $row['stanOstrzegawczy'] . '</td>';
                        echo '<td>' . $row['stanAlarmowy'] . '</td>';
                        echo '<td>' . $row['stanWody'] . '</td>';
                        echo '</tr>';
                    }
                }
            ?>
        </table>
    </aside>

    <aside class="prawy">
        <h3>Informacje</h3>
        <ul>
            <li>Brak ostrzeżeń o burzach z gradem</li>
            <li>Smog w mieście Wrocław</li>
            <li>Silny wiatr w Karkonoszach</li>
        </ul>
        <h3>Średnie stany wód</h3>
        <?php
            $zapytanie = 'SELECT `dataPomiaru`, AVG(`stanWody`) FROM `pomiary` GROUP BY `dataPomiaru`;';
            $wynik = mysqli_query($polaczenie, $zapytanie);
            while($row = mysqli_fetch_assoc($wynik)) {
                echo '<p>' . $row['dataPomiaru'] . ': ' . $row['AVG(`stanWody`)'] . '</p>';
            }
        ?>
        <a href="https://komunikaty.pl">Dowiedz się więcej</a>
        <img src="./obraz2.jpg" alt="rzeka">
    </aside>

    <footer>
        <p>Stronę wykonał: XXXXXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>