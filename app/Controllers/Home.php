<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Cronmodel;
use CodeIgniter\Files\File;
use Config\Services;

class Home extends BaseController {

    public function index() {
        return view('Views/dashboard');
    }

    public function createcron() {
        return view('Views/createCron');
    }

    public function test() {

//$cron_job = "* * * * * /usr/bin/php /path/to/script.php >> /home/kent/cronTest/myJob.log 2>&1 ";

//        $cron_job = "*/1 * * * * /usr/bin/sh /home/breinard/Downloads/testing/new.sh >> /home/breinard/Downloads/myjob.log 2>&1 ";
//        $cron_job = "*/1 * * * * /usr/bin/php /home/breinard/Downloads/testing/CronURLScript.php >> /home/breinard/Downloads/myjob.log 2>&1 ";

        $cron_job = "*/1 * * * * /usr/bin/php /var/www/html/cronjob/app/Scripts/CronURLScript.php >> /home/breinard/Downloads/log.log 2>&1 ";

        shell_exec("(crontab -l ; echo '" . $cron_job . "') | crontab -");

        echo "Cron job added successfully!";

        die;
    }
    
    public function removecron() {

$jobs = shell_exec("crontab -l"); 
	$to_remove = "* * * * * php /usr/local/scripts/newjob.php";
	$removed = str_replace($to_remove,"",$jobs); 
	shell_exec("echo '$removed' | sort | uniq | crontab"); 

        die;
    }

    public function test2() {
        
        $job_list = shell_exec("crontab -l"); 
        
        $cron_jobs = explode("\n", $job_list);
        
        var_dump($cron_jobs);
        
        die;
        
    }

    public function edit($cron_id = null) {

        $user = new Cronmodel();
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $session = \Config\Services::session();

        $session->set('cron_id', $cron_id);

        $data = ["cron_id" => $cron_id];

        $a = $user->getEditCronList($data);
        if ($a) {
//            return $this->response->setJSON($a);
            $data['details'] = $a;
            return view('Views/editCron', $data);
        } else {
            $data = ["status" => 'failed'];
            return $this->response->setJSON($data);
        }
    }

//   get existing cron details from database

    function get_cron_list() {

        $user = new Cronmodel();
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $a = $user->getdetails();
        if ($a) {
            return $this->response->setJSON($a);
        } else {
            $data = ["status" => 'failed'];
            return $this->response->setJSON($data);
        }
    }

    //   get particular edit cron details from database
//    function get_edit_cron_list() {
//
//        $user = new Cronmodel();
//        $request = \Config\Services::request();
//        $session = \Config\Services::session();
//        $session = \Config\Services::session();
//        
//        $cron_id = $request->getPost('cron_id');
//        $session->set('cron_id', $cron_id);
//        
//        $data = ["cron_id" => $cron_id];
//        
//        $a = $user->getEditCronList($data);
//        if ($a) {
////            return $this->response->setJSON($a);
//            return view('Views/editCron');
//        } else {
//            $data = ["status" => 'failed'];
//            return $this->response->setJSON($data);
//        }
//    }
//    
    // Create a new task

    public function createcron_func() {

//      default values

        $minute = '*';
        $day_of_week = '*';
        $days = '';
        $months = '*';
        $reccurance = '∞';
        $hour = '*';
        $command = '/var/www/html/cronjob/app/Scripts/CronURLScript.php';

        // The command to be executed
//      $command = '/usr/bin/php /path/to/script.php >> /path/to/logfile.log 2>&1';
//      get post datas from fromtend 

        $user = new Cronmodel();
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $cron_label = $request->getPost('cron_label');
        $cron_url = $request->getPost('cron_url');
        $minute = $request->getPost('minute');
        $day_of_week = $request->getPost('day_of_week');
        $days = $request->getPost('days');
        $months = $request->getPost('months');
        $reccurance = $request->getPost('reccurance');
        $hour = $request->getPost('hour');

        if ($minute == '') {
            $minute = '*';
        }
        if ($day_of_week == '') {
            $day_of_week = '*';
        }
        if ($days == '') {
            $days = '*';
        }
        if ($months == '') {
            $months = '*';
        }
        if ($hour == '') {
            $hour = '*';
        }
        if ($reccurance == '') {
            $reccurance = '∞';
        }
        
        
//      The schedule for the task (in this example, every minute)
        $schedule = "$minute $hour $days $months $day_of_week";
        
        $cron_job = "$schedule /usr/bin/php $command >> /home/breinard/Downloads/log.log 2>&1 ";

        shell_exec("(crontab -l ; echo '" . $cron_job . "') | sort | uniq | crontab -");
        
        
//      data to be send to the model

        $data = [
            'cron_label' => $cron_label,
            'cron_url' => $cron_url,
            'minute' => $minute,
            'day_of_the_week' => $day_of_week,
            'days' => $days,
            'month' => $months,
            'reccurance' => $reccurance,
            'hour' => $hour,
            'cron_command' => $cron_job
        ];

//        send data to model

        $a = $user->insertCron($data);
        if ($data) {
            $data = ["status" => 'success'];
            return $this->response->setJSON($data);
        }
    }

    // Update an existing task

    function updateOrEditCron($cron_id = null) {

        $user = new Cronmodel();
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $cron_id = $request->getPost('cron_id');
        $cron_label = $request->getPost('cron_label');
        $cron_url = $request->getPost('cron_url');
        $minute = $request->getPost('minute');
        $day_of_week = $request->getPost('day_of_week');
        $days = $request->getPost('days');
        $months = $request->getPost('months');
        $reccurance = $request->getPost('reccurance');
        $hour = $request->getPost('hour');

        if ($minute == '') {
            $minute = '*';
        }
        if ($day_of_week == '') {
            $day_of_week = '*';
        }
        if ($days == '') {
            $days = '*';
        }
        if ($months == '') {
            $months = '*';
        }
        if ($hour == '') {
            $hour = '*';
        }
         if ($reccurance == '' || $reccurance == 0) {
            $reccurance = '∞';
        }

//      data to be send to the model
        $data = [
            'cron_id' => $cron_id,
            'cron_label' => $cron_label,
            'cron_url' => $cron_url,
            'minute' => $minute,
            'day_of_the_week' => $day_of_week,
            'days' => $days,
            'month' => $months,
            'reccurance' => $reccurance,
            'hour' => $hour
        ];

        $a = $user->editOrUpdateCron($data);

        if ($a) {
            $data = ["status" => 'success'];
            return $this->response->setJSON($a);
        } else {
            $data = ["status" => 'failed'];
            return $this->response->setJSON($data);
        }
    }

    // Delete an existing task

    function deleteCronFromDB() {

//      get post datas from fromtend 

        $user = new Cronmodel;
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $cron_id = $request->getPost('cron_id');

//      to be executed on the terminal
//        exec("sed -i '$cron_id d' /etc/cron.d/my_cron");
//        data to be send to the model
        $data = [
            'cron_id' => $cron_id
        ];

//        send data to model

        $a = $user->deleteCron($data);
//        if ($data) {
//            $data = ["status" => 'success'];
//            return $this->response->setJSON($data);
//        }
        
//      To delete it from crontab
        
    }
    
    
    //    crontab deletion function
    
    function getDeleteCommandFromCronTab() {

//      get post datas from fromtend 

        $user = new Cronmodel;
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        $cron_id = $this->request->getPost('cron_id');
        
        $details = $user->getDeleteCronDetail($cron_id);
        
         if ($details) {
             
            $to_remove = $details[0]->cron_command;
            $jobs = shell_exec("crontab -l"); 
            $removed = str_replace($to_remove,"",$jobs); 
            shell_exec("echo '$removed' | sort | uniq | crontab"); 
            
        } else {
            
            $data = ["status" => 'failed'];
            return $this->response->setJSON($data);
            
        }
    }

}
