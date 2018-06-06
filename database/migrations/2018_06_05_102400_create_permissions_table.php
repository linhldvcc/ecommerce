<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Permission;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
        });

        Permission::create([
            'name' => 'Thêm Sản phẩm',
            'slug' => 'create-product',
        ]);

        Permission::create([
            'name' => 'Sửa Sản phẩm',
            'slug' => 'update-product',
        ]);

        Permission::create([
            'name' => 'Xóa Sản phẩm',
            'slug' => 'delete-product',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
