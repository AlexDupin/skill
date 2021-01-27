const row = document.querySelectorAll("tbody tr");

const retired = {
  value: "retired",
  checkbox: document.getElementById("filterRetired")
};

function filterRetired() {
  for (let i = 0; i < row.length; i++) {
    if (retired.checkbox.checked == false) {
      var col = row[i].getElementsByTagName("td")[0];
      console.log(col);
      if (col.textContent.indexOf(retired.value) > -1) {
        row[i].style.display = "none";
      } else {
        row[i].style.display = "";
      }
    } else {
      row[i].style.display = "";
    }
  }
}

retired.checkbox.addEventListener("click", filterRetired);
document.addEventListener("DOMContentLoaded", filterRetired);
