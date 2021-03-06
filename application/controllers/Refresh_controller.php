<?php defined('BASEPATH') or exit('No direct script access allowed');

class Refresh_controller extends CI_Controller {

  public function refresh(){


          $database="doctores_db7";
          $mysqli = mysqli_connect("localhost", "doctores_u16", "%^nNtJ*5&Vm_", $database);
          // Check for errors
          if (mysqli_connect_errno()){
              echo "mysqli not connect";
          }

      /* query all tables */
          $sql = "SHOW TABLES WHERE tables_in_doctores_db7 not like 'ci_%'";
          if($result = mysqli_query($mysqli,$sql)){
            /* add table name to array */
            while($row = mysqli_fetch_row($result)){
              $found_tables[]=$row[0];
            }
          }
          else{
            die("Error, could not list tables.");
          }

  
          /* loop through and drop each table */
          foreach($found_tables as $table_name){
            $sql = "DROP TABLE $database.$table_name";
            if($result = mysqli_query($mysqli,$sql)){
              // echo "Success - table $table_name deleted.<br>";
            }
            else{
              // echo "Error deleting";
            }
          }

  
         // Open the default SQL file
         $query = file_get_contents('refresh/sql/re_install.sql');
  
          // Execute a multi query
          $multi_query = $mysqli->multi_query($query);
          // Close the connection
          $mysqli->close();
   }

}