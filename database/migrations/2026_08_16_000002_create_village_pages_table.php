<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('village_pages',function(Blueprint $t){
            $t->id(); $t->unsignedBigInteger('desa_id')->index(); $t->string('category',30); $t->string('title'); $t->string('slug');
            $t->string('excerpt',500)->nullable(); $t->longText('body'); $t->string('image')->nullable(); $t->unsignedInteger('sort_order')->default(0); $t->boolean('active')->default(true); $t->timestamps();
            $t->unique(['desa_id','slug']);
        });
    }
    public function down(): void { Schema::dropIfExists('village_pages'); }
};
