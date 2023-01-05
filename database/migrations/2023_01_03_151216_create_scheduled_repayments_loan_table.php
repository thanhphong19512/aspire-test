<?php

use App\Shared\LoanConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledRepaymentsLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_repayments_loan', function (Blueprint $table) {
            $table->id('scheduled_repayments_loan_id');
            $table->bigInteger('loan_id');
            $table->decimal('debt', 12);
            $table->decimal('interest', 12);
            $table->decimal('total', 12);
            $table->smallInteger('payment_period');
            $table->date('payment_term')->nullable();
            $table->smallInteger('loan_state')->default(LoanConstant::LOAN_STATE_PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheduled_repayments_loan');
    }
}
