<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Plank\Mediable\Media;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('media',  'variant_name')) {
            Schema::table('media', function (Blueprint $table) {
                $table->string('variant_name', 255)->after('size')->nullable();
            });
        }

        if (!Schema::hasColumn('media',  'original_media_id')) {
            Schema::table('media', function (Blueprint $table)
                {
                    $table->foreignIdFor(Media::class, 'original_media_id')
                        ->nullable()
                        ->after('variant_name')
                        ->constrained('media')
                        ->nullOnDelete();
                }
            );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'media',
            function (Blueprint $table) {
                if (DB::getDriverName() !== 'sqlite') {
                    $table->dropForeign('original_media_id');
                }
                $table->dropColumn('original_media_id');
            }
        );
        Schema::table(
            'media',
            function (Blueprint $table) {
                $table->dropColumn('variant_name');
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('mediable.connection_name', parent::getConnection());
    }
};
