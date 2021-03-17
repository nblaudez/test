<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Friend;
use App\Service\Poppy;

class FriendController extends AbstractController
{

    public function setFriendshipValueAction(Request $request, DocumentManager $dm, Poppy $poppyService,  $name, $value) {
        $friend = $dm->getRepository(Friend::class)->findOneBy(['name' => $name]);   
        if(!$friend) {     
            return new JsonResponse(["status"=>"success", "message"=> "no friend avaiable"], 500);
        }
        $result = $poppyService->setFriendshipValue($friend, $value);
        if($result === true) {
            return new JsonResponse(["status"=>"success", "message"=> "Friendship value of $name has been changed"], 200);
        } else {
            return new JsonResponse(["status"=>"error", "message"=> "An error occurs :".$result->getMessage()], 500);
        }    
    }

    public function eatenAction(Request $request, DocumentManager $dm) {
            $friends = $dm->getRepository(Friend::class)->getEaten();   
            if(count($friends->toArray()) > 0) {     
                return new JsonResponse($friends->toArray(), 200);
            } else {
                return new JsonResponse(["status"=>"success", "message"=> "no friend have been eaten"], 200);
            }
    }

    public function getAction(Request $request, DocumentManager $dm)
    {

        try {
            $parameters = $request->query->all();        
            $friends = $dm->getRepository(Friend::class)->getAllOrFiltered($parameters);   
            if(count($friends->toArray()) > 0) {     
                return new JsonResponse($friends->toArray(), 200);
            } else {
                return new JsonResponse(["status"=>"success", "message"=> "no friend avaiable"], 200);
            }
        } catch(\Excepetion $e) {            
            return new JsonResponse(["status"=>"error", "error"=> $e->getMessage()], 500);
        }    
    }

    public function newAction(Request $request, DocumentManager $dm, Poppy $poppyService)
    {
        $parameters = [];
        
        if ($content = $request->getContent()) {
            $parameters = json_decode($content, true);
        }

        $result = $poppyService->create($parameters);
        if($result === true) {
            return new JsonResponse([
                "status" => "success",
                "message" => "friend added"
            ], 200);
        } else {
            if(is_array($result)) {
                return new JsonResponse([
                    "status" => "error",
                    "error" => $result
                ], 500);
            } else {
                return new JsonResponse([
                    "status" => "error",
                    "error" => $result->getMessage()
                ], 500);
            }
        }
    }
}