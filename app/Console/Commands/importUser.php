<?php

namespace App\Console\Commands;

use App\Models\QrCode;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class importUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:user {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->argument('type')=='normal'){
            $this->loadData();
        }



        if($this->argument('type')=='regenerate_duplicate'){
            $qr=QrCode::selectRaw('max(id) as id')->groupby('token')->havingRaw('count(1)>1')->pluck('id')->toArray();

            Registration::whereIn('id',QrCode::whereIn('id',$qr)->pluck('registration_id')->toArray())->orderBy('id')->chunk(100,function ($data){
                foreach($data as $datum){
                    Artisan::call('regenerate:token',['email'=>$datum->email]);
                }

            });

        }


        return Command::SUCCESS;
    }

    public function loadData()
    {
        // Open the CSV file for reading
        $csvFile = 'New Student List.csv';
        if (($handle = fopen($csvFile, 'r')) !== FALSE) {

            // Read the header row first (if necessary)
            $headers = fgetcsv($handle);

            // Initialize an array to hold the CSV data
            $csvData = '';
            $data_to_insert=[];
            // Loop through the file line by line
            while (($row = fgetcsv($handle)) !== FALSE) {
                // Combine headers with row values for associative array
                $csvData=(object) array_combine($headers, $row);
                if(!empty($csvData->Name)) {
                    $data_to_insert = [
                        'name' => $csvData->Name,
                        'email' => $csvData->Email . '||' . mt_rand(11111111, 99999999),
                        'phone' => $this->checkPhone(mt_rand(11111111111, 99999999999)),
                        // 'company' => '',
                        'consent' => 'yes',
                        'reason_for_attending' => 'Attend workshop/conference',
                        'attending_masterclass' => 'no',
                        'master_classes' => "",
                        'is_zenith_customer' => 'no'
                    ];
//dd($data_to_insert);
                    $registration = Registration::updateOrCreate($data_to_insert);
                    $registration->qrcode()->create([
                        'url' => '',
                        'token' => '',
                    ]);
                    Artisan::call('regenerate:token', ['email' => $data_to_insert['email']]);
                }
            }

            // Close the file after reading
            fclose($handle);


        }
    }

    private function checkPhone($phone){
        if(Registration::where('phone',$phone)->exists()){

            return $this->checkPhone(mt_rand(111111111,999999999));
        }
        return $phone;
    }
}
