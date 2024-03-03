<?php 

class Controller{
    private $db;

    function __construct($pdo){
        $this->db = $pdo;
        
    }

        
    function Delete($id){
        try{
            $sql = "DELETE FROM job WHERE ID IN($id)";
            $result = $this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    function showdata($section){
        try{ 
            $sql = "SELECT * FROM job WHERE section = '$section' ORDER BY ID DESC ";
            $result = $this->db->query($sql);
            return $result;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }
    function showdata_all(){
        try{ 
            $sql = "SELECT * FROM job ORDER BY ID DESC";
            $result = $this->db->query($sql);
            return $result;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }

    function showdata_id($ID){
          try{
              $sql = "SELECT * FROM job WHERE ID = '$ID'";
              $result = $this->db->query($sql);
              return $result;

          }catch(PDOException $e){
            $e->getMessage();
            return false;

          }

    }

    function countJob_all(){
        try{
            $sql = "SELECT COUNT(*) AS NUM FROM job WHERE  Finish = 'N' group by Finish;";
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $row = $result['NUM'];
            return $row;

        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }

    }

    function countjob_sub_all(){
        try{
            $sql = "SELECT COUNT(*) AS num FROM job_sub WHERE Finish = 'N' GROUP BY Finish;";
            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $count = $row['num'];
            return $count;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }



    function showdata_sub($Subject){
        try{ 
            $sql = "SELECT * FROM job_sub WHERE Subject = '$Subject' ORDER BY ID DESC ";
            $result = $this->db->query($sql);
            return $result;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }

    function finish_sub($all,$count,$Subject){
        try{ 
            date_default_timezone_set('Asia/Bangkok');
            $current_date = date('d/m/Y');

            $sql = "UPDATE job_sub SET Finish = 'Y', Finish_date = '$current_date' WHERE ID in ($all)";
            $result = $this->db->query($sql);

            $sql_sub = "SELECT Sub FROM job WHERE Subject = '$Subject';";
            $stmt = $this->db->query($sql_sub);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $Sub = $result['Sub'];

            $update = "UPDATE job SET Sub = $Sub-$count WHERE Subject = '$Subject'";
            $finish = $this->db->query($update);
            return true;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }


    function selectjobname($section){
        try{
            $sql = "SELECT DISTINCT `Subject` FROM job where Section = '$section'; ";
            $result = $this->db->query($sql);
            return $result;  

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }

    function Addjob($Date, $Subject, $Problem, $Requirement, $Request_by, $Receive, $Finish, $Sub, $Department, $Section){
        try{
            $sql = "INSERT INTO job (Date, Subject, Problem, Requirement, Request_by, Receive, Finish, Sub, Department, Section)
                            VALUES (:Date, :Subject, :Problem, :Requirement, :Request_by, :Receive,:Finish, :Sub, :Department ,:Section )";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":Date",$Date);
            $stmt->bindParam(":Subject",$Subject);
            $stmt->bindParam(":Problem",$Problem);
            $stmt->bindParam(":Requirement",$Requirement);
            $stmt->bindParam(":Request_by",$Request_by);
            $stmt->bindParam(":Sub",$Sub);
            $stmt->bindParam(":Receive",$Receive);
            $stmt->bindParam(":Finish",$Finish);
            $stmt->bindParam(":Department",$Department);
            $stmt->bindParam(":Section",$Section);
            
            $stmt->execute();
            return true;

        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }
    }

    function countJob($section){
        try{
            $sql = "SELECT COUNT(*) AS NUM FROM job WHERE Section = '$section' AND Finish = 'N' group by section;";
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $row = $result['NUM'];
            return $row;

        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }

    }


    function Addsub($Date, $Subject, $Problem, $Requirement, $Request_by, $Receive, $Finish, $Department, $Section){
        try{
            $sql = "INSERT INTO `job_sub` (`Date`, `Subject`, `Problem`, `Requirement`, `Request_by`, `Receive`, `Finish`, `Department`, `Section`)
                            VALUES (:Date, :Subject, :Problem, :Requirement, :Request_by, :Receive,:Finish, :Department ,:Section )";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":Date",$Date);
            $stmt->bindParam(":Subject",$Subject);
            $stmt->bindParam(":Problem",$Problem);
            $stmt->bindParam(":Requirement",$Requirement);
            $stmt->bindParam(":Request_by",$Request_by);
            $stmt->bindParam(":Receive",$Receive);
            $stmt->bindParam(":Finish",$Finish);
            $stmt->bindParam(":Department",$Department);
            $stmt->bindParam(":Section",$Section);
            $stmt->execute();

            $sql_sub = "SELECT `Sub` FROM `job` WHERE Subject = '$Subject';";
            $stmt = $this->db->query($sql_sub);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $Sub = $result['Sub'];

            $update = "UPDATE `job` SET `Sub` = $Sub+1 WHERE Subject = '$Subject'";
            $update_sub = $this->db->query($update);
            return true;

        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }
    }


    function countjob_sub($Section){
        try{
            $sql = "SELECT COUNT(*) AS num FROM job_sub WHERE Finish = 'N' AND Section = '$Section' GROUP BY Finish;";
            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $count = $row['num'];
            return $count;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }


    function showdata_receive($Subject, $Section){
        try{
            $sql = "SELECT * FROM job WHERE Subject = :Subject AND Section = :Section";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":Subject",$Subject);
            $stmt->bindParam(":Section",$Section);
            $stmt->execute();
            return $stmt;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }

    }

    function showdata_receive_sub($Subject, $Section){
        try{
            $sql = "SELECT * FROM job_sub WHERE Subject = :Subject AND Section = :Section";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":Subject",$Subject);
            $stmt->bindParam(":Section",$Section);
            $stmt->execute();
            return $stmt;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }

    }

    function recieve_job($all){
        try{ 
            date_default_timezone_set('Asia/Bangkok');
            $current_date = date('d/m/Y');

            $sql = "UPDATE `job` SET `Receive` = 'Y' ,`Receive_date` = '$current_date' WHERE ID in ($all)";
            $result = $this->db->query($sql);
            return true;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }

    function recieve_job_($all){
        try{ 
            date_default_timezone_set('Asia/Bangkok');
            $current_date = date('d/m/Y');

            $sql = "UPDATE `job` SET `Receive` = 'Y' ,`Receive_date` = '$current_date' WHERE ID = '$all'";
            $result = $this->db->query($sql);
            return true;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }

    function receive_jobsub($all){
        try{ 
            date_default_timezone_set('Asia/Bangkok');
            $current_date = date('d/m/Y');      

            $sql = "UPDATE job_sub SET Receive = 'Y' ,Receive_date = '$current_date' WHERE ID in ($all)";
            $result = $this->db->query($sql);

            // $sql_sub = "SELECT Sub FROM job WHERE Subject = '$Subject';";
            // $stmt = $this->db->query($sql_sub);
            // $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // $Sub = $result['Sub'];

            // $update = "UPDATE job SET Sub = $Sub-$count WHERE Subject = '$Subject'";
            // $finish = $this->db->query($update);
            return true;



        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }
    

    function showdetail_main($ID){
        try{
            $sql = "SELECT * FROM job WHERE ID = :ID;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":ID",$ID);
            $stmt->execute();
            return $stmt;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }
   

    function finish_job($all){
        try{
            date_default_timezone_set('Asia/Bangkok');
            $current_date = date('d/m/Y');    
            $sql = "UPDATE job SET Finish = 'Y', Finish_date = '$current_date' WHERE ID = '$all'";
            $result = $this->db->query($sql);
            return true;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }
    }

    function showdetail_sub($ID){
        try{
            $sql = "SELECT 
                        job.ID as ID,
                        job_sub.ID as Sub_id,
                        job_sub.Date,
                        job_sub.Subject,
                        job_sub.Problem,
                        job_sub.Requirement,
                        job_sub.Request_by,
                        job_sub.Receive,
                        job_sub.Receive_date,
                        job_sub.Finish,
                        job_sub.Finish_date,
                        job_sub.Department,
                        job_sub.Section
                    FROM `job_sub` INNER JOIN job ON job_sub.Subject = job.Subject 
                    WHERE job_sub.ID = :ID 
                    ORDER BY job_sub.ID DESC;";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":ID",$ID);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }

    }

    function mail_checkbox($ID){
        try{
            $sql = "SELECT * FROM job WHERE ID = $ID";
            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            return $row;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }

    }
    function mail_checkbox_($ID){
        try{
            $sql = "SELECT * FROM job WHERE ID = '$ID'";
            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            return $row;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }

    }

    function mail_checkbox_sub($ID){
        try{
            $sql = "SELECT * FROM job_sub WHERE ID = $ID";
            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            return $row;

        }catch(PDOException $e){
            $e->getMessage();
            return false;

        }

    }

    function showdata_job_sub(){
        try{
            $sql = "SELECT 
                    job.ID,
                    job_sub.ID AS Sub_id,
                    job_sub.Date,
                    job_sub.Subject,
                    job_sub.Problem,
                    job_sub.Requirement,
                    job_sub.Request_by,
                    job_sub.Receive,
                    job_sub.Receive_date,
                    job_sub.Finish,
                    job_sub.Finish_date,
                    job_sub.Department,
                    job_sub.Section
                    FROM `job_sub` INNER JOIN job ON job_sub.Subject = job.Subject 
                    ORDER BY job_sub.ID DESC;";
            $result = $this->db->query($sql);
            return $result;

        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }
    }
}
?>
