$(document).ready(function () {
  // Event for checking if the passwords match
  $("#confirmpassword").on("keyup", function () {
    var pswd1 = document.querySelector("#password").value;
    var pswd2 = $(this).val();
    // console.log("Password 1: " + pswd1 + " Password 2: " + pswd2);
    if (pswd1 != pswd2) {
      document.querySelector("#password").style.borderWidth = 5;
      document.querySelector("#confirmpassword").style.borderWidth = 5;
      document.querySelector("#password").style.borderColor = "red";
      document.querySelector("#confirmpassword").style.borderColor = "red";
    } else {
      document.querySelector("#password").style.borderWidth = 5;
      document.querySelector("#confirmpassword").style.borderWidth = 5;
      document.querySelector("#password").style.borderColor = "green";
      document.querySelector("#confirmpassword").style.borderColor = "green";
    }
  });

  // setInterval(function () {
  //   var currentTime = new Date();
  //   var hours = currentTime.getHours();
  //   var minutes = currentTime.getMinutes();
  //   var seconds = currentTime.getSeconds();
  //   document.querySelector("#currenttime").innerHTML =
  //     hours + ":" + minutes + ":" + seconds;
  // }, 1000); // updates every 1000 milliseconds (1 second)
});
