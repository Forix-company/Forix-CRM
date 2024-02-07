<?php

namespace Modules\Base\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class FetchDataFromApiStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:states';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from API states and store in cache';

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
     * @return int
     */
    public function handle()
    {
        $cacheKey = 'api_states';

        if (Cache::has($cacheKey)) {
            $this->info('Data already exists in cache.');
            return;
        }
        else {
            Cache::forget($cacheKey);

            $States = Http::withHeaders([
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            ])->get('https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/states.json');
            $array = json_decode($States, true);

            foreach ($array as $value) {
                $GetCitie[] = array('country_name' => $value["country_name"], 'name' => $value["name"]);
            }

            Cache::put($cacheKey, $GetCitie);

            $this->info('Data fetched and stored in cache.');
        }
    }
}
