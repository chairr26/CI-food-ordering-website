<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lau Cafe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background-color: #EEEEEE;
        }

        .navbar {
            overflow: hidden;
            background-color: #495371;
            top: 0;
            width: 100%;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <a class="navbar-brand" href="#">Lau Cafe</a>
        <a class="nav-link" data-toggle="modal" data-target=".orderCart">Keranjang
            <div style="width: 20px;height: 20px;background: #fb9200;position: absolute;top: 13px;margin-left: 65px;border-radius: 50%">
                <p id="order_number" style="position: absolute;margin-top: 0;margin-left: 6px;color: #fff;font-size: 80%">0</p>
            </div>
        </a>
    </div>

    <div class="main">
        <div id="list_food_home" class="container">
            <div class="row" id="prinf_food">


            </div>
        </div>

    </div>
    <?php
    foreach ($menu as $key => $value) :
    ?>
        <script>
            var prinf = `<div class="col-6 col-sm-6 col-md-4 col-lg-3 p-4">
                <div class="produre_box bg-white shadow-sm">
                <div class="image_box">
                <img src="<?= $value->menu_image ?>" width="100%" height="100%" style="">
                </div>
                <div class="info_box p-3 bg-white">
                    <div style="height:50px">
                        <p class="float-left font-weight-bold" style="font-size: 90%;margin:0; color:#495371"><?= $value->menu_name ?></p>
                        <div style="clear: both;"></div>
                        <p class="float-left font-weight-bold" style="font-size: 65%;margin:0; color:#fb9200" >Rp <?= number_format($value->menu_price) ?></p>
                    </div>
                    <div style="height:60px">
                        <p style="font-size: 85%;width:85%;"><?= $value->menu_description ?></p>
                    </div>
                    <div class="order_box float-right">
                        <div onclick="checkorder(<?= $value->menu_id ?>)" class="order_button float-right pt-2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                </div>
                <div style="clear: both;"></div>
                </div>
                </div>
                </div>`;
            document.getElementById("prinf_food").innerHTML += prinf;
        </script>
    <?php endforeach ?>



    <script>
        function checkorder(id) {



            for (let i = 0; i < orderFood.length; i++) {
                var checkordervalue = 0;

                if (id == orderFood[i].id_food && checkLogin == orderFood[i].user_id_order) {

                    checkordervalue = 1;
                    orderFood[i].quanlity_order++;

                    orderFood[i].quanlity_order;
                    localStorage.setItem("orderFood", JSON.stringify(orderFood));
                    orderprinf();

                }

            }
            if (checkordervalue == 0) {
                orderpush(id);
                orderprinf();

            }
        }
    </script>


</body>

</html>