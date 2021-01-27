function HideManageUsers(){
    var AccessLevelhttp = new XMLHttpRequest();
    AccessLevelhttp.open("GET", "getAccessLevel.php", true);
    AccessLevelhttp.send();
    AccessLevelhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            var AccessLevel = this.responseText;
            if (AccessLevel == "1"){
                document.getElementById("ManageUsers").style.display = "none";
            }
        }
    };
}
document.addEventListener("DOMContentLoaded", HideManageUsers);