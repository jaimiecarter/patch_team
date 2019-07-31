<?php
    require_once __DIR__ . '/database.php';
   
    $patch_id = $_POST['patch_id'] ?? '';
    $full_patch_JSON = $_POST['fullPatch'] ?? '';
    $full_cam_patch = $_POST['cam_patch'] ?? '';
    $current_time = date("d/m/y");
    $job_name = $_POST['job_name'] ?? '';
    $facility = $_POST['facility'] ?? '';
    $company = $_POST['company'] ?? '';
    $client = $_POST['client'] ?? '';

    $sql = "UPDATE patches SET full_patch_JSON = :fullPatch, 
    camera_patch = :cameraPatch, date = :saveDate,  
    job_name = :jobname, facility = :facility, 
    company = :company, client = :client 
    WHERE patch_id = :patchId ;";
    $stmt = $pdo->prepare($sql);
  
    $stmt->execute(['fullPatch' => $full_patch_JSON, 
    'cameraPatch' => $full_cam_patch, 'saveDate' => $current_time, 
    'jobname' => $job_name, 'facility' => $facility, 
    'company' => $company, 'client' => $client, 
    'patchId' => $patch_id]);
   
?>