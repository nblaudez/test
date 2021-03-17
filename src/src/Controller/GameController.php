<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
use App\Document\Friend;

class GameController extends AbstractController
{

    public function callMonsterAction(Request $request, DocumentManager $dm)
    {
        $name = $request->get('name');
        try {
            if($name == null) {            
                $friends = $dm->getRepository(Friend::class)->getAllOrFiltered([]);   
                if(count($friends->toArray()) > 0) {     
                    $friends = $friends->toArray();
                    $friend = $friends[rand(0, count($friends) - 1)];
                } else {
                    return new JsonResponse(["status"=>"success", "message"=> "no friend avaiable"], 200);
                }    
            } else {            
                $friends = $dm->getRepository(Friend::class)->getAllOrFiltered(["name" => $name]);   
                if(count($friends->toArray()) > 0) {     
                    $friends = $friends->toArray();
                    $friend = $friends[0];
                } else {
                    return new JsonResponse(["status"=>"success", "message"=> "no friend avaiable"], 200);
                }            
            }

            switch($friend['type']) {
                case "god":
                    $message="Friend is a GOD. A god can't be eaten";
                break;
                case "unicorn":
                    $message="Friend is unicorn. It will survive";
                break;
                default:
                    $value = rand(0,100);
                    $friend['friendshipValue'] = $friend['friendshipValue'] - 100;
                    if($friend['friendshipValue'] < 0) {
                        $message="Friend has been eaten";
                        
                        $ofriend = $dm->getRepository(Friend::class)->findOneBy(['name' => $friend['name']]); 
                        $ofriend->setFriendshipValue($friend['friendshipValue']);
                        $dm->persist($ofriend);
                        $dm->flush();
                    } else {
                        $message="Friend lost $value friendship value";                    
                    }
                break;
            }


            return new JsonResponse(["status"=>"success", "friend"=> $friend['name'], "message" => $message], 200);

        } catch(\Excepetion $e) {
            return new JsonResponse(["status"=>"error", "error"=> $e->getMessage()], 500);
        }    
        
        
    }
}