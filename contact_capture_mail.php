<?php
// Simply emails the contents of your unsubmitted form the recipients
// entered in on the contact_capture_recipients.php file

require('PHPMailer/class.phpmailer.php');
require('contact_capture_recipients.php');

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

    //validate the info
    

    $message = "";
    foreach($form_array as $input) {
        $message .= $input['name'] . "\n";
        $message .= $input['value'] . "\n";
        $message .= "\n";
    }
    // file_put_contents('test1.txt', $message);



    //loop through forms
    for($i = 0; $i < count($contact_capture_recipients); $i++) {
      //icebox - if this form_id matches the form_id on our recipients, then send

      foreach($contact_capture_recipients[$i]['recipients'] as $recipient) {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        // Set PHPMailer to use the sendmail transport
        $mail->isSendmail();
        //Set who the message is to be sent from
        $mail->setFrom($contact_capture_recipients[$i]['from'][1], $contact_capture_recipients[$i]['from'][0]);
        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress($recipient[1], $recipient[0]);
        //Set the subject line
        $mail->Subject = 'Businesstastic Form Abandoned';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $message = '<p>'.$message.'</p>';

        $mail->msgHTML($message);
        //Replace the plain text body with one created manually
        // $mail->AltBody = $message;
        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            file_put_contents('test1.txt', "Mailer Error: " . $mail->ErrorInfo);
        } else {
            file_put_contents('test1.txt', "Message sent!");
        }
      } //end recipient foreach
    } //end form for

    // Sends a string back saying success
    // (not needed they aren't on that page anymore)
    // echo 'Successful request!';
}
