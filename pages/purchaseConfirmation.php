<?php
    /**
     * Called using AJAX
     */
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once '../vendor/autoload.php';

    require_once("../db/autoloader.php");
    require_once("functions.php");
    require_once "../data/conf.php";
    session_start();
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $buyer = User::getUserByLogin($login);
        $buyerID = $buyer->id;
        if (isset($_POST["bikeID"])) {
            $bikeID = $_POST["bikeID"];
            $bike = Bicycle::getBicycleByID($bikeID);
            $sellerID = $bike->ownerID;
            $seller = User::getUserByID($sellerID);
            if ($sellerID != $buyerID) {
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // No debug output
//                    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.gmx.net';                          // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = CONF_EMAILADDRESS;                 // SMTP username
                    $mail->Password = CONF_EMAIL_PW;                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('yann.roth@gmx.net', 'Re-cycle info');
                    $mail->addAddress('yann.roth@gmx.net', 'Yann Roth');     // Add a recipient
                    $mail->addReplyTo('yann.roth@gmx.net', 'Yann Roth');


                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    echo 'Message has been sent.<br>';
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    echo '<br>';
                }
                echo "Seller '" . $seller->getUserFullName() . "' sells bicycle '" . $bike->title . "' to buyer '" . $buyer->getUserFullName() . "'.";
            } else echo "You cannot sell your bicycle to yourself! Sorry!";
        } else echo "No bike id set, sorry!";
    } else echo "session cookie 'user' not set!";