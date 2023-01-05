<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loans';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'loan_id';

    protected $fillable = [
        'user_id',
        'interest_rate',
        'amount',
        'term',
        'payment_cycle',
        'approved_user_id',
        'approved_at',
        'loan_state',
    ];

    /**
     * @return HasMany
     */
    public function scheduledRepayments()
    {
        return $this->hasMany(ScheduledRepaymentsLoan::class, 'loan_id');
    }
}
