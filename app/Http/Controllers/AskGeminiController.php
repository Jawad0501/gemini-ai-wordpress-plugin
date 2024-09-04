<?php

namespace GeminiAI\App\Http\Controllers;

class AskGeminiController
{
    public static function storeAPI(\WP_Rest_Request $request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'settings';
        $existing_key = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE title = %s", 'GEMINI_API_KEY'));
        $existing_key_value = $wpdb->get_var($wpdb->prepare("SELECT value_given FROM $table_name WHERE title = %s", 'GEMINI_API_KEY'));

        $api_key = sanitize_text_field($request->get_param('apiKey'));

        if ($existing_key) {
            $wpdb->update(
                $table_name,
                array('value_given' => $api_key),
                array('title' => 'GEMINI_API_KEY'),
                array('%s'),
                array('%s')
            );
        } else {
            $wpdb->insert(
                $table_name,
                array(
                    'title' => 'GEMINI_API_KEY',
                    'value_given' => $api_key,
                ),
                array(
                    '%s',
                    '%s'
                )
            );
        }

        return [
            'message'  => 'API Key Updated'
        ];
    }
}