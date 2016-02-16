<?php namespace Jrenton\Laravel5Scaffold;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ScaffoldFromFileCommand extends Command
{
    protected $signature = 'scaffold:file';

    protected $description = "Makes table, controller, model, views, seeds, and repository from file";

    protected $app;

    public function __construct($app)
    {
        parent::__construct();
        $this->app = $app;
    }

    public function handle()
    {
        $scaffold = new Scaffold($this);

        $this->info('Please wait while all your files are generated...');

        $scaffold->createModelsFromFile($this->argument('file'));

        $this->info('Finishing...');

        $this->call('clear-compiled');

        $this->call('optimize');

        $this->info('Done!');
    }

    protected function getArguments()
    {
        return array(
            array('file', InputArgument::REQUIRED, 'Path to the file'),
        );
    }

}
