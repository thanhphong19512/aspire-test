<?php

namespace App\Shared;

class LoanConstant
{
    const LOAN_STATE_PENDING = 0;
    const LOAN_STATE_APPROVED = 1;

    const LOAN_STATE_PAID = 3;

    // interest rate in percent
    const DEFAULT_INTEREST_RATE = 12;

    const DEFAULT_LOAN_TERM = 3;

    // default 7 Days fro payment cycle
    const DEFAULT_PAYMENT_CYCLE = 7;

    const MINIMUM_LOAN_STATE = 3;

    const MAXIMUM_LOAN_STATE = 60;
}
