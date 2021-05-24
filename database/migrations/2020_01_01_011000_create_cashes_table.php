<?php

use HDSSolutions\Finpar\Blueprints\BaseBlueprint as Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCashesTable extends Migration {
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
        $schema->create('cashes', function(Blueprint $table) {
            $table->id();
            $table->foreignTo('Company');
            $table->foreignTo('CashBook');
            $table->string('description');
            $table->amount('start_balance');
            $table->amount('end_balance');
            // use table as document
            $table->asDocument();
        });

        // create lines table
        $schema->create('cash_lines', function(Blueprint $table) {
            $table->id();
            $table->foreignTo('Company');
            $table->foreignTo('Cash');
            $table->foreignTo('Currency');
            $table->char('cash_type', 2);
            $table->amount('amount', signed: true);
            $table->string('description');
            // add relation to movement as morphable object
            $table->morphable('refer')->nullable();
            $table->morphable('partner')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cash_lines');
        Schema::dropIfExists('cashes');
    }

}
