<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use League\Csv\Reader;
use Illuminate\Queue\SerializesModels;
use App\Models\Employee;

class EmployeeWorker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chunk_data = array();
    /**
     * Create a new job instance.
     */
    public function __construct(array $chunk_data)
    {
        //
        $this->chunk_data = $chunk_data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Employee::insertOrIgnore($this->chunk_data);
    }
}
