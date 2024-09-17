<?php

require_once '../app/config/config.php';
require_once '../app/classes/Reservation.php';

$apartment_id = $_POST['id'];
$from = $_POST['start_date'];
$to = $_POST['end_date'];
$adults = $_POST['adults'];
$kids = $_POST['kids'];

$reservation = new Reservation();
$reservations = $reservation->get_all_by_apartment($apartment_id);

$flag = true;
foreach ($reservations as $rez) {
    $dateFrom = $rez['start_date'];
    $dateTo = $rez['end_date'];

    if ($from <= $dateTo && $to >= $dateFrom) {
        $flag = false;
        break;
    }
}

if($flag) {
    $reservation->create($apartment_id, $_SESSION['user_id'], $from, $to, $adults, $kids);
    $_SESSION['message']['text'] = 'You reserved the apartment from ' . $from . ' to ' . $to . '.';
    $_SESSION['message']['type'] = "success";
    header('location: reservations.php');
} else {
    $_SESSION['message']['text'] = 'The apartment is already reserved in that interval! Try again.';
    $_SESSION['message']['type'] = "danger";
    header('location: ../apartment.php?id='.$apartment_id);
}

exit();
