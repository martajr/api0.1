<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 12/05/2018
 * Time: 1:28
 */

namespace AppBundle\Model;
use AppBundle\Model\Utils;


class AccessContract
{

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------INSERT-------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

// function insertDocument(bytes documentUniqueId,bytes invoiceNumber,bytes total,bytes3 currency,
//  bytes paymentType,bytes supplierName,bytes customerName,bytes paymentTerms,bytes dates)
    function insertDocument($documentUniqueId,$invoiceNumber,$total, $currency,$paymentType, $supplierName,
                            $customerName,$paymentTerms, $dates){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("insertDocument(bytes,bytes,bytes,bytes3,bytes,bytes,bytes,uint256,bytes)");
        // argumentos en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        $hexInvoiceNumber = $utils-> stringToHex($invoiceNumber);
        $hexTotal = $utils-> stringToHex($total);
        $hexCurrency = $utils-> stringToHex($currency);
        $hexPaymentType = $utils-> stringToHex($paymentType);
        $hexSupplierName = $utils-> stringToHex($supplierName);
        $hexCustomerName = $utils-> stringToHex($customerName);
        $hexPaymentTerms = $utils-> stringToHex($paymentTerms);
        $hexDates = $utils-> stringToHex($dates);
        //tamaño de los argumentos dinamicos(bytes) sin dezplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        $rawHexInvoiceNumberLength = strlen($hexInvoiceNumber)/2;
        $hexInvoiceNumberLengthPad = str_pad(dechex($rawHexInvoiceNumberLength), 64, "0", STR_PAD_LEFT);
        $rawHexTotalLength = strlen($hexTotal)/2;
        $hexTotalLengthPad = str_pad(dechex($rawHexTotalLength), 64, "0", STR_PAD_LEFT);
        $rawHexPaymentTypeLength = strlen($hexPaymentType)/2;
        $hexPaymentTypeLengthPad = str_pad(dechex($rawHexPaymentTypeLength), 64, "0", STR_PAD_LEFT);
        $rawHexSupplierNameLength = strlen($hexSupplierName )/2;
        $hexSupplierNameLengthPad = str_pad(dechex($rawHexSupplierNameLength), 64, "0", STR_PAD_LEFT);
        $rawHexCustomerNameLength = strlen($hexCustomerName )/2;
        $hexCustomerNameLengthPad = str_pad(dechex($rawHexCustomerNameLength), 64, "0", STR_PAD_LEFT);
        $rawHexDatesLength = strlen($hexDates)/2;
        $hexDatesLengthPad = str_pad(dechex($rawHexDatesLength), 64, "0", STR_PAD_LEFT);
        //tamaño de los argumentos dinamicos(bytes) en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        $hexInvoiceNumberLength32 = $utils->lengthBytesOnBlocksOf32($hexInvoiceNumber);
        $hexTotalLength32 = $utils->lengthBytesOnBlocksOf32($hexTotal);
        $hexPaymentTypeLength32 = $utils->lengthBytesOnBlocksOf32($hexPaymentType);
        $hexSupplierNameLength32 = $utils->lengthBytesOnBlocksOf32($hexSupplierName);
        $hexCustomerNameLength32 = $utils->lengthBytesOnBlocksOf32($hexCustomerName);
        $hexDatesLength32 = $utils->lengthBytesOnBlocksOf32($hexDates);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*9), 64, "0", STR_PAD_LEFT);//numero de argumentos
        $offsetInvoiceNumber =str_pad(dechex(32*9 +32+$hexDocumentUniqueIdLength32), 64, "0", STR_PAD_LEFT);
        $offsetTotal =str_pad(dechex(32*9 +32+$hexDocumentUniqueIdLength32 +32+$hexInvoiceNumberLength32), 64, "0", STR_PAD_LEFT);
        $offsetPaymentType =str_pad(dechex(32*9 +32+$hexDocumentUniqueIdLength32 +32+$hexInvoiceNumberLength32 +32+$hexTotalLength32), 64, "0", STR_PAD_LEFT);
        $offsetSupplierName =str_pad(dechex(32*9 +32+$hexDocumentUniqueIdLength32 +32+$hexInvoiceNumberLength32 +32+$hexTotalLength32 +32+$hexPaymentTypeLength32), 64, "0", STR_PAD_LEFT);
        $offsetCustomerName =str_pad(dechex(32*9 +32+$hexDocumentUniqueIdLength32 +32+$hexInvoiceNumberLength32 +32+$hexTotalLength32 +32+$hexPaymentTypeLength32+32+$hexSupplierNameLength32), 64, "0", STR_PAD_LEFT);
        $offsetDates =str_pad(dechex(32*9 +32+$hexDocumentUniqueIdLength32 +32+$hexInvoiceNumberLength32 +32+$hexTotalLength32 +32+$hexPaymentTypeLength32+32+$hexSupplierNameLength32 +32+$hexCustomerNameLength32), 64, "0", STR_PAD_LEFT);
        //argumentos no dinamicos desplazados
        $hexCurrencyPad = str_pad($hexCurrency, 64, "0");
        $hexPaymentTermsPad = str_pad($hexPaymentTerms, 64, "0");
        //argumentos dinamicos completados con ceros
        $hexDocumentUniqueIdFull = str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        $hexInvoiceNumberFull = str_pad($hexInvoiceNumber,  $hexInvoiceNumberLength32*2 , "0");
        $hexTotalFull = str_pad($hexTotal,  $hexTotalLength32*2 , "0");
        $hexPaymentTypeFull = str_pad($hexPaymentType,  $hexPaymentTypeLength32*2 , "0");
        $hexSupplierNameFull = str_pad($hexSupplierName,  $hexSupplierNameLength32*2 , "0");
        $hexCustomerNameFull = str_pad($hexCustomerName,  $hexCustomerNameLength32*2 , "0");
        $hexDatesFull = str_pad($hexDates,  $hexDatesLength32*2 , "0");

        $bytecode=$signature.
            $offsetDocumentUniqueID.$offsetInvoiceNumber.$offsetTotal.$hexCurrencyPad.$offsetPaymentType.  // argumentos no dinamicos y offsets de los dinamicos
            $offsetSupplierName.$offsetCustomerName.$hexPaymentTermsPad.$offsetDates.
            $hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull.             //argumentos dinamicos
            $hexInvoiceNumberLengthPad.$hexInvoiceNumberFull.
            $hexTotalLengthPad.$hexTotalFull.
            $hexPaymentTypeLengthPad.$hexPaymentTypeFull.
            $hexSupplierNameLengthPad.$hexSupplierNameFull.
            $hexCustomerNameLengthPad.$hexCustomerNameFull.
            $hexDatesLengthPad.$hexDatesFull;
        $answer = $utils->curlRequestSendTransaction($bytecode);
        return $answer['result'];
    }


    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------CHECKS-------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//function exists(bytes documentUniqueId) returns(bool)
    function exists($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("exists(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000001
        $arg = substr($result,65);//
       if ($arg=="1"){
            return true;
        }else{
            return false;
        }
    }
//function documentIsPending(bytes documentUniqueId) returns(bool)
    function documentIsPending($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("documentIsPending(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000001
        $arg = substr($result,65);//
        if ($arg=="1"){
            return true;
        }else{
            return false;
        }
    }
//function documentIsAccepted(bytes documentUniqueId) returns(bool)
    function documentIsAccepted($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("documentIsAccepted(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000001
        $arg = substr($result,65);//
        if ($arg=="1"){
            return true;
        }else{
            return false;
        }
    }
//function documentFactoringIsPending(bytes documentUniqueId) returns(bool)
    function documentFactoringIsPending($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("documentFactoringIsPending(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000001
        $arg = substr($result,65);//
        if ($arg=="1"){
            return true;
        }else{
            return false;
        }
    }
//function documentFactoringIsRequested(bytes documentUniqueId) returns(bool)
    function documentFactoringIsRequested($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("documentFactoringIsRequested(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000001
        $arg = substr($result,65);//
        if ($arg=="1"){
            return true;
        }else{
            return false;
        }
    }
//function documentFactoringIsAccepted(bytes documentUniqueId) returns(bool)
    function documentFactoringIsAccepted($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("documentFactoringIsAccepted(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000001
        $arg = substr($result,65);//
        if ($arg=="1"){
            return true;
        }else{
            return false;
        }
    }
//function documentIsPaid(bytes documentUniqueId) returns(bool success)
    function documentIsPaid($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("documentIsPaid(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000001
        $arg = substr($result,65);//
        if ($arg=="1"){
            return true;
        }else{
            return false;
        }
    }

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------SETTERS------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//function setFactoringTotal(bytes documentUniqueId, bytes factoringTotal)
    function setFactoringTotal($documentUniqueId,$factoringTotal){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setFactoringTotal(bytes,bytes)");
        // argumentos en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        $hexFactoringTotal = $utils-> stringToHex($factoringTotal);
        //tamaño de los argumentos sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        $rawHexFactoringTotalLength = strlen($hexFactoringTotal)/2;
        $hexFactoringTotalLengthPad = str_pad(dechex($rawHexFactoringTotalLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        $hexFactoringTotalLength32 = $utils->lengthBytesOnBlocksOf32($hexFactoringTotal);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueId = str_pad(dechex(32*2), 64, "0", STR_PAD_LEFT);//numero de argumentos
        $offsetFactoringTotal = str_pad(dechex(32*2+32+$hexDocumentUniqueIdLength32), 64, "0", STR_PAD_LEFT);//numero de argumentos + offset id y id
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        $hexFactoringTotalFull= str_pad($hexFactoringTotal,  $hexFactoringTotalLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueId.$offsetFactoringTotal.
            $hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull.$hexFactoringTotalLengthPad.$hexFactoringTotal;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];
    }
//function setFactoringExpirationDate(bytes documentUniqueId, bytes19 factoringExpirationDate)
    function setFactoringExpirationDate($documentUniqueId,$factoringExpirationDate)
    {
        $utils = new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setFactoringExpirationDate(bytes,bytes19)");
        // argumentos en hexadecimal
        $hexDocumentUniqueId = $utils->stringToHex($documentUniqueId);
        $hexFactoringExpirationDate = $utils->stringToHex($factoringExpirationDate);
        //tamaño del argumento dinamico sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId) / 2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento dinamico en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueId = str_pad(dechex(32 * 2), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull = str_pad($hexDocumentUniqueId, $hexDocumentUniqueIdLength32 * 2, "0");
        //argumentos no dinamicos desplazados
        $hexFactoringExpirationDatePad = str_pad($hexFactoringExpirationDate, 64, "0");
        //llamada al nodo
        $bytecode = $signature . $offsetDocumentUniqueId . $hexFactoringExpirationDatePad .
            $hexDocumentUniqueIdLengthPad . $hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];
    }
//function setFinancialInstitutionName(bytes documentUniqueId, bytes financialInstitutionName)
    function setFinancialInstitutionName($documentUniqueId,$financialInstitutionName){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setFinancialInstitutionName(bytes,bytes)");
        // argumentos en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        $hexFinancialInstitutionName = $utils-> stringToHex($financialInstitutionName);
        //tamaño de los argumentos sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        $rawHexFinancialInstitutionNameLength = strlen($hexFinancialInstitutionName)/2;
        $hexFinancialInstitutionNameLengthPad = str_pad(dechex($rawHexFinancialInstitutionNameLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        $hexFinancialInstitutionNameLength32 = $utils->lengthBytesOnBlocksOf32($hexFinancialInstitutionName);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueId = str_pad(dechex(32*2), 64, "0", STR_PAD_LEFT);//numero de argumentos
        $offsetFinancialInstitutionName = str_pad(dechex(32*2+32+$hexDocumentUniqueIdLength32), 64, "0", STR_PAD_LEFT);//numero de argumentos + offset id y id
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        $hexFactoringTotalFull= str_pad($hexFinancialInstitutionName,  $hexFinancialInstitutionNameLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueId.$offsetFinancialInstitutionName.
            $hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull.$hexFinancialInstitutionName.$hexFinancialInstitutionName;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];
    }
//function setPaymentDate(bytes documentUniqueId, bytes19 paymentDate)
    function setPaymentDate($documentUniqueId,$paymentDate){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setPaymentDate(bytes,bytes19)");
        // argumentos en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        $hexPaymentDate = $utils-> stringToHex($paymentDate);
        //tamaño del argumento dinamico sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento dinamico en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueId = str_pad(dechex(32*2), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //argumentos no dinamicos desplazados
        $hexPaymentDatePad = str_pad($hexPaymentDate, 64, "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueId.$hexPaymentDatePad.
            $hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];
    }

    /*-----------------------------------------------------------------------------------------*/
    /*-----------------------------------SETTERS ESTADOS---------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//function setStateAcceptedFromPending(bytes documentUniqueId)
    function setStateAcceptedFromPending($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setStateAcceptedFromPending(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];

    }
//function setStatePaidFromAccepted(bytes documentUniqueId)
    function setStatePaidFromAccepted($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setStatePaidFromAccepted(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];

    }
//function setFactoringStateRequested(bytes documentUniqueId)
    function setFactoringStateRequested($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setFactoringStateRequested(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];

    }
//function setFactoringStateAcceptedFromRequested(bytes documentUniqueId)
    function setFactoringStateAcceptedFromRequested($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setFactoringStateAcceptedFromRequested(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];

    }

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------SETTERS ESTADOS PLUS INFO------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

// function setStatePaidFromAcceptedPlusInfo(bytes documentUniqueId,bytes19 paymentDate)
    function setStatePaidFromAcceptedPlusInfo($documentUniqueId,$paymentDate){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setStatePaidFromAcceptedPlusInfo(bytes,bytes19)");
        // argumentos en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        $hexPaymentDate = $utils-> stringToHex($paymentDate);
        //tamaño del argumento dinamico sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*2), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //argumento no dinamico desplazado
        $hexPaymentDatePad = str_pad($hexPaymentDate, 64, "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexPaymentDatePad.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];

    }

//function setFactoringStateAcceptedFromRequestedPlusInfo(bytes documentUniqueId, bytes factoringTotal,
// bytes19 factoringExpirationDate, bytes financialInstitutionName)
    function setFactoringStateAcceptedFromRequestedPlusInfo($documentUniqueId,
     $factoringTotal, $factoringExpirationDate, $financialInstitutionName){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("setFactoringStateAcceptedFromRequested(bytes)");
        // argumentos en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        $hexFactoringTotal = $utils-> stringToHex($factoringTotal);
        $hexFactoringExpirationDate = $utils-> stringToHex($factoringExpirationDate);
        $hexFinancialInstitutionName = $utils-> stringToHex($financialInstitutionName);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        $rawHexFactoringTotalLength = strlen($hexFactoringTotal)/2;
        $hexFactoringTotalLengthPad = str_pad(dechex($rawHexFactoringTotalLength), 64, "0", STR_PAD_LEFT);
        $rawHexFinancialInstitutionNameLength = strlen($hexFinancialInstitutionName)/2;
        $hexFinancialInstitutionNameLengthPad = str_pad(dechex($rawHexFinancialInstitutionNameLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        $hexFactoringTotalLength32 = $utils->lengthBytesOnBlocksOf32($hexFactoringTotal);
        $hexFinancialInstitutionNameLength32 = $utils->lengthBytesOnBlocksOf32($hexFinancialInstitutionName);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*4), 64, "0", STR_PAD_LEFT);//numero de argumentos
        $offsetFactoringTotal = str_pad(dechex(32*4 +32+$hexDocumentUniqueIdLength32), 64, "0", STR_PAD_LEFT);//numero de argumentos
        $offsetFinancialInstitutionName = str_pad(dechex(32*4+32+$hexDocumentUniqueIdLength32+32+$hexFinancialInstitutionNameLength32), 64, "0", STR_PAD_LEFT);//numero de argumentos

        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        $hexFactoringTotalFull= str_pad($hexFactoringTotal,  $hexFactoringTotalLength32*2 , "0");
        $hexFinancialInstitutionNameFull= str_pad($hexFinancialInstitutionName,  $hexFinancialInstitutionNameLength32*2 , "0");
        //argumento no dinamico desplazado
        $hexFactoringExpirationDatePad = str_pad($hexFactoringExpirationDate, 64, "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$offsetFactoringTotal.$hexFactoringExpirationDatePad.$offsetFinancialInstitutionName.
            $hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull.$hexFactoringTotalLengthPad.$hexFactoringTotalFull.
            $hexFinancialInstitutionNameLengthPad.$hexFinancialInstitutionNameFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];

    }

    /*-----------------------------------------------------------------------------------------*/
    /*-----------------------------------DELETE & INDEX----------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//function deleteDocument(bytes documentUniqueId)
    function deleteDocument($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("deleteDocument(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $hashTx = $utils->curlRequestSendTransaction($bytecode);
        return $hashTx['result'];

    }
//function getDocumentCount() returns(uint count)
    function getDocumentCount()
    {
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getDocumentCount()");
        $bytecode= $signature;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000004  la respuesta en hex
        $argResult = substr($result, 2);// eliminar 0x
        return hexdec($argResult);
    }
//function getDocumentAtIndex(uint index)returns(bytes documentUniqueId)
    function getDocumentAtIndex($index){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getDocumentAtIndex(uint256)");
        //index desplasado 32 bytes
        $indexPad =str_pad($index, 64, "0", STR_PAD_LEFT);
        //llamada al nodo
        $bytecode=$signature.$indexPad;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020 indica donde empieza la definicion de la respuesta(a los 32 B)
        //0000000000000000000000000000000000000000000000000000000000000040 indica el tamaño de la respuesta(0x40-> 64 B -> 128 caracteres)
        //6636343436613831616566613436613165323537383535663262623935356563 la respuesta en hex
        //3037313830616439366334376263383562386661663236353662393138343539

        $lenghtAndArgResult = substr($result,66);// string con la longitud de la respuesta y la respuesta
        $lenghtResult= substr($lenghtAndArgResult,0,64);// logitud del resultado
        $argResult=substr($lenghtAndArgResult,64,hexdec($lenghtResult)*2); // argumento

        return $utils->HexToString($argResult);
    }


    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------GETTERS------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//function getInvoiceNumber(bytes documentUniqueId) returns(bytes invoiceNumber)
    function getInvoiceNumber($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getInvoiceNumber(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        //return $utils->curlRequestCall($bytecode);
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getTotal(bytes documentUniqueId) returns(bytes total)
    function getTotal($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getTotal(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getFactoringTotal(bytes documentUniqueId) returns(bytes factoringTotal)
    function getFactoringTotal($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getFactoringTotal(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getState(bytes documentUniqueId) returns(bytes8 state)
    function getState($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getState(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x6163636570746564000000000000000000000000000000000000000000000000
        return $utils->hexToString(trim(substr($result,2),"0"));
    }
//function getCurrency(bytes documentUniqueId) returns(bytes3 currency)
    function getCurrency($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getCurrency(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x6163636570746564000000000000000000000000000000000000000000000000
        return $utils->hexToString(trim(substr($result,2),"0"));
    }
//function getPaymentType(bytes documentUniqueId) returns(bytes paymentTypel)
    function getPaymentType($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getPaymentType(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;

        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getSupplierName(bytes documentUniqueId) returns(bytes supplierName)
    function getSupplierName($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getSupplierName(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getCustomerName(bytes documentUniqueId) returns(bytes customerName)
    function getCustomerName($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getCustomerName(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getFinancialInstitutionName(bytes documentUniqueId) returns(bytes financialInstitutionName)
    function getFinancialInstitutionName($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getFinancialInstitutionName(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getFactoringState(bytes documentUniqueId) returns(bytes14 factoringState)
    function getFactoringState($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getFactoringState(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x6163636570746564000000000000000000000000000000000000000000000000
        return $utils->hexToString(trim(substr($result,2),"0"));
    }
//function getPaymentTerms(bytes documentUniqueId) returns(bytes paymentTerms)
    function getPaymentTerms($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getPaymentTerms(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
//llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        //0x
        //0000000000000000000000000000000000000000000000000000000000000004  la respuesta en hex
        $argResult = substr($result, 2);// eliminar 0x
        return hexdec($argResult);
    }

//function getDates(bytes documentUniqueId) returns(bytes dates)
    function getDates($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getDates(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
//llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x
        //0000000000000000000000000000000000000000000000000000000000000020  offset
        //000000000000000000000000000000000000000000000000000000000000000e tamaño de la respuesta
        //696e766f696365206e756d626572000000000000000000000000000000000000  respuesta
        $arg = substr($result,66);// eliminar 0x y offset
        $lenghtArg= substr($arg,0,64);// logitud del resultado
        $clean=substr($arg,64,hexdec($lenghtArg)*2); //limpiar ceros
        return $utils->hexToString($clean);
    }
//function getFactoringExpirationDate(bytes documentUniqueId) returns(bytes19 factoringExpirationDate)
    function getFactoringExpirationDate($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getFactoringExpirationDate(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x6163636570746564000000000000000000000000000000000000000000000000
        return $utils->hexToString(trim(substr($result,2),"0"));
    }
//function getPaymentDate(bytes documentUniqueId) returns(bytes19 paymentDate)
    function getPaymentDate($documentUniqueId){
        $utils= new Utils();
        // firma del metodo
        $signature = $utils->hexMethodSignature("getPaymentDate(bytes)");
        // argumento en hexadecimal
        $hexDocumentUniqueId = $utils-> stringToHex($documentUniqueId);
        //tamaño del argumento sin desplazar y desplazado
        $rawHexDocumentUniqueIdLength = strlen($hexDocumentUniqueId)/2;
        $hexDocumentUniqueIdLengthPad = str_pad(dechex($rawHexDocumentUniqueIdLength), 64, "0", STR_PAD_LEFT);
        //tamaño del argumento en bloques de 32 bytes
        $hexDocumentUniqueIdLength32 = $utils->lengthBytesOnBlocksOf32($hexDocumentUniqueId);
        //offset argumentos dinamicos(bytes)
        $offsetDocumentUniqueID = str_pad(dechex(32*1), 64, "0", STR_PAD_LEFT);//numero de argumentos
        //argumento dinamico completados con ceros
        $hexDocumentUniqueIdFull= str_pad($hexDocumentUniqueId,  $hexDocumentUniqueIdLength32*2 , "0");
        //llamada al nodo
        $bytecode=$signature.$offsetDocumentUniqueID.$hexDocumentUniqueIdLengthPad.$hexDocumentUniqueIdFull;
        $answer = $utils->curlRequestCall($bytecode);
        $result=$answer['result'];
        // ejemplo de resultado
        //0x6163636570746564000000000000000000000000000000000000000000000000
        return $utils->hexToString(trim(substr($result,2),"0"));
    }

}