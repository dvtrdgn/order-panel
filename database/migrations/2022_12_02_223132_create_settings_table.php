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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('keywords')->nullable();
            $table->string('site_url')->nullable();
         
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();

            $table->text('description')->nullable();
            $table->string('copy')->nullable();
           
            $table->text('analytic')->nullable();
            $table->text('header_css')->nullable();
            $table->text('footer_js')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();

            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->text('map_url')->nullable();
            $table->text('map_address')->nullable();
            $table->text('recaptcha_sitekey')->nullable();
            $table->text('recaptcha_secretkey')->nullable();
            $table->string('user_id')->nullable();

            $table->string('logo_white')->nullable();
            $table->string('maintenance_bg')->nullable();
            $table->string('footer_image')->nullable();
            $table->string('static_1_image')->nullable();
            $table->string('static_2_image')->nullable();
            $table->string('static_3_image')->nullable();
            $table->string('static_4_image')->nullable();
            $table->string('static_5_image')->nullable();
            $table->string('static_6_image')->nullable();
            
            $table->text('general_info')->nullable();
            $table->text('isActive_general_info')->nullable();
            $table->text('contact_information')->nullable();
            $table->text('contact_alert')->nullable();
            $table->text('isActive_contact_alert')->nullable();
            $table->string('email_to_contact_form')->nullable();
            $table->string('email_to_form')->nullable();
            $table->boolean('isFrontendMaintaince')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
