    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up()
        {
            Schema::create('admin_profiles', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('nama_lengkap')->nullable();
                $table->string('no_telepon')->nullable();
                $table->string('foto')->nullable();
                $table->string('jabatan')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('admin_profiles');
        }
    }; 