<?php


namespace App\Services;


use App\Repository\AccountsRepository;
use App\Repository\PurchaseRepository;
use App\Repository\SaleRepository;
use Carbon\Carbon;

class MonthlyReportService
{
    /**
     * @var SaleRepository
     */
    private $saleRepository;
    /**
     * @var PurchaseRepository
     */
    private $purchaseRepository;
    /**
     * @var AccountsRepository
     */
    private $accountsRepository;

    /**
     * MonthlyReportService constructor.
     * @param SaleRepository $saleRepository
     * @param PurchaseRepository $purchaseRepository
     * @param AccountsRepository $accountsRepository
     */
    public function __construct(SaleRepository $saleRepository, PurchaseRepository $purchaseRepository, AccountsRepository $accountsRepository)
    {

        $this->saleRepository = $saleRepository;
        $this->purchaseRepository = $purchaseRepository;
        $this->accountsRepository = $accountsRepository;
    }

    public function findSaleReportByMonth($fromDate, $toDate)
    {
        $fromDate = Carbon::parse($fromDate)->format('Y-m-d');
        $toDate = Carbon::parse($toDate)->format('Y-m-d');
        return $this->saleRepository->findByMonth($fromDate, $toDate);
    }

    public function findPurchaseReportByMonth($fromDate, $toDate)
    {
        $fromDate = Carbon::parse($fromDate)->format('Y-m-d');
        $toDate = Carbon::parse($toDate)->format('Y-m-d');
        return $this->purchaseRepository->findByMonth($fromDate, $toDate);
    }

    public function findAccountReportByMonth($fromDate, $toDate)
    {
        $fromDate = Carbon::parse($fromDate)->format('Y-m-d');
        $toDate = Carbon::parse($toDate)->format('Y-m-d');
        return $this->accountsRepository->findByMonth($fromDate, $toDate);
    }
}
