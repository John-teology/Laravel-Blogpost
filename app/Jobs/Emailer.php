<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewPostEmail;
use Illuminate\Support\Facades\Mail;

class Emailer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */
    public function __construct(public $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->data['to'])->send(new NewPostEmail(['title' => $this->data['title'], 'name' => $this->data['name'], 'content' => $this->data['content'],'id' => $this->data['id']])); // so eto yung nag papadala ng email
    
        
    }
}
