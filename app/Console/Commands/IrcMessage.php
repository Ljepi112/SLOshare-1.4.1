<?php

namespace App\Console\Commands;

use App\Bots\IRCAnnounceBot;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class IrcMessage extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'irc:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sporočila kanala IRC';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Messaging '.$this->argument('channel').': '.$this->argument('message'));
        $ircAnnounceBot = new IRCAnnounceBot();
        $ircAnnounceBot->message($this->argument('channel'), $this->argument('message'));
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['channel', InputArgument::REQUIRED, 'Kanal, ki mu želite poslati sporočilo'],
            ['message', InputArgument::REQUIRED, 'Sporočilo, ki ga želite poslati'],
        ];
    }
}
