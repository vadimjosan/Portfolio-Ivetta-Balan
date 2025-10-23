<?php
// Setează email-ul tău
$to = "ivetta.balan@gmail.com";

// Verifică dacă formularul a fost trimis
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if(!$name || !$email || !$message){
        die("All fields are required!");
    }

    $subject = "New message from portfolio website";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "You have received a new message from your portfolio website:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";

    if(mail($to, $subject, $body, $headers)){
        // Redirect cu mesaj de succes
        header("Location: contacts.php?success=1");
        exit;
    } else {
        die("Sorry, something went wrong. Please try again later.");
    }
} else {
    // Dacă cineva accesează direct scriptul
    header("Location: contacts.php");
    exit;
}
