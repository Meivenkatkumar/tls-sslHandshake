<?php 

$simple_string = readline("Enter the message that needs to be encrypted: "); 




$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption_iv = '1234567891011121'; 
$encryption_key = "SymmetricKey"; 

$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv); 

echo "Encrypted String: " . $encryption . "\n"; 
file_put_contents("encrypted.txt", $encryption);


?>
