<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Effortless Reservations for Groups, From Start to Stay">
    <meta name="author" content="ALFA Hotels">
    <title>ALFA Hotels | Group Hotel Booking Made Easy</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon2.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
    
	<script type="text/javascript">
    function delayedRedirect(){
        window.location = "index.html"
    }
    </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">
<?php


						$mail = $_POST['email'];
						$to = "alex01pap@gmail.com";/* YOUR EMAIL HERE */
						$subject = "Booking request from ALFA Hotels";
						$headers = "From: ALFA Hotels <noreply@atravel.gr>";
						$message = "DETAILS\n";
						$message .= "\nCheck in > Check out: " . $_POST['dates'];
						$message .= "\nLocation: " . $_POST['address'];
						$message .= "\nAdults: " . $_POST['adults'];
						$message .= "\nChilds: " . $_POST['child'];
						if( isset( $_POST['notes'] ) && $_POST['notes']) {
						$message .= "\nSpecial notes: " . $_POST['notes'];
						}
						
						$message .= "\nBooking Options:\n" ;
						foreach($_POST['options'] as $value) 
							{ 
							$message .=   "- " .  trim(stripslashes($value)) . "\n"; 
							};
	
						$message .= "\nGroup name: " . $_POST['group_name'];
						$message .= "\nRoom type: " . $_POST['group_type'];
						$message .= "\nYour name: " . $_POST['your_name'];
						$message .= "\nEmail: " . $_POST['email'];
						$message .= "\nTelephone: " . $_POST['telephone'];
						$message .= "\nTerms and conditions accepted: " . $_POST['terms']. "\n";
	
						//Receive Variable
						$sentOk = mail($to,$subject,$message,$headers);
						
						//Confirmation page
						$user = "$mail";
						$usersubject = "Thank You";
						$userheaders = "From: business@atravel.gr\n";
						/*$usermessage = "Thank you for your time. Your quotation request is successfully submitted.\n"; WITH OUT SUMMARY*/
						//Confirmation page WITH  SUMMARY
						$usermessage = "Thank you for your time. Your request is successfully submitted. We will reply shortly.\n\nBELOW A SUMMARY\n\n$message"; 
						mail($user,$usersubject,$usermessage,$userheaders);
						
						// Send data to Zapier webhook using PHP cURL
						        $webhook_url = 'https://hooks.zapier.com/hooks/catch/9950511/2tg9gob/';
						        $webhook_data = array(
						            'dates' => $_POST['dates'],
						            'address' => $_POST['address'],
						            'adults' => $_POST['adults'],
						            'child' => $_POST['child'],
						            'notes' => $_POST['notes'],
						            'group_name' => $_POST['group_name'],
						            'group_type' => $_POST['group_type'],
						            'your_name' => $_POST['your_name'],
						            'email' => $_POST['email'],
						            'telephone' => $_POST['telephone']
						        );
						
						        // Use cURL to send the form data to the webhook
						        $ch = curl_init($webhook_url);
						        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
						        curl_setopt($ch, CURLOPT_POST, true);
						        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($webhook_data));
						        $result = curl_exec($ch);
						        curl_close($ch);
						
						        // Check if Zapier webhook submission was successful
						        if ($result === FALSE) {
						            // Handle webhook error
						            echo "There was an issue submitting your request to Zapier.";
						        } else {
						            echo "Success! Data was sent to Zapier.";
						        }
						
?>
<!-- END SEND MAIL SCRIPT -->   

<div id="success">
    <div class="icon icon--order-success svg">
         <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
          <g fill="none" stroke="#8EC343" stroke-width="2">
             <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
             <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
          </g>
         </svg>
     </div>
	<h4><span>Request successfully sent!</span>Thank you for your time</h4>
	<small>You will be redirect back in 5 seconds.</small>
</div>
</body>
</html>
