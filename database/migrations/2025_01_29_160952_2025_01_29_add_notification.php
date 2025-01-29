<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('notifiable_type'); // Model yang menerima notifikasi (User, Admin, dll)
            $table->unsignedBigInteger('notifiable_id'); // ID penerima notifikasi
            $table->string('type'); // Jenis notifikasi (like, comment, dll)
            $table->text('data'); // Data JSON untuk pesan notifikasi
            $table->timestamp('read_at')->nullable(); // Status baca
            $table->timestamps();

            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
