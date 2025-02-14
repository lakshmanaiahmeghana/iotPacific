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

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'meghanal138@gmail.com'; // Your Gmail
    $mail->Password = 'ycxk mcwu snxh uijo'; // Use an App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email settings
    $mail->setFrom($_POST['email'], 'New Subscriber');
    $mail->addAddress('meghanal138@gmail.com'); // Receiving email
    $mail->Subject = "New Subscription: " . $_POST['email'];
    $mail->Body = "A new user has subscribed with the email: " . $_POST['email'];

    // Send email
    if ($mail->send()) {
        echo "OK"; // ✅ JavaScript expects this!
    } else {
        echo "Failed to send message.";
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>
