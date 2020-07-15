<?php

class ExecutionTime
{
     private $startTime;
     private $endTime;

     public function start(){
         $this->startTime = getrusage();
     }

     public function end(){
         $this->endTime = getrusage();
     }

     private function runTime($ru, $rus, $index) {
         return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
     }    

     public function __toString(){
         return "This process used " . $this->runTime($this->endTime, $this->startTime, "utime") .
        " ms for its computations\nIt spent " . $this->runTime($this->endTime, $this->startTime, "stime") .
        " ms in system calls\n";
     }
}


$simple_string = "This_will_be_encrypted_1000_times_over_and_over_again";


$symmetricTime = new ExecutionTime();


/////////////////////////////////////////// SymmetricKey//////////////////////////////////////////


$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption_iv = '1234567891011121';
$decryption_iv = $encryption_iv; 
$encryption_key = "SymmetricKey"; 
$decryption_key = $encryption_key;
 
echo "Symmetric Key simulation Begins!\n";


$symmetricTime->start();


for($i = 0 ; $i < 10000 ; $i++){
    //   Encryption
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);   

    //   Decryption
    $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv); 
}

$symmetricTime->end();

echo $symmetricTime;



//////////////////////////////////////////// AsymmetricKey////////////////////////////////////////////////


$asymmetricTime = new ExecutionTime();
$public_key = openssl_get_publickey(file_get_contents('public.pem'));
$private_key = openssl_get_privatekey(file_get_contents('private.key'));

echo "\n\n\n\n\n\nAsymmetric Key simulation Begins!\n";

$asymmetricTime->start();

for($i = 0 ; $i < 10000 ; $i++){
    //   Encryption
    $encryption = $e = NULL;
    openssl_public_encrypt($simple_string, $encryption, $public_key);

    // Decryption
    $decryption = NULL;

    openssl_private_decrypt($encryption, $decryption, $private_key);
}

$asymmetricTime->end();

echo $asymmetricTime;

?>