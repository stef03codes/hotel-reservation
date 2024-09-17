<?php
require_once 'inc/header.php';
require_once 'app/classes/Reservation.php';
require_once 'app/classes/Apartment.php';

$reservation = new Reservation();
$apartment = new Apartment();

$user_reservations = $reservation->get_all_by_user($_SESSION['user_id']);
$user_name = explode(' ', $_SESSION['name'])[0];

?>

<section>
    <div class="container">
        <?php if(isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show">
                <?php
                echo $_SESSION['message']['text'];
                unset($_SESSION['message']);
                ?>
                <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1><?= $user_name ?>'s Reservations</h1>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Apartment</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Cancellation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($user_reservations as $res) : ?>
                    <tr>
                        <td>
                            Room
                            <?php
                                $apartment_info = $apartment->read($res['apartment_id']);
                                echo $apartment_info['room_number'];
                            ?>
                        </td>
                        <td><?= $res['start_date'] ?></td>
                        <td><?= $res['end_date'] ?></td>
                        <td><?= $res['adults'] ?></td>
                        <td><?= $res['children'] ?></td>
                        <td>
                            <a href="reservation_manager/cancel_reservation.php?reservation_id=<?= $res['reservation_id'] ?>"
                               class="btn btn-danger">Cancel</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
