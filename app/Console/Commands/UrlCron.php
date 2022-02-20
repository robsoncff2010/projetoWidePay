<?php

namespace App\Console\Commands;

use App\Models\RegisterUrl;
use App\Services\Url\UrlService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UrlCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rotina para acessar todas as urls cadastradas colhendo http status e body, depois gravar no banco de dados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $urlService = new UrlService(new RegisterUrl());
        $urlService->accessUrls();
    }
}
