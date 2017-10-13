<?php
// If you are using Composer
require 'vendor/autoload.php';

// If you are not using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php");

if(array_key_exists('message', $_POST)) {
    $subject = "Message from DeepSee landing page";
    $content = new SendGrid\Content("text/plain", $_POST["message"]);
} else {
    $subject = "Newsletter subscription request from DeepSee landing page";
    $content = new SendGrid\Content("text/plain", 'Subscribe');
}

$from = new SendGrid\Email(null, $_POST["email"]);
$to = new SendGrid\Email(null, "saxton@gmail.com");

$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
echo $response->headers();
echo $response->body();
