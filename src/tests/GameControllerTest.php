<?php
namespace App\Tests;

use App\Service\Poppy;
use App\Document\Friend;
use App\Repository\FriendRepository;
use App\Controller\GameController;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class GameControllerTest extends TestCase
{
    
    public function testCallMonsterAction()
    {
        $dmStub = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()   
            ->setMethods(['getRepository'])                 
            ->getMock();

        $repositoryStub = $this->getMockBuilder(FriendRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['findOneBy'])
            ->getMock();

        $friendStub = $this->getMockBuilder(Friend::class)                     
                     ->disableOriginalConstructor()
                     ->setMethods(['setFriendshipValue','persist','flush'])
                     ->getMock();            
        
        $dmStub->expects($this->once())->method('getRepository')->willReturn($repositoryStub);
        $repositoryStub->expects($this->once())->method('findOneBy')->willReturn($friendStub);
        $friendStub->expects($this->once())->method('setFriendshipValue');
        $friendStub->expects($this->once())->method('persist');
        $friendStub->expects($this->once())->method('flush');

        $controller = new GameController();
        $controller->callMonsterAction(new Request(), $dmStub;        
    }
}
