<?php

namespace App\Console\Commands;

use App\Jobs\ImportXMLofHC;
use App\Models\ImportCSV;
use App\Models\ImportXML;
use Illuminate\Console\Command;

class importXMLDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importXML';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is command for import xml every day';

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
     *
     * @return mixed
     */
    public function handle()
    {
        dispatch(new ImportXMLofHC());
        $import_xml = ImportXML::find(1);
        $import_xml->last_import = date('Y-m-d H:i:s');
        $import_xml->save();
        echo "Importing Done";
    }
}
