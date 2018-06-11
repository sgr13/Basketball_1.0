<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 05.04.18
 * Time: 22:36
 */

namespace BasketballBundle\Repository;


class PlayerRepository extends \Doctrine\ORM\EntityRepository
{
    public function checkIfUserPlayerExists($userId)
    {
        $q = $this->createQueryBuilder('v');
        $q->select('v')
            ->where('v.user = :user_id')
            ->setParameter('user_id', $userId);

        return $q->getQuery()->getArrayResult();

    }
}