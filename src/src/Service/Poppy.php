<?php
namespace App\Service;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Friend;

Class Poppy {

  protected $dm;

  public function __construct(DocumentManager $dm) {
    $this->dm = $dm;
  }


  /**
   * Create a new friend
   * @param mixed $parameters  Array of data of the friend
   * @return mixed Exception | Array of error | true
   */
  public function create($parameters) {
    $errors = [];
    $fields = ['name','type','tags','friendshipvalue'];
    foreach($fields as $field) {            
        if(!array_key_exists($field, $parameters)) {
            $errors[]="field $field must be present in parameters and have a value";
        }
    }

    if(count($errors) > 0) {
        return $errors;
    } else {
        try {
            $friend = new Friend();
            foreach($parameters as $field => $value) {                
                $method = "set".ucfirst($field);
                $friend->$method($value);
            }
        
            $this->save($friend);

            return true;
        } catch(\Exception $e) {
            return $e;
        }
        
    }
  }

  /**
   * Modify friendship value of a friend
   * @param \App\Model\Friend $friend Friend to change friendshipvalue
   * @param int $value Value to set
   * @return mixed Exception | true
   */
  public function setFriendshipValue($friend, $value) {

      try {        
        $friend->setFriendshipValue($value);
        $this->save($friend);
        return true;
      } catch(\Exception $e) {
        return $e;
      }
  }

  /**
   * Save a french in database
   * @param \App\Document\Friend $friend Friend to save
   */
  public function save($friend) {
    $this->dm->persist($friend);
    $this->dm->flush();
  }
}