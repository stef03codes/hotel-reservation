<?php

require_once '../app/config/config.php';
require_once '../app/classes/Reservation.php';

$reservation = new Reservation();
$reservation->cancel($_GET['reservation_id']);

$_SESSION['message']['text'] = 'Successfully cancelled reservation';
$_SESSION['message']['type'] = "warning";

header('Location: ../reservations.php');
exit();