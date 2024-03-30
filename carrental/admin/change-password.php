<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // Code for change password	
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['alogin'];
        $sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update admin set Password=:newpassword where UserName=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Your Password succesfully changed";
        } else {
            $error = "Your current password is not valid.";
        }
    }
?>

    <?php
    include "includes/header.php"
    ?>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-400" style="background-color: #1c2a57;">
                    <div class="card-body p-5">
                        <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
                            <?php if ($error) { ?>
                                <div class="alert alert-dismissible fade show" role="alert" style="background-color: #f8d7da;">
                                <strong style="color: #842029;">ERROR <?php echo htmlentities($error); ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="color: #000 !important;"></button>
                            </div><?php } else if ($msg) { ?>
                                <div class="alert alert-dismissible fade show" role="alert" style="background-color: #d1e7dd;">
                                <strong style="color: #0f5132;">SUCCESS <?php echo htmlentities($msg); ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="color: #000 !important;"></button>
                            </div>
                            <?php } ?>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" name="password" id="password" required placeholder="Enter Your Current Password">
                                <label for="floatingInput">Current Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" name="newpassword" id="newpassword" required placeholder="Enter Your New Password">
                                <label for="floatingInput">New Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" name="confirmpassword" id="confirmpassword" required placeholder="Enter Your Confirm Password">
                                <label for="floatingInput">Confirm Password</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn" name="submit" type="submit" style="background-color: #FE5115; color: #FFF;">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "includes/footer.php"
        ?>
    </div>
    </main>
<?php } ?>