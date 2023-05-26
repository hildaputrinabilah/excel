<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Data;
use Illuminate\Database\Seeder;
use Rap2hpoutre\FastExcel\FastExcel;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $Data = (new FastExcel)->import('Healthiness Dashboard.xlsx', function ($line) {
            return Data::create([
                'it_project' => $line['It Project'],
                'summary' => $line['Summary'],
                'name_project' => $line['Name Project'],
                'assignee' => $line['Assignee'],
                'reporter' => $line['Reporter'],
                'priority' => $line['Priority'],
                'status' => $line['Status'],
                'created' => $line['Created'],
                'squad' => $line['Squad']
                
            ]);
        });
        
    }
}
