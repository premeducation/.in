<?php
if(isset($_FILES['photo'])){
    move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $_FILES['photo']['name']);

    sendNotification();
}

function sendNotification() {
    $content = array(
        "en" => "New photo uploaded! Check now 🔥"
    );

    $fields = array(
        'app_id' => "1fd60d36-ba54-4dc0-896e-b7a27e4081de",
        'included_segments' => array('All'),
        'contents' => $content
    );

    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic os_v2_app_d7la2nv2krg4bclow6rh4qeb32qahq3d3p3ugbmaj2iynytqmcen7qmr6ru4foo4memxdeecqt5bwhok3xpfu6gqv6d63o6n6mxa4la'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_exec($ch);
    curl_close($ch);
}
?>