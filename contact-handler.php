<?php
// Ratatouille Fox — contact form handler
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: contact.html'); exit; }
if (!empty($_POST['website'])) { header('Location: contact.html?status=sent'); exit; }
$name = trim(strip_tags($_POST['name'] ?? ''));
$email = trim($_POST['email'] ?? '');
$topic = trim(strip_tags($_POST['topic'] ?? 'General'));
$message = trim(strip_tags($_POST['message'] ?? ''));
if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) { header('Location: contact.html?status=error'); exit; }
$name = str_replace(["\r", "\n"], ' ', $name);
$topic = str_replace(["\r", "\n"], ' ', $topic);
$headers = "From: Ratatouille Fox Website <no-reply@ratatouillefox.com>\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8\r\n";
$ok = @mail('hello@ratatouillefox.com', 'Ratatouille Fox enquiry: ' . $topic, "Name: $name\nEmail: $email\nTopic: $topic\n\n$message\n", $headers);
header('Location: contact.html?status=' . ($ok ? 'sent' : 'error'));
exit;
