<?php

require 'vendor/autoload.php';

// Send back to home page if not filled out correctly
if(!isset($_POST['email']) || $_POST['email'] == null) {
    header('Location: /');
    die();
}

// set the subject and content fields
if(isset($_POST['message'])) {
    $message_type = "contact";
    $subject = "Message from HOME page";

    $content_text =<<<EOD
NAME: {$_POST['name']}

EMAIL: {$_POST['email']}

{$_POST['message']}
EOD;

    $content = new SendGrid\Content("text/plain", $content_text);

} else {
    $message_type = "subscription";
    $subject = "Subscription request from HOME page";
    $content = new SendGrid\Content("text/plain", $_POST['email']);
}

// set the rest of the email fields
$contact_email = getenv('CONTACT_EMAIL');
$from = new SendGrid\Email(null, $_POST['email']);
$to = new SendGrid\Email(null, $contact_email);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);

// set a cookie with a message that will be displayed
// in a pop-up after the form is submitted based upon
// the type and result status

// echo $response->headers();
// echo $response->body();
if($response->statusCode() == '202') {
    if($message_type == 'contact') {
        $message = 'Thank you for your message.  We will respond to you shortly.';
    } else {
        $message = 'Thank you for signing up.  We will keep you posted.';
    }    
} else {
    if($message_type == 'contact') {
        $message = 'Message failed: please email us directly at ' . getenv('CONTACT_EMAIL') . ' for assistance';
    } else {
        $message = 'Sign-up failed: please email us directly at ' . getenv('CONTACT_EMAIL') . ' for assistance';
    }     
}
setcookie("message", $message);
header('Location: /');