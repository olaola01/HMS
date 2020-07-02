<?php
include "vendor/autoload.php";
include "src/initialize.php";

use Src\helper\Path;

$specilizationid = $_POST['specilizationid'];
if (!empty($specilizationid)){
    $stmt = $connection->query("SELECT doctorName, id FROM doctors WHERE specilization='$specilizationid'");?>
    <option selected="selected">Select Doctor </option>
    <?php
    while ($data = $stmt->fetch()) {
        $id = $data['id'];
        $doctorname = $data['doctorName'];
    ?>
    <option value="<?php echo Path::h($id); ?>"><?php echo Path::h($doctorname);?></option>
        <?php
    }}

    $doctor = $_POST['doctor'];
    if(!empty($doctor)){
        $stmt = $connection->query("SELECT docFees FROM doctors WHERE id='$doctor'");
        while ($data = $stmt->fetch()) {
            $docFees = $data['docFees'];
            ?>
            <option value="<?php echo Path::h($docFees); ?>"><?php echo Path::h($docFees) ?></option>
<?php
        }}?>