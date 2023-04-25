<?php
use App\Support\Models\Auth;

extend('layouts/master.php')
    ?>
<?php section('content') ?>

<?php if (Auth::check()) : ?>
    <h2> Selamat Datang <?= $user->first_name ?>     <?= $user->last_name ?> !</h2>
    <p>
    <table>
        <figcaption> Berikut informasi tentang anda </figcaption>
        <tbody>
            <tr>
                <td> Email </td>
                <td> : </td>
                <td> <?= $user->email ?> </td>
            </tr>
            <tr>
                <td> Nama </td>
                <td> : </td>
                <td> <?php echo $user->first_name . ' ' . $user->last_name; ?> </td>
            </tr>

            <tr>
                <td> Umur </td>
                <td> : </td>
                <td> <?= $user->age; ?></td>
            </tr>
            <tr>
                <td> Tentang </td>
                <td>: </td>
                <td> <?= $user->about ?> </td>
            </tr>
        </tbody>
    </table>
    </p>
<?php endif; ?>
<?php endSection() ?>

