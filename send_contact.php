 <?php
include('config.php');
require('class.phpmailer.php');
 $nume    = filter_var($_POST["nume"], FILTER_SANITIZE_STRING);
 $email    = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
 $subiect    = filter_var($_POST["subiect"], FILTER_SANITIZE_STRING);
 $mesaj    = filter_var($_POST["mesaj"], FILTER_SANITIZE_STRING);

 	if(empty($nume)) {
		$empty[] = "<b>Nume</b>";		
	}	
	if(empty($email)) {
		$empty[] = "<b>Email</b>";
	}
    if(empty($subiect)) {
        $empty[] = "<b>Subiect</b>";
    }


	if(!empty($empty)) {
        echo "<div class='alert alert-danger fade in alert-dismissible'>
		    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
		    <strong>Error!</strong> Obligatoriu ".implode(", ",$empty)."
		</div>";
		die();
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  echo "<div class='alert alert-danger fade in alert-dismissible'>
				    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
			    <strong>Email invalid</strong>
				</div>";
				die();
	}
	// if (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) { 
 //   			echo "<div class='alert alert-danger fade in alert-dismissible'>
	// 			    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
	// 		    <strong>Telefon invalid</strong>
	// 			</div>";
	// 			die();
	// }



	$captcha = $_POST['g-recaptcha-response'];
	$curl = curl_init();
	$secretKey = SECRET_KEY;
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => array(
	        'secret' => $secretKey,
	        'response' => $captcha
	    )
	));
	$response = curl_exec($curl);
	curl_close($curl);

	if(strpos($response, '"success": true') !== FALSE) {

	} else {
	    echo "<div class='alert alert-danger fade in alert-dismissible'>
				    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
			    <strong>Eroare captcha</strong>
				</div>";
				die();
	}
	   $subject = "Mesaj din pagina de contact";
	   include('template_contact.php'); 
       $mail = new PHPMailer();
       $mail->From = $email_trimite_email;
       $mail->FromName = $alt_trimite_email5;
       $mail->Subject = $subject;
       $mail->AltBody = "<h4>".base_url."</h4>";
       $mail->IsMail();
       $mail->MsgHTML($message);
       $mail->AddAddress($email_administrator, $catreName);
       $mail->SMTPDebug  = 1;
       $mail->SMTPAuth   = true; 
       $mail->IsSMTP();
       $mail->Host = $server_trimite_email;
       $mail->Username = $email_trimite_email;
       $mail->Password = $parola_trimite_email;

// if(is_array($_FILES)) {
// $mail->AddAttachment($_FILES['attachmentFile']['tmp_name'],$_FILES['attachmentFile']['name']); 
// }

$mail->IsHTML(true);

if(!$mail->Send()) {
	echo "<div class='alert alert-danger fade in alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
    <strong>Eroare!</strong> Mesajul nu a fost trimis, incercati din nou.
</div>";
} else {
	echo "<div class='alert alert-success fade in alert-dismissible' style='margin-top:18px;'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
    <strong>Succes!</strong> Mesajul a fost trimis cu succes.
</div>";
}	
?>