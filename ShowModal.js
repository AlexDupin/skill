$(document).ready(function() {
  var url = window.location.href;
  if (url.indexOf('?showproject') != -1) {
    $("#ShowProject").modal('show');
  }
  if (url.indexOf('?showmodal=2') != -1) {
    $("#modal-2").modal('show');
  }
});