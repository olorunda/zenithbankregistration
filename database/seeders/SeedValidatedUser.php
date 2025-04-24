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
//        $csvFile = fopen('C:\Users\ADMIN\PhpstormProjects\zenithbank\database\seeders\real.csv', 'r'); // Path to your CSV file
        $csvFile = fopen('/var/www/html/projects/zenithbankregistration/database/seeders/real.csv', 'r'); // Path to your CSV file
        $data_to_import=[];
// Check if the file is opened successfully
        if ($csvFile !== false) {
            // Read the headers
            $headers = fgetcsv($csvFile);
            $i=0;
            // Loop through the file line by line
            while (($row = fgetcsv($csvFile)) !== false) {
                // Combine headers with values
//                dd($headers);
                $data = array_combine($headers, $row);
                $data_to_import[]=[
//                    'acct_num'=>$data['Account No'],
                    'ran'=>$data["\u{FEFF}Account No"],
                    'chn'=>$data['CHN'] ?? '.',
                    'name'=>$data['Full Name'] ?? '.',
                    'holdings'=>$data['Holding'] ?? '.',
                    'address'=>$data['Address'] ?? '.',
                    'phone_num'=>$data['Mobile Number'] ?? '.',
                    'emails'=>$data['Email Address'],
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
