<?php

namespace App\Console\Commands;

use App\Models\Cms;
use App\Models\Document;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ArchivedCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archived:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Log::info('Archived Cron');
            Document::where('is_archived', 0)->where('is_active', 1)->where('expire_date', '<', Carbon::now()->format('Y-m-d'))->update(['is_archived' => 1]);
            Cms::where('is_archived', 0)->where('is_active', 1)->where('expiry_date', '<', Carbon::now()->format('Y-m-d'))->update(['is_archived' => 1]);
        } catch (\Exception $e) {
            Log::error('Archived Cron Error ' . $e->getMessage());
        }
    }
}


