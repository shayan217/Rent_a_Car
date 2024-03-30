<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $vehicletitle = $_POST['vehicletitle'];
        $brand = $_POST['brandname'];
        $vehicleoverview = $_POST['vehicalorcview'];
        $priceperday = $_POST['priceperday'];
        $fueltype = $_POST['fueltype'];
        $modelyear = $_POST['modelyear'];
        $seatingcapacity = $_POST['seatingcapacity'];
        $vimage1 = $_FILES["img1"]["name"];
        $vimage2 = $_FILES["img2"]["name"];
        $vimage3 = $_FILES["img3"]["name"];
        $vimage4 = $_FILES["img4"]["name"];
        $vimage5 = $_FILES["img5"]["name"];
        $airconditioner = $_POST['airconditioner'];
        $powerdoorlocks = $_POST['powerdoorlocks'];
        $antilockbrakingsys = $_POST['antilockbrakingsys'];
        $brakeassist = $_POST['brakeassist'];
        $powersteering = $_POST['powersteering'];
        $driverairbag = $_POST['driverairbag'];
        $passengerairbag = $_POST['passengerairbag'];
        $powerwindow = $_POST['powerwindow'];
        $cdplayer = $_POST['cdplayer'];
        $centrallocking = $_POST['centrallocking'];
        $crashcensor = $_POST['crashcensor'];
        $leatherseats = $_POST['leatherseats'];
        move_uploaded_file($_FILES["img1"]["tmp_name"], "img/vehicleimages/" . $_FILES["img1"]["name"]);
        move_uploaded_file($_FILES["img2"]["tmp_name"], "img/vehicleimages/" . $_FILES["img2"]["name"]);
        move_uploaded_file($_FILES["img3"]["tmp_name"], "img/vehicleimages/" . $_FILES["img3"]["name"]);
        move_uploaded_file($_FILES["img4"]["tmp_name"], "img/vehicleimages/" . $_FILES["img4"]["name"]);
        move_uploaded_file($_FILES["img5"]["tmp_name"], "img/vehicleimages/" . $_FILES["img5"]["name"]);

        $sql = "INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor,LeatherSeats) VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor,:leatherseats)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
        $query->bindParam(':brand', $brand, PDO::PARAM_STR);
        $query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
        $query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
        $query->bindParam(':fueltype', $fueltype, PDO::PARAM_STR);
        $query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
        $query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
        $query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
        $query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
        $query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
        $query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
        $query->bindParam(':vimage5', $vimage5, PDO::PARAM_STR);
        $query->bindParam(':airconditioner', $airconditioner, PDO::PARAM_STR);
        $query->bindParam(':powerdoorlocks', $powerdoorlocks, PDO::PARAM_STR);
        $query->bindParam(':antilockbrakingsys', $antilockbrakingsys, PDO::PARAM_STR);
        $query->bindParam(':brakeassist', $brakeassist, PDO::PARAM_STR);
        $query->bindParam(':powersteering', $powersteering, PDO::PARAM_STR);
        $query->bindParam(':driverairbag', $driverairbag, PDO::PARAM_STR);
        $query->bindParam(':passengerairbag', $passengerairbag, PDO::PARAM_STR);
        $query->bindParam(':powerwindow', $powerwindow, PDO::PARAM_STR);
        $query->bindParam(':cdplayer', $cdplayer, PDO::PARAM_STR);
        $query->bindParam(':centrallocking', $centrallocking, PDO::PARAM_STR);
        $query->bindParam(':crashcensor', $crashcensor, PDO::PARAM_STR);
        $query->bindParam(':leatherseats', $leatherseats, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Vehicle posted successfully";
        } else {
            $error = "Something went wrong. Please try again";
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
                    <div class="card-body p-5">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-floating mb-3 col-9">
                                    <input type="text" class="form-control" id="floatingInput1" placeholder="Enter Vehicle Title" name="vehicletitle" required>
                                    <label for="floatingInput1">Vehicle Title</label>
                                </div>
                                <div class="form-floating mb-3 col-3">
                                    <select class="form-select" id="floatingSelect" required name="brandname">
                                        <option value="" disabled selected>Select Brand</option>
                                        <?php $ret = "select id,BrandName from tblbrands";
                                        $query = $dbh->prepare($ret);
                                        //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                        ?>
                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BrandName); ?></option>
                                        <?php }
                                        } ?>

                                    </select>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="floatingInput1" placeholder="Enter Vehicle Overview" name="vehicalorcview" required style="height: 100px;">
                                    <label for="floatingInput1">Vehicle Over View</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="floatingInput1" placeholder="Enter Vehicle Price" name="priceperday" required>
                                    <label for="floatingInput1">Price per Day(in USD)</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" id="floatingSelect" name="fueltype" required>
                                        <option value="" disabled selected>Select Fuel Type</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="CNG">CNG</option>
                                    </select>
                                </div>
                                <div class="form-floating mb-3 col-9">
                                    <input type="text" class="form-control" id="floatingInput1" placeholder="Enter Modal/Year" name="modelyear" required>
                                    <label for="floatingInput1">Modal Year</label>
                                </div>
                                <div class="form-floating mb-3 col-3">
                                    <input type="text" class="form-control" id="floatingInput1" placeholder="Enter seating capacity" name="seatingcapacity" required>
                                    <label for="floatingInput1">Seating Capacity*</label>
                                </div>
                            </div>
                            <br><br><br>
                            <h4 class="text-light font-weight-bold">Upload Images</h4>
                            <div class="row">
                                <div class="form-floating mb-3 col-4">
                                    <input type="file" class="form-control" id="floatingInput1"  name="img1" required>
                                    <label for="floatingInput1">Image 1</label>
                                </div>
                                <div class="form-floating mb-3 col-4">
                                    <input type="file" class="form-control" id="floatingInput1"  name="img2" required>
                                    <label for="floatingInput1">Image 2</label>
                                </div>
                                <div class="form-floating mb-3 col-4">
                                    <input type="file" class="form-control" id="floatingInput1"  name="img3" required>
                                    <label for="floatingInput1">Image 3</label>
                                </div>
                                <div class="form-floating mb-3 col-4">
                                    <input type="file" class="form-control" id="floatingInput1" name="img4" required>
                                    <label for="floatingInput1">Image 4</label>
                                </div>
                                <div class="form-floating mb-3 col-4">
                                    <input type="file" class="form-control" id="floatingInput1" name="img5">
                                    <label for="floatingInput1">Image 5</label>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <h4 class="text-light font-weight-bold">Accessories</h4>
                                <div class="col-12 mb-3">
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="airconditioner" name="airconditioner" value="1">
                                        <label class="form-check-label text-light" for="airconditioner">Air Conditioner</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
                                        <label class="form-check-label text-light" for="powerdoorlocks">Power Door Locks</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
                                        <label class="form-check-label text-light" for="antilockbrakingsys">AntiLock Braking</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="brakeassist" name="brakeassist" value="1">
                                        <label class="form-check-label text-light" for="brakeassist">Brake Assist</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="powersteering" name="powersteering" value="1">
                                        <label class="form-check-label text-light" for="powersteering">Power Steering</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="driverairbag" name="driverairbag" value="1">
                                        <label class="form-check-label text-light" for="accessory3">Driver Airbag</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
                                        <label class="form-check-label text-light" for="passengerairbag">Passenger Airbag</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="powerwindow" name="powerwindow" value="1">
                                        <label class="form-check-label text-light" for="powerwindow">Power Windows</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="cdplayer" name="cdplayer" value="1">
                                        <label class="form-check-label text-light" for="cdplayer">CD Player</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="centrallocking" name="centrallocking" value="1">
                                        <label class="form-check-label text-light" for="centrallocking">Central Locking</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="crashcensor" name="crashcensor" value="1">
                                        <label class="form-check-label text-light" for="crashcensor">Crash Sensor</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input" type="checkbox" id="leatherseats" name="leatherseats" value="1">
                                        <label class="form-check-label text-light" for="leatherseats">Leather Seats</label>
                                    </div>
                                    <!-- Add more checkboxes as needed -->
                                </div>
                            </div>

                            <div class="d-grid">
                                <button class="btn" type="submit" style="background-color: #FE5115; color: #FFF;" name="submit">Save Changes</button>
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