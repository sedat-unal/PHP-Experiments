<?php
extract($_POST);
session_start();
echo $_POST['alici'] . "<br>" . $_POST['mesaj'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);
try {
 //Server settings
 $mail->CharSet = 'UTF-8';
 $mail->SMTPDebug = 0; // debug on - off
 $mail->isSMTP(); 
 $mail->Host = 'mail.almhizlituketim.com'; // SMTP sunucusu örnek : mail.alanadi.com
 $mail->SMTPAuth = true; // SMTP Doğrulama
 $mail->Username = 'siparis@almhizlituketim.com'; // Mail kullanıcı adı
 $mail->Password = 'Hp53POGZ'; // Mail şifresi
 $mail->SMTPSecure = ''; // Şifreleme
 $mail->Port = 587; // SMTP Port
$mail->SMTPOptions = array(
 'ssl' => array(
 'verify_peer' => false,
 'verify_peer_name' => false,
 'allow_self_signed' => false
 )
);

 //Alıcılar
 $mail->setfrom('siparis@almhizlituketim.com', 'ALM Hızlı Tüketim |');
 $mail->addAddress($_POST['alici']);
 //İçerik
 $mail->isHTML(true);
 $mail->Subject = 'Size Özel Teklifimiz Var';
 $mail->Body = $_POST['mesaj'];

 $mail->send();
 echo "Mesajınız İletildi --> ".$_POST['alici']."<br>";
} catch (Exception $e) {
 echo 'Mesajınız İletilemedi. Hata: ', $mail->ErrorInfo;
}

?>