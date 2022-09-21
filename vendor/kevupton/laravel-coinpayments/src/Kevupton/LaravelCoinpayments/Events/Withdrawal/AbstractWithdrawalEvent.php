<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 25/03/2018
 * Time: 9:13 PM
 */

namespace Kevupton\LaravelCoinpayments\Events\Withdrawal;

use Kevupton\LaravelCoinpayments\Events\Event;
use Kevupton\LaravelCoinpayments\Models\Withdrawal;

class AbstractWithdrawalEvent extends Event
{
    /**
     * @var Withdrawal
     */
    public $withdrawal;

    public function __construct (Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }
}