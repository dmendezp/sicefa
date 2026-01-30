<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('formulations', function (Blueprint $table) {
            if (!Schema::hasColumn('formulations', 'produced_expiration_date')) {
                $table->date('produced_expiration_date')->nullable()->after('date');
            }
            if (!Schema::hasColumn('formulations', 'produced_lot_number')) {
                $table->string('produced_lot_number', 255)->after('produced_expiration_date');
            }
            if (!Schema::hasColumn('formulations', 'produced_inventory_code')) {
                $table->string('produced_inventory_code', 255)->nullable()->after('produced_lot_number');
            }
            if (!Schema::hasColumn('formulations', 'produced_mark')) {
                $table->string('produced_mark', 255)->nullable()->after('produced_inventory_code');
            }
            if (!Schema::hasColumn('formulations', 'produced_destination')) {
                $table->string('produced_destination', 50)->after('produced_mark');
            }
        });
    }

    public function down(): void
    {
        Schema::table('formulations', function (Blueprint $table) {
            foreach ([
                'produced_destination',
                'produced_mark',
                'produced_inventory_code',
                'produced_lot_number',
                'produced_expiration_date',
            ] as $col) {
                if (Schema::hasColumn('formulations', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
