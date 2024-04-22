<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{


    public $titleArray =['mr', 'mr.', 'mrs','mrs.', 'ms','ms.', 'miss','miss.', 'dr','dr.', 'prof','prof.', 'mister', 'mister.'];
    public $people = [];

    public function processCsv(Request $request, $csvFile='')
    {
        $request->validate ([
            'csvFile' => 'file|mimetypes:text/plain,text/csv',
        ]);

        $csvFile = $request->csvFile;//
        $file = fopen($csvFile,"r");


        while( $data = fgetcsv($file)) {
            $name = $data[0];
            $parts = [];
            array_push($parts, $name);

            // Split names into parts there's a seperator i.e and, &, mr and mrs
            if(str_contains(strtolower(trim($name)), ' and ')){
                $parts = $this->checkSeperator($name, 'and', 'mr', 'mrs');
            }

            if(str_contains(strtolower(trim($name)), ' & ')){
                $parts = $this->checkSeperator($name, '&', 'mr');
            }


            foreach ($parts as $part) {
                $person = [
                    'title' => null,
                    'first_name' => null,
                    'initial' => null,
                    'last_name' => null
                ];

                $namePosition = strtok(trim($part), ' ');
                if (in_array(strtolower($namePosition), $this->titleArray)) {
                    $person['title'] = $namePosition;
                    $namePosition = strtok(" ");
                }

                if(strlen($namePosition) <= 2 ){
                    $person['initial'] = $namePosition;
                    $namePosition = strtok(" ");
                }

                if(strlen($namePosition) >= 3){
                    $isLastname = explode(' ', $part);
                    if(strtolower( trim(array_pop($isLastname)) ) !== strtolower(trim($namePosition)) ) {
                        $person['first_name'] = $namePosition;
                    }
                }

                // Parse last name
                $lastSpacePos = strrpos(trim($part), ' ');
                if ($lastSpacePos !== false) {
                    $person['last_name'] = substr(trim($part), $lastSpacePos + 1);
                } else {
                    // If no space is found, assume the entire part is the last name
                    $person['last_name'] = trim($part);
                }

                // Add person to array
                $this->people[] = $person;
            }

        }

        fclose($file);


        // return response()->json($people);
        return view('index', ['people' => $this->people]); // redirect()->route('/')->with($people);


    }

    public function checkSeperator(string $string, string $seperator, string $prefix = '', string $surfix = '' )  {

        $seperator = ' '.strtolower(trim($seperator)).' ';
        $prefix = strtolower(trim($prefix));
        $surfix = strtolower(trim($surfix));

        if(str_contains(strtolower(trim($string)), $seperator)){
            $parts = explode($seperator, $string);
            if (count($parts) > 1  ) {
                if(
                    str_contains(strtolower(trim($string)), $prefix.$seperator) ||
                    str_contains(strtolower(trim($string)), $seperator.$surfix) ||
                    str_contains(strtolower(trim($string)), $surfix.$seperator) ||
                    str_contains(strtolower(trim($string)), $seperator.$prefix)

                ){
                    $parts[0] = $parts[0].' ' .substr(end($parts),  strpos(end($parts), ' '));
                }
            }
            return $parts;
        }
        return false;
    }



}