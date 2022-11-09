<?php
    $title = 'Success'; 
    require_once 'includes/header.php'; 
    require_once 'db/conn.php';
    require_once 'sendemail.php';


    if(isset($_POST['submit'])){
        //extract values from the $_POST array
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $specialty = $_POST['specialty'];
        $email = $_POST['email'];
        $contact = $_POST['phone'];
        
        $orig_file = $_FILES["avatar"]["tmp_name"];
        $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'uploads/';
        $destination = "$target_dir$contact.$ext";
        move_uploaded_file($orig_file,$destination);  
        
       
       

        //Call function to insert and track if success or not
        $isSuccess = $crud->insertAttendees($fname, $lname, $dob, $email,$contact,$specialty,$destination);
        $specialtyName = $crud->getSpecialtyById($specialty);
        
        if($isSuccess){
          SendEmail::SendMail($email, "welcome to IT Confrence 2022", "You have successfully registered for this year\'s IT Confrence");
           include 'includes/successmessage.php';
        }
        else{
            include 'includes/errormessage.php';
        }

    }
?>
    
       
    <!-- This prints out values that were passed to the action page using method="post" -->
    <img src="<?php echo $destination; ?>" style="width: 15%; height:15%"/>  
   
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $_POST['firstname'] . ' ' . $_POST['lastname'];  ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
              <?php echo $specialtyName['name'];  ?>    
            </h6>
            <p class="card-text">
                Date Of Birth: <?php echo $_POST['dob'];  ?>
            </p>
            <p class="card-text">
                Email Adress: <?php echo $_POST['email'];  ?>
            </p>
            <p class="card-text">
                Contact Number: <?php echo $_POST['phone'];  ?>
            </p>
    
        </div>
    </div>
    

<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>