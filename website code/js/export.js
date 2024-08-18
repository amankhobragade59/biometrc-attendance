$(document).ready(function () {
    $("#efetch").click(function (event) {
        event.preventDefault();
        console.log("clicked");
        let edt = $("#edate").val();
        mydata = {date: edt};
        send="<div><table><thead><tr><td>Date</td><td>Name</td><td>G-mail</td><td>Punch In</td><td>Punch Out</td></tr></thead><tbody>";
        $.ajax({
            url: "get_export.php",
            method: "POST",
           data: JSON.stringify(mydata),
            success: function (data) {
                console.log(data);
                for (i = 0; i < data.length; i++) 
                {
                    send+="<tr><td>" + data[i].date + "</td><td>" + data[i].name + "</td><td>" + data[i].gmail + "</td><td>" + data[i].punchin + "</td><td>" + data[i].punchout + "</td></tr>";
                }
                send+="</tbody></table></div>"; 
                $("#econtent").html(send);
            }
        })
    })

    // $("#dicon").click(function () {
    //     console.log("download clicked");
    //     let edt = $("#edate").val();
    //     mydata = { date: edt};
    //     $.ajax({
    //         url: "download.php",
    //         method: "POST",
    //         data: JSON.stringify(mydata),
    //         success: function (data) {
    //             console.log(data);
    //         }
    //     })
    // })
})