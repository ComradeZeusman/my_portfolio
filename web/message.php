<?php
session_start(); // Start the session at the beginning of your script

// Include PHPMailer
require 'Mailer/src/PHPMailer.php';
require 'Mailer/src/SMTP.php';
require 'Mailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Your SMTP configuration
$smtp_host = 'smtp.gmail.com';
$smtp_port = 587; // Adjust the port accordingly
$smtp_username = 'madastore49@gmail.com';
$smtp_password = 'iycbwrkdhivdddgr';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the last email was sent less than 60 seconds ago
    if (isset($_SESSION['last_email_sent']) && (time() - $_SESSION['last_email_sent']) < 60) {
      echo '<!DOCTYPE html>
      <html lang="en" class="bg-gray-100">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Message Sent</title>
          <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
          <style>
              body {
                  font-family: \'Poppins\', sans-serif;
              }
          </style>
      </head>
      <body class="flex flex-col min-h-screen">
          <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
              <h1 class="text-2xl font-bold text-gray-800"><a href="/index.html">Madalo Stanford Perenje</a></h1>
              <ul class="flex space-x-4">
                  <li><a href="index.php" class="text-gray-600 hover:text-gray-800 transition duration-300">Home</a></li>
                  <li><a href="#projects" class="text-gray-600 hover:text-gray-800 transition duration-300">Projects</a></li>
                  <li><a href="#contact-me" class="text-gray-600 hover:text-indigo-600 transition duration-300">Contact Me</a></li>
              </ul>
          </nav>
          <main class="flex-grow">
              <section class="py-16" id="message-sent">
                  <div class="max-w-4xl mx-auto px-4">
                      <div class="bg-red-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md animate__animated animate__fadeIn" role="alert">
                          <div class="flex">
                              <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                              <div>
                                  <p class="font-bold">Message not sent</p>
                                  <p class="text-sm">Please wait before sending another message.</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
          </main>
          <footer class="bg-gray-800 text-white py-4 px-6 mt-auto">
              <div class="max-w-4xl mx-auto flex justify-between items-center">
                  <p>&copy; 2023 Madalo Stanford Perenje</p>
                  <div class="flex space-x-4">
                      <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                          <i class="fab fa-twitter fa-2x"></i>
                      </a>
                      <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                          <i class="fab fa-linkedin fa-2x"></i>
                      </a>
                      <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                          <i class="fab fa-github fa-2x"></i>
                      </a>
                  </div>
              </div>
          </footer>
      </body>
      </html>';
    } else {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // Step 4: Compose the password reset email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->Port = $smtp_port;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('Portifolio', 'websie');
        $mail->addAddress('stanfordperenje@gmail.com');
        $mail->Subject = 'New message from your portofolio website';
        $mail->Body = 'You have received a new message from the user ' . $name . ' (' . $email . '): ' . $message;

        // Step 5: Send the email
        if ($mail->send()) {
            // Update the timestamp of the last email sent
            $_SESSION['last_email_sent'] = time();
            echo '<!DOCTYPE html>
            <html lang="en" class="bg-gray-100">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Message Sent</title>
                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
                <style>
                    body {
                        font-family: \'Poppins\', sans-serif;
                    }
                </style>
            </head>
            <body class="flex flex-col min-h-screen">
                <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800"><a href="/index.html">Madalo Stanford Perenje</a></h1>
                    <ul class="flex space-x-4">
                        <li><a href="index.php" class="text-gray-600 hover:text-gray-800 transition duration-300">Home</a></li>
                        <li><a href="#projects" class="text-gray-600 hover:text-gray-800 transition duration-300">Projects</a></li>
                        <li><a href="#contact-me" class="text-gray-600 hover:text-indigo-600 transition duration-300">Contact Me</a></li>
                    </ul>
                </nav>
                <main class="flex-grow">
                    <section class="py-16" id="message-sent">
                        <div class="max-w-4xl mx-auto px-4">
                            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md animate__animated animate__fadeIn" role="alert">
                                <div class="flex">
                                    <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                    <div>
                                        <p class="font-bold">Message sent successfully</p>
                                        <p class="text-sm">Your message has been sent. We will get back to you shortly.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
                <footer class="bg-gray-800 text-white py-4 px-6 mt-auto">
                    <div class="max-w-4xl mx-auto flex justify-between items-center">
                        <p>&copy; 2023 Madalo Stanford Perenje</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                                <i class="fab fa-linkedin fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                                <i class="fab fa-github fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </footer>
            </body>
            </html>';
          
        } else {
            echo "Error: " . $mail->ErrorInfo;
        }
    }
}
?>