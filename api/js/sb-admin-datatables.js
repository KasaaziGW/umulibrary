$(document).ready(function () {
  $("#dataTable").DataTable();
  $("#booksTable").DataTable({
    serverSide: true,
    ajax: { url: "fetchBooks.php", dataType: "json", type: "POST" },
    paging: true,
    pageLength: 50,
    lengthMenu: [
      [50, 100, 200, 300, 500, 1000, 5000],
      [50, 100, 200, 300, 500, 1000, 5000],
    ],
    processing: true,
    columns: [
      { data: "verify" },
      { data: "barcode" },
      { data: "call_no" },
      { data: "isbn" },
      { data: "item_type_1" },
      { data: "item_type_2" },
      { data: "title" },
      { data: "copyrightdate" },
      { data: "branch" },
      { data: "date_created" },
      { data: "last_borrowed" },
      { data: "status" },
      { data: "comment" },
      { data: "staff" },
      { data: "addcomment" },
    ],
    dom: '<"top"lBipf>rt<"bottom"ip><"clear">',
    buttons: [
      {
        extend: "excel",
        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
      },
      {
        extend: "csv",
        text: "csv",
      },
      {
        extend: "print",
        text: '<i class="fa fa-print" aria-hidden="true"></i>',
      },
    ],
  });
  var verified = $("#verifiedTable").DataTable({
    serverSide: true,
    paging: true,
    pageLength: 50,
    lengthMenu: [
      [50, 100, 200, 300, 500, 1000, 5000],
      [50, 100, 200, 300, 500, 1000, 5000],
    ],
    ajax: {
      url: "fetchVerified.php",
      dataType: "json",
      type: "POST",
      data: function (d) {
        d.staff = $("#staffFilter").val(); // Send the selected staff to the server
      },
    },
    processing: true,
    columns: [
      { data: "verify" },
      { data: "barcode" },
      { data: "call_no" },
      { data: "isbn" },
      { data: "item_type_1" },
      { data: "item_type_2" },
      { data: "title" },
      { data: "copyrightdate" },
      { data: "branch" },
      { data: "status" },
      { data: "comment" },
      { data: "staff" },
      { data: "addcomment" },
    ],
    // dom: "Bfrtip", // Layout control
    dom: '<"top "lBip>rt<"bottom"ip><"clear">',
    buttons: [
      {
        extend: "excel",
        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
      },
      {
        extend: "csv",
        text: "csv",
      },
      {
        extend: "print",
        text: '<i class="fa fa-print" aria-hidden="true"></i>',
      },
    ],
  });
  // Event listener for the staff filter dropdown
  $("#staffFilter").change(function () {
    verified.ajax.reload(); // Reload the table data when the dropdown selection changes
  });

  $("#pendingTable").DataTable({
    serverSide: true,
    ajax: { url: "fetchPending.php", dataType: "json", type: "POST" },
    paging: true,
    pageLength: 50,
    lengthMenu: [
      [50, 100, 200, 300, 500, 1000, 5000],
      [50, 100, 200, 300, 500, 1000, 5000],
    ],
    processing: true,
    columns: [
      { data: "verify" },
      { data: "barcode" },
      { data: "call_no" },
      { data: "isbn" },
      { data: "item_type_1" },
      { data: "item_type_2" },
      { data: "title" },
      { data: "copyrightdate" },
      { data: "branch" },
      { data: "status" },
      { data: "comment" },
      { data: "staff" },
      { data: "addcomment" },
    ],
    dom: '<"top"lBip>rt<"bottom"ip><"clear">',
    buttons: [
      {
        extend: "excel",
        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
      },
      {
        extend: "csv",
        text: "csv",
      },
      {
        extend: "print",
        text: '<i class="fa fa-print" aria-hidden="true"></i>',
      },
    ],
  });
});
