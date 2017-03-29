<?php
session_start();
header('Content-Type: application/json');
require_once '../../vendor/autoload.php';

    // user already logged in
    if(isset($_SESSION['user'])) {
        http_response_code(400);
        echo json_encode($_SESSION['user']);
        die;
    }


    $provider = $_REQUEST['provider'];

    if($provider == "google") {

        $client = new Google_Client();
        $client->setClientId("990108584498-dirhm8ho9rd8h2213v8gtc5g234m7dp9.apps.googleusercontent.com");
        $payload = $client->verifyIdToken($_REQUEST['id_token']);

        if ($payload) {
            $gUserData = $payload->getAttributes()['payload'];

            $user = array(
                "name" => $gUserData['name'],
                "email" => $gUserData['email']
            );

            $_SESSION['user'] = $user;
            echo json_encode($user);
            die;

        } else {
            die;
        }

        die;

    } else {
        http_response_code(400);
        echo "unrecognized login provider: " . $provider;
        die;
    }

?>