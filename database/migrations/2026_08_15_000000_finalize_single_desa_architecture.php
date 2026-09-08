<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * This project is intentionally single-desa per installation:
     * one Laravel project + one database = one village.
     *
     * No desa_id column is required.
     * A second/third village gets a separate copy of the project/database.
     */
    public function up(): void
    {
        // Architecture/documentation migration only.
    }

    public function down(): void
    {
        // Nothing to reverse.
    }
};
