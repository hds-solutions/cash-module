<?php

use HDSSolutions\Finpar\Blueprints\BaseBlueprint as Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCashLinesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // get schema builder
        $schema = DB::getSchemaBuilder();

        // replace blueprint
        $schema->blueprintResolver(fn($table, $callback) => new Blueprint($table, $callback));

        // create table
        $schema->create('cash_lines', function(Blueprint $table) {
            $table->id();
            $table->foreignTo('Company');
            $table->foreignTo('Cash');
            $table->foreignTo('CashType');
            $table->foreignTo('Currency');
            $table->amount('amount', signed: true);
            $table->string('description');
            // add relation to movement as morphable object
            $table->morphable('refer')->nullable();
            // $table->foreignTo('Cash', 'to_cash_id')->nullable();
            // $table->foreignTo('BankAccount')->nullable();
            // $table->foreignTo('Invoice')->nullable();
            // $table->foreignTo('Employee')->nullable();
            // $table->foreignTo('CreditNote')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cash_lines');
    }

}
