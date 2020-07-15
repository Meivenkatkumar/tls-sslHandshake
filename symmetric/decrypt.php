<?php

$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$decryption_key = "SymmetricKey"; 
$decryption_iv = '1234567891011121'; 
$encryption = file_get_contents("encrypted.txt");

$decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv); 
echo "Decrypted String: " . $decryption; 

?> 

