<?php include 'init.php'; ?>


<div class="container">
    <div class="cart-table">
        <table>
            <thead>
                <tr>
                    <th class="product-h">Product</th>
                    <th>Price</th>
                    <th class="quan">Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="product-col">
                        <img src="img/product/product-1.jpg" alt="">
                        <div class="p-title">
                            <h5>Blue Dotted Shirt</h5>
                        </div>
                    </td>
                    <td class="price-col">$29</td>
                    <td class="quantity-col">
                        <div class="pro-qty">
                            <input type="text" value="1">
                        </div>
                    </td>
                    <td class="total">$29</td>
                    <td class="product-close">x</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?php
include $tpl . 'footer.php';
?>