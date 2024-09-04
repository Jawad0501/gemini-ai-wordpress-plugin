<?php
/*
 * Plugin Name: GEMINI AI
 * Description: Basic usage of GEMINI API
 * Version: 1.0.0
 * Author: Nowshad Jawad
 * Text Domain: gemini-ai
 */

define('GEMINI_AI_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('GEMINI_AI_PLUGIN_URL', plugin_dir_url(__FILE__));

class GeminiAIPlugin
{
    public function init () 
    {
        $this->autoload();

        register_activation_hook(__FILE__, [$this, 'activate_plugin']);
        // register_deactivation_hook(__FILE__, [$this, 'deactivate_plugin']);

    }

    public function autoload ()
    {
        spl_autoload_register(function($class) {
            $match = 'GeminiAI';

            if (!preg_match("/\b{$match}\b/", $class)) {
                return;
            }

            $path = plugin_dir_path(__FILE__);

            $file = str_replace(
                ['GeminiAI', '\\', '/App/'],
                ['', DIRECTORY_SEPARATOR, 'app/'],
                $class
            );

            require(trailingslashit($path) . trim($file, '/') . '.php');

            
        });

        // HOOK FOR REST API INTEGRATION - WILL STUDY LATER ON // 
        
        add_action('rest_api_init', function () {
            require_once GEMINI_AI_PLUGIN_PATH . 'app/Http/routes.php';
        });

        require_once GEMINI_AI_PLUGIN_PATH . 'app/Hooks/hooks.php';
        
    }

    public function activate_plugin ()
    {
        \GeminiAI\App\Helpers\Activator::activate();
    }

    // public function deactivate_plugin ()
    // {
    //     \GeminiAI\App\Helpers\Activator::activate();
    // }


}


(new GeminiAIPlugin())->init();






