<?php

require_once 'app/config/config.php';
require_once 'app/classes/Reservation.php';
require_once 'app/classes/Apartment.php';

$apartment_id = $_POST['id'];
$from = $_POST['start_date'];
$to = $_POST['end_date'];
$adults = $_POST['adults'];
$kids = $_POST['kids'];

$reservation = new Reservation();
$reservations = $reservation->get_all();

$flag = true;
foreach ($reservations as $rez) {
    if($from > $rez['start_date'] && $to < $rez['end_date']) {
        $flag = false;
        break;
    }
}

$apartment = new Apartment();

if(!$apartment->isReserved($apartment_id)) {
    $reservation->create($apartment_id, $from, $to, $adults, $kids);
    $apartment->update($apartment_id, 1);
    $_SESSION['message']['text'] = 'You reserved the apartment from ' . $from . ' to ' . $to . '.';
    $_SESSION['message']['type'] = "success";
} else {
    $_SESSION['message']['text'] = 'The apartment is already reserved in that interval! Try again.';
    $_SESSION['message']['type'] = "danger";
}
