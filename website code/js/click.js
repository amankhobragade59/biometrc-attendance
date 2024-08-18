$(document).ready(function () {
    $("#submit").click(function (event) {
        event.preventDefault();
        console.log("clicked");
        let nm = $("#name").val();
        let gm = $("#gmail").val();
        let rd = $("#registrationDate").val();
        // console.log(sn);
        // console.log(nm);
        // console.log(gm);
        // console.log(rd);
        mydata = { name: nm, gmail: gm, registrationdate: rd, selected: 1 };
        $.ajax({
            url: "insert.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function (data) {
                msg = "<div class ='alert alert-success alert-dismissible fade show border-primry mt-4 role='alert''>" + data + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" + "</div>";
                $("#msg").html(msg);
            }
        })
    })
})