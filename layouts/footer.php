
    <button id="back-to-top">&#x25b2;</button>
    <script>
        $(function() {
            $updatecart = $(".updatecart");
            $updatecart.click(function(e){
                e.preventDefault();
                $qty = $(this).parents("tr").find(".qty").val();

                $key = $(this).attr("data-key");
                $.ajax({
                    url: 'cap-nhat-gio-hang.php',
                    type: 'GET',
                    data: {'qty': $qty, 'key': $key},
                    success: function(data){

                        if(data ==1) {
                            alert("Cập nhật giỏ hàng thành công!");
                            location.href = 'gio-hang.php';
                        }
                    }
                });
            })
        })
    </script>
</body>
</html>
