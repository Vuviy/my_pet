<?php

namespace Modules\Parser\Console;

use App\Models\Test;
use Illuminate\Console\Command;
use Modules\Parser\Contracts\IDataResource;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Parse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'parse:site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *`
     * @return mixed
     */
    public function handle(IDataResource $resource)
    {
        $resource->parse('https://www.work.ua/salary/');
        $resource->saveInDB();

        return 'file created';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
//            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
//            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
