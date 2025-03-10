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
        Schema::create('ticket_models', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number');
            $table->string('client_name');
            $table->string('company_name');
            $table->string('client_contact_info');
            $table->string('client_contact_number');
            $table->string('project_name');
            $table->string('project_type');
            $table->text('project_description');
            $table->string('web_url');
            $table->decimal('project_cost', 10, 2);
            $table->decimal('advance_payment_received_amount', 10, 2);
            $table->string('payment_method');
            $table->string('project_status');
            $table->Integer('assigned_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_models');
    }
};
