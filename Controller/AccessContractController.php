<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 15/01/2018
 * Time: 13:13
 */

namespace AppBundle\Controller;


use AppBundle\Model\AccessContractModel;
use AppBundle\Model\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class AccessContractController extends FOSRestController
{

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------INSERT-------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Post("/documents")
     */
    function insertDocument(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $fiscalYear = $request->get('fiscalYear');
        $total = $request->get('total');
        $currency =$request->get('currency');
        $paymentType=$request->get('paymentType');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $paymentTerms=$request->get('paymentTerms');
        $invoiceDate=$request->get('invoiceDate');
        $expirationDate=$request->get('expirationDate');
        return $model->insertNewDocument($invoiceNumber,$fiscalYear,$total,$currency,$paymentType,
            $supplierName,$customerName,$paymentTerms,$invoiceDate,$expirationDate);
    }

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------CHECKS-------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Get("/documents/{id}/exists")
     */
    function exists($id){
        $model= new Model();
        return $model->exists($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/exists")
     */
    function existsData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->exists("",$invoiceNumber ,$total, $supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/pending")
     */
    function documentIsPending($id){
        $model= new Model();
        return $model->documentIsPending($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/pending")
     */
    function documentIsPendingData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->documentIsPending("",$invoiceNumber ,$total, $supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/accepted")
     */
    function documentIsAccepted($id){
        $model= new Model();
        return $model->documentIsAccepted($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/accepted")
     */
    function documentIsAcceptedData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->documentIsAccepted("",$invoiceNumber ,$total, $supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/factoring/pending")
     */
    function documentFactoringIsPending($id){
        $model= new Model();
        return $model->documentFactoringIsPending($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/factoring/pending")
     */
    function documentFactoringIsPendingData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->documentFactoringIsPending("",$invoiceNumber ,$total, $supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/factoring/requested")
     */
    function documentFactoringIsRequested($id){
        $model= new Model();
        return $model->documentFactoringIsRequested($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/factoring/requested")
     */
    function documentFactoringIsRequestedData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->documentFactoringIsRequested("",$invoiceNumber ,$total, $supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/factoring/accepted")
     */
    function documentFactoringIsAccepted($id){
        $model= new Model();
        return $model->documentFactoringIsAccepted($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/factoring/accepted")
     */
    function documentFactoringIsAcceptedData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->documentFactoringIsAccepted("",$invoiceNumber ,$total, $supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/paid")
     */
    function documentIsPaid($id){
        $model= new Model();
        return $model->documentIsPaid($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/paid")
     */
    function documentIsPaidData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->documentIsPaid("",$invoiceNumber ,$total, $supplierName,$customerName);
    }



    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------SETTERS------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Post("/documents/{id}/factoring/total")
     */
    function setFactoringTotal($id,Request $request){
        $model= new Model();
        $factoringTotal= $request->get('factoringTotal');
        return $model->setFactoringTotal($id,"","","","",$factoringTotal);
    }
    /**
     * @Rest\Post("/documents/factoring/total")
     */
    function setFactoringTotalData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $factoringTotal= $request->get('factoringTotal');
        return $model->setFactoringTotal("",$invoiceNumber,$total,$supplierName,$customerName,$factoringTotal);
    }


    /**
     * @Rest\Post("/documents/{id}/factoring/expirationDate")
     */
    function setFactoringExpirationDate($id,Request $request){
        $model= new Model();
        $factoringExpirationDate= $request->get('factoringExpirationDate');
        return $model->setFactoringTotal($id,"","","","",$factoringExpirationDate);
    }
    /**
     * @Rest\Post("/documents/factoring/expirationDate")
     */
    function setFactoringExpirationDateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $factoringExpirationDate= $request->get('factoringExpirationDate');
        return $model->setFactoringTotal("",$invoiceNumber,$total,$supplierName,$customerName,$factoringExpirationDate);
    }


    /**
     * @Rest\Post("/documents/{id}/financialInstitutionName")
     */
    function setFinancialInstitutionName($id,Request $request){
        $model= new Model();
        $financialInstitutionName= $request->get('financialInstitutionName');
        return $model->setFinancialInstitutionName($id,"","","","",$financialInstitutionName);
    }
    /**
     * @Rest\Post("/documents/financialInstitutionName")
     */
    function setFinancialInstitutionNameData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $financialInstitutionName= $request->get('financialInstitutionName');
        return $model->setFinancialInstitutionName("",$invoiceNumber,$total,$supplierName,$customerName,$financialInstitutionName);
    }


    /**
     * @Rest\Post("/documents/{id}/paymentDate")
     */
    function setPaymentDate($id,Request $request){
        $model= new Model();
        $paymentDate = $request->get('paymentDate');
        return $model->setPaymentDate($id,"","","","",$paymentDate);
    }
    /**
     * @Rest\Post("/documents/paymentDate")
     */
    function setPaymentDateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $paymentDate = $request->get('paymentDate');
        return $model->setPaymentDate("",$invoiceNumber,$total,$supplierName,$customerName,$paymentDate);
    }


//POST /documents/{id}/state/accepted   /documents/state/accepted

//POST /documents/{id}/state/paid  /documents/state/paid

//POST /documents/{id}/state/paidPlus  /documents/state/paidPlus

//POST /documents/{id}/factoringState/requested   /documents/factoringState/requested

//POST /documents/{id}/factoringState/accepted   /documents/factoringState/accepted

//POST /documents/{id}/factoringState/acceptedPlus   /documents/factoringState/acceptedPlus
    /*-----------------------------------------------------------------------------------------*/
    /*-----------------------------------SETTERS ESTADOS---------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Post("/documents/{id}/state/accepted")
     */
    function setStateAcceptedFromPending($id){
        $model= new Model();
        return $model->setStateAcceptedFromPending($id,"","","","");
    }
    /**
     * @Rest\Post("/documents/state/accepted")
     */
    function setStateAcceptedFromPendingData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setStateAcceptedFromPending("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Post("/documents/{id}/state/paid")
     */
    function setStatePaidfFromAccepted($id){
        $model= new Model();
        return $model->setStatePaidfFromAccepted($id,"","","","");
    }
    /**
     * @Rest\Post("/documents/state/paid")
     */
    function setStatePaidfFromAcceptedData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setStatePaidfFromAccepted("",$invoiceNumber,$total,$supplierName,$customerName);
    }



    /**
     * @Rest\Post("/documents/{id}/factoringState/requested")
     */
    function setFactoringStateRequested($id){
        $model= new Model();
        return $model->setFactoringStateRequested($id,"","","","");
    }
    /**
     * @Rest\Post("/documents/factoringState/requested")
     */
    function setFactoringStateRequestedData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setFactoringStateRequested("",$invoiceNumber,$total,$supplierName,$customerName);
    }


    /**
     * @Rest\Post("/documents/{id}/factoringState/accepted")
     */
    function setFactoringStateAcceptedFromRequested($id){
        $model= new Model();
        return $model->setFactoringStateAcceptedFromRequested($id,"","","","");
    }
    /**
    * @Rest\Post("/documents/factoringState/accepted")
    */
    function setFactoringStateAcceptedFromRequestedData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setFactoringStateAcceptedFromRequested("",$invoiceNumber,$total,$supplierName,$customerName);
    }


    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------SETTERS ESTADOS PLUS INFO------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Post("/documents/{id}/state/paidPlus")
     */
    function setStatePaidfFromAcceptedPlusInfo($id,Request $request){
        $model= new Model();
        $paymentDate = $request->get('paymentDate');
        return $model->setStatePaidfFromAcceptedPlusInfo($id,"","","","",$paymentDate);
    }
    /**
     * @Rest\Post("/documents/state/paidPlus")
     */
    function setStatePaidfFromAcceptedPlusInfoData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $paymentDate = $request->get('paymentDate');
        return $model->setStatePaidfFromAcceptedPlusInfo("",$invoiceNumber,$total,$supplierName,$customerName,$paymentDate);
    }

    /**
     * @Rest\Post("/documents/{id}/factoringState/acceptedPlus")
     */
    function setFactoringStateAcceptedFromRequestedPlusInfo($id,Request $request){
        $model= new Model();
        $factoringTotal = $request->get('factoringTotal');
        $factoringExpirationDate = $request->get('factoringExpirationDate');
        $financialInstitutionName = $request->get('financialInstitutionName');
        return $model->setFactoringStateAcceptedFromRequestedPlusInfo($id,"","","","",$factoringTotal,$factoringExpirationDate,$financialInstitutionName);
    }
    /**
     * @Rest\Post("/documents/factoringState/acceptedPlus")
     */
    function setFactoringStateAcceptedFromRequestedPlusInfoData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $factoringTotal = $request->get('factoringTotal');
        $factoringExpirationDate = $request->get('factoringExpirationDate');
        $financialInstitutionName = $request->get('financialInstitutionName');
        return $model->setFactoringStateAcceptedFromRequestedPlusInfo("",$invoiceNumber,$total,$supplierName,$customerName,$factoringTotal,$factoringExpirationDate,$financialInstitutionName);
    }

    /*-----------------------------------------------------------------------------------------*/
    /*-----------------------------------DELETE & INDEX----------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Delete("/documents/{id}")
     */
    function deleteDocument($id){
        $model= new Model();
        return $model->deleteDocument($id,"","","","");
    }
    /**
     * @Rest\Delete("/documents")
     */
    function deleteDocumentData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->deleteDocument("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/count")
     */
    public function getDocumentCount()
    {
        $model= new Model();
        return $model->getDocumentCount();
    }

    /**
     * @Rest\Get("/documents/{index}")
     */
    public function getDocumentIdAtIndex($index)
    {
        $model= new Model();
        return $model->getDocumentIdAtIndex($index);
    }

    /**
     * @Rest\Get("/documents/ids")
     */
    public function getAllDocumentId()
    {
        $model= new Model();
        return $model->getAllDocumentId();
    }

//GET /documents/{id}/<DATO>  /documents/<DATO>

//GET /documents/{id}/all  /documents/all

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------GETTERS------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Get("/documents/{id}/invoiceNumber")
     */
    function getInvoiceNumber($id){
        $model= new Model();
        return $model->getInvoiceNumber($id,"","","","");
    }
    /**
     * @Rest\Get("/documents/invoiceNumber")
     */
    function getInvoiceNumberData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getInvoiceNumber("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/total")
     */
    function getTotal($id){
        $model= new Model();
        return $model->getTotal($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/total")
    */
    function getTotalData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getTotal("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/factoringTotal")
     */
    function getFactoringTotal($id){
        $model= new Model();
        return $model->getFactoringTotal($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/factoringTotal")
    */
    function getFactoringTotalData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFactoringTotal("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/state")
     */
    function getState($id){
        $model= new Model();
        return $model->getState($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/state")
    */
    function getStateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getState("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/currency")
     */
    function getCurrency($id){
        $model= new Model();
        return $model->getCurrency($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/currency")
    */
    function getCurrencyData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getCurrency("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/paymentType")
     */
    function getPaymentType($id){
        $model= new Model();
        return $model->getPaymentType($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/paymentType")
    */
    function getPaymentTypeData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getPaymentType("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/supplierName")
     */
    function getSupplierName($id){
        $model= new Model();
        return $model->getSupplierName($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/supplierName")
    */
    function getSupplierNameData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getSupplierName("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/customerName")
     */
    function getCustomerName($id){
        $model= new Model();
        return $model->getCustomerName($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/customerName")
    */
    function getCustomerNameData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getCustomerName("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/financialInstitutionName")
     */
    function getFinancialInstitutionName($id){
        $model= new Model();
        return $model->getFinancialInstitutionName($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/financialInstitutionName")
    */
    function getFinancialInstitutionNameData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFinancialInstitutionName("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/factoringState")
     */
    function getFactoringState($id){
        $model= new Model();
        return $model->getFactoringState($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/factoringState")
    */
    function getFactoringStateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFactoringState("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/paymentTerms")
     */
    function getPaymentTerms($id){
        $model= new Model();
        return $model->getPaymentTerms($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/paymentTerms")
    */
    function getPaymentTermsData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getPaymentTerms("",$invoiceNumber,$total,$supplierName,$customerName);
    }


    /**
     * @Rest\Get("/documents/{id}/fiscalYear")
     */
    function getFiscalYear($id){
        $model= new Model();
        return $model->getFiscalYear($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/fiscalYear")
    */
    function getFiscalYearData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFiscalYear("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/invoiceDate")
     */
    function getInvoiceDate($id){
        $model= new Model();
        return $model->getInvoiceDate($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/invoiceDate")
    */
    function getInvoiceDateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getInvoiceDate("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/expirationDate")
     */
    function getExpirationDate($id){
        $model= new Model();
        return $model->getExpirationDate($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/expirationDate")
    */
    function getExpirationDateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getExpirationDate("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/factoringExpirationDate")
     */
    function getFactoringExpirationDate($id){
        $model= new Model();
        return $model->getFactoringExpirationDate($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/factoringExpirationDate")
    */
    function getFactoringExpirationDateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFactoringExpirationDate("",$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Get("/documents/{id}/paymentDate")
     */
    function getPaymentDate($id){
        $model= new Model();
        return $model->getPaymentDate($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/paymentDate")
    */
    function getPaymentDateData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getPaymentDate("",$invoiceNumber,$total,$supplierName,$customerName);
    }


    /**
     * @Rest\Get("/documents/{id}/all")
     */
    function getAll($id){
        $model= new Model();
        return $model->getAll($id,"","","","");
    }
    /**
    * @Rest\Get("/documents/all")
    */
    function getAllData(Request $request){
        $model= new Model();
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getAll("",$invoiceNumber,$total,$supplierName,$customerName);
    }


}