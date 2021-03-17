<?php
namespace App\Repository;

use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class FriendRepository extends DocumentRepository
{
    
    public function getEaten() {

        $qb = $this->createQueryBuilder()
                    ->field("friendshipValue")->lte(0);
        

        return $qb->hydrate(false)
            ->getQuery()
            ->execute();
    }

    public function getAllOrFiltered($parameters) {

        $qb = $this->createQueryBuilder();

        foreach($parameters as $field => $value) {
             $qb->field($field)->equals($value);
        }

        return $qb->hydrate(false)
            ->getQuery()
            ->execute();
    }
}