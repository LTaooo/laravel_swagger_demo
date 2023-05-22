<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->comment("学生名字");
            $table->integer("class_id")->comment("班级id");
            $table->integer('age')->comment("年龄");
            $table->integer('created_at')->comment("创建时间");
            $table->integer('updated_at')->comment("更新时间");
            $table->integer('deleted_at')->comment("删除时间");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
};
