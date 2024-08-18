$(document).ready(function () {
    //ajax for editing
    $("#user_list").on("click", ".btn-edit", function () {
        console.log("edit clicked");
        let id = $(this).attr("edi");
        console.log(id);
        mydata = { sid: id };
        mythis = this;
        console.log(mydata);
        $.ajax({
            url: "edited.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function (data) {
                // if (data) {
                //     alert("User editing Successfully");
                // }
                // else {
                //     alert("User editing Failed");
                // }

            }
        })
    })
})