$(document).ready(
    function aman () {
        output = "";
        $.ajax({
            url: "get_newuser.php",
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
                        data[i].registrationdate +"</td></tr>";
                }
                $("#newuser").html(output);
            }
        })
        //aman();
})