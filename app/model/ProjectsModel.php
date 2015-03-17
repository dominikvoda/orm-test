<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

/**
 * Description of ProjectsModel
 *
 * @author Dominik
 */
class ProjectsModel extends \Nette\Object{
    
     const TABLE_NAME = 'projects';
     const TABLE_FTP = 'ftp';
     const TABLE_DATABSE = 'database';
     const TABLE_CONTACTS = 'contacts';
     const TABLE_WEBHOSTING = 'webhosting';
     
     private $database;
     
     public function __construct(\Nette\Database\Context $database) {
         $this->database = $database;
     }
     
     public function getProjects(){
         return $this->database->table(self::TABLE_NAME);
     }
     
     public function getProject($id){
         return $this->getProjects()->get($id);
     }
     
     public function getFtp($id){
         return $this->database->table(self::TABLE_FTP)->where('project', $id)->fetch();
     }
     
     public function getDatabase($id){
         return $this->database->table(self::TABLE_DATABSE)->where('project', $id)->fetch();
     }
     
     public function getWebhosting($id){
         return $this->database->table(self::TABLE_WEBHOSTING)->where('project', $id)->fetch();
     }
     
     public function getContacts($id){
         return $this->database->table(self::TABLE_CONTACTS)->where('project', $id)->fetchAll();
     }
}
