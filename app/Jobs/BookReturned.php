<?php

namespace App\Jobs;

use App\Mail\NewBookReturnNotification;
use App\Models\Book;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookReturned implements ShouldQueue
{
    protected $book;
    protected $user;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(Book $book,User $user)
    {
        $this->book = $book;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->user)->send(new NewBookReturnNotification($this->book));
    }
}
