<?php

namespace Intracto\SecretSantaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PoolRepository extends EntityRepository
{
    public function findAllAdminPools($email)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->addSelect('pool.listurl')
            ->addSelect('pool.date')
            ->addSelect('pool.locale')
            ->from('IntractoSecretSantaBundle:Pool', 'pool')
            ->join('pool.entries', 'entries')
            ->andWhere('entries.poolAdmin = true')
            ->andWhere('entries.email = :email')
            ->andWhere('pool.date > CURRENT_TIMESTAMP()')
            ->setParameter('email', $email);

        return $qb->getQuery()->getResult();
    }
}
