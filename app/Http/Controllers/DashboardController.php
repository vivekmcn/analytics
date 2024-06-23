<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Project;
use App\Models\User;
use App\Models\Credential;
use App\Models\KeywordPosition;
use App\Models\Keyword;
use App\Models\Competitor;
use App\Models\Position;
use App\Models\PositionReport;
use App\Models\CustomerProject;
use Illuminate\Support\Facades\Auth;
use PDF;
use Session;
use Analytics;
use Google_Client;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    
    public function index()
    {
        $customer       =   Customer::where('user_id', Auth::user()->id)->first();
        $dayMonths      =   [];

        $customerprojects = CustomerProject::where('customer_id', $customer->id)->pluck('project_id' ,'id')->toArray();
        $projectlist    =   Project::whereIn('id', $customerprojects)->pluck('name', 'id')->toArray();
        $project        =   Project::whereIn('id', $customerprojects)->first();

        //Get ga 4 data
        $response = [];
        $credential     =   Credential::where('project_id', $project->id)->where('credential_type_id', 3)->first();
        //Interval set to last 6 months
        $start_date =   date("Y-m-01", strtotime("-5 months"));
        $end_date   =   date("Y-m-t");
        $startdate =  $start_date;
        while(strtotime($startdate)<strtotime($end_date)){
            $dayMonths[] = date("M Y", strtotime($startdate));
            $startdate = date("Y-m-d",strtotime($startdate." +1 months"));
        }

        config(['analytics.property_id' => $project->property_id]);
        $analytics = new Analytics();
        $period = Period::create(new \DateTime($start_date), new \DateTime($end_date));
        $analyticsData = Analytics::get(
            $period,
            ['totalUsers'],
            ['defaultChannelGroup','yearMonth'],
            0
        );   
        $data = json_decode($analyticsData, true);
        foreach($data as $row){    
            $response['ga4']['current'][$row['defaultChannelGroup']][$row['yearMonth']]['total'] = $row['totalUsers'];
        }   

        // Interval set to previous 6 months
        $start_date =   date("Y-m-01", strtotime("-12 months"));
        $end_date   =   date("Y-m-t", strtotime("-6 months"));
        config(['analytics.property_id' => $project->property_id]);
        $analytics = new Analytics();
        $period = Period::create(new \DateTime($start_date), new \DateTime($end_date));
        $analyticsData = Analytics::get(
            $period,
            ['totalUsers'],
            ['defaultChannelGroup','yearMonth'],
            0
        );   
        $data = json_decode($analyticsData, true);
        $convertionEvent  = [];
        foreach($data as $row){    
             $response['ga4']['prev'][$row['defaultChannelGroup']][$row['yearMonth']]['total'] = $row['totalUsers'];
        }

        //Get ga 3 data
        $credential     =   Credential::where('project_id', $project->id)->where('credential_type_id', 1)->first();
        //Interval set to last 6 months
        $start_date =   date("Y-m-01", strtotime("-5 months"));
        $end_date   =   date("Y-m-t");
        config(['analytics.property_id' => $project->property_id]);
        $analytics = new Analytics();
        $period = Period::create(new \DateTime($start_date), new \DateTime($end_date));
        $analyticsData = Analytics::get(
            $period,
            ['totalUsers'],
            ['defaultChannelGroup','yearMonth'],
            0
        );   
        $data = json_decode($analyticsData, true);
        foreach($data as $row){    
            $response['ga3']['current'][$row['defaultChannelGroup']][$row['yearMonth']]['total'] = $row['totalUsers'];
        }   

        // Interval set to previous 6 months
        $start_date =   date("Y-m-01", strtotime("-12 months"));
        $end_date   =   date("Y-m-t", strtotime("-6 months"));
        config(['analytics.property_id' => $project->property_id]);
        $analytics = new Analytics();
        $period = Period::create(new \DateTime($start_date), new \DateTime($end_date));
        $analyticsData = Analytics::get(
            $period,
            ['totalUsers'],
            ['defaultChannelGroup', 'yearMonth'],
            0
        );   
        $data = json_decode($analyticsData, true);
        $convertionEvent  = [];
        foreach($data as $row){    
             $response['ga3']['prev'][$row['defaultChannelGroup']][$row['yearMonth']]['total'] = $row['totalUsers'];
        }         
       
        $majorChannels  = ['Organic Search', 'Direct', 'Referral', 'Organic Social','Email', 'Paid Search'];
        
        $ga4DataSetsSolid = [];
        foreach ($majorChannels as $key => $channel) {
            if(isset($response['ga4']['current'][$channel])){
                foreach ($dayMonths as $key => $dayMonth) {
                    $ga4DataSetsSolid[$channel][$dayMonth] = $response['ga4']['current'][$channel][date("Ym", strtotime($dayMonth))]?$response['ga4']['current'][$channel][date("Ym", strtotime($dayMonth))]['total']:0;
                }
            }else{
                foreach ($dayMonths as $key => $dayMonth) {
                    $ga4DataSetsSolid[$channel][$dayMonth] = 0;
                }
            }
        }
        $ga4DataSetsDotted = [];
        foreach ($majorChannels as $key => $channel) {
            if(isset($response['ga4']['prev'][$channel])){
                foreach ($dayMonths as $key => $dayMonth) {
                    $dayMonthDate = date("Ym",strtotime($dayMonth." -6 months"));
                    $ga4DataSetsDotted[$channel][$dayMonth] = $response['ga4']['prev'][$channel][$dayMonthDate]?$response['ga4']['prev'][$channel][$dayMonthDate]['total']:0;
                }
            }else{
                foreach ($dayMonths as $key => $dayMonth) {
                    $ga4DataSetsDotted[$channel][$dayMonth] = 0;
                }
            }
        }
        $ga3DataSetsSolid = [];
        foreach ($majorChannels as $key => $channel) {
            if(isset($response['ga3']['current'][$channel])){
                foreach ($dayMonths as $key => $dayMonth) {
                    $ga3DataSetsSolid[$channel][$dayMonth] = $response['ga3']['current'][$channel][date("Ym", strtotime($dayMonth))]?$response['ga3']['current'][$channel][date("Ym", strtotime($dayMonth))]['total']:0;
                }
            }else{
                foreach ($dayMonths as $key => $dayMonth) {
                    $ga3DataSetsSolid[$channel][$dayMonth] = 0;
                }
            }
        }
        $ga3DataSetsDotted = [];
        foreach ($majorChannels as $key => $channel) {
            if(isset($response['ga3']['prev'][$channel])){
                foreach ($dayMonths as $key => $dayMonth) {
                    $dayMonthDate = date("Ym",strtotime($dayMonth." -6 months"));
                    $ga3DataSetsDotted[$channel][$dayMonth] = $response['ga3']['prev'][$channel][$dayMonthDate]?$response['ga3']['prev'][$channel][$dayMonthDate]['total']:0;
                }
            }else{
                foreach ($dayMonths as $key => $dayMonth) {
                    $ga3DataSetsDotted[$channel][$dayMonth] = 0;
                }
            }
        }
         $dayMonths = "'".implode("','", $dayMonths)."'";

        return view('user.dashboard')->with(compact('ga4DataSetsSolid', 'ga4DataSetsDotted', 'ga3DataSetsSolid', 'ga3DataSetsDotted', 'dayMonths', 'majorChannels'));
    }

    public function readDrive(){
        $client = $this->getClient(\Google_Service_Drive::DRIVE);
        // var_dump($client);exit;
        $service = new \Google_Service_Drive($client);
        $sheetService = new \Google_Service_Sheets($client);
        $list = $service->files->listFiles();
        // var_dump($list);exit;
        $values=[];
        foreach($list->getFiles() as $file) {
            $result = $sheetService->spreadsheets->get($file->id, [ "ranges"=> "May '24!A2:C2", "fields" => "sheets(data(rowData(values(hyperlink,formattedValue))))","includeGridData" => true]);
            print_r($result);exit;
            $rowData = $result->getSheets()[0]->getData()[0]->getRowData();
            echo "<pre>";
            foreach ($rowData as $i => $row) {
                foreach ($row as $j => $col) {
                    print_r($col);
                    $link = $col->getHyperlink();
                    if (isset($link)) {
                        array_push($values, [$col->getFormattedValue(), $link]);
                    }
                }
            }
            exit;
            echo "<pre>";
            print_r($values);exit;
        }
        exit;

    }

    public function getClient($scopes){

        putenv("GOOGLE_APPLICATION_CREDENTIALS=".app_path('GA') . DIRECTORY_SEPARATOR ."drive.json");
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setApplicationName('Analytics');
        $client->setScopes($scopes);
        return $client;

    }
    
}