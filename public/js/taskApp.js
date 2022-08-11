$(document).ready(function () {
  $("#tasksList").DataTable();
});
deleteItem("[remove-btn]");
function deleteItem(item) {
  $(item).click(function (e) {
    e.preventDefault();
    var path = $(this).attr("href");
    SweetDeleteConfirm(path);
  });
}

function SweetDeleteConfirm(url) {
  swal({
    title: "Are you sure?",
    text: "You will not be able to recover!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((deleteConfirm) => {
    if (deleteConfirm) {
      swal({
        title: "Deleted!",
        text: "It has been deleted!",
        type: "success",
        confirmButtonText: "OK",
      }).then((isConfirm) => {
        if (isConfirm) {
          window.location = url;
        }
      });
    } else {
      swal("Your record is safe!");
    }
  });
}
