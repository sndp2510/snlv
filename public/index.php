<?php
session_start();
if(isset($_SESSION['user'])) {
?>

<h1>Welcome <?php echo $_SESSION['user']['name']?></h1>

<?php
} else {
?>

<html>
    <head>
        <title>SNLV</title>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id"  content="990108584498-dirhm8ho9rd8h2213v8gtc5g234m7dp9.apps.googleusercontent.com">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

        <script>
            function onSignIn(googleUser) {
                var profile = googleUser.getBasicProfile();
                var id_token = googleUser.getAuthResponse().id_token;
                $.post({
                    url: "/api/v1/login.php",
                    data: {
                        provider : "google",
                        id_token : id_token
                    },
                    success: function(data, status){
                        console.log(data);
                        console.log(status);
                        location.reload();
                    },
                    error: function (jqXHR, exception) {
                        console.log(jqXHR);
                        console.log(exception);
                    }
                });
            }
        </script>

    </head>
    <body>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
    </body>
</html>

<?php
}
?>
