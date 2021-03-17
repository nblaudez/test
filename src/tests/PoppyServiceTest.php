<?php
namespace App\Tests;

use App\Service\Poppy;
use App\Document\Friend;
use PHPUnit\Framework\TestCase;

class PoppyServiceTest extends TestCase
{
    public function testCreate()
    {
        $stub = $this->getMockBuilder(Poppy::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['save'])
                     ->getMock();     
                              
        $stub->expects($this->once())->method('save');
        
        $parameters = ["name"=> "nicolas", "type" => "unicorn", "friendshipvalue"=>100,"tags"=>["water","wood"]];
        $stub->create($parameters);        
    }

    public function testsetFriendshipValue()
    {
        $stub = $this->getMockBuilder(Poppy::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['save'])
                     ->getMock(); 
                     
        $friendStub = $this->getMockBuilder(Friend::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['setFriendshipValue'])
                     ->getMock();              
                              
        $friendStub->expects($this->once())->method('setFriendshipValue');
        $stub->expects($this->once())->method('save');
                
        $stub->setFriendshipValue($friendStub, 200);
    }
}