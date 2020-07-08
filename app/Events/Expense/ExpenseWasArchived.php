<?php
/**
 * Invoice Ninja (https://invoiceninja.com)
 *
 * @link https://github.com/invoiceninja/invoiceninja source repository
 *
 * @copyright Copyright (c) 2020. Invoice Ninja LLC (https://invoiceninja.com)
 *
 * @license https://opensource.org/licenses/AAL
 */

namespace App\Events\Expense;

use App\Models\Company;
use App\Models\Expense;
use Illuminate\Queue\SerializesModels;

/**
 * Class ExpenseWasArchived.
 */
class ExpenseWasArchived
{
    use SerializesModels;

    /**
     * @var Expense
     */
    public $expense;

    public $company;

    public $event_vars;
    /**
     * Create a new event instance.
     *
     * @param Expense $expense
     */
    public function __construct(Expense $expense, Company $company, array $event_vars)
    {
        $this->expense = $expense;
        $this->company = $company;
        $this->event_vars = $event_vars;
    }
}
