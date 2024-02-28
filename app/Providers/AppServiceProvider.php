<?php

namespace App\Providers;

use App\Models\Miasto;
use App\Models\Person;
use App\Models\Rodzina;
use App\Models\Singles;
use App\Models\Admin;
use App\Models\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Laravel\Fortify\Fortify;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        // \App\Models\Miasto::factory(5)->create();   
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!Schema::hasTable('miastos')) {
            echo "Brak bazy danych 'miastos' tworzę...\n";
            Schema::create('miastos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nazwa');
                $table->string('wojewodztwo');
                $table->integer('kod_pocztowy');
                $table->string('img');
                $table->string('kraj');
                $table->timestamps();
            });
            if (Miasto::all()->isEmpty()) {
                echo "Brak uzytkowników... wypełniam...\n";
                DatabaseSeeder::fillWithCities();
            }
        } 
       


        if (!Schema::hasTable('families')) {
            echo "Brak bazy danych 'families' tworzę...\n";
            Schema::create('families', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('miasto_id');
                $table->string('nazwisko');
                // $table->integer('ilosc_czlonkow');
                $table->timestamps();
                $table->foreign('miasto_id')
                    ->references('id')
                    ->on('miastos')
                    ->onDelete('cascade');
            });
            if (Rodzina::all()->isEmpty()) {
                echo "Brak rodzin... wypełniam...\n";
                DatabaseSeeder::fillWithFamilies();
            }
            
        } 


        if (!Schema::hasTable('persons')) {
            echo "Brak bazy danych 'persons' tworzę...\n";
                Schema::create('persons', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('rodzina_id')->default(99);
                $table->string('name');
                $table->string('surname')->default();
                $table->string('pesel');
                $table->char('sex');
                $table->timestamps();
                $table->foreign('rodzina_id')
                    ->references('id')
                    ->on('families')
                    ->onDelete('cascade');
            });
            if (Person::all()->isEmpty()) {
                echo "Brak osób... wypełniam...\n";
                DatabaseSeeder::fillWithPersons();
            }
            
        } 

        // if (!Schema::hasTable('singles')) {
        //     echo "Brak bazy danych 'singles' tworzę...\n";
        //     Schema::create('singles', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->string('name');
        //         $table->string('surname');
        //         $table->string('pesel');
        //         $table->string('email');
        //         $table->char('sex');
        //         $table->timestamps();
        //     });
        //     if (Singles::all()->isEmpty()) {
        //         echo "Brak uzytkowników... wypełniam...\n";
        //         DatabaseSeeder::fillWithSinglePersons();
        //     }
        // } 

        // if (!Schema::hasTable('admins')) {
        //     echo "Brak bazy danych 'admins' tworzę...\n";
        //     Schema::create('admins', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->string('name');
        //         $table->string('surname');
        //         $table->string('pesel');
        //         $table->string('login');
        //         $table->string('email');
        //         $table->string('password');
        //         $table->char('sex');
        //         $table->timestamps();
        //     });
        //     if (Admin::all()->isEmpty()) {
        //         echo "Brak adminów... wypełniam...";
        //         DatabaseSeeder::fillWithSingleAdmins();
        //     }
        // } 








        if (!Schema::hasTable('users')) {
            echo "Brak bazy danych 'users' tworzę...\n";
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();
                $table->timestamps();
            });      
        } 
        if (!Schema::hasTable('password_resets')) {
            echo "Brak bazy danych 'password_resets' tworzę...\n";
            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
           
        } 
        if (!Schema::hasTable('users')) {
            echo "Brak bazy danych 'users' tworzę...\n";
            Schema::table('users', function (Blueprint $table) {
                $table->text('two_factor_secret')
                    ->after('password')
                    ->nullable();
    
                $table->text('two_factor_recovery_codes')
                    ->after('two_factor_secret')
                    ->nullable();
    
                if (Fortify::confirmsTwoFactorAuthentication()) {
                    $table->timestamp('two_factor_confirmed_at')
                        ->after('two_factor_recovery_codes')
                        ->nullable();
                }
            });
        } 

        if (!Schema::hasTable('personal_access_tokens')) {
            echo "Brak bazy danych 'personal_access_tokens' tworzę...\n";
            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->id();
                $table->morphs('tokenable');
                $table->string('name');
                $table->string('token', 64)->unique();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();
            });
           
        } 

        if (!Schema::hasTable('sessions')) {
            echo "Brak bazy danych 'sessions' tworzę...\n";
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
           
        } 
       
    }
}
