<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../assets/vendor/PHPMailer/src/Exception.php';
require __DIR__ . '/../assets/vendor/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../assets/vendor/PHPMailer/src/SMTP.php';

// Allow CORS (for local development)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
$mail = new PHPMailer(true);

header('Content-Type: text/plain'); // Ensure response is plain text

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'meghanal138@gmail.com'; 
    $mail->Password = 'ycxk mcwu snxh uijo'; // Use an App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('meghanal138@gmail.com');
    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['message'];

    if ($mail->send()) {
        echo "OK"; // ✅ JavaScript expects this!
    } else {
        echo "Failed to send message.";
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>
