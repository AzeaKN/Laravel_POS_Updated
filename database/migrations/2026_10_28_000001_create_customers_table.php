<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            // Additional display fields preserve the original TFA5 customer table.
            $table->date('joined')->nullable();
            $table->unsignedInteger('orders')->default(0);
            $table->decimal('spent', 12, 2)->default(0);
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('customers'); }
};
