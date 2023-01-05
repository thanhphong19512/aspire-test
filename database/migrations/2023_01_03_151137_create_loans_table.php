<?php

use App\Shared\LoanConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id');
            $table->bigInteger('user_id');
            $table->decimal('interest_rate', 3);
            $table->decimal('amount', 12);
            $table->smallInteger('term');
            $table->smallInteger('payment_cycle');
            $table->bigInteger('approved_user_id')->nullable();
            $table->date('approved_at')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
