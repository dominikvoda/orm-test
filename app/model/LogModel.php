<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Nette\Database\Context;

/**
 * Description of LogModel
 *
 * @author Dominik
 */
class LogModel extends \Nette\Object{
    /** @var Nette\Database\Context */
    private $database;
    
    const LOGIN_TABLE = 'login_log';
    const ACTIONS_TABLE = 'actions_log';
    
    public function __construct(Context $database) {
        $this->database = $database;
    }
    
    public function getLoginLogByUser($id){
        return $this->database->table(self::LOGIN_TABLE)->where('user_id', $id)->order('date DESC');
    }
    
    public function addRecord($creatorId, $message, $ip){
        $array['user_id'] = $creatorId;
        $array['ip'] = $ip;
        $array['date'] = new \Nette\Utils\DateTime;
        $array['text'] = $message;
        $this->database->table(self::ACTIONS_TABLE)->insert($array);
    }
}
