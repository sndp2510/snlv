<?php
    header('Content-Type: application/json');

    // user already logged in
    if(isset($_SESSION)) {
        http_response_code(400);
        echo json_encode($_SESSION['user']);
        die;
    }


    $provider = $_REQUEST['provider'];

    if($provider == "google") {

        $id_token = $_REQUEST['id_token'];

        $user = array(
            "name" => "abcd",
            "email" => "efgh"
        );

        echo json_encode($user);
        $_SESSION['user'] = $user;
        die;

    } else {
        http_response_code(400);
        echo "unrecognized login provider: " . $provider;
        die;
    }

?>