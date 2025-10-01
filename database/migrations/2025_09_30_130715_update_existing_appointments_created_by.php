<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExistingAppointmentsCreatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Mettre à jour les RDV existants qui n'ont pas de created_by
        $defaultUser = \App\Models\User::where('role', 'admin')->first() ?? \App\Models\User::first();
        
        if ($defaultUser) {
            \App\Models\Appointment::whereNull('created_by')->update([
                'created_by' => $defaultUser->id,
                'approval_status' => 'approved' // Les RDV existants sont considérés comme approuvés
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remettre les RDV à leur état précédent
        \App\Models\Appointment::whereNotNull('created_by')->update([
            'created_by' => null,
            'approval_status' => 'pending'
        ]);
    }
}
