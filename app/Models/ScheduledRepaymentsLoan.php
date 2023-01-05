<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledRepaymentsLoan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scheduled_repayments_loan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'scheduled_repayments_loan_id';
}
