<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/section.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <title>All Requirement</title>

</head>
<style>
    a {
        text-decoration: none;
    }

  
</style>
<?php
session_start();
if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $office = $_SESSION['office'];

    // echo $username;
    // echo $office;
}
require_once "DB/connnect.php";

// echo $countjob;
date_default_timezone_set('Asia/Bangkok');
$current_date = date('d/m/Y');
// echo $current_date;

if(isset($_GET['ID'])){
    $ID = $_GET['ID'];
    $Subject =  $_GET['Subject'];
    // echo $id;

    $result = $controller->showdata_id($ID);
    $sub = $controller->showdata_sub($Subject);
}

if (isset($_POST['Receive'])) {
    // $Subject = $_POST['Subject'];
    // $Department = $_POST['Department'];
    // $Section = $_POST['Section'];
    // echo $Department,$Section;
    // echo "asdas";
    if (!empty($_POST["ids"])) {
        $count = count($_POST['ids']);

        $all = implode(",", $_POST['ids']);
        // echo $all;

        $ids = explode(",", $all);

        $update = $controller->recieve_job_($all);
        foreach ($ids as $ID) {
            $row = $controller->mail_checkbox_($ID);

            $Subject = $row['Subject'];
            $Section = $row['Section'];
            $Department = $row['Department'];
            $Request_by = $row['Request_by'];
            $Date = $row['Date'];
            // $Problem = $row['Problem'];
            $Requirement = $row['Requirement'];

            $txt1 = explode("\n", $row["Problem"]);
            foreach ($txt1 as $text1) {
                @$Problem .= $text1 . "<br>";
            }

            require "mail_reply_main.php";
            $result = $controller->showdata_id($ID);
            $sub = $controller->showdata_sub($Subject);
        }

        // $result = $controller->showdata_sub($Subject);
        $_SESSION['true'] = "Update Job Success";
        require_once "swithalert.php";
    } else {
        $_SESSION['false'] = "Select checkbox";
        require_once "swithalert.php";
    }
}

if (@isset($_POST['Receive_sub'])) {
    @$Date = $_POST['Date'];
    @@$Subject = $_POST["Subject"];
    // $Problem = $_POST["Problem"];
    // $Requirement = $_POST["Requirement"];
    @$Request_by = $_POST["Request_by"];
    @$Department = $_POST["Department"];
    @$Section = $_POST["Section"];
    // echo $Request_by;
    if (!empty($_POST["ids"])) {
      $count = count($_POST['ids']);

      $all = implode(",", $_POST['ids']);
      // echo $all;

      $ids = explode(",", $all);

      $update = $controller->receive_jobsub($all);
      foreach ($ids as $ID) {
          $row = $controller->mail_checkbox_sub($ID);

          $Subject = $row['Subject'];
          $Section = $row['Section'];
          $Department = $row['Department'];
          $Request_by = $row['Request_by'];
          $Date = $row['Date'];
          // $Problem = $row['Problem'];
          $Requirement = $row['Requirement'];

          $txt1 = explode("\n", $row["Problem"]);
          foreach ($txt1 as $text1) {
              @$Problem .= $text1 . "<br>";
          }

          require "mail_reply_sub.php";
          $Problem = "";
          $result = $controller->showdata_id($ID);
          $sub = $controller->showdata_sub($Subject);
      }

        $result = $controller->showdata_sub($Subject);
        $_SESSION['true'] = "Update Job Success";
        require_once "swithalert.php";
        
    }else{
        $result = $controller->showdata_sub($Subject);
        $_SESSION['false'] = "Select checkbox";
        require_once "swithalert.php";
    }
}





// $section = "Business Analysis";
// $result = $controller->showdata_all();
// $countjob = $controller->countJob_all();
// $select = $controller->selectjobname();
// $countjob_sub = $controller->countjob_sub_all();


?>

<body>
    <style>
        .head {
            position: relative;
            display: flex;
            /* border: 5px solid blue; */

        }

        .head h3 {
            margin-left: 2rem;
            padding: 1rem 1rem;
            color: aliceblue;
            margin-top: -5px;
        }

        #login {
            display: flex;
            position: absolute;
            right: 0;
            margin-top: 0.6rem;
            margin-right: 0.6rem;

            /* border: 1rem solid blue; */
        }

        .head3 {
            margin-left: 2rem;
            padding: 1rem 1rem;
            color: aliceblue;
        }

        a {
            color: red;
        }
    </style>

    <body>
        <div class="head">
            <div>
                <a href="index.php">
                    <h3>Admin</h3>
                </a>
            </div>
            <div id="login">
                <div>
                    <span class="input-group " style="margin-left: 14.5rem; margin-top:4px; width:50%">
                        <span class="input-group-text" id="basic-addon1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
                            </svg>
                        </span>
                        <input type="text" value="<?php echo $_SESSION['username'] . "  " . $_SESSION['office']; ?>" readonly name="user_01" class="form-control" placeholder="User Name" aria-label="Input group example" aria-describedby="basic-addon1">

                    </span>
                </div>
                <div class="btn_login  ">
                    <!-- <button type="submit" class="btn btn-secondary btn-sm">Login</button> -->
                    <a href="logout.php" class="btn btn-secondary btn-sm mt-2">Logout</a>
                </div>
            </div>


        </div>
        <h1 class="text-center mt-4 mb-4 ">Main Requirement</h1>


        <form action="requirement_detail.php" method="post" class="table p-2">
            <!-- <div class="container  table"> -->
            <div class="d-flex justify-content-end">
                        <!-- <button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#Main" data-bs-whatever="@mdo">Add Job</button> -->
                        <button type="submit" name="Receive" class="btn btn-primary btn-sm mb-1">Receive</button>
                    </div>
                <table id="example" class="table table-striped table-bordered" width="100%">
                    
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th class="text-center"></th>
                            <th class="text-center">Req.no</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Problem</th>
                            <th class="text-center">Requirement</th>
                            <th class="text-center">Request</th>
                            <th class="text-center">Section</th>
                            <th class="text-center">Receive</th>
                            <th class="text-center">Received</th>
                            <th class="text-center">Finish</th>
                            <th class="text-center">Finished</th>
                            <th class="text-center">Img1</th>
                            <th class="text-center">Img2</th>
                           
                            <!-- <th>Department</th> -->
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $ReceiveValue = @$row['Receive'];
                            $isDisabled = $ReceiveValue === 'Y' ? 'disabled' : '';

                            $finishValue = @$row['Finish'];
                            if ($finishValue === "N") {

                                $detail = "finish_job.php?ID=" . $row['ID'] . "&Department=" . $row['Department'] . "&Section=" . $row['Section'];
                                $btn = "btn-warning";
                            } else {
                                $detail = "#";
                                $btn = "btn-success";
                            }
                        ?>

                            <tr>
                                <td><input style="width: 25px; height: 25px" type="checkbox" class="checkbox " name="ids[]" value="<?php echo @$row["ID"] ?>" <?php echo $isDisabled; ?>></td>
                                <td><?php echo $row['ID']; ?></td>    
                                <td> <?php echo $row['Date']; ?> </td>
                                <td> <a href="requirement_detail.php?ID=<?php echo $row['ID']."&Subject=".$row['Subject']; ?>"></a><?php echo $row['Subject']; ?> </td>
                                <td class="detail" width="20%" >  <?php  $txt1 = explode("\n",$row["Problem"]);
                                                            foreach ($txt1 as $text1) {
                                                                echo  $text1 . "<br>";
                                                            }?></td> 
                                                           
                                <td class="detail" width="25%" > <?php $txt = explode("\n",$row["Requirement"]);
                                                                    foreach ($txt as $text) {
                                                                        echo $text . "<br>";
                                                                    }?> </td> 
                                <td><?php echo $row['Request_by']; ?></td>
                                <td><?php echo $row['Section']; ?></td>
                                <td><?php echo $row['Receive']; ?> </td>
                                <td><?php echo $row['Receive_date']; ?> </td>
                                <td> <a href="<?php echo $detail; ?>" class="btn <?php echo $btn; ?>" disable><?php echo $row['Finish']; ?></a> </td>
                                <td><?php echo $row['Finish_date']; ?></td>
                                <td><img style="width: 100%; height:auto;" src="img_upload/<?php echo $row['ID']; ?>.png" alt=""></td>
                                <td><img style="width: 100%; height:auto;" src="img_upload/<?php echo $row['ID']; ?>-2.png" alt=""></td>
                                <!-- <td>test</td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <!-- </div> -->
        </form>

        <h1 class="text-center mt-4 mb-4 ">Sub</h1>
        <form action="requirement_detail.php" method="post" class="p-2">
        <div class="d-flex justify-content-end">
                        <!-- <button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#Main" data-bs-whatever="@mdo">Add Job</button> -->
                        <button type="submit" name="Receive_sub" class="btn btn-primary btn-sm mb-1">Receive</button>
                    </div>
        <table id="example2" class="table table-striped table-bordered " width="100%" >
                    
                    <thead class="table-warning">
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Date</th>
                            <!-- <th>Subject</th> -->
                            <th class="text-center">Problem</th>
                            <th class="text-center">Requirement</th>
                            <th class="text-center">Request</th>
                            <th class="text-center">Section</th>
                            <th class="text-center">Receive</th>
                            <th class="text-center">Receive Date</th>
                            <th class="text-center">Finish</th>
                            <!-- class="text-center"- <th>Sub</th> -->
                            <th class="text-center">Finish Date</th>
                            <th class="text-center">Img1</th>
                            <th class="text-center">Img2</th>
                            <!-- <th>Department</th> -->
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $sub->fetch(PDO::FETCH_ASSOC)) {
                            $ReceiveValue = @$row['Receive'];
                            $isDisabled = $ReceiveValue === 'Y' ? 'disabled' : '';

                            $finishValue = @$row['Finish'];
                            if ($finishValue === "N") {

                                $detail = "finish_sub.php?ID=" . $row['ID'] . "&Department=" . $row['Department'] . "&Section=" . $row['Section'];
                                $btn = "btn-warning";
                            } else {
                                $detail = "#";
                                $btn = "btn-success";
                            }
                        ?>

                            <tr>
                
                            <td><input style="width: 25px; height: 25px" type="checkbox" class="checkbox " name="ids[]" value="<?php echo @$row["ID"]; ?>" <?php echo $isDisabled; ?>></td>                                                                                                                        
                                <td> <?php echo $row['Date']; ?> </td>
                                <!-- <td> <a href="requirement_detail.php?ID=<?php echo $row['ID']."&Subject=".$row['Subject']; ?>"></a><?php echo $row['Subject']; ?> </td> -->
                                <td class="detail" width=20%> <?php  $txt1 = explode("\n",$row["Problem"]);
                                                            foreach ($txt1 as $text1) {
                                                                echo  $text1 . "<br>";
                                                            }?></td> 
                                                           
                                <td class="detail" width=25%> <?php $txt = explode("\n",$row["Requirement"]);
                                                                    foreach ($txt as $text) {
                                                                        echo $text . "<br>";
                                                                    }?> </td> 
                                <td><?php echo $row['Request_by']; ?></td>
                                <td><?php echo $row['Section']; ?></td>
                                <td><?php echo $row['Receive']; ?> </td>
                                <td><?php echo $row['Receive_date']; ?> </td>
                                <td> <a href="<?php echo $detail; ?>" class="btn <?php echo $btn; ?>" disable><?php echo $row['Finish']; ?></a> </td>
                                
                                <td><?php echo $row['Finish_date']; ?> </td>
                                <td><img style="width: 100%; height:auto;" src="img_upload_sub/<?php echo $row['ID']; ?>.png" alt=""></td>
                                <td><img style="width: 100%; height:auto;" src="img_upload_sub/<?php echo $row['ID']; ?>-2.png" alt=""></td><!-- <td>test</td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </form>
    </body>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: ['excel', 'colvis'],
                select: true, // Enable row selection
                pageLength: 100 // กำหนดจำนวนแถวที่แสดงเป็น 100
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');

                var table2 = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['excel', 'colvis'],
                select: true, // Enable row selection
                pageLength: 100 // กำหนดจำนวนแถวที่แสดงเป็น 100
            });

            table2.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        // ลบประกาศตัวแปร subs (หากมี)
        let subsd = document.querySelectorAll('.sub');

        subsd.forEach(function(input) {

            let valueAsInt = parseInt(input.value.trim(), 10);

            // ตรวจสอบค่าและเปลี่ยนสีพื้นหลังถ้าเป็น 0
            if (valueAsInt === 0) {
                input.style.backgroundColor = "rgb(29, 146, 0)";
                input.style.color = "White";
                // input.style.border = "1px solid black";
            }
            if (valueAsInt >= 5) {
                input.style.backgroundColor = "red";
                input.style.color = "White";
                // input.style.border = "1px solid black";
            }
            if (valueAsInt >= 1 && valueAsInt <= 4) {
                input.style.backgroundColor = "rgb(255, 183, 0)";
                input.style.color = "black";
                // input.style.border = "1px solid black";
            }
        });
    </script>

</html>