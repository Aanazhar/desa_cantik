<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\DesaProfileSection;

$sections = DesaProfileSection::all();
echo "Total sections: " . $sections->count() . "\n";

foreach ($sections as $section) {
    echo "- ID: {$section->id}, Type: {$section->section_type}, Active: {$section->is_active}, Content length: " . strlen($section->content ?? '') . "\n";
}
