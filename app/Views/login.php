<?php extend('layouts/master.php') ?>

<?php section('pageTitle') ?>
Login <?php endSection() ?>

<?php section('content') ?>

<?php if (! empty($error)) : ?>
    <div class="alert">
        <?= $error ?>
    </div>
<?php endif; ?>

<form action="/auth/login" method="POST">
    <fieldset class="auth-box">

        <legend> Login </legend>

        <div class="form-group">
            <label for="email"> E-mail</label>
            <input type="email" id="email" name="email" value="" />

        </div>

        <div class="form-group">
            <label for="password"> Password</label>
            <input type="password" id="password" name="password" value="" />

        </div>

        <div class="form-group">
            <button type="submit" name="submit"> Login </button>
        </div>
    </fieldset>
</form>
<?php endSection() ?>

