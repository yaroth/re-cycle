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
                    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.gmx.net';                          // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = CONF_EMAILADDRESS;                 // SMTP username
                    $mail->Password = CONF_EMAIL_PW;                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->setFrom('recycle@gmx.ch', 'Re-cycle info');
                    $mail->addAddress($buyer->email, $buyer->getUserFullName());     // Add a recipient
                    $mail->addReplyTo($seller->email, $seller->getUserFullName());

                    // send seller a copy
                    $mail->addCC($seller->email, $seller->getUserFullName());

                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "Re-cycle : Ihr neues Secondhand Velo!";
                    $message = "Dear $buyer->getUserFullName(), <br> you bought a second hand biycle on recycle.ch. 
                        Congratulations! <br>
                        Please get in touch with the seller to organize the payment and handover.<br> 
                        The email address is in the Cc.<br>
                        Seller: $seller->email. <br>
                        Buyer: $buyer->email. <br>
                        Thanks for buying at recycle.ch. <br>
                        Regards<br>
                        The recycle team!";
                    $mail->Body = $message;
                    $mail->AltBody = "Dear $buyer->getUserFullName() , \n you bought a second hand biycle on recycle.ch.
                        Congratulations! Please get in touch with the seller to organize the payment and handover.\n
                        Seller: $seller->email. \n
                        Buyer: $buyer->email. \n
                        Thanks for buying at recycle.ch. \n
                        Regards\n
                        The recycle team!";

                    $mail->send();
                    echo "Message sent to seller: " . $seller->getUserFullName() . " (" . $seller->email . ")<br>";
                    echo "Message sent to buyer: " . $buyer->getUserFullName() . " (" . $buyer->email . ")<br>";
                    echo "Sold bike: $bike->title<br>";
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    echo '<br>';
                }
            } else echo "You cannot sell your bicycle to yourself! Sorry!";
        } else echo "No bike id set, sorry!";
    } else echo "session cookie 'user' not set!";