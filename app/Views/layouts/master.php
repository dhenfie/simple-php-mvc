<?php use App\Support\Models\Auth; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= renderSection('pageTitle') ?? 'PHPMVC'; ?></title>
    <link rel="stylesheet" href="/style.css" />
</head>

<body>
    <nav class="nav">
        <span class="nav-brand"> PHP MVC</span>
        <ul>
            <li> <a href="/"> Home </a> </li>
            <li>
                <?php if (! Auth::check()) : ?> <a href="/auth/login" target="_blank"> Login </a></li>

                <?php endif; ?>
            </li>
            <li> <?php if (Auth::check()) : ?> <a href="/auth/logout" target="_blank"> Logout </a> <?php endif; ?>
            </li>
        </ul>
    </nav>

    <main class="main">
        <div class="container">
            <?= renderSection('content') ?>
        </div>
    </main>
</body>

</html>
