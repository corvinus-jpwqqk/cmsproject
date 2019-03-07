<?php  include "includes/connect.php"; ?>
 <?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->

<?php
    $message = "";
    global $connection;
    if(isset($_POST['submit'])){
        $to = "akavirykatana@gmail.com";
        $header  = "From: " . $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        if(!empty($header) && !empty($subject) && !empty($body)){
            $body = wordwrap($body, 60);
            mail($to, $subject, $body, $header);
        }
        else{
            $message = "Please fill out all fields!";
        }
    }
?>

<div class="container">    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <h6><?php echo $message; ?><h6>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="subject" class="sr-only">username</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> 
        </div>
    </div>
</section>
<hr>
<?php include "includes/footer.php";?>
