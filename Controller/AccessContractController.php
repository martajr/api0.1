<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 15/01/2018
 * Time: 13:13
 */

namespace AppBundle\Controller;


use AppBundle\Model\AccessContractModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class AccessContractController extends FOSRestController
{

    /**
     * @Rest\Get("/document/count")
     */
    public function getDocumentCount()
    {
        $model= new AccessContractModel();
        return $model->getDocumentCount();
    }
    /**
     * @Rest\Get("/document/index/{index}")
     */
    public function getDocumentAtIndex($index)
    {
        $model= new AccessContractModel();
        return $model->getDocumentAtIndex($index);
    }

    /**
     * @Rest\Post("/user/")
     */
    public function postAction(Request $request)
    {
        $data = new User;
        $name = $request->get('name');
        $role = $request->get('role');
        if(empty($name) || empty($role))
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setName($name);
        $data->setRole($role);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("User Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        //command server : C:\xampp\php\php.exe bin/console server:run
        $model= new AccessContractModel();

        /*$foo1= $model->setExpirationDate("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write Expiration Date ");
        $foo2= $model->setFinancialInstitutionName("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write financial institution name");
        $foo3= $model->setPaymentDate("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write paymet date");
        $foo4= $model->setFactoringExpirationDate("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write factoring expiration date");
        $foo5= $model->setFactoringTotal("f1046a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459","tests write factoring total");
        return new Response($foo1.$foo2.$foo3.$foo4.$foo5);*/
        //$foo = $model->getInvoiceNumber("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459");
        //$foo = $model->getDocumentCount();
        //$foo = $model->getDocumentAtIndex(0);
        $foo = nl2br($model->getAll("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459"));
        //$foo = $model->deleteDocument("f9446a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459");
        //$foo = $model->deleteAll();
        /*$foo = $model->insertDocument("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459",
            "invoice numbre test","fiscal year test","total test","factoring total test",
            "state test","currency test","payment type test","supplier name test",
            "customer name test","finacial institutio name test","factoring state test",
            "payment term test"," invoice date test","payment date test",
            "expiration date test","factoring expiration date test");*/
        //$foo = $model->getDocumentList();
        //$foo = $model->exists("f1146a81aefa46a1e257855f2bb955ec07180ad96c47bc85b8faf2656b918459");

        return new Response($foo);

    }

}