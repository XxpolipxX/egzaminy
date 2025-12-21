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
        <form action="./zamow.php" method="post">
            <label for="model">Model:
                <select name="model" id="model" class="kontrolki">
                    <?php
                        $zapytanie = 'SELECT `model` FROM `produkt`;';
                        $wynik = mysqli_query($polaczenie, $zapytanie);
                        while($row = mysqli_fetch_assoc($wynik)) {
                            echo '<option value="' . $row['model'] . '">' . $row['model'] . '</option>';
                        }
                    ?>
                </select>
            </label>
            <label for="rozmiar">
                Rozmiar:
                <select name="rozmiar" id="rozmiar" class="kontrolki">
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                </select>
            </label>
            <label for="liczba-par">
                Liczba par:
                <input type="number" name="liczba-par" id="liczba-par" class="kontrolki">
            </label>
            <input type="submit" value="Zamów" class="kontrolki">
        </form>
        <?php
            $zapytanie = 'SELECT `buty`.`model`, `buty`.`nazwa`, `buty`.`cena`, `produkt`.`nazwa_pliku` FROM `buty` JOIN `produkt` ON `buty`.`model` = `produkt`.`model`;';
            $wynik = mysqli_query($polaczenie, $zapytanie);
            while($row = mysqli_fetch_assoc($wynik)) {
                echo '<div class="buty">';
                echo '<img src="' . $row['nazwa_pliku'] . '" alt="but męski">';
                echo '<h2>' . $row['nazwa'] . '</h2>';
                echo '<h5>Model: ' . $row['model'] . '</h5>';
                echo '<h4>Cena: ' . $row['cena'] . '</h4>';
                echo '</div>';
            }
        ?>
    </main>

    <footer>
        <p>Autor strony: XXXXXXXX</p>
    </footer>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>