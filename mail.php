<?php
// If you are using Composer
require 'vendor/autoload.php';

// If you are not using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php");

// Send back to home page if not filled out correctly
if(!isset($_POST['email'])) {
    header('Location: index.html');
}

if(isset($_POST['message'])) {
    $subject = "Message from HOME page";

    $content_text =<<<EOD
NAME: {$_POST['name']}

EMAIL: {$_POST['email']}

{$_POST['message']}
EOD;

    $content = new SendGrid\Content("text/plain", $content_text);

} else {
    $subject = "Subscription request from HOME page";
    $content = new SendGrid\Content("text/plain", $_POST['email']);
}

$from = new SendGrid\Email(null, $_POST['email']);
$to = new SendGrid\Email(null, 'admin@deepsee.io');
// $to = new SendGrid\Email(null, 'saxton@gmail.com');

$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
// echo $response->statusCode();
// echo $response->headers();
// echo $response->body();
header('Location: index.html');