<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\User;
use Illuminate\Console\Command;
use function Symfony\Component\Translation\t;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:challenge_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing challenge example data from JSON file';

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
        $filename = 'challenge_data';
        $path = storage_path() . "/${filename}.json";

        $json = json_decode(file_get_contents($path), true);

        foreach ($json['users'] as $userData) {

            $user = User::firstOrCreate([
                'id' => $userData['id'],
                'name' => $userData['name'],
                'age' => $userData['age']
            ]);

            foreach ($userData['companies'] as $companyData) {
                $company = Company::firstOrCreate([
                    'id' => $companyData['id'],
                    'name' => $companyData['name'],
                    'started_at' => $companyData['started_at']
                ]);

                $user->companies()->attach($company->id);
            }
//            dd($user);
        }
    }
}
