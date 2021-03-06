<?php
require_once('../config.php');
require_once('../veeam.class.php');

session_start();

$veeam = new VBO($host, $port);
$veeam->setToken($_SESSION['token']);

$org = $veeam->getOrganizations();
?>
<div class="main-container">
    <h1>Organizations overview</h1>
    <?php
    if (count($org) != '0') {
    ?>
    <table class="table table-bordered table-padding table-striped" id="table-organizations">
        <thead>
            <tr>
                <th>Name</th>
                <th>Region</th>
                <th>First backup</th>
                <th>Last backup</th>
            </tr>
        </thead>
        <tbody> 
        <?php
        for ($i = 0; $i < count($org); $i++) {
        ?>
            <tr>
                <td><?php echo $org[$i]['name']; ?></td>
                <td><?php echo $org[$i]['region']; ?></td>
                <td><?php echo (isset($org[$i]['firstBackuptime']) ? date('d/m/Y H:i T', strtotime($org[$i]['firstBackuptime'])) : 'N/A'); ?></td>
                <td><?php echo (isset($org[$i]['lastBackuptime']) ? date('d/m/Y H:i T', strtotime($org[$i]['lastBackuptime'])) : 'N/A'); ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <?php
    } else {
        echo 'No organizations have been added.';
    }
    ?>
</div>