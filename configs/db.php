<?php
    class Database {
        public static function connect() {
            $db = new mysqli('localhost','u438675109_arevaloleo','Piedra4585728','u438675109_turnos');
            $db->query("SET NAMES 'utf8'");
            return $db;
        }

        private function db_close($db){
            $this->db->close();
        }
        
    }