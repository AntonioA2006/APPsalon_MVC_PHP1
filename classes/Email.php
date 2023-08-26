<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre , $token){

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        
    }
    public function enviarComfirmacion(){
        //crear e object de email

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];


            $mail->setFrom('cuentas@appsalon.com');
            $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');

            $mail->Subject = 'Confirma Tu Cuenta';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido.= "<p><strong> Hola" .$this->nombre .  "</strong> Has creado tu cuenta en appsalon, solo debes comfirmar la cuenta selecionando el sihguiente enlace
            </p>";
            $contenido.= "<p> Presiona Aqui : <a href = '".$_ENV['APP_URL']."/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
            $contenido.= "<p> Si Tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $contenido.="</html>";

            $mail->Body = $contenido;

            //ENVIAR EL MAIL

            $mail->send();

    }

    public function enviarInstrucciones(){
           //crear e object de email

           $mail = new PHPMailer();
           $mail->isSMTP();
           $mail->Host = $_ENV['EMAIL_HOST'];
           $mail->SMTPAuth = true;
           $mail->Port = $_ENV['EMAIL_PORT'];
           $mail->Username = $_ENV['EMAIL_USER'];
           $mail->Password = $_ENV['EMAIL_PASS'];

           $mail->setFrom('cuentas@appsalon.com');
           $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');

           $mail->Subject = 'Restablece tu Password';
           $mail->isHTML(true);
           $mail->CharSet = 'UTF-8';

           $contenido = "<html>";
           $contenido.= "<p><strong> Hola" .$this->nombre .  "</strong> Has solicitado restablecer tu password </p>";
           $contenido.= "<p> Presiona Aqui : <a href = '".$_ENV['APP_URL']."/recuperar?token=" . $this->token . "'>Restablece tu Password</a> </p>";
           $contenido.= "<p> Si Tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
           $contenido.="</html>";

           $mail->Body = $contenido;

           //ENVIAR EL MAIL

           $mail->send();


    }

}