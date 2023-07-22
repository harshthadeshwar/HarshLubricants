<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];
  $contact = $_POST["contact"];

  // Perform form validation and processing
  // You can add your own validation and processing logic here

  // Example: Sending an email with the form data
   $to = "harshlub@gmail.com";
   $subject = "New Enquiry";
   $body = "Name: " . $name . "\n"
         . "Email: " . $email . "\n"
           . "Message: " . $message ."\n"
          . "Contact: " . $contact;

  $headers = "From: " . $email;

  $servername="localhost";
  $username="root";
  $password="";
  $dbname="harsh_lubricants";

  $conn =mysqli_connect($servername,$username,$password,$dbname);
  if($conn->connect_error){
    die('Connection failed: '.$conn->connect_error);
  }else{
    $stmt = $conn->prepare("insert into enquiry(name, email, message, contact) 
    values(?,?,?,?)");
    $stmt->bind_param("sssi",$name ,$email ,$message ,$contact);
    $stmt->execute();
    echo "REGISTRATION SUCCESFUL,WE WILL GET BACK TO YOU SOON!!!";
    $stmt->close();
    $conn->close();
  }

  // Send the email
  if (mail($to, $subject, $body, $headers)) {
    // Email sent successfully
   echo "Thank you for your enquiry! We will get back to you soon.";
  } else {
     // Failed to send email
    echo "There was a problem sending your enquiry. Please try again later.";
  }
 }
?>