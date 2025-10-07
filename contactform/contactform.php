<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize form data
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Your receiving email address
    $to = "lexiconelevatorss@gmail.com";  // <-- Replace with your own email address

    // Email subject and body
    $subject = "New message from your website Lexicon Elevators: $name";
    $body  = "You have received a new message from your website contact form.\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n";
    $body .= "Message:\n$message\n";


    //
    // saving locally in server
    $filename = "query_log.txt";
    $data_to_add = "Name: $name\n".
                   "Email: $email\n".
                   "Subject: $subject\n".
                   "Message: $message\n".
                   "-------------------------\n";

    // Open the file in append mode ('a')
    $file_pointer = fopen($filename, "a");

    // Check if the file was opened successfully
    if ($file_pointer) {
        // Write the data to the file
        fwrite($file_pointer, $data_to_add);

        // Close the file
        fclose($file_pointer);

        // echo "Data appended successfully to '$filename'.";
    }


    // Email headers
    $headers  = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        // Success message
        echo "Thank You!";
    } else {
        // Error message
        echo "Oops! Something went wrong. Please try again later.";
    }

} else {
    // If accessed directly (without submitting form)
    header("Location: index.html");
    exit();
}
?>

