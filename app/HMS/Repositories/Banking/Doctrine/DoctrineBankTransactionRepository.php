<?php

namespace HMS\Repositories\Banking\Doctrine;

use HMS\Entities\Banking\Account;
use Doctrine\ORM\EntityRepository;
use HMS\Entities\Banking\BankTransaction;
use HMS\Repositories\Banking\BankTransactionRepository;

class DoctrineBankTransactionRepository extends EntityRepository implements BankTransactionRepository
{
    /**
     * find the latest transaction for each account.
     * @return array
     */
    public function findLatestTransactionForAllAccounts()
    {
        $q = parent::createQueryBuilder('bankTransaction')
            ->addSelect('MAX(bankTransaction.transactionDate) AS latestTransactionDate')
            ->groupBy('bankTransaction.account')
            ->where('bankTransaction.account IS NOT NULL');

        return $q->getQuery()->getResult();
    }

    /**
     * find the latest transaction for given account.
     * @param  Account $account
     * @return null|BankTransaction
     */
    public function findLatestTransactionByAccount(Account $account)
    {
        return parent::findOneByAccount($account, ['transactionDate' => 'DESC']);
    }

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
