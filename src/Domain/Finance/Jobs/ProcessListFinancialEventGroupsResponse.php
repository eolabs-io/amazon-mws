<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Jobs;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FinancialEventGroup;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ProcessListFinancialEventGroupsResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FormatsModelAttributes;

    /** @var Illuminate\Support\Collection */
    public $results;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->persistListFinancialEventGroups();
    }

    public function persistListFinancialEventGroups()
    {
        $items = data_get($this->results, 'FinancialEventGroupList');
        array_walk($items, [$this,'createFinancialEventGroupFromList']);
    }

    public function createFinancialEventGroupFromList($financialEventGroupList)
    {
        $attributes = ['financial_event_group_id' => data_get($financialEventGroupList, 'FinancialEventGroupId'),];
        $values = $this->getFormatedAttributes($financialEventGroupList, new FinancialEventGroup);

        $financialEventGroup = FinancialEventGroup::updateOrCreate($attributes, $values);

        $this->associateOriginalTotal($financialEventGroupList, $financialEventGroup);
        $this->associateConvertedTotal($financialEventGroupList, $financialEventGroup);
        $this->associateBeginningBalance($financialEventGroupList, $financialEventGroup);

        $financialEventGroup->save();
    }

    public function associateOriginalTotal($financialEventGroupList, FinancialEventGroup $financialEventGroup)
    {
        $originalTotalList = data_get($financialEventGroupList, 'OriginalTotal', null);

        if (!$originalTotalList) {
            return;
        }

        $values = $this->getFormatedAttributes($originalTotalList, new CurrencyAmount);

        $originalTotal = CurrencyAmount::create($values);

        $originalTotal = $financialEventGroup->originalTotal;
        $originalTotal->fill($values)->save();

        $financialEventGroup->originalTotal()
                            ->associate($originalTotal);
    }

    public function associateConvertedTotal($financialEventGroupList, FinancialEventGroup $financialEventGroup)
    {
        $convertedTotalList = data_get($financialEventGroupList, 'ConvertedTotal', null);

        if (!$convertedTotalList) {
            return;
        }

        $values = $this->getFormatedAttributes($convertedTotalList, new CurrencyAmount);

        $convertedTotal = CurrencyAmount::create($values);

        $convertedTotal = $financialEventGroup->convertedTotal;
        $convertedTotal->fill($values)->save();

        $financialEventGroup->convertedTotal()
                            ->associate($convertedTotal);
    }

    public function associateBeginningBalance($financialEventGroupList, FinancialEventGroup $financialEventGroup)
    {
        $beginningBalanceList = data_get($financialEventGroupList, 'BeginningBalance', null);

        if (!$beginningBalanceList) {
            return;
        }

        $values = $this->getFormatedAttributes($beginningBalanceList, new CurrencyAmount);

        $beginningBalance = CurrencyAmount::create($values);

        $beginningBalance = $financialEventGroup->beginningBalance;
        $beginningBalance->fill($values)->save();

        $financialEventGroup->beginningBalance()
                            ->associate($beginningBalance);
    }
}
