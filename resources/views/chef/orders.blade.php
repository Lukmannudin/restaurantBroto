<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
table {
    border-spacing: 0;
}
    table tr td,
    table tr th {
        text-align: center;
        padding:2px;
    }
</style>
</head>
<body>
    <table border=1>
        <tr>
            <th>Table</th>
            <th>Customer Name</th>
            <th>Status</th>
            <th>Menu Orders</th>
            <th>Qty Orders</th>
            <th>Action</th>
        </tr>
        <?php 
            $indf=""; 
            $nama="";
            $orderTemp="";
            $orderTemp2="";
            ?>
        <?php foreach ($orders as $order): 
            ?>
        <tr>
           <?php if ($indf != $order->identifier): ?>        
            <td>
                <?php echo $order->identifier; ?>
            </td>
            <?php $indf = $order->identifier ?>
            <?php else: ?>
            <td></td>
            <?php endif; ?>

           <?php if ($nama != $order->customer_name): ?>  
            <td><?php echo $order->customer_name; ?></td>
            <?php $nama = $order->customer_name ?>
            <?php else: ?>
            <td></td>
            <?php endif; ?>

            <?php if($orderTemp != $order->orderid): ?>       
            <td>
            <?php 
                echo $order->statusOrder; 
                ?>
            </td>
            <?php $orderTemp = $order->orderid; ?>
            <?php else: ?>
            <td></td>
            <?php endif; ?>

            <td><?php echo $order->title ?></td>
            <td><?php echo $order->qtyOrderItem ?></td>
            <?php if($orderTemp2 != $order->orderid): ?>   
            <td>    </td>
            <?php $orderTemp2 = $order->orderid; ?>
            <?php else: ?>
            <td></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
    <pre>
   
</body>
</html>