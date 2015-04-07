<?php
   function adminer_object() {
        class AdminerSoftware extends Adminer {

        function permanentLogin() {
            // key used for permanent login
            return "8240598f61ebac7cf7d6ab1e5a5706cf";
        }

            function credentials() {
               // === Get root path =======================================================
               $path_array = explode("\\us_opt2",dirname(__FILE__)); // Split at folder
               $root       = substr($path_array[0],0,-5);   // Get path e.g C:\..\UniServer

               // === Get MySQL Password ==================================================
               $file="$root\htpasswd\mysql\passwd.txt" ; //Name and path of password file
               $fh = fopen($file, 'r');                  //Open for read
               $password = trim(fgets($fh));             //Get first line removce /n
               fclose($fh);                              //Close
               // ============================================== END Get MySQL Password ===

               // server, username and password for connecting to database
               return array('127.0.0.1', 'root', $password);
            }
            function database() {
                // database name, will be escaped by Adminer
                return '';
            }
        }
        return new AdminerSoftware;
    }
  require_once("adminer.php");
?>