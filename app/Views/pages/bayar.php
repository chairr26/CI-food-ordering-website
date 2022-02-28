<?php
if (isset($_POST["data"])) {
    print_r($_POST["data"]);
} else {
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script>
        const cartItems = localStorage.getItem("shoppingCart");
        const jsonString = JSON.stringify(cartItems);

        jQuery.ajax({
            url: "<?= site_url('Bayar') ?>",
            method: "post",
            data: {
                data: jsonString,
                buna: "hbkhn"
            },
            success: function(res) {
                jQuery('body').append(res);
            },
            error: function(err) {
                jQuery('body').append(err);
            }
        });
    </script>
<?php } ?>