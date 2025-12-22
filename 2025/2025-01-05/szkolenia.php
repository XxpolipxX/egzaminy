<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'firma');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Firma szkoleniowa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="kontener">
        <header>
            <img src="./baner.jpg" alt="Szkolenia">
        </header>
    
        <nav>
            <ul>
                <li><a href="./index.html">Strona główna</a></li>
                <li><a href="./szkolenia.php">Szkolenia</a></li>
            </ul>
        </nav>
    
        <main>
            <?php
                $zapytanie = 'SELECT `Data`, `Temat` FROM `szkolenia` ORDER BY `Data` ASC;';
                $wynik = mysqli_query($polaczenie, $zapytanie);
                $plik = fopen('harmonogram.txt', 'a');
                while($row = mysqli_fetch_assoc($wynik)) {
                    echo '<p>' . $row['Data'] . ' ' . $row['Temat'] . '</p>';
                    fwrite($plik, $row['Data'] . ' ' . $row['Temat'] . PHP_EOL);
                }
                fclose($plik);
            ?>
        </main>
    
        <footer>
            <h2>Firma szkoleniowa, ul. Główna 1, 23-456 Warszawa</h2>
            <p>Autor: XXXXXXXXXX</p>
        </footer>
    </section>
</body>
</html>

<?php
    mysqli_close($polaczenie);
?>