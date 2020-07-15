<?php

$simple_string = readline("Enter the message that needs to be encrypted: "); 

$public_key = openssl_get_publickey(file_get_contents('public.pem'));
$encryption = $e = NULL;

openssl_public_encrypt($simple_string, $encryption, $public_key);
echo "Encrypted String: " . $encryption . "\n"; 
file_put_contents("encrypted.txt", $encryption);
?>
