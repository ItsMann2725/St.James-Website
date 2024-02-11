<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Determine which form is being submitted based on a hidden input field
    $formType = isset($_POST["formType"]) ? $_POST["formType"] : '';

    // Process the form based on its type
    switch ($formType) {
        case 'application':
            processApplicationForm();
            break;
        case 'contact':
            processContactForm();
            break;
        default:
            // Handle unknown form types or display an error message
            echo "Error: Unknown form type.";
            break;
    }
}

// Function to process the application form
function processApplicationForm() {
    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $eligibility = $_POST["eligibility"];
    $ageEligibility = $_POST["age-eligibility"];
    $resumeFileName = $_FILES["resume"]["name"];
    $coverLetter = $_POST["summary"];

    // Compose email message
    $to = "manthanwiz28@gmail.com";  // Replace with your email address
    $subject = "New Job Application";
    $message = "First Name: $firstname\nLast Name: $lastname\nEmail: $email\nPhone: $phone\nAddress: $address\n";
    $message .= "Eligibility to work in the US: $eligibility\nAge Eligibility: $ageEligibility\n";
    $message .= "Resume File: $resumeFileName\nCover Letter: $coverLetter";

    // Additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        // Email sent successfully

        // Redirect to the thank you page for the application form
        header("Location: thank_you_application.php");
        exit();
    } else {
        // Email sending failed
        echo "Error: Unable to send email. Please try again later.";
    }
}

// Function to process the contact form
function processContactForm() {
    // Your contact form processing logic here
    // ...
    // Retrieve form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $persons = $_POST["person"];
    $reservationDate = $_POST["reservation-date"];
    $reservationTime = $_POST["reservation-time"];
    $message = $_POST["message"];

    // Perform any necessary validation and sanitization

    // Compose email message
    $to = "manthanwiz28@gmail.com";  // Replace with your email address
    $subject = "New Reservation";
    $body = "Name: $name\nPhone: $phone\nPersons: $persons\nDate: $reservationDate\nTime: $reservationTime\nMessage: $message";

    // Send email
    if (mail($to, $subject, $body)) {
        // Email sent successfully

    // Redirect to the thank you page for the contact form
    header("Location: thank_you_contact.php");
    exit();
}else {
    // Email sending failed
    echo "Error: Unable to send email. Please try again later.";
}
}
