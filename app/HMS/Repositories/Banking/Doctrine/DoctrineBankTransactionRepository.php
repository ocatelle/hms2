<?php

namespace HMS\Repositories\Banking\Doctrine;

use HMS\Entities\Banking\BankTransaction;
use Doctrine\ORM\EntityRepository;
use HMS\Repositories\Banking\BankTransactionRepository;

class DoctrineBankTransactionRepository extends EntityRepository implements BankTransactionRepository
{
    /**
     * save BankTransaction to the DB. 
     * @param  BankTransaction $bankTransaction
     */
    public function save(BankTransaction $bankTransaction)
    {
        $this->_em->persist($bankTransaction);
        $this->_em->flush();
    }
}
