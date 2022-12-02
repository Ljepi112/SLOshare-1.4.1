<?php

namespace App\Console\Commands;

use App\Console\ConsoleTools;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @see \Tests\Todo\Unit\Console\Commands\GitUpdaterTest
 */
class GitUpdater extends Command
{
    use ConsoleTools;

    /**
     * The copy command.
     */
    private string $copyCommand = 'cp -Rfp';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'git:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Izvaja ukaze, potrebne za posodobitev vaše spletne strani z uporabo Git';

    /**
     * @var string[]
     */
    private const ADDITIONAL = [
        '.env',
        'laravel-echo-server.json',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->input = new ArgvInput();
        $this->output = new ConsoleOutput();

        $this->io = new SymfonyStyle($this->input, $this->output);

        $this->info('
        ***************************
        * Git Updater v3.0   *
        ***************************
        ');

        $this->line('<fg=cyan>
        THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
        
        IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, 
        SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE 
        GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) EVEN IF ADVISED OF THE POSSIBILITY 
        OF SUCH DAMAGE.
        
        WITH THAT SAID YOU CAN BE GUARANTEED THAT YOUR DATABASE WILL NOT BE ALTERED.
        
        <fg=red>BY PROCEEDING YOU AGREE TO THE ABOVE DISCLAIMER! USE AT YOUR OWN RISK!</>
        </>');

        if (! $this->io->confirm('Ali želite nadaljevati', true)) {
            $this->line('<fg=red>Prekinjen ...</>');
            exit();
        }

        $this->io->writeln('
        Za prekinitev pritisnite CTRL + C KADAR koli! Prekinitev lahko povzroči nepričakovane rezultate!
        ');

        \sleep(1);

        $this->update();

        $this->white('Prosimo, sporočite morebitne napake ali težave.');

        $this->done();
    }

    private function update(): void
    {
        $updating = $this->checkForUpdates();

        if ((\is_countable($updating) ? \count($updating) : 0) > 0) {
            $this->alertDanger('Najdene posodobitve');

            $this->cyan('Datoteke, ki jih je treba posodobiti:');
            $this->io->listing($updating);

            if ($this->io->confirm('Začnite postopek posodobitve', true)) {
                $this->call('down');

                $this->process('git add .');

                $paths = $this->paths();

                $this->backup($paths);

                $this->header('Ponastavitev skladišča');

                $this->commands([
                    'git fetch origin',
                    'git reset --hard origin/master',
                ]);

                $this->restore($paths);

                $conflicts = \array_intersect($updating, $paths);
                if ($conflicts !== []) {
                    $this->red('Nekatere datoteke niso bile posodobljene zaradi konfliktov.');
                    $this->red('Zdaj vas bomo vodili skozi posodabljanje teh datotek.');

                    $this->manualUpdate($conflicts);
                }

                if ($this->io->confirm('Zaženi nove selitve (php artisan migrate)', true)) {
                    $this->migrations();
                }

                $this->clearCache();

                if ($this->io->confirm('Namestite nove pakete (composer install)', true)) {
                    $this->composer();
                }

                $this->clearComposerCache();

                $this->updateSLOSHAREConfig();

                $this->setCache();

                if ($this->io->confirm('Prevedi sredstva (npx mix -p)', true)) {
                    $this->compile();
                }

                $this->permissions();

                $this->supervisor();

                $this->php();

                $this->header('Oživljanje spletnega mesta');
                $this->call('up');
            } else {
                $this->alertDanger('Prekinjena posodobitev');
                exit();
            }
        } else {
            $this->alertSuccess('Ni razpoložljivih posodobitev');
        }
    }

    private function checkForUpdates(): array
    {
        $this->header('Preverjanje posodobitev');

        $this->process('git fetch origin');
        $process = $this->process('git diff ..origin/master --name-only');
        $updating = \array_filter(\explode("\n", $process->getOutput()), 'strlen');

        $this->done();

        return $updating;
    }

    private function manualUpdate($updating): void
    {
        $this->alertInfo('Ročna posodobitev');
        $this->red('Posodobitev bo povzročila, da IZGUBITE vse spremembe, ki ste jih morda naredili v datoteki!');

        foreach ($updating as $file) {
            if ($this->io->confirm(\sprintf('Update %s', $file), true)) {
                $this->updateFile($file);
            }
        }

        $this->done();
    }

    private function updateFile($file): void
    {
        $this->process(\sprintf('git checkout origin/master -- %s', $file));
    }

    private function backup(array $paths): void
    {
        $this->header('Varnostno kopiranje datotek');

        $this->commands([
            'rm -rf '.\storage_path('gitupdate'),
            'mkdir '.\storage_path('gitupdate'),
        ], true);

        foreach ($paths as $path) {
            $this->validatePath($path);
            $this->createBackupPath($path);
            $this->process($this->copyCommand.' '.\base_path($path).' '.\storage_path('gitupdate').'/'.$path);
        }

        $this->done();
    }

    private function restore(array $paths): void
    {
        $this->header('Obnavljanje varnostnih kopij');

        foreach ($paths as $path) {
            $to = Str::replaceLast('/.', '', \base_path(\dirname($path)));
            $from = \storage_path('gitupdate').'/'.$path;

            if (\is_dir($from)) {
                $to .= '/'.\basename($from).'/';
                $from .= '/*';
            }

            $this->process(\sprintf('%s %s %s', $this->copyCommand, $from, $to));
        }

        $this->commands([
            'git add .',
            'git checkout origin/master -- package-lock.json',
            'git checkout origin/master -- composer.lock',
        ]);
    }

    private function composer(): void
    {
        $this->header('Namestitev paketov Composer');

        $this->commands([
            'composer self-update',
            'composer install --prefer-dist --no-dev -o',
        ]);

        $this->done();
    }

    private function compile(): void
    {
        $this->header('Compiling Assets ...');

        $this->commands([
            'npm install npm -g',
            'rm -rf node_modules',
            'npm cache clean --force',
            'npm install --no-audit',
            'npx mix -p',
        ]);

        $this->done();
    }

    private function updateSLOSHAREConfig(): void
    {
        $this->header('Posodabljanje konfiguracijske datoteke SLOshare.eu');
        $this->process('git fetch origin && git checkout origin/master -- config/sloshare.php');
        $this->done();
    }

    private function clearComposerCache(): void
    {
        $this->header('Brisanje predpomnilnika Composer');
        $this->process('composer clear-cache --no-interaction --ansi --verbose');
        $this->done();
    }

    private function clearCache(): void
    {
        $this->header('Čiščenje predpomnilnika aplikacij');
        $this->call('optimize:clear');
        $this->done();
    }

    private function setCache(): void
    {
        $this->header('Nastavitev predpomnilnika');
        $this->call('optimize');
        $this->done();
    }

    private function migrations(): void
    {
        $this->header('Izvajanje novih migracij');
        $this->call('migrate');
        $this->done();
    }

    private function permissions(): void
    {
        $this->header('Osvežitev dovoljenj');
        $this->process('chown -R www-data: storage bootstrap public config');
        $this->done();
    }

    private function supervisor(): void
    {
        $this->header('Ponovni zagon nadzornika');
        $this->call('queue:restart');
        $this->process('supervisorctl reread && supervisorctl update && supervisorctl reload');
        $this->done();
    }

    private function php(): void
    {
        $this->header('Ponovni zagon PHP');
        $this->process('systemctl restart php8.1-fpm');
        $this->done();
    }

    private function validatePath($path): void
    {
        if (! \is_file(\base_path($path)) && ! \is_dir(\base_path($path))) {
            $this->red(\sprintf("Pot '%s' je neveljavno", $path));
        }
    }

    private function createBackupPath($path): void
    {
        if (! \is_dir(\storage_path(\sprintf('gitupdate/%s', $path))) && ! \is_file(\base_path($path))) {
            if (! \mkdir($concurrentDirectory = \storage_path(\sprintf('gitupdate/%s', $path)), 0775, true) && ! \is_dir($concurrentDirectory)) {
                throw new \RuntimeException(\sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        } elseif (\is_file(\base_path($path)) && \dirname($path) !== '.') {
            $path = \dirname($path);
            if (! \is_dir(\storage_path(\sprintf('gitupdate/%s', $path))) && ! \mkdir($concurrentDirectory = \storage_path(\sprintf(
                'gitupdate/%s',
                $path
            )), 0775, true) && ! \is_dir($concurrentDirectory)) {
                throw new \RuntimeException(\sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
    }

    private function paths(): array
    {
        $p = $this->process('git diff master --name-only');
        $paths = \array_filter(\explode("\n", $p->getOutput()), 'strlen');

        return \array_merge($paths, self::ADDITIONAL);
    }
}
