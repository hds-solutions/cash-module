<?php

use HDSSolutions\Laravel\Blueprints\BaseBlueprint as Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCashBookUserTable extends Migration {

    public function up() {
        // get schema builder
        $schema = DB::getSchemaBuilder();

        // replace blueprint
        $schema->blueprintResolver(fn($table, $callback) => new Blueprint($table, $callback));

        // create table
        $schema->create('cash_book_user', function(Blueprint $table) {
            $table->asPivot();
            $table->foreignTo('CashBook');
            $table->foreignTo('User');
            $table->primary([ 'cash_book_id', 'user_id' ]);
        });
    }

    public function down() {
        Schema::dropIfExists('cash_book_user');
    }

}
