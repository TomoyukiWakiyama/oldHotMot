$table->foreignId('owner_id')
    ->constrained()
    ->onUpdate('cascade')
    ->onDelete('cascade');