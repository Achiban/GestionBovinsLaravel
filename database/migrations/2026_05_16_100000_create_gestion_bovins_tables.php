<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etables', function (Blueprint $table) {
            $table->id('id_etab');
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('quarantaines', function (Blueprint $table) {
            $table->id('id_q');
            $table->string('libelle');
            $table->timestamps();
        });

        Schema::create('vendeurs', function (Blueprint $table) {
            $table->id('id_vend');
            $table->string('nom_vend');
            $table->string('prenom_vend')->nullable();
            $table->string('tel_vend')->nullable();
            $table->string('farm_vend')->nullable();
            $table->timestamps();
        });

        Schema::create('transporteurs', function (Blueprint $table) {
            $table->id('id_trans');
            $table->string('cin_t')->unique();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('tel')->nullable();
            $table->timestamps();
        });

        Schema::create('vehicules', function (Blueprint $table) {
            $table->id('id_veh');
            $table->string('Matricule')->unique();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('id_trans')->nullable();
            $table->foreign('id_trans')->references('id_trans')->on('transporteurs')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('vetos', function (Blueprint $table) {
            $table->id('id_vet');
            $table->string('nom_vet');
            $table->string('prenom_vet')->nullable();
            $table->string('tel_vet')->nullable();
            $table->timestamps();
        });

        Schema::create('bovins', function (Blueprint $table) {
            $table->id('id_bov');
            $table->string('race')->nullable();
            $table->date('dateachat')->nullable();
            $table->decimal('prixachat', 10, 2)->nullable();
            $table->decimal('poidachat', 8, 2)->nullable();
            $table->string('lieuachat')->nullable();
            $table->date('datevente')->nullable();
            $table->decimal('prixavente', 10, 2)->nullable();
            $table->decimal('poidvente', 8, 2)->nullable();
            $table->string('lieuvente')->nullable();
            $table->boolean('vendu')->default(false);
            $table->boolean('mort')->default(false);
            $table->date('datemort')->nullable();
            $table->decimal('poidAct', 8, 2)->nullable();
            
            $table->unsignedBigInteger('id_etab')->nullable();
            $table->foreign('id_etab')->references('id_etab')->on('etables')->onDelete('set null');
            
            $table->unsignedBigInteger('id_vend')->nullable();
            $table->foreign('id_vend')->references('id_vend')->on('vendeurs')->onDelete('set null');

            $table->unsignedBigInteger('id_q')->nullable();
            $table->foreign('id_q')->references('id_q')->on('quarantaines')->onDelete('set null');

            $table->timestamps();
        });

        Schema::create('medicaments', function (Blueprint $table) {
            $table->id('id_med');
            $table->string('libelle');
            $table->text('description')->nullable();
            $table->integer('quantite_med')->default(0);
            $table->decimal('prix_med', 10, 2)->nullable();
            $table->date('dateachat')->nullable();
            $table->date('dateexp_med')->nullable();
            $table->timestamps();
        });

        Schema::create('medic_consommes', function (Blueprint $table) {
            $table->id('id_m');
            $table->string('libelle_m');
            $table->integer('quantite_m');
            $table->unsignedBigInteger('id_bov');
            $table->foreign('id_bov')->references('id_bov')->on('bovins')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->id('id_stock');
            $table->string('libelle_st');
            $table->text('description_s')->nullable();
            $table->integer('quantite_s')->default(0);
            $table->integer('quantiteAct')->default(0);
            $table->decimal('prix_s', 10, 2)->nullable();
            $table->date('dateachat')->nullable();
            $table->date('dateexp_s')->nullable();
            $table->timestamps();
        });

        Schema::create('nourritures', function (Blueprint $table) {
            $table->id('id_n');
            $table->string('libelle_n');
            $table->integer('quantite_n');
            $table->decimal('prix', 10, 2)->nullable();
            $table->unsignedBigInteger('id_bov');
            $table->foreign('id_bov')->references('id_bov')->on('bovins')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('visites', function (Blueprint $table) {
            $table->id('id_pres');
            $table->text('description_v')->nullable();
            $table->date('datepres')->nullable();
            $table->decimal('prix_pres', 10, 2)->nullable();
            $table->unsignedBigInteger('id_bov');
            $table->foreign('id_bov')->references('id_bov')->on('bovins')->onDelete('cascade');
            $table->unsignedBigInteger('id_vet')->nullable();
            $table->foreign('id_vet')->references('id_vet')->on('vetos')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visites');
        Schema::dropIfExists('nourritures');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('medic_consommes');
        Schema::dropIfExists('medicaments');
        Schema::dropIfExists('bovins');
        Schema::dropIfExists('vetos');
        Schema::dropIfExists('vehicules');
        Schema::dropIfExists('transporteurs');
        Schema::dropIfExists('vendeurs');
        Schema::dropIfExists('quarantaines');
        Schema::dropIfExists('etables');
    }
};
