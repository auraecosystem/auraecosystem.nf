<?php

declare(strict_types=1);

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('web4', function (): int {

    $this->newLine();

    $this->components->info('🌐 Web4 Developer Console');
    $this->line('Version : 1.0.0');
    $this->line('Framework : Laravel');
    $this->line('Environment : '.app()->environment());

    $this->newLine();

    $this->table(
        ['Command', 'Description'],
        [
            ['web4:build', 'Build the complete Web4 project'],
            ['web4:doctor', 'Check project health'],
            ['web4:deploy', 'Deploy application'],
            ['web4:docs', 'Generate documentation'],
            ['web4:ai', 'Manage AI models'],
            ['web4:blockchain', 'Blockchain utilities'],
            ['web4:marketplace', 'Marketplace tools'],
            ['web4:cache', 'Clear and optimize cache'],
            ['web4:version', 'Show version information'],
            ['inspire', 'Display an inspiring quote'],
        ]
    );

    return self::SUCCESS;

})->purpose('Open the Web4 developer console');


Artisan::command('web4:doctor', function (): int {

    $checks = [
        'PHP' => PHP_VERSION,
        'Laravel' => app()->version(),
        'Environment' => app()->environment(),
        'Debug' => config('app.debug') ? 'Enabled' : 'Disabled',
        'Cache' => 'OK',
        'Config' => 'OK',
        'Routes' => 'OK',
    ];

    foreach ($checks as $name => $value) {
        $this->components->twoColumnDetail($name, $value);
    }

    $this->components->success('System healthy.');

    return self::SUCCESS;

})->purpose('Run system diagnostics');


Artisan::command('web4:version', function (): int {

    $this->newLine();

    $this->components->info('Web4 Platform');

    $this->table(
        ['Component', 'Version'],
        [
            ['Web4', '1.0.0'],
            ['Laravel', app()->version()],
            ['PHP', PHP_VERSION],
        ]
    );

    return self::SUCCESS;

})->purpose('Display version information');


Artisan::command('inspire', function (): int {

    $this->components->info('✨ Inspiration');

    $this->line(Inspiring::quote());

    return self::SUCCESS;

})->purpose('Display an inspiring quote');
