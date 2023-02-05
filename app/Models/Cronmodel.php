<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of Cronmodel
 *
 * @author breinard
 */

class Cronmodel extends model{
    
       public function getdetails() {
           
        $db = \Config\Database::connect();
        $builder = $db->table('cronDetails');

        $builder->select('*');
        $query = $builder->get();

        $res = $query->getResult();
        return $res;
    }
    
     public function getEditCronList($data) {
           
        $db = \Config\Database::connect();
        $builder = $db->table('cronDetails');
        
        $cron_id = $data['cron_id'];

        $builder->select('*');
        $builder->where('cron_id' ,$cron_id);
        $query = $builder->get();

        $res = $query->getResult();
        return $res;
    }
    
    
    public function insertCron($data) {
        
        $db = \Config\Database::connect();

        $tbl = $db->table('cronDetails');


        $tbl->insert($data);
    }

    
    public function editOrUpdateCron($data) {
        
        $db = \Config\Database::connect();
        $tbl = $db->table('cronDetails');
        
        $cron_id = $data['cron_id'];
        $cron_label = $data['cron_label'];
        $cron_url = $data['cron_url'];
        $minute = $data['minute'];
        $day_of_week = $data['day_of_the_week'];
        $days = $data['days'];
        $months = $data['month'];
        $reccurance = $data['reccurance'];
        $hour = $data['hour'];

        $tbl->set('cron_label', $cron_label);
        $tbl->set('cron_url', $cron_url);
        $tbl->set('minute', $minute);
        $tbl->set('day_of_the_week', $day_of_week);
        $tbl->set('days', $days);
        $tbl->set('month', $months);
        $tbl->set('hour', $hour);
        $tbl->set('reccurance', $reccurance);
        $tbl->where('cron_id', $cron_id);
        $tbl->update();

        $query = $tbl->get();
        $result = $query->getResult();
        
//        return $result;
//        
//        if (isset($result)) {
            return $data;
//        } else {
//            return 'nothing';
//        }
    }
    
    
//    delete cron function
    
     public function deleteCron($data) {
        
        $db = \Config\Database::connect();
        
        $cron_id = $data['cron_id'];
        
        $tbl = $db->table('cronDetails');
        $tbl->where('cron_id', $cron_id);
        $tbl->delete();
    }
    
    public function getDeleteCronDetail($data) {
        
         $db = \Config\Database::connect();
        $builder = $db->table('cronDetails');

        $builder->select('cron_command');
        $builder->where('cron_id',$data);
        $query = $builder->get();

        $res = $query->getResult();
        return $res;
    }
}
