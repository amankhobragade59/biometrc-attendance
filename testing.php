<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<button type="button" class ="class"id="btn1">download1</button>
<button type="button" id="btn2">download2</button>
<button type="button" id="btn3">download3</button>
<button type="button" id="en">enable</button>
</button>
<script>
    const btn1= $('#btn1').attr('class');
    const btn2= $('#btn2');
    const btn3= $('#btn3');
    const btn4= $('#btn4');
    const en= $('#en');
    if(btn1.length)
{
    $('#btn1').on('click', function (){
        console.log("btn1 clicked");
    btn2.addClass('disabled').prop('disabled',true);
    btn3.addClass('disabled').prop('disabled',true);
    });
    
}
if(en.length)
{
    $('#en').on('click', function (){
        console.log("enable clicked");
    btn2.removeClass('disabled').prop('disabled',false);
    btn3.removeClass('disabled').prop('disabled',false);
    });
    
}   

   
</script>
</body>

</html>