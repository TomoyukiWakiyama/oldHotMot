Schema::create('menus', function (Blueprint $table) {
    $table->id();
    $table->foreignId('store_id')
        ->constrained()
        ->onUpdate('cascade')
        ->onDelete('cascade');
    $table->string('name');
    $table->text('information');
    $table->unsignedInteger('price');
    $table->boolean('is_selling');
    $table->integer('sort_order');
    $table->foreignId('category_id')
        ->constrained();
    $table->boolean('new_item');
    $table->boolean('soon_over');
    $table->boolean('small_serving');
    $table->timestamps();
});