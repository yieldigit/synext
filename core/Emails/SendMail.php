<?php
namespace Synext\Emails;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SendMail{
    const SMTPUSER = 'noreply@informatutos.com';
    const SMTPPASS = 'Rootforuserroot07$';

    /**
     * send_mail.
     *
     * @param string $to      L'adesse mail du destinataire ex : doe@monmail.com
     * @param string $subject Le sujet de votre message ex : Demande Authentification
     * @param string $message Votre message ex :Un message d'exemple pour l'authentification
     * @param array  $from  L'entête de votre message ex : ['email@contact.com' => 'nom']
     *
     * @return bool
     */
    public static function mailTo(string $from, string $to,string $subject, string $message):bool{
        $name = explode('@',$to);
        try{
            $transport = (new Swift_SmtpTransport('smtp.zoho.com', 465, 'ssl'))
                ->setUsername(self::SMTPUSER)
                ->setPassword(self::SMTPPASS);
            $mailer = new Swift_Mailer($transport);
            $content = (new Swift_Message())
                ->setSubject($subject)
                ->setFrom([$from=>'InformaUrl'])
                ->setTo($to)
                ->setBody($message, 'text/html');
            if ($mailer->send($content)) {
                return true;
            } else {
                return false;
            }
        }catch (\Exception $e) {
            return false;
        }
    }
}