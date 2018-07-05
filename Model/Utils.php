<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 08/05/2018
 * Time: 17:36
 */

namespace AppBundle\Model;
use kornrunner\Keccak;

class Utils
{
    const URl="http://localhost:8545";
    const ACCOUNT="0xDd421A95ab8D53919092Cf2A144815905C2BC4Db";
    const CONTRACT="0xc56d6d54a18F0B79516b3B1866b39cE52AE64F3A";

    // llamada a eth_call
    function curlRequestCall($bytecode)
    {
        $data = [
            'jsonrpc' => '2.0', 'method' => 'eth_call', 'params' => [[
                "from" => self::ACCOUNT, "to" => self::CONTRACT, "data" => $bytecode], 'latest'
            ], 'id' => 67
        ];

        $this->unlockAccount();
        $params = json_encode($data);
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, self::URl);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $params);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
        curl_close($handler);
        $json = json_decode($response, true);
        return $json;
    }
    // llamada a eth_sendTransaction
    function curlRequestSendTransaction($bytecode)
    {

        $data = [
            'jsonrpc' => '2.0', 'method' => 'eth_sendTransaction', 'params' => [[
                "from" => self::ACCOUNT, "to" => self::CONTRACT, "gas" => "0x927c0", "data" => $bytecode]], 'id' => 67
        ];
        $params = json_encode($data);
        $this->unlockAccount();
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, self::URl);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $params);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
        curl_close($handler);
        $json = json_decode($response, true);
        return $json;
    }
    function curlCheckNetConection()
{

    $data = [
        'jsonrpc' => '2.0', 'method' => 'net_listening', 'params' => [], 'id' => 67];
    $params = json_encode($data);
    $handler = curl_init();
    curl_setopt($handler, CURLOPT_URL, self::URl);
    curl_setopt($handler, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($handler, CURLOPT_POST, true);
    curl_setopt($handler, CURLOPT_POSTFIELDS, $params);
    curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handler);
    curl_close($handler);
    $json = json_decode($response, true);
    $result=$json['result'];
    if($result){
        return true;
    }else {
        return false;
    }
//    return $json;
}

    function curlCheckNetSync()
    {
        $data = [
            'jsonrpc' => '2.0', 'method' => 'eth_syncing', 'params' => [], 'id' => 67];
        $params = json_encode($data);
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, self::URl);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $params);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
        curl_close($handler);
        $json = json_decode($response, true);
        $result=$json['result'];
        if(!$result){
            return true;
        }else {
            return false;
        }
//        return $json;
    }
    function curlCheckTransaction($hashTx)
    {
        $data = [
            'jsonrpc' => '2.0', 'method' => 'eth_getTransactionReceipt', 'params' => [$hashTx], 'id' => 67
        ];
        $params = json_encode($data);
        $this->unlockAccount();
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, self::URl);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $params);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
        curl_close($handler);
        $json = json_decode($response, true);
        $result=$json['result'];
        return $result;
//        return $json;
    }


    private function unlockAccount(){
        // curl -X POST --data '{"jsonrpc":"2.0","method":"personal_unlockAccount","params":["0x7642b...", "password", 3600],"id":67}' http://localhost:8545
        $url = "http://localhost:8545";
        $data  = [
            'jsonrpc'=>'2.0','method'=>'personal_unlockAccount','params'=>['0xDd421A95ab8D53919092Cf2A144815905C2BC4Db','bleSurfu',3600
            ],'id'=>67
        ];
        $params= json_encode($data);
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $params);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($handler);
        curl_close($handler);
    }
    //generar identificador a partir de invoiceNumber, total, supplierName y customerName
    function generateId($invoiceNumber, $total, $supplierName, $customerName){
        $data=$invoiceNumber.$total.$supplierName.$customerName;
        return hash ( "sha256",$data,false );
    }
    // devuelve la longitud de un argumento hexadecimal en bloques de 32 bytes para ajustarlo al formato
    // por ejemplo, un argumento que ocupe 33 bytes devuelve 64.
    function lengthBytesOnBlocksOf32($argHex){
        $length = strlen($argHex)/2;
        $length32 = 0;
         $i = 0;
         while(true){
             if ($length <= 32*$i){
                 $length32 = 32*$i;
                 break;
             }else{$i++;}
         }
         return $length32;

    }
    // devuelve la firma del metodo en hexadecimal para la api
    function hexMethodSignature($methodSignature){
        $hash =  Keccak::hash($methodSignature, 256);
        $beginnningHash = substr ( $hash ,0, 8 );
        return "0x".$beginnningHash;
    }
    // pasa de string a hexadecimal
    function stringToHex($string){
        $hex='';
        for ($i=0; $i < strlen($string); $i++){
            $hex .= dechex(ord($string[$i]));
        }
        return $hex;
    }
    // pasa de hexadecimal a string
    function hexToString($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
}