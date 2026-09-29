<?php






use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/phpmailer/Exception.php';
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';

function envoiMail($destinataire, $objet, $message)
{
    date_default_timezone_set('Europe/Paris');

    $dateEnvoi = date('d/m/Y à H:i:s');






    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP Hostinger
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@sioslam.com';
        $mail->Password   = 'f>O@Xrv&OD7';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Exp�diteur
        $mail->setFrom('contact@sioslam.com', 'BTS SIO');
        
        // Destinataire
        $mail->addAddress($destinataire);

        // Contenu
        $mail->Subject = $objet;
        $mail->Body =
            "Nouveau message \n\n" .
            "Date et heure d'envoi: " . $dateEnvoi . "\n\n" .
            "Adresse email: ". $_POST['email'] . "\n" .
            "Objet: ". $_POST['objet'] . "\n\n" .
            "Message:\n". $_POST['comm'] . "\n";

        $mail->CharSet = 'UTF-8';

        // Envoi
        $mail->send();

        return true;

    } catch (Exception $e) {

        // Pour le d�veloppement uniquement
        // echo "Erreur : " . $mail->ErrorInfo;

        return false;
    }
}
