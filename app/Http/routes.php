<?php

$router = new \GeminiAI\App\Services\Router('gemini-ai');

$permissions = ['manage_options'];

$router->post('set-gemini-api-key', ['\GeminiAI\App\Http\Controllers\AskGeminiController', 'storeAPI'], $permissions);