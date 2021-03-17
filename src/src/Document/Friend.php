<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(db="clickeeat", collection="Friend") */
/** @MongoDB\Document(repositoryClass="App\Repository\FriendRepository") */
class Friend
{

 /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;


    /**
     * @MongoDB\Field(type="string")
     */
    protected $type;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $friendshipValue;

    /**
     * @MongoDB\Field(type="collection")
     */
    protected $tags;


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type) {
        if(!in_array(strtolower($type), ["unicorn","god","hooman","noob"])) {
            throw new \Exception("bad poppy type", 1000);
        }
        $this->type = strtolower($type);
    }

    public function getFriendshipValue(){
        return $this->friendshipValue;
    }

    public function setFriendshipValue($friendshipValue){
        $this->friendshipValue = $friendshipValue;
    }

    public function getTags(){
        return $this->tags;
    }

    public function setTags($tags){
        $this->tags = $tags;
    }
    
}