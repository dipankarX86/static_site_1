<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize form data
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Your receiving email address
    $to = "er.dipankarsaikia@gmail.com";  // <-- Replace with your own email address

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

        echo "Data appended successfully to '$filename'.";
    } else {
        echo "Error: Could not open the file '$filename'.";
    }
    //


    // Email headers
    $headers  = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        // Success message
        echo "
        <html>
        <head>
          <title>Message Sent</title>
          <style>
            body {
              font-family: Arial, sans-serif;
              background-color: #f2f2f2;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
              margin: 0;
            }
            .box {
              background: white;
              padding: 30px 40px;
              border-radius: 10px;
              box-shadow: 0 0 10px rgba(0,0,0,0.1);
              text-align: center;
            }
            h2 { color: #25d366; }
            a.button {
              display: inline-block;
              margin-top: 15px;
              padding: 10px 20px;
              background-color: #25d366;
              color: white;
              text-decoration: none;
              border-radius: 5px;
              transition: 0.3s;
            }
            a.button:hover {
              background-color: #1ebe57;
            }
          </style>
        </head>
        <body>
          <div class='box'>
            <h2>✅ Thank You!</h2>
            <p>Your message has been sent successfully.</p>
            <a href='javascript:history.back()' class='button'>Go Back</a>
          </div>
        </body>
        </html>";
    } else {
        // Error message
        echo "
        <html>
        <head><title>Error</title></head>
        <body>
          <h3>❌ Oops! Something went wrong. Please try again later.</h3>
          <a href='javascript:history.back()'>Go Back</a>
        </body>
        </html>";
    }

} else {
    // If accessed directly (without submitting form)
    header("Location: index.html");
    exit();
}
?>

