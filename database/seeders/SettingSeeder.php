<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $settings = new \stdClass;
        $settings->name = 'TMail';
        $settings->version = '6.8';
        $settings->license_key = '';
        $settings->api_keys = [];
        $settings->domains = [];
        $settings->homepage = 0;
        $settings->app_header = '';
        $settings->theme = 'default';
        $settings->fetch_seconds = 20;
        $settings->fetch_messages_limit = 15;
        $settings->ads = [
            'one' => '',
            'two' => '',
            'three' => '',
            'four' => '',
            'five' => '',
        ];
        $settings->socials = [];
        $settings->colors = [
            'primary' => '#0155b5',
            'secondary' => '#2fc10a',
            'tertiary' => '#d2ab3e'
        ];
        $settings->imap = [
            'host' => 'localhost',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => 'username',
            'password' => 'password',
            'default_account' => 'default',
            'protocol' => 'imap'
        ];
        $settings->language = 'en';
        $settings->enable_create_from_url = false;
        $settings->forbidden_ids = [
            'admin',
            'catch'
        ];
        $settings->blocked_domains = [];
        $settings->cron_password = str_shuffle('6789abcdefghijklmnopqrstuvwxy');
        $settings->delete = [
            'value' => 1,
            'key' => 'd'
        ];
        $settings->custom = [
            'min' => 3,
            'max' => 15
        ];
        $settings->random = [
            'start' => 0,
            'end' => 0
        ];
        $settings->global = [
            'css' => '',
            'js' => '',
            'header' => '',
            'footer' => ''
        ];
        $settings->cookie = [
            'enable' => true,
            'text' => '<p>By using this website you agree to our <a href="#" target="_blank">Cookie Policy</a></p>'
        ];
        $settings->recaptcha = [
            'enabled' => false,
            'site_key' => '',
            'secret_key' => ''
        ];
        $settings->after_last_email_delete = 'redirect_to_homepage';
        $settings->date_format = 'd M Y h:i A';
        $settings->groot_theme_options = [
            'extra_text_page' => 0
        ];
        $settings->disable_mailbox_slug = false;
        $settings->enable_masking_external_link = true;

        foreach ($settings as $key => $value) {
            if (!Setting::where('key', $key)->exists()) {
                Setting::create([
                    'key' => $key,
                    'value' => serialize($value)
                ]);
            }
        }
    }
}
