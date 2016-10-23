<?php

    // More headers
   // $headers .= 'From: ganesh.euraka@gmail.com'. "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";

    $headers = 'From: ganesh.euraka@gmail.com'. "\r\n" .
        'Reply-To:' .$_SESSION["lec_email"] . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

mail("csungroupprojectsem1@gmail.com", "APPONTMENT REQUEST", $message,$headers);

?>