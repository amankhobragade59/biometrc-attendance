$(document).ready(function () {

        send = "";
        $.ajax({
            url: "get_dashboard.php",
            method: "GET",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                for (i = 0; i < data.length; i++) {
                    send += "<tr><td>" + data[i].serialnumber + "</td><td>" + data[i].name + "</td><td>" + data[i].gmail + "</td><td>" + data[i].date + "</td><td>" + data[i].punchin + "</td><td>" + data[i].punchout + "</td></tr>";
                }
                $("#dash").html(send);
                showdata();
            }
        })
    


})