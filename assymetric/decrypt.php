<?php 
$private_key = openssl_get_privatekey(file_get_contents('private.key'));
$encryption = file_get_contents("encrypted.txt");
$decryption = NULL;

openssl_private_decrypt($encryption, $decryption, $private_key);
echo "Decrypted String: " . $decryption;
?>