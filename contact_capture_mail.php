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
    echo 'Successful request!';
    file_put_contents('test1.txt', $form_array);
}
