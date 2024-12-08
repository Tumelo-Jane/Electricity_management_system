<?php

require_once '../api/vendor/autoload.php';
// Set up the client
$client = new Google_Client();
$client->setApplicationName('Electricity bills');
$client->setScopes(Google_Service_Gmail::GMAIL_SEND);
$client->setAuthConfig('../clientId.json'); // Path to your OAuth 2.0 credentials JSON file

// Authenticate with OAuth 2.0
$client->setAccessToken('https://oauth2.googleapis.com/token');

// Create a Gmail service object
$service = new Google_Service_Gmail($client);

// Prepare the email
$email = new Google_Service_Gmail_Message();
$email->setRaw(base64_encode("From: electritybills232@gmail.com\r\nTo: tumijane.maluleke@gmail.com\r\nSubject: Test Email\r\n\r\nThis is a test email."));

// Send the email
$service->users_messages->send('me', $email);

echo "Email sent successfully.";

?>