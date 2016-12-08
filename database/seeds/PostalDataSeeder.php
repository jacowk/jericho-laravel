<?php

use Illuminate\Database\Seeder;
use jericho\Util\Util;
use jericho\Suburb;
use jericho\Area;

/**
 * This seeder is to load postal data from a file
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-25
 *
 */
class PostalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $load_data = true;
        
        if ($load_data)
        {
        	Suburb::truncate();
        	Area::truncate();
        	
        	$file_name = 'data/postalcodes.csv';
        	$postalcode_file = fopen($file_name, 'r');
        	
        	if (($handle = fopen($file_name, "r")) !== FALSE)
        	{
        		while (($input_array = fgetcsv($handle, 1000, ",")) !== FALSE)
        		{
        			//Get individual values
        			$suburb_name = $this->formatName($input_array[1]);
        			$suburb_box_code = $input_array[2];
        			$suburb_street_code = $input_array[3];
        			$area_name = $this->formatName($input_array[4]);
        			
        			if (!Util::isValidRequestVariable($suburb_name) && !Util::isValidRequestVariable($area_name))
        			{
        				Util::writeToLog('Postal data empty: ' . implode(',', $input_array));
        				continue;
        			}
        			if ($suburb_name === '-' || $area_name === '-')
        			{
        				Util::writeToLog('Postal data with dash: ' . implode(',', $input_array));
        				continue;
        			}
        			
        			if ($this->exlude($suburb_name))
        			{
        				continue;
        			}
        			if (!$this->include($area_name))
        			{
        				continue;
        			}
        			//Get existing Area
        			$area = Area::where('name', 'like', $area_name)->first();
        			
        			//Save area if it does not exist
        			if ($area == null)
        			{
        				$area = new Area();
        				$area->name = $area_name;
        				$area->created_by_id = 1;
        				$area->save();
        			}
        			//Get existing Suburb
        			$suburb = Suburb::where('name', 'like', $suburb_name)->first();
        			
        			//Save suburb if it does not exist
        			$suburb = new Suburb();
        			$suburb->name = $suburb_name;
        			$suburb->box_code = $suburb_box_code;
        			$suburb->street_code = $suburb_street_code;
        			$suburb->created_by_id = 1;
        			$suburb->save();
        			
        			//Hookup area and suburb
        			$area->suburbs()->save($suburb);
        		}
        		fclose($postalcode_file);
        	}
        }
    }
    
    private function formatName($name)
    {
    	$name = trim($name, '/r/n');
    	$name = strtolower($name);
    	$name = ucwords($name);
    	return $name;
    }
    
    private function exlude($name)
    {
    	$excludes = [' uit', ' fase', '-noord', '-oos', '-suid', '-wes', 'noord-', 'oos-', 'suid-', 'wes-'];
    	if (str_contains(strtolower($name), $excludes))
    	{
    		return true;
    	}
    	return false;
    }
    
    private function include($name)
    {
    	Util::writeToLog($name);
    	//$includes = ['Alberton', 'Alexandra', 'Atteridgeville', 'Bekkersdal', 'Benoni', 'Boipatong', 'Boksburg', 'Bophelong', 'Brakpan', 'Bronberg', 'Bronkhorstspruit', 'Carletonville', 'Centurion', 'Cullinan', 'Daveyton', 'Devon', 'Duduza', 'Edenvale', 'Ekangala', 'Evaton', 'Germiston', 'Hammanskraal', 'Heidelberg', 'Impumelelo', 'Irene', 'Isando', 'Johannesburg', 'Kagiso', 'Katlehong', 'Kempton Park', 'Khutsong', 'Kromdraai', 'Krugersdorp', 'KwaThema', 'Lenasia', 'Magaliesburg', 'Mamelodi', 'Meyerton', 'Midrand', 'Mohlakeng', 'Muldersdrift', 'Nigel', 'Pretoria', 'Randburg', 'Randfontein', 'Ratanda', 'Refilwe', 'Reiger Park', 'Roodepoort', 'Sandton', 'Sebokeng', 'Sharpeville', 'Soshanguve', 'Soweto', 'Springs', 'Tembisa', 'Thokoza', 'Tsakane', 'Vanderbijlpark', 'Vereeniging', 'Vosloorus', 'Wattville', 'Westonaria', 'Zithobeni'];
    	$includes = ['alberton', 'alexandra', 'atteridgeville', 'bekkersdal', 'benoni', 'boipatong', 'boksburg', 'bophelong', 'brakpan', 'bronberg', 'bronkhorstspruit', 'carletonville', 'centurion', 'cullinan', 'daveyton', 'devon', 'duduza', 'edenvale', 'ekangala', 'evaton', 'germiston', 'hammanskraal', 'heidelberg', 'impumelelo', 'irene', 'isando', 'johannesburg', 'kagiso', 'katlehong', 'kempton park', 'khutsong', 'kromdraai', 'krugersdorp', 'kwathema', 'lenasia', 'magaliesburg', 'mamelodi', 'meyerton', 'midrand', 'mohlakeng', 'muldersdrift', 'nigel', 'pretoria', 'randburg', 'randfontein', 'ratanda', 'refilwe', 'reiger park', 'roodepoort', 'sandton', 'sebokeng', 'sharpeville', 'soshanguve', 'soweto', 'springs', 'tembisa', 'thokoza', 'tsakane', 'vanderbijlpark', 'vereeniging', 'vosloorus', 'wattville', 'westonaria', 'zithobeni'];
    	if (str_contains(strtolower($name), $includes))
    	{
    		return true;
    	}
    	return false;
    }
}
