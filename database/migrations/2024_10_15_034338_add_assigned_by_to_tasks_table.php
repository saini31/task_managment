<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedByToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Adding the 'assigned_by' column
            $table->unsignedBigInteger('assigned_by')->nullable()->after('user_id'); // Nullable if the task is created by the user themselves
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade'); // Foreign key relation to users table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Dropping the foreign key and column in case of rollback
            $table->dropForeign(['assigned_by']);
            $table->dropColumn('assigned_by');
        });
    }
}
