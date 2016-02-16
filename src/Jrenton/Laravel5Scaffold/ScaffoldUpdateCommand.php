<?php namespace Jrenton\Laravel5Scaffold;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class ScaffoldUpdateCommand extends Command
{
    protected $signature = 'scaffold:update';

    protected $description = "Update model and database schema based on changes to models file";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Updating...');

        $scaffold = new Scaffold($this);

        $scaffold->update();

        $this->info('Finishing...');

        $this->call('clear-compiled');

        $this->call('optimize');

        $this->info('Done!');
    }

    protected function getArguments()
    {
        return array(
            array('name', InputArgument::OPTIONAL, 'Name of the model/controller.'),
        );
    }
}