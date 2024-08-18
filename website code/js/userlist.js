$(document).ready(function () {

    output = "";
    $.ajax({
        url: "retrieve.php",
        method: "GET",
        dataType: 'json',
        success: function (data) {
            console.log(data);
            for (i = 0; i < data.length; i++) {
                output +=
                    "<tr><td>" +
                    data[i].serialnumber +
                    "</td><td>" +
                    data[i].name +
                    "</td><td>" +
                    data[i].gmail +
                    "</td><td>" +
                    data[i].registrationdate +
                    "</td><td> <button class='btn btn-outline-danger btn-sm btn-del' datasid=" + data[i].serialnumber + ">Delete</button></td></tr>";
            }
            $("#user_list").html(output);
        }
    })

    //ajax for deleting
    $("#user_list").on("click", ".btn-del", function () {
        console.log("delete clicked");
        let id = $(this).attr("datasid");
        console.log(id);
        mydata = { sid: id };
        mythis = this;
        $.ajax({
            url: "delete.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function (data) {
                if (data) {
                    alert("User Deleted Successfully");
                    $(mythis).closest("tr").fadeOut();
                }
                else {
                    alert("User Deleted Failed");
                }

            }
        })
    })


    //ajax for editing
    // $("#user_list").on("click", ".btn-edit", function () {
    //     console.log("edit clicked");
    //     let id = $(this).attr("editid");
    //     console.log(id);
    //     mydata = { sid: id };
    //     mythis = this;
    //     $.ajax({
    //         url: "edit.php",
    //         method: "POST",
    //         data: JSON.stringify(mydata),
    //         success: function (data) {
    //             if (data) {
    //                 alert("User editing Successfully");
    //             }
    //             else {
    //                 alert("User editing Failed");
    //             }

    //         }
    //     })
    // })

});