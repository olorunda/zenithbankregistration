<?php

namespace Database\Seeders;

use App\Models\ValidatedUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeedValidatedUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->import();
    }

    public function import()
    {
        $csvFile = fopen('C:\Users\ADMIN\PhpstormProjects\zenithbank\database\seeders\validated_users.csv', 'r'); // Path to your CSV file
        $data_to_import=[];
// Check if the file is opened successfully
        if ($csvFile !== false) {
            // Read the headers
            $headers = fgetcsv($csvFile);
            $i=0;
            // Loop through the file line by line
            while (($row = fgetcsv($csvFile)) !== false) {
                // Combine headers with values
                $data = array_combine($headers, $row);
                $data_to_import[]=[
                    'ran'=>$data['RAN'],
                    'chn'=>$data['CHN'],
                    'name'=>$data['NAME'],
                    'holdings'=>$data['HOLDINGS'],
                    'address'=>$data['ADDRESS'],
                    'phone_num'=>$data['PHONE NO'],
                    'emails'=>$data['EMAILS'],
                    ];
                if($i%1000==0){
                    ValidatedUser::insert($data_to_import);
                    $data_to_import=[];
                }

                $i++;
                // Print the row data

            }

            fclose($csvFile);
            ValidatedUser::insert($data_to_import);
        } else {
            echo "Failed to open file.";
        }
    }
}
