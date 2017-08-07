<?php
    include_once '/header.php';
?>

<?php
    include_once '/sidemenu.php';
?>

<div id="log">
    <form action="/signin" method="get" onsubmit="onSignInSubmit()">
        <p>
            <input id="signin-username" name="username" placeholder="Nazwa użytkownika">
        </p>
        <p>
            <input id="signin-password" type="password" name="password" placeholder="Hasło">
        </p>
        <p>
            <input type="submit"value="Zarejestruj się">
        </p>
    </form>
</div>
<script src="/static/js/sjcl.js"></script>
<script src="/static/js/sidebar.js"></script>
<script src="/static/js/hashed.js"></script>
<script src="/static/js/signin.js"></script>

<?php
    include_once '/footer.php';
?>