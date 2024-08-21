<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    // require 'vendor/phpmailer/phpmailer/src/Exception.php';
    // require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    // require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    
    require 'vendor/autoload.php';

    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "registration"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        // Validate email domain
        if (!preg_match("/^[a-z0-9._%+-]+@(gmail|yahoo)\.com$/", $email)) {
            die("Invalid email domain. Only Gmail and Yahoo are accepted.");
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (name, phone, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $phone, $email);

        if ($stmt->execute()) {
            echo "Registration successful. A confirmation email has been sent.";

            // Create a new instance of PHPMailer
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'anakor.chinaza.s@gmail.com';
                $mail->Password   = ''; 
                $mail->SMTPSecure = 'ssl';            
                $mail->Port       = 465;               
    
                //Recipients
                $mail->setFrom('anakor.chinaza.s@gmail.com', 'Chinaza');
                $mail->addAddress($email, $name); 
    
                // Content
                $mail->isHTML(false);
                $mail->Subject = 'Registration Confirmation';
                $mail->Body    = "Hello $name,\n\nThank you for registering. Your phone number is $phone.\n\nRegards,\nTeam";
               
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>
