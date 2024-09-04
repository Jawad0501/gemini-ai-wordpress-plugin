<?php

namespace GeminiAI\App\Hooks\Handlers;

use GeminiAI\App\Helpers\Helper;

class AdminMenuHandler
{
    public function register()
    {
        add_action('admin_menu', array($this, 'addMenu'));
    }

    public function addMenu()
    {
        $permission = Helper::getAppPermission();

        if (!$permission) {
            return;
        }

        add_menu_page(
            'Ask Gemini',
            'Ask Gemini',
            $permission,
            'gemini-ai',
            array($this, 'render'),
            'dashicons-lightbulb'
        );

        add_submenu_page(
            'ask-gemini',                
            'Set API Key',              
            'Set API Key',
            $permission,
            'gemini-ai#/set-gemini-api-key',
            array($this, 'render')
        );

    }

    public function render()
    {   
        add_filter('admin_footer_text', function ($content) {
            return 'Thank you for using <a rel="noopener"  target="_blank" href="#">Ask Gemini</a>';
        });

        wp_enqueue_script('jquery');
        wp_enqueue_script('ask_gemini_app_script', GEMINI_AI_PLUGIN_URL . 'vue/dist/assets/js/index.js', ['jquery'], 1.0, true);
        wp_enqueue_style('ask_gemini_app_style', GEMINI_AI_PLUGIN_URL . 'vue/dist/assets/css/index.css');

        wp_localize_script('ask_gemini_app_script', 'GeminiAIAdmin', [
            'slug'            => 'gemini-ai',
            'nonce'           => wp_create_nonce('gemini-ai'),
            'rest'            => [
                'base_url'  => esc_url_raw(rest_url()),
                'url'       => rest_url('gemini-ai'),
                'nonce'     => wp_create_nonce('wp_rest'),
                'namespace' => 'gemini-ai',
                'version'   => '1'
            ],
        ]);


        echo '<div id="app"></div>';
    }
}