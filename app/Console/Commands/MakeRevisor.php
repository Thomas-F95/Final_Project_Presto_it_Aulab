<?php

namespace App\Console\Commands;

// use Illuminate\Console\Attributes\Description;
// use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\User;


// #[Signature('app:make-revisor')]
// #[Description('Command description')]
class MakeRevisor extends Command
{
    /**
     * Execute the console command.
     */
    // Comand with EMAIL as argument
    protected $signature = 'app:make-revisor {email}';
    protected $description = 'Rende un utente registrato revisore';
    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error("Utente con email {$this->argument('email')} non trovato.");
            return;
        }

        if ($user->isRevisor()) {
            $this->warn("{$user->name} è già un revisore.");
            return;
        }

        $user->update(['role' => 'revisor']);

        $this->info("Perfetto! {$user->name} è ora un revisore.");
    }
}
