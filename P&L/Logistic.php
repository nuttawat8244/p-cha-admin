<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/section.css">
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
    <title>Logistic</title>

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
else{
    header("location:../login.php");
}
require_once "../DB/connnect.php";

// echo $countjob;
date_default_timezone_set('Asia/Bangkok');
$current_date = date('d/m/Y');
// echo $current_date;

if (isset($_POST["save"])) {
    $Date = $_POST["Date"];
    $Subject = $_POST["Subject"];
    // $Problem = $_POST["Problem"];
    // $Requirement = $_POST["Requirement"];
    $Request_by = $_POST["Request_by"];

    $txt1 = explode("\n", $_POST["Problem"]);
    foreach ($txt1 as $text1) {
        @$Problem .= $text1 . "<br>";
    }

    $txt = explode("\n", $_POST["Requirement"]);
    foreach ($txt as $text) {
        @$Requirement .= $text . "<br>";
    }
    $Receive = "N";
    $Finish =  "N";
    $Sub = 0;
    $Department = "P&L";
    $Section = "Logistic";
    // echo " $Request_by";
    $link_receive = "http://localhost:8081/p-cha/" . "receive.php?Subject=" . $Subject . "&Section=" . $Section;
    // $link_receive = "https://booking-room.ucc.co.th/p-cha/"."recieve.php?Subject=".$Subject."&Section=".$Section;

    // $link_receive = "http://localhost/p-cha/"."receive.php?Subject=".$Subject."&Section=".$Section;

    $Addjob_Logistic = $controller->Addjob($Date, $Subject, $Problem, $Requirement, $Request_by, $Receive,  $Finish, $Sub, $Department, $Section);

    require_once "../mail.php";


    if ($Addjob_Logistic) {
        $_SESSION['true'] = "Add Job Success";
        require_once "../swithalert.php";
    } else {
        $_SESSION['false'] = "Add Job Fail";
        require_once "../swithalert.php";
    }
}


if (isset($_POST['sub'])) {
    $Date = $_POST["Date"];
    $Subject = $_POST["Subject"];
    // $Problem = $_POST["Problem"];
    // $Requirement = $_POST["Requirement"];
    $Request_by = $_POST["Request_by"];

    $txt1 = explode("\n", $_POST["Problem"]);
    foreach ($txt1 as $text1) {
        @$Problem .= $text1 . "<br>";
    }

    $txt = explode("\n", $_POST["Requirement"]);
    foreach ($txt as $text) {
        @$Requirement .= $text . "<br>";
    }

    $Receive = "N";
    $Finish =  "N";
    // $Sub = 0;
    $Department = "P&L";
    $Section = "Logistic";
    // echo " $Request_by";

    $link_receive = "http://localhost:8081/p-cha/" . "receive.php?Subject=" . $Subject . "&Section=" . $Section;
    // $link_receive = "https://booking-room.ucc.co.th/p-cha/"."recieve.php?Subject=".$Subject."&Section=".$Section;
    // $link_receive = "http://localhost/p-cha/"."receive_sub.php?Subject=".$Subject."&Section=".$Section;


    $Addsub_Logistic = $controller->Addsub($Date, $Subject, $Problem, $Requirement, $Request_by, $Receive, $Finish, $Department, $Section);

    require_once "../mail_sub.php";

    if ($Addsub_Logistic) {
        $_SESSION['true'] = "Add Sub Job Success";
        require_once "../swithalert.php";
    } else {
        $_SESSION['false'] = "Add Sub Job Fail";
        require_once "../swithalert.php";
    }
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

        $update = $controller->recieve_job($all);
        foreach ($ids as $ID) {
            $row = $controller->mail_checkbox($ID);

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
            require "../mail_reply_main.php";
            $Problem = "";
        }




        // $result = $controller->showdata_sub($Subject);
        $_SESSION['true'] = "Update Job Success";
        require_once "../swithalert.php";
    } else {
        $_SESSION['false'] = "Select checkbox";
        require_once "../swithalert.php";
    }
}


$section = "Logistic";
$result = $controller->showdata($section);
$countjob = $controller->countJob($section);
$select = $controller->selectjobname($section);
$countjob_sub = $controller->countjob_sub($section);


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

     
    </style>

    <body>
        <div class="head">
            <div>
                <a href="../index.php">
                    <h3>Logistic Requirement</h3>
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
                    <a href="../logout.php" class="btn btn-secondary btn-sm mt-2">Logout</a>
                </div>
            </div>


        </div>
        <h1 class="text-center mt-4">Job Logistic</h1>

        <div class="board">
            <div class="input-group dash">
                <div class="input-group-text" id="btnGroupAddon">Main</div>
                <input type="text" class="form-control" value="<?php echo $countjob; ?>" aria-describedby="btnGroupAddon" readonly>
            </div>
            <div class="input-group dash ">
                <div class="input-group-text" id="btnGroupAddon">Sub</div>
                <input type="text" class="form-control" value="<?php echo $countjob_sub; ?>" placeholder="" aria-describedby="btnGroupAddon" style="width: 10px;" readonly>
            </div>
        </div>


        <form action="Logistic.php" method="post" class="p-2">
            <!-- <div class="container  table"> -->
                <table id="example" class="table table-striped table-bordered" width="100%">
                    <div class="d-flex justify-content-end">
                        <!-- <button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#Main" data-bs-whatever="@mdo">Add Job</button> -->
                        <button type="submit" name="Receive" class="btn btn-primary btn-sm mb-1">Receive</button>
                    </div>
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Req.no</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Problem</th>
                            <th class="text-center">Requirement</th>
                            <th class="text-center">Request</th>
                            <th class="text-center">Receive</th>
                            <th class="text-center">Receive Date</th>
                            <th class="text-center">Finish</th>
                            <th class="text-center">Finish Date</th>
                            <th class="text-center">Sub</th>
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

                                $detail = "../finish_job.php?ID=" . $row['ID'] . "&Department=" . $row['Department'] . "&Section=" . $row['Section'];
                                $btn = "btn-warning";
                            } else {
                                $detail = "#";
                                $btn = "btn-success";
                            }
                        ?>

                            <tr>
                                <td><input style="width: 25px; height: 25px" type="checkbox" class="checkbox " name="ids[]" value="<?php echo "'".@$row["ID"]."'"; ?>" <?php echo $isDisabled; ?>></td>
                                <td> <?php echo $row['ID']; ?></td>                                                                                                                                
                                <td> <?php echo $row['Date']; ?> </td>
                                <td class="link"> <a href="../requirement_detail.php?ID=<?php echo $row['ID']."&Subject=".$row['Subject']; ?>"><?php echo $row['Subject']; ?></a> </td>
                                <td class="detail" width=20%> <?php  $txt1 = explode("\n",$row["Problem"]);
                                                            foreach ($txt1 as $text1) {
                                                                echo  $text1 . "<br>";
                                                            }?></td> 
                                                           
                                <td class="detail" width=25%> <?php $txt = explode("\n",$row["Requirement"]);
                                                                    foreach ($txt as $text) {
                                                                        echo $text . "<br>";
                                                                    }?> </td> 
                                <td><?php echo $row['Request_by']; ?></td>
                                <td><?php echo $row['Receive']; ?> </td>
                                <td><?php echo $row['Receive_date']; ?> </td>
                                <td> <a href="<?php echo $detail; ?>" class="btn <?php echo $btn; ?>" disable><?php echo $row['Finish']; ?></a> </td>
                                <td><?php echo $row['Finish_date']; ?> </td>
                                <td>

                                    <input type="text" value=" <?php echo $row['Sub']; ?>" readonly style="width: 4.2rem; display:inline-block" class="sub form-control text-center" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <!-- <a href="../Detail_job.php?Subject=<?php echo $row['Subject']; ?>&Department=P&L &Section=Logistic" name="detail" class="btn btn-secondary mb-1 ">Detail</a> -->

                                </td>
                                
                                <!-- <td>test</td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <!-- </div> -->
        </form>




        <div class="modal fade" id="Main" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Job Logistic Requirement </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class=" " action="Logistic.php" method="post">
                            <div class="d-flex justify-content-start w-50 ">
                                <div class="col-md-4 position-relative m-2 ">
                                    <label for="validationTooltip01" class="form-label">Date</label>
                                    <input type="text" class="form-control text-center" readonly value="<?php echo $current_date; ?>" name="Date">
                                </div>
                                <div class="col-md-4 position-relative m-2">
                                    <label for="validationTooltip02" class="form-label">Department</label>
                                    <input type="text" readonly class="form-control text-center" value="P&L" name="Department">
                                </div>
                                <div class="col-md-4 position-relative m-2">
                                    <label for="validationTooltipUsername" class="form-label">Section</label>
                                    <input type="text" readonly class="form-control text-center" value="Logistic" name="Section">
                                </div>
                            </div>
                            <div class=" mt-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Subject</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="Subject" id="Subject Name" class="form-control">
                                    </div>
                                </div>

                                <label for="validationTooltipUsername" class="form-label mt-4">Problem</label>
                                <textarea name="Problem" id="" class="form-control" cols="10" rows="2"></textarea>

                                <label for="validationTooltipUsername" class="form-label mt-4">Requirement</label>
                                <textarea name="Requirement" id="" class="form-control" cols="20" rows="5"></textarea>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <div class="col-md-4 position-relative ">
                                    <label for="validationTooltip01" class="form-label" style="margin-left: 11rem;">Request By</label>
                                    <input type="text" name="Request_by" class="form-control text-center" readonly id="validationTooltip01" value="<?php echo $_SESSION['username']; ?>" required style="margin-left: 8rem; width:8rem;">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary btn-sm">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- modal sub job -->

        <div class="modal fade" id="Sub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">SubJob Logistic Requirement </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class=" " action="Logistic.php" method="post">
                            <div class="d-flex justify-content-start w-50 ">
                                <div class="col-md-4 position-relative m-2 ">
                                    <label for="validationTooltip01" class="form-label">Date</label>
                                    <input type="text" class="form-control text-center" readonly value="<?php echo $current_date; ?>" name="Date">
                                </div>
                                <div class="col-md-4 position-relative m-2">
                                    <label for="validationTooltip02" class="form-label">Department</label>
                                    <input type="text" readonly class="form-control text-center" value="P&L" name="Department">
                                </div>
                                <div class="col-md-4 position-relative m-2">
                                    <label for="validationTooltipUsername" class="form-label">Section</label>
                                    <input type="text" readonly class="form-control text-center" value="Logistic" name="Section">
                                </div>
                            </div>
                            <div class=" mt-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Subject</label>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Default select example" name="Subject" require>
                                            <option selected>Select Job</option>
                                            <?php while ($row = $select->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['Subject']; ?>"><?php echo $row['Subject']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <label for="validationTooltipUsername" class="form-label mt-4">Problem</label>
                                <textarea name="Problem" id="" class="form-control" cols="10" rows="2"></textarea>

                                <label for="validationTooltipUsername" class="form-label mt-4">Requirement</label>
                                <textarea name="Requirement" id="" class="form-control" cols="20" rows="5"></textarea>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <div class="col-md-4 position-relative ">
                                    <label for="validationTooltip01" class="form-label" style="margin-left: 11rem;">Request By</label>
                                    <input type="text" name="Request_by" class="form-control text-center" readonly id="validationTooltip01" value="<?php echo $_SESSION['username']; ?>" required style="margin-left: 8rem; width:8rem;">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="sub" class="btn btn-primary btn-sm">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </body>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: ['excel', 'colvis'],
                select: true // Enable row selection
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
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