<?php

namespace App\Jobs;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\ProductCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    private $user;
    private $product;

    public function __construct($user, $product)
    {
        $this->user = $user;
        $this->product = $product;
    }

    /**s
     * Execute the job.
     */
    public function handle(): void
    {
        // User::create([
        //     'name' => 'mohammad',
        //     'email' => 'mo@email.com',
        //     'password' => bcrypt(123456789),
        //     'role' => 0,
        // ]);

        Mail::to($this->user->email)->send(new ProductCreatedMail($this->user, $this->product));
    }
}
