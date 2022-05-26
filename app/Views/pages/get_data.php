<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script>
    var cartItems = localStorage.getItem("shoppingCart");
    var idlog = localStorage.getItem("idlog");
    var jsonString = JSON.stringify(cartItems);

    jQuery.ajax({
        url: "<?= site_url('Bayar/qr') ?>",
        method: "post",
        data: {
            data: jsonString,
            nomeja: <?php echo $nomeja; ?>,
            idlog: idlog
        },
        success: function(res) {
            jQuery('body').append(res);
        },
        error: function(err) {
            jQuery('body').append(err);
        }
    });
</script>