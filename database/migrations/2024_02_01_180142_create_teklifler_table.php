<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teklifler', function (Blueprint $table) {
            $table->id();
            $table->string('hizmetad');
            $table->integer('adet');
            $table->integer('birimfiyat');
            $table->string('kdvtip');
            $table->integer('iskonto');
            $table->decimal('toplamkdv', 13, 2);
            $table->decimal('toplamiskonto', 13, 2);
            $table->decimal('toplamfiyat', 13, 2);
            $table->foreignId('firma_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teklifler');
    }
};
