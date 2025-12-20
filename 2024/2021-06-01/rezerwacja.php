<?php
    $polaczenie = mysqli_connect('localhost', 'root', '', 'baza');

    $data = $_POST['data'];
    $ileOsob = $_POST['ile-osob'];
    $telefon = $_POST['telefon'];
    if(isset($_POST['zgoda'])) {
        $zgoda = $_POST['zgoda'];
    }

    $zapytanie = 'INSERT INTO `rezerwacje` (`id`, `data_rez`, `liczba_osob`, `telefon`) VALUES (NULL, "' . $data . '", ' . $ileOsob . ', "' . $telefon . '");';
    mysqli_query($polaczenie, $zapytanie);

    mysqli_close($polaczenie);
?>