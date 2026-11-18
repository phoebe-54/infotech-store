
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->string('type')->default('pc');
});
        
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::table('categories', function (Blueprint $table) {
    $table->dropColumn('type');
});
    }
    
};
