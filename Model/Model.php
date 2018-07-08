<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 08/05/2018
 * Time: 17:37
 */

namespace AppBundle\Model;
use AppBundle\Model\AccessContractModel;
use AppBundle\Model\AccessContract;
use AppBundle\Model\Utils;


class Model
{
    function checkConection(){
        $utils = new Utils();
        if($utils->curlCheckNetConection()){
            return ['status'=>'CONNECTED'];
        }else{
            return ['status'=>'NOT_CONNECTED'];
        }
    }

    function checkSync(){
        $utils = new Utils();
        if($utils->curlCheckNetSync()){
            return ['status'=>'NODE_SYNC'];
        }else{
            return ['status'=>'NODE_NOT_SYNC'];
        }
    }

    function checkTransaction($hashTx){
        $utils = new Utils();
        $result =$utils->curlCheckTransaction($hashTx);
        if($utils->curlCheckNetConection()){

        if($result['status']=='0x1') {
            $status = 'SUCCESS';
           }else{
            $status = 'FAILURE';
        }
        $hashTx=$result['transactionHash'];
        $gasUsed=hexdec(trim(substr($result['gasUsed'],2),"0"));
        $blockNumber=hexdec(trim(substr($result['blockNumber'],2),"0"));
        $blockHash=$result['blockHash'];
        return ['status'=>$status,'hashTx'=>$hashTx,'gasUsed'=>$gasUsed,'blockNumber'=>$blockNumber,'blockHash'=>$blockHash];

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------INSERT-------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    // nuevo documento sin factoringTotal, factorinExpirationDate, financialInstitutionName y paymentDate
    function insertNewDocument($invoiceNumber,$fiscalYear,$total ,$currency,$paymentType,
                               $supplierName,$customerName,$paymentTerms,
                               $invoiceDate,$expirationDate){
        $contract = new AccessContract();
        $utils = new Utils();
        $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);

        if($utils->curlCheckNetConection()){

                if(!($contract->exists($documentUniqueId))){
                     $dates = $fiscalYear . "-" . $invoiceDate . "-" . $expirationDate; //(FYFY-AAAA/MM/DD HH:MM:SS-AAAA/MM/DD HH:MM:SS)
                    $hashTx = $contract->insertDocument($documentUniqueId, $invoiceNumber, $total, $currency, $paymentType,
                        $supplierName, $customerName, $paymentTerms, $dates);
                    return ['documentUniqueId' => $documentUniqueId, 'hashTx' => $hashTx,'invoiceNumber'=>$invoiceNumber
                    ,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
                }else{
                    return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_ALREADY_EXIST',
                        'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
                }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------CHECKS-------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//exists
    function exists($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear)
    {
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        $answer = $contract->exists($documentUniqueId);
        return ['documentUniqueId' => $documentUniqueId,"exists" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//documentIsPending
    function documentIsPending($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear)
    {
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){
        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->documentIsPending($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"documentIsPending" => $answer,
            'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//documentIsAccepted
    function documentIsAccepted($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear)
    {
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->documentIsAccepted($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"documentIsAccepted" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//documentFactoringIsPending
    function documentFactoringIsPending($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear)
    {
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->documentFactoringIsPending($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"documentFactoringIsPending" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//documentFactoringIsRequested
    function documentFactoringIsRequested($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear)
    {
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->documentFactoringIsRequested($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"documentFactoringIsRequested" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//documentFactoringIsAccepted
    function documentFactoringIsAccepted($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear)
    {
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->documentFactoringIsAccepted($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"documentFactoringIsAccepted" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//documentIsPaid
    function documentIsPaid($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear)
    {
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->documentIsPaid($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"documentIsPaid" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------SETTERS------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//setFactoringTotal requiere factoring accepted
    function setFactoringTotal($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear,$factoringTotal){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentFactoringIsAccepted($documentUniqueId)){
                $hashTx = $contract->setFactoringTotal($documentUniqueId,$factoringTotal);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,'factoringTotal'=>$factoringTotal,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_FACTORING_NOT_ACCEPTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//setFactoringExpirationDate requiere factoring accepted
    function setFactoringExpirationDate($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear,$factoringExpirationDate){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentFactoringIsAccepted($documentUniqueId)){
                $hashTx = $contract->setFactoringExpirationDate($documentUniqueId,$factoringExpirationDate);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,'factoringExpirationDate'=>$factoringExpirationDate,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_FACTORING_NOT_ACCEPTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//setFinancialInstitutionName requiere factoring accepted
    function setFinancialInstitutionName($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear,$financialInstitutionName){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentFactoringIsAccepted($documentUniqueId)){
                $hashTx = $contract->setFinancialInstitutionName($documentUniqueId,$financialInstitutionName);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,'financialInstitutionName'=>$financialInstitutionName,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_FACTORING_NOT_ACCEPTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//setPaymentDate requiere paid
    function setPaymentDate($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear,$paymentDate){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentIsPaid($documentUniqueId)){
                $hashTx = $contract->setPaymentDate($documentUniqueId,$paymentDate);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,'paymentDate'=>$paymentDate,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_NOT_PAID',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
    /*-----------------------------------------------------------------------------------------*/
    /*-----------------------------------SETTERS ESTADOS---------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//setStateAcceptedFromPending requiere pending
    function setStateAcceptedFromPending($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentIsPending($documentUniqueId)){
                $hashTx = $contract->setStateAcceptedFromPending($documentUniqueId);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_NOT_PENDING',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//setStatePaidfFromAccepted requiere accepted
    function setStatePaidfFromAccepted($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentIsAccepted($documentUniqueId)){
                $hashTx = $contract->setStatePaidFromAccepted($documentUniqueId);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_NOT_ACCEPTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//setFactoringStateRequested requiere factoring pending
    function setFactoringStateRequested($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentFactoringIsPending($documentUniqueId)){
                $hashTx = $contract->setFactoringStateRequested($documentUniqueId);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_NOT_FACTORING_ACCEPTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//setFactoringStateAcceptedFromRequested requiere factoring requested
    function setFactoringStateAcceptedFromRequested($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentFactoringIsRequested($documentUniqueId)){
                $hashTx = $contract->setFactoringStateAcceptedFromRequested($documentUniqueId);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_NOT_FACTORING_REQUESTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------SETTERS ESTADOS PLUS INFO------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//setStatePaidFromAcceptedPlusInfo requiere accepted
    function setStatePaidFromAcceptedPlusInfo($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear,$paymentDate){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentIsAccepted($documentUniqueId)){
                $hashTx = $contract->setStatePaidFromAcceptedPlusInfo($documentUniqueId,$paymentDate);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,'paymentDate'=>$paymentDate,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_NOT_ACCEPTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }

//setFactoringStateAcceptedFromRequestedPlusInfo requiere factoring requested
    function setFactoringStateAcceptedFromRequestedPlusInfo($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear,
       $factoringTotal, $factoringExpirationDate, $financialInstitutionName){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            if($contract->documentFactoringIsRequested($documentUniqueId)){
                $hashTx = $contract->setFactoringStateAcceptedFromRequestedPlusInfo($documentUniqueId,$factoringTotal,
                    $factoringExpirationDate, $financialInstitutionName);
                return ['documentUniqueId' => $documentUniqueId,'hashTx'=>$hashTx,'factoringTotal'=>$factoringTotal
                    ,'factoringExpirationDate'=> $factoringExpirationDate, 'financialInstitutionName'=> $financialInstitutionName,
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }else{
                return ['documentUniqueId' => $documentUniqueId,'error' =>'DOCUMENT_NOT_FACTORING_REQUESTED',
                    'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
            }
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }

    /*-----------------------------------------------------------------------------------------*/
    /*-----------------------------------DELETE & INDEX----------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

//deleteDocument
    function deleteDocument($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $hashTx= $contract->deleteDocument($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"hashTx" => $hashTx,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getDocumentCount
    function getDocumentCount(){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        return ['Count'=>$contract->getDocumentCount()];

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getDocumentIdAtIndex
    function getDocumentIdAtIndex($index){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        return ['documentUniqueId' => $contract->getDocumentAtIndex($index)];

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getAllDocumentId
    function getAllDocumentId(){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        $count =$contract->getDocumentCount();
        $data =array();
        for ($i=0;$i<$count;$i++){
            $id=$contract->getDocumentAtIndex($i);
            array_push($data,$id);
        }
        return $data;

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------GETTERS------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

// getInvoiceNumber
    function getInvoiceNumber($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getInvoiceNumber($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"InvoiceNumber" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getTotal
    function getTotal($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer =  $contract->getTotal($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"Total" => $answer,
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getFactoringTotal
    function getFactoringTotal($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getFactoringTotal($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"FactoringTotal" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getState
    function getState($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getState($documentUniqueId);;
            return ['documentUniqueId' => $documentUniqueId,"State" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getCurrency
    function getCurrency($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getCurrency($documentUniqueId);;
            return ['documentUniqueId' => $documentUniqueId,"Currency" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getPaymentType
    function getPaymentType($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getPaymentType($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,'PaymentType' => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getSupplierName
    function getSupplierName($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getSupplierName($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"SupplierName" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getCustomerName
    function getCustomerName($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getCustomerName($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"CustomerName" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getFinancialInstitutionName
    function getFinancialInstitutionName($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getFinancialInstitutionName($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"FinancialInstitutionName" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getFactoringState
    function getFactoringState($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getFactoringState($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"FactoringState" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getPaymentTerms
    function getPaymentTerms($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getPaymentTerms($documentUniqueId);;
            return ['documentUniqueId' => $documentUniqueId,"PaymentTerms" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//function getDates(bytes documentUniqueId) returns(bytes dates)
//getFiscalYear
    function getFiscalYear($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $dates= $contract->getDates($documentUniqueId);
            $answer= substr($dates,0,4);
            return ['documentUniqueId' => $documentUniqueId,"FiscalYear" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getInvoiceDate
    function getInvoiceDate($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $dates= $contract->getDates($documentUniqueId);
            $answer= substr($dates,5,19);
            return ['documentUniqueId' => $documentUniqueId,"InvoiceDate" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getExpirationDate
    function getExpirationDate($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $dates= $contract->getDates($documentUniqueId);
            $answer= substr($dates,25,19);
            return ['documentUniqueId' => $documentUniqueId,"ExpirationDate" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getFactoringExpirationDate
    function getFactoringExpirationDate($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getFactoringExpirationDate($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"FactoringExpirationDate" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }
    }
//getPaymentDate
    function getPaymentDate($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            $answer = $contract->getPaymentDate($documentUniqueId);
            return ['documentUniqueId' => $documentUniqueId,"PaymentDate" => $answer,
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'$total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }
//getAll
    function getAll($id,$invoiceNumber, $total, $supplierName, $customerName,$fiscalYear){
        $contract = new AccessContract();
        $utils = new Utils();
        if($utils->curlCheckNetConection()){

        if(($id=="")){
            $documentUniqueId = $utils->generateId($invoiceNumber, $total, $supplierName, $customerName,$fiscalYear);
        }else{
            $documentUniqueId = $id;
        }
        if($contract->exists($documentUniqueId)){
            return ['documentUniqueId' => $documentUniqueId,
                'InvoiceNumber'=> $contract->getInvoiceNumber($documentUniqueId),
                'Total'=> $contract->getTotal($documentUniqueId),
                'FactoringTotal'=> $contract->getFactoringTotal($documentUniqueId),
                'State'=> $contract->getState($documentUniqueId),
                'Currency'=> $contract->getCurrency($documentUniqueId),
                'PaymentType'=> $contract->getPaymentType($documentUniqueId),
                'SupplierName'=> $contract->getSupplierName($documentUniqueId),
                'CustomerName'=> $contract->getCustomerName($documentUniqueId),
                'CustomerName'=> $contract->getCustomerName($documentUniqueId),
                'FinancialInstitutionName'=> $contract->getFinancialInstitutionName($documentUniqueId),
                'FactoringState'=> $contract->getFactoringState($documentUniqueId),
                'PaymentTerms'=> $contract->getPaymentTerms($documentUniqueId),
                'FiscalYear'=> substr($contract->getDates($documentUniqueId),0,4),
                'InvoiceDate'=> substr($contract->getDates($documentUniqueId),5,19),
                'ExpirationDate'=> substr($contract->getDates($documentUniqueId),25,19),
                'FactoringExpirationDate' => $contract->getFactoringExpirationDate($documentUniqueId) ,
                'PaymentDate' => $contract->getPaymentDate($documentUniqueId),
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }else{
            return ['documentUniqueId' => $documentUniqueId,'error' =>'ID_NOT_EXISTS',
                'invoiceNumber'=>$invoiceNumber,'total'=>$total,'supplierName'=>$supplierName,'customerName'=>$customerName,"fiscalYear"=>$fiscalYear];
        }

        }else{
            return ['error' =>'NOT_NETWORK_CONNECTION'];
        }

    }

}