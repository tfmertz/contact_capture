<?php
// Simply emails the contents of your unsubmitted form the recipients
// entered in on the contact_capture_recipients.php file

// Make sure we posted here
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'This page is forbidden';
    header("Location: /");
    die();
}
else {
    //grab the info from the request
    $request_data = file_get_contents('php://input');
    $form_array = json_decode($request_data, true);

    $message = "";
    foreach($form_array as $input) {
        $message .= $input['name'] . "\n";
        $message .= $input['value'] . "\n";
        $message .= "\n";
    }
    file_put_contents('test1.txt', $message);




    // Sends a string back saying success
    // (not needed they aren't on that page anymore)
    // echo 'Successful request!';
}
