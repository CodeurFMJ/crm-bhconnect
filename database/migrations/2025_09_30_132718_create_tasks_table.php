<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->unsignedBigInteger('assigned_to'); // employé assigné
            $table->unsignedBigInteger('assigned_by'); // admin qui assigne
            $table->unsignedBigInteger('client_id')->nullable(); // client lié (optionnel)
            $table->date('due_date')->nullable(); // date d'échéance
            $table->text('notes')->nullable(); // notes additionnelles
            $table->timestamp('completed_at')->nullable(); // date de completion
            $table->timestamps();
            
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            
            $table->index(['assigned_to', 'status']);
            $table->index(['assigned_by']);
            $table->index(['due_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
