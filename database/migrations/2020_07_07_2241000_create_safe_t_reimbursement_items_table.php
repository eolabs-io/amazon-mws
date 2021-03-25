<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateSafeTReimbursementItemsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safe_t_reimbursement_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('safe_t_reimbursement_event_id');
            $table->timestamps();

            $table->foreign('safe_t_reimbursement_event_id')->references('id')->on('safe_t_reimbursement_events')->onDelete('cascade');
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('safe_t_reimbursement_items');
    }
}
