<?php
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;;
  
 require 'vendor/autoload.php';
 //required files
 
//required files
//Create an instance; passing `true` enables exceptions

  $pm_host = "111.223.34.132";
	$pm_port = 587;
	$pm_smtp = "111.223.34.132";
	$pm_user = "web_authen@ucc.co.th";
	$pm_pass = "web@1989";
	$pm_from = "Requirement@ucc.co.th"; //คนส่ง
	$pm_fromname = "Requirement : ".$Section;
  $receive = $Request_by."@ucc.co.th"; //คนรับ

	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl';
	$mail->CharSet = "utf-8";  // &#3651;&#3609;&#3626;&#3656;&#3623;&#3609;&#3609;&#3637;&#3657; &#3606;&#3657;&#3634;&#3619;&#3632;&#3610;&#3610;&#3648;&#3619;&#3634;&#3651;&#3594;&#3657; tis-620 &#3627;&#3619;&#3639;&#3629; windows-874 &#3626;&#3634;&#3617;&#3634;&#3619;&#3606;&#3649;&#3585;&#3657;&#3652;&#3586;&#3648;&#3611;&#3621;&#3637;&#3656;&#3618;&#3609;&#3652;&#3604;&#3657;
	
	$mail->Host     = $pm_host; //  mail server �ͧ���
   // $mail->SMTPAuth = false;     //  ���͡�����ҹ������ Ẻ SMTP
  $mail->SMTPAutoTLS = false; // Disable certificate verification

	if (!empty($pm_smtp)) { 
		$mail->SMTPSecure = $pm_smtp;
	}
	
    $mail->Username = $pm_user;   //  account e-mail �ͧ��ҷ���ͧ��è���
    $mail->Password = $pm_pass;  //  ���ʼ�ҹ e-mail �ͧ��ҷ���ͧ��è���
	

    // $mail = new PHPMailer(true);
 
    // //Server settings
    // $mail->isSMTP();                              //Send using SMTP
    // $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;             //Enable SMTP authentication
    // $mail->Username   = 'nuttawat8244@gmail.com';   //SMTP write your email
    // $mail->Password   = 'fvywuhhejnedanvq';      //SMTP password
    // $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    // $mail->Port       = 465;                                    
    // $mail->CharSet = "utf-8";
    // //Recipients
    // $mail->setFrom( "nuttawat8244@gmail.com", $pm_fromname); // Sender Email and name//คนส่ง//subject
    // $mail->addAddress("nuttawat8244@gmail.com","jappan55@gmail.com");     //Add a recipient email  คนรับ
    // $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email
 
 
	$mail->SetFrom($pm_from, $pm_fromname);     //  account e-mail &#3586;&#3629;&#3591;&#3648;&#3619;&#3634;&#3607;&#3637;&#3656;&#3651;&#3594;&#3657;&#3651;&#3609;&#3585;&#3634;&#3619;&#3626;&#3656;&#3591;&#3629;&#3637;&#3648;&#3617;&#3621;  , &#3594;&#3639;&#3656;&#3629;&#3612;&#3641;&#3657;&#3626;&#3656;&#3591;&#3607;&#3637;&#3656;&#3649;&#3626;&#3604;&#3591; &#3648;&#3617;&#3639;&#3656;&#3629;&#3612;&#3641;&#3657;&#3619;&#3633;&#3610;&#3652;&#3604;&#3657;&#3619;&#3633;&#3610;&#3648;&#3617;&#3621;&#3660;&#3586;&#3629;&#3591;&#3648;&#3619;&#3634;
	$mail->AddAddress($receive);      //Add a recipient email  คนรับ

    // $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email
 
  $txt = explode("\n",$Requirement);

  $bodyContent = "<font face='Cordia New' size='4' >";
  $bodyContent .= "เรียนคุณ <b> P'cha </b><br>";
  $bodyContent .= "ขอวันที่ : <b>" .$Date. "</b><br>";
  $bodyContent .= "ผู้ขอ : <b>" .$Request_by. "</b><br>";
  $bodyContent .= "Department: <b>".$Department."</b> Section: <b>".$Section."</b><br>";
  $bodyContent .= "Subject: <b>".$Subject."</b> <br>";
  $bodyContent .= "<p><b>Ploblem .:</b> <br>";
  $bodyContent .= $Problem." <br>";
  $bodyContent .= "<b>Requirement .:</b> <br>";

  foreach ($txt as $text) {
      $bodyContent .= $text . "<br>";
  }
  $bodyContent .= "<p><b>Comment .:</b> <br>";
  $bodyContent .= $Comment."<br>";
  $bodyContent .= "<a style='color:'' href='$link'><h3><span style='color:green'>งานเสร็จเรียบร้อยแล้ว</span><br>คลิ๊กเพื่อcapture หน้าจอ program</h3></a>";
  $bodyContent .= "</font>";

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject ="Requirement Success : $Subject " ;   // email subject headings
    $mail->Body    = $bodyContent; //email message//email message
      
    // Success sent message alert
    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
      // echo "Message sent!";
      }


?>