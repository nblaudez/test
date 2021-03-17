<?php
namespace App\Tests;

use App\Service\Poppy;
use App\Document\Friend;
use App\Repository\FriendRepository;
use App\Controller\FriendController;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class FriendControllerTest extends TestCase
{
    public function testSetFriendshipValueAction()
    {
        $dmStub = $this->getMockBuilder(DocumentManager::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['persist','flush','getRepository'])
                     ->getMock();
        
        $repositoryStub = $this->getMockBuilder(FriendRepository::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['findOneBy'])
                     ->getMock();

        $friendStub = $this->getMockBuilder(Friend::class)
                     ->setMethods(['setFriendshipValue'])
                     ->disableOriginalConstructor()
                     ->getMock();


        $dmStub->method("getRepository")->willReturn($repositoryStub);
        $repositoryStub->method("findOneBy")->willReturn($friendStub);

        $friendStub->expects($this->once())->method('setFriendshipValue');

        $dmStub->expects($this->once())->method('persist');
        $dmStub->expects($this->once())->method('flush');
                
        $controller = new FriendController();
        $controller->setFriendshipValueAction(new Request(), $dmStub, new Poppy($dmStub),  "nicolas", 100);        
      
    }
    
    public function testcreateAction()
    {
        $dmStub = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()            
            ->getMock();

        $poppyStub = $this->getMockBuilder(Poppy::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();
        
        $poppyStub->expects($this->once())->method('create')->willReturn(true);

        $controller = new FriendController();
        $controller->newAction(new Request(), $dmStub, $poppyStub);        
    }
}
