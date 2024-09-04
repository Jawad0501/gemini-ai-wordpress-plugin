<?php

namespace GeminiAI\App\Helpers;

class Activator 
{
    public static function activate ()
    {
        self::createTheTable();
    }

    public static function createTheTable ()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'settings';

        $charset_collate = $wpdb->get_charset_collate();

        $create_table_sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            value_given TEXT NOT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY title (title)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($create_table_sql);

        // add_action('admin-notice', 'Database Table Created');
    }
}