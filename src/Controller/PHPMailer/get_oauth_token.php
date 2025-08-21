<?php

namespace PHPMailer\PHPMailer;

use League\OAuth2\Client\Provider\Google;
use Stevenmaguire\OAuth2\Client\Provider\Microsoft;
use TheNetworg\OAuth2\Client\Provider\Azure;

require 'vendor/autoload.php';
session_start();

$providerName = '';
$clientId = '';
$clientSecret = '';
$tenantId = '';

if (isset($_POST['provider'])) {
    $providerName = $_POST['provider'];
    $clientId = $_POST['clientId'];
    $clientSecret = $_POST['clientSecret'];
    $tenantId = $_POST['tenantId'];
    $_SESSION['provider'] = $providerName;
    $_SESSION['clientId'] = $clientId;
    $_SESSION['clientSecret'] = $clientSecret;
    $_SESSION['tenantId'] = $tenantId;
} elseif (isset($_SESSION['provider'])) {
    $providerName = $_SESSION['provider'];
    $clientId = $_SESSION['clientId'];
    $clientSecret = $_SESSION['clientSecret'];
    $tenantId = $_SESSION['tenantId'];
}

$redirectUri = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$params = [
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri,
    'accessType' => 'offline'
];

$options = [];
$provider = null;

switch ($providerName) {
    case 'Google':
        $provider = new Google($params);
        $options = ['scope' => ['https://mail.google.com/']];
        break;
    case 'Microsoft':
        $provider = new Microsoft($params);
        $options = ['scope' => ['wl.imap','wl.offline_access']];
        break;
    case 'Azure':
        $params['tenantId'] = $tenantId;
        $provider = new Azure($params);
        $options = ['scope' => ['https://outlook.office.com/SMTP.Send','offline_access']];
        break;
}

if (!$provider) {
    exit('Provider missing');
}

if (!isset($_GET['code'])) {
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
} elseif (empty($_GET['state']) || $_GET['state'] !== $_SESSION['oauth2state']) {
    unset($_SESSION['oauth2state']);
    unset($_SESSION['provider']);
    exit('Invalid state');
} else {
    unset($_SESSION['provider']);
    $token = $provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);
    echo 'Refresh Token: ', htmlspecialchars($token->getRefreshToken());
}
