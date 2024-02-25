<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Determines which form is being submitted based on a hidden input field
    $formType = isset($_POST["formType"]) ? $_POST["formType"] : '';

    // Processes the form based on its type
    switch ($formType) {
        case 'application':
            processApplicationForm();
            break;
        case 'contact':
            processContactForm();
            break;
        case 'subscription':
            processSubscriptionForm();
            break;
        default:
            // Handles unknown form types or display an error message
            echo "Error: Unknown form type.";
            break;
    }
}

// Function to process the application form
function processApplicationForm() {
    // Retrieves form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $eligibility = $_POST["eligibility"];
    $ageEligibility = $_POST["age-eligibility"];
    $resumeFileName = $_FILES["resume"]["name"];
    $coverLetter = $_POST["summary"];

    // Composes email message
    $to = "manthanwiz28@gmail.com";
    $subject = "New Job Application";
    $message = "First Name: $firstname\nLast Name: $lastname\nEmail: $email\nPhone: $phone\nAddress: $address\n";
    $message .= "Eligibility to work in the US: $eligibility\nAge Eligibility: $ageEligibility\n";
    $message .= "Resume File: $resumeFileName\nCover Letter: $coverLetter";

    // Additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Sends email
    if (mail($to, $subject, $message, $headers)) {

        // Redirects to the thank you page for the application form
        header("Location: thank_you_application.php");
        exit();
    } else {
        echo "Error: Unable to send email. Please try again later.";
    }
}

function processSubscriptionForm() {
    // Collect form data
    $email = $_POST["email_address"];

        // Email details
        $to = "manthanwiz28@gmail.com";
        $subject = "New Subscription";
        $message = "A new user has subscribed. Email: $email";

        // Send email
        $headers = $email;
        if (mail($to, $subject, $message, $headers)) {

    
        header("Location: thank_you_subscription.php");
        exit();
    } else {
        echo "Error: Unable to send email. Please try again later.";
    }
}
// Function to process the contact form
function processContactForm() {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $persons = $_POST["person"];
    $reservationDate = $_POST["reservation-date"];
    $reservationTime = $_POST["reservation-time"];
    $message = $_POST["message"];

    // Composes email message
    $to = "manthanwiz28@gmail.com";
    $subject = "New Reservation";
    $body = "Name: $name\nPhone: $phone\nPersons: $persons\nDate: $reservationDate\nTime: $reservationTime\nMessage: $message";

    // Sends email
    if (mail($to, $subject, $body)) {

    // Redirects to the thank you page for the contact form
    header("Location: thank_you_contact.php");
    exit();
}
else {
    echo "Error: Unable to send email. Please try again later.";
    }
}
