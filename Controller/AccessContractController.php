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

//GET /documents/{id}/pending /documents/pending
//GET /documents/{id}/accepted /documents/accepted
//GET /documents/{id}/paid /documents/paid
//GET /documents/{id}/factoring/requested /documents/factoring/pending
//GET /documents/{id}/factoring/requested /documents/factoring/requested
//GET /documents/{id}/factoring/accepted /documents/factoring/accepted


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


//POST /documents/{id}/factoring/total   /documents/factoring/total
//POST /documents/{id}/factoring/expirationDate
///documents/factoring/expirationDate
//POST /documents/{id}/financialInstitutionName /documents/financialInstitutionName

//POST /documents/{id}/paymentDate   /documents/paymentDate

    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------------------SETTERS------------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Post("/setFactoringTotal")
     */
    function setFactoringTotal(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $factoringTotal = $request->get('factoringTotal');
        return $model->setFactoringTotal($id,$invoiceNumber,$total,$supplierName,$customerName,$factoringTotal);
    }
    /**
     * @Rest\Post("/setFactoringExpirationDate")
     */
    function setFactoringExpirationDate(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $factoringExpirationDate = $request->get('factoringExpirationDate');
        return $model->setFactoringTotal($id,$invoiceNumber,$total,$supplierName,$customerName,$factoringExpirationDate);
    }
    /**
     * @Rest\Post("/setFinancialInstitutionName")
     */
    function setFinancialInstitutionName(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $financialInstitutionName = $request->get('financialInstitutionName');
        return $model->setFinancialInstitutionName($id,$invoiceNumber,$total,$supplierName,$customerName,$financialInstitutionName);
    }
    /**
     * @Rest\Post("/setPaymentDate")
     */
    function setPaymentDate(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        $paymentDate = $request->get('paymentDate');
        return $model->setPaymentDate($id,$invoiceNumber,$total,$supplierName,$customerName,$paymentDate);
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
     * @Rest\Post("/setStateAcceptedFromPending")
     */
    function setStateAcceptedFromPending(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setStateAcceptedFromPending($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
     * @Rest\Post("/setStatePaidfFromAccepted")
     */
    function setStatePaidfFromAccepted(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setStatePaidfFromAccepted($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
     * @Rest\Post("/setFactoringStateRequested")
     */
    function setFactoringStateRequested(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setFactoringStateRequested($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
     * @Rest\Post("/setFactoringStateAcceptedFromRequested")
     */
    function setFactoringStateAcceptedFromRequested(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->setFactoringStateAcceptedFromRequested($id,$invoiceNumber,$total,$supplierName,$customerName);
    }

//DELETE /documents/{id}/  /documents/

//GET /documents/count

//GET /documents/{index}

//GET /documents/ids



    /*-----------------------------------------------------------------------------------------*/
    /*-----------------------------------DELETE & INDEX----------------------------------------*/
    /*-----------------------------------------------------------------------------------------*/

    /**
     * @Rest\Post("/deleteDocument")
     */
    function deleteDocument(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->deleteDocument($id,$invoiceNumber,$total,$supplierName,$customerName);
    }

    /**
     * @Rest\Post("/getDocumentCount")
     */
    public function getDocumentCount()
    {
        $model= new Model();
        return $model->getDocumentCount();
    }

    /**
     * @Rest\Post("/getDocumentAtIndex")
     */
    public function getDocumentIdAtIndex(Request $request)
    {
        $model= new Model();
        $index = $request->get('index');
        return $model->getDocumentIdAtIndex($index);
    }

    /**
     * @Rest\Post("/getAllDocumentId")
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
     * @Rest\Post("/getInvoiceNumber")
     */
    function getInvoiceNumber(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getInvoiceNumber($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getTotal")
 */
    function getTotal(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getTotal($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getFactoringTotal")
 */
    function getFactoringTotal(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFactoringTotal($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getState")
 */
    function getState(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getState($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getCurrency")
 */
    function getCurrency(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getCurrency($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getPaymentType")
 */
    function getPaymentType(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getPaymentType($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getSupplierName")
 */
    function getSupplierName(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getSupplierName($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getCustomerName")
 */
    function getCustomerName(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getCustomerName($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getFinancialInstitutionName")
 */
    function getFinancialInstitutionName(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFinancialInstitutionName($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getFactoringState")
 */
    function getFactoringState(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFactoringState($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getPaymentTerms")
 */
    function getPaymentTerms(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getPaymentTerms($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getFiscalYear")
 */
    function getFiscalYear(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFiscalYear($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getInvoiceDate")
 */
    function getInvoiceDate(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getInvoiceDate($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
    /**
 * @Rest\Post("/getExpirationDate")
 */
    function getExpirationDate(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getExpirationDate($id,$invoiceNumber,$total,$supplierName,$customerName);
    }  /**
 * @Rest\Post("/getFactoringExpirationDate")
 */
    function getFactoringExpirationDate(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getFactoringExpirationDate($id,$invoiceNumber,$total,$supplierName,$customerName);
    }  /**
 * @Rest\Post("/getPaymentDate")
 */
    function getPaymentDate(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getPaymentDate($id,$invoiceNumber,$total,$supplierName,$customerName);
    }  /**
 * @Rest\Post("/getAll")
 */
    function getAll(Request $request){
        $model= new Model();
        $id = $request->get('id');
        $invoiceNumber = $request->get('invoiceNumber');
        $total = $request->get('total');
        $supplierName = $request->get('supplierName');
        $customerName = $request->get('customerName');
        return $model->getAll($id,$invoiceNumber,$total,$supplierName,$customerName);
    }
//    /**
//     * @Rest\Get("/document/index/{index}")
//     */
//    public function getDocumentAtIndex($index)
//    {
//        $model= new AccessContractModel();
//        return $model->getDocumentAtIndex($index);
//    }
//
//    /**
//     * @Rest\Post("/user/")
//     */
//    public function postAction(Request $request)
//    {
//        $data = new User;
//        $name = $request->get('name');
//        $role = $request->get('role');
//        if(empty($name) || empty($role))
//        {
//            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
//        }
//        $data->setName($name);
//        $data->setRole($role);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($data);
//        $em->flush();
//        return new View("User Added Successfully", Response::HTTP_OK);
//    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        //command server : C:\xampp\php\php.exe bin/console server:run
        $modelC= new AccessContractModel();
        $model= new Model();

        /*$foo1= $model->setExpirationDate("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write Expiration Date ");
        $foo2= $model->setFinancialInstitutionName("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write financial institution name");
        $foo3= $model->setPaymentDate("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write paymet date");
        $foo4= $model->setFactoringExpirationDate("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write factoring expiration date");
        $foo5= $model->setFactoringTotal("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write factoring total");
        return new Response($foo1.$foo2.$foo3.$foo4.$foo5);*/
        //$foo = $model->getInvoiceNumber("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459");
        //$foo = $model->getDocumentCount();
        //$foo = $model->getDocumentAtIndex(0);
        //$foo = nl2br($model->getAll("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459"));
        //$foo = $model->deleteDocument("id1");
        //$foo = $model->deleteAll();
        /*$foo = $model->insertDocument("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459",
            "invoice numbre test","fiscal year test","total test","factoring total test",
            "state test","currency test","payment type test","supplier name test",
            "customer name test","finacial institutio name test","factoring state test",
            "payment term test"," invoice date test","payment date test",
            "expiration date test","factoring expiration date test");*/
        //$foo = $model->getDocumentList();
        //$foo = $model->exists("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459");
//$foo= $model->getInvoiceNumber("id1");
       // $foo= $model->getTotal("id1");
        //$foo=$model->getState("id1");
        //$foo=$model->exists("id4");
        /*$foo = json_encode($model->insertNewDocument("identificador largo para testear","invoicenumber1","FY01","total1",
        "c01","paymenttype1","suppliername1","customername1","paymentterms1",
            "AAAA/MM/DD HH:ID:01","AAAA/MM/DD HH:ED:01"));*/
        $foo=json_encode($model->exists("","invoicenumber1","total1"
        ,"suppliername1","customername1"));
        $foo=json_encode($model->setFactoringTotal("","invoicenumber1","total1"
            ,"suppliername1","customername1","factoringTotal1"));
        $foo=json_encode($model->getInvoiceNumber("3dbda9e306e2cb4f123b1c9ae2e9ba30c6309c1b540228542ebc71131b4dfe0b","invoicenumber1","total1"
            ,"suppliername1","customername1"));
        $foo=json_encode($model->getAll("3dbda9e306e2cb4f123b1c9ae2e9ba30c6309c1b540228542ebc71131b4dfe0b","invoicenumber1","total1"
            ,"suppliername1","customername1"));
        $foo=json_encode($model->getAllDocumentId());
        $foo=json_encode( $model->insertNewDocument('invoiceNumber3','FY03',
            'total3','c03','paymentType3', 'supplierName3',
            'customerName3','paymentTerms3','AAAA/MM/DD HH:ID:03','AAAA/MM/DD HH:ED:03'));

        return new Response($foo);

    }

}