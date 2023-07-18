// Validate input
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
  echo "Please fill in all fields";
  exit;
}

// Sanitize input
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Create mailer and set data
require 'PHPMailer.php';
$mail = new PHPMailer();

$mail->setFrom($email, $name);
$mail->addAddress('nahomg761@gmail.com'); 

$mail->Subject = 'New contact form submission';
$mail->Body = $message;

// Send email
if($mail->send()) {
  echo "Thank you for contacting us!"; 
} else {
  echo "Oops, error sending message.";
}