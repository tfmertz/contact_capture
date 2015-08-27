<?php

# This is a sample of how to configure your email recipients
# copy this file and rename it contact_capture_recipients.php

# Enter the email addresses below that will receive the contact capture forms
$contact_capture_recipients = array(
    array(
        'form_id' => 'default',
        'from' => 'support@example.com',
        'recipients' => array(
            'jdoe@example.com',
            'jsmith@example.com'
        )
    ),
    array(
      #second form goes here
    ),
);
