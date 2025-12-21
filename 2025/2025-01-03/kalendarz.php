<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'kalendarz');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kalendarz</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Dni, miesiące, lata...</h1>
    </header>

    <section class="napis">
        <?php
            $data = date('d-m-Y');
            $dzisiaj = date("m-d");
            $dzien = date("D");
            switch($dzien) {
                case 'Mon':
                    $dzien = 'poniedziałek';
                    break;
                case 'Tue':
                    $dzien = 'wtorek';
                    break;
                case 'Wed':
                    $dzien = 'środa';
                    break;
                case 'Thu':
                    $dzien = 'czwartek';
                    break;
                case 'Fri':
                    $dzien = 'piątek';
                    break;
                case 'Sat':
                    $dzien = 'sobota';
                    break;
                case 'Sun':
                    $dzien = 'niedziela';
                    break;
            }
            $zapytanie = 'SELECT `imiona` FROM `imieniny` WHERE `data` = "' . $dzisiaj . '";';
            $wynik = mysqli_fetch_assoc(mysqli_query($polaczenie, $zapytanie));
            echo '<p>Dzisiaj jest ' . $dzien . ', ' . $data . ', imieniny: ' . $wynik['imiona'] . '</p>';
        ?>
    </section>

    <aside class="lewy">
        <table>
            <tr>
                <th>liczba dni</th>
                <th>miesiąc</th>
            </tr>
            <tr>
                <td rowspan="7">31</td>
                <td>styczeń</td>
            </tr>
            <tr>
                <td>marzec</td>
            </tr>
            <tr>
                <td>maj</td>
            </tr>
            <tr>
                <td>lipiec</td>
            </tr>
            <tr>
                <td>sierpień</td>
            </tr>
            <tr>
                <td>październik</td>
            </tr>
            <tr>
                <td>grudzień</td>
            </tr>
            <tr>
                <td rowspan="4">30</td>
                <td>kwiecień</td>
            </tr>
            <tr>
                <td>czerwiec</td>
            </tr>
            <tr>
                <td>wrzesień</td>
            </tr>
            <tr>
                <td>listopad</td>
            </tr>
            <tr>
                <td>28 lub 29</td>
                <td>luty</td>
            </tr>
        </table>
    </aside>

    <section class="srodek">
        <h2>Sprawdź kto ma urodziny</h2>
        <form method="post">
            <input type="date" name="data" id="data" value="2024-01-01" min="2024-01-01" max="2024-12-31" required>
            <input type="submit" value="wyślij">
        </form>
        <?php
            if(array_key_exists('data', $_POST) && $_POST['data'] != '') {
                $data = $_POST['data'];
                $formatedDate = date('m-d', strtotime($data));
                $zapytanie = 'SELECT `imiona` FROM `imieniny` WHERE `data` = "' . $formatedDate . '";';
                $wynik = mysqli_fetch_assoc(mysqli_query($polaczenie, $zapytanie));
                echo 'Dnia ' . $data . ' są imieniny: ' . $wynik['imiona'];
            }
        ?>
    </section>

    <aside class="prawy">
        <a href="https://pl.wikipedia.org/wiki/Kalendarz_Majów" target="_blank"><img src="./kalendarz.gif" alt="Kalendarz Majów"></a>
        <h2>Rodzaje kalendarzy</h2>
        <ol>
            <li>
                słoneczny
                <ul>
                    <li>kalendarz Majów</li>
                    <li>juliański</li>
                    <li>gregoriański</li>
                </ul>
            </li>
            <li>
                księżycowy
                <ul>
                    <li>starogrecki</li>
                    <li>babiloński</li>
                </ul>
            </li>
        </ol>
    </aside>

    <footer>
        <p>Stronę opracował: XXXXXXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>