<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalFieldsToAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('approval_status')->default('pending')->after('status'); // pending, approved, rejected, rescheduled
            $table->unsignedBigInteger('created_by')->nullable()->after('approval_status'); // employé qui a créé le RDV
            $table->unsignedBigInteger('approved_by')->nullable()->after('created_by'); // admin qui a approuvé
            $table->text('admin_notes')->nullable()->after('approved_by'); // notes de l'admin
            $table->timestamp('approved_at')->nullable()->after('admin_notes'); // date d'approbation
            $table->timestamp('rescheduled_to')->nullable()->after('approved_at'); // nouvelle date si reporté
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['approved_by']);
            $table->dropColumn([
                'approval_status',
                'created_by',
                'approved_by',
                'admin_notes',
                'approved_at',
                'rescheduled_to'
            ]);
        });
    }
}
