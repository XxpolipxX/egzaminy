<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'wedkarstwo');

    $lowisko = $_POST['lowisko'];
    $data = $_POST['data'];
    $sedzia = $_POST['sedzia'];

    $zapytanie = 'INSERT INTO `zawody_wedkarskie`(`id`, `Karty_wedkarskie_id`, `Lowisko_id`, `data_zawodow`, `sedzia`) VALUES (NULL, 0, ' . $lowisko . ', "' . $data . '", "' . $sedzia . '");';
    mysqli_query($polaczenie, $zapytanie);

    mysqli_close($polaczenie);
?>