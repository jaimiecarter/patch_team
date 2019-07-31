function deleteJob(num){
    patch_id = parseInt(num);
    console.log(patch_id);

    var pid = new FormData();
    pid.append("patch_id", patch_id);
    fetch("../php-functions/delete_job.php", {
        method: "POST",
        body: pid
    })
    .then(function(){
        window.location = "../pages/select.php";
    });
    
}
var nav = document.getElementById('select');
nav.style.backgroundColor = "rgb(36, 123, 160)";