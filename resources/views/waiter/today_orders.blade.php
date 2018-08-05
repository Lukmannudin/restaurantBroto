
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('img/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon-16x16.png')}}">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main.css')}}" />
    <script src="main.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="{{asset('img/resbroto.png')}}" width="100" height="100" alt=""></a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Waiter Dashboard - Today's Orders
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-bell" style="font-size:24px"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($notifications as $notif) : ?>
                            <a class="dropdown-item" href="{{@route('orderDetail',['orderid' => $notif->orderid])}}"><?php echo $notif->notification ?></a>
                        <?php endforeach; ?> 
                    </div>
                </li>
            </ul>
           
            <form class="form-inline my-2 my-lg-0" method="post" action="{{@route('searchWaiter')}}">
                    {{ csrf_field() }}
                <div class="input-group mr-2">
                    <input class="form-control" type="search" name="search" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
        </div>
    </nav>
    
    <div class="container">
        <a href="{{@route('waiterAdd')}}"><button class="btn btn-light btn-add">Add Order</button></a>
        <br>
<form action="{{@route('categoryWaiter')}}" method="post">
{{ csrf_field() }}
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="category" id="inlineCheckbox1" value="ordered"  onchange="this.form.submit()">
        <label class="form-check-label" for="inlineCheckbox1">ordered</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="category" id="inlineCheckbox2" value="cooked"  onchange="this.form.submit()">
        <label class="form-check-label" for="inlineCheckbox2">cooked</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="category" id="inlineCheckbox3" value="delivered" onchange="this.form.submit()">
        <label class="form-check-label" for="inlineCheckbox3">delivered</label>
    </div>
</form>

        <form action="">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" data-field="id" data-sortable="true">#</th>
                        <th scope="col">orderid</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Order Time</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; 
                foreach ($orders as $order): ?>
                    <tr>
                        <th scope="row"><a href="{{@route('orderDetail',['orderid' => $order->orderid])}}"><?php echo $no ?></a></th>
                        <td><?php echo $order->orderid ?></td>
                        <td><?php echo $order->customer_name ?></td>
                        <td><?php echo $order->status_order ?></td>
                        <?php $date = strtotime($order->dateOrder); ?>
                        <td><?php echo date('H:i:s',$date); ?></td>
                        <?php if ($order->status_order =="cooked") :?>
                            <td>
                            <a href="{{@route('deliverOrder',['orderid' => $order->orderid])}}"><button type="button" class="btn"> Deliver</button></a>
                                <!-- <a href="{{@route('deliverOrder',['orderid' => $order->orderid])}}" class="btn"><button></button></a> -->
                            </td>
                        <?php elseif($order->status_order == "delivered"): ?>
                            <td><button class="btn disabled">Delivered</button></td>
                        <?php else:?>
                            <td><button class="btn disabled">Deliver</button></td>
                        <?php endif; ?>
                    </tr>
                <?php $no++;  endforeach; ?> 
                </tbody>
            </table>
        </form>
    </div>

<div class="modal fade" id="orderidnotfound" tabindex="-1" role="dialog" aria-labelledby="orderidnotfoundLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderidnotfoundLabel">
                    <!-- <i class="fa fa-question-circle" aria-hidden="true"></i> -->
                    <i class="fa fa-exclamation-circle"></i>
                    <!--<i class="fa fa-warning" aria-hidden="true"></i> -->
                    Information
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <?php 
                
                    if (isset($message)) {
                        echo $message; 
                    } else {
                        echo '{search name} not found';
                    }
                ?>
            </div>
            
            <!-- <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div> -->
        </div>
    </div>
</div>
    
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
    crossorigin="anonymous"></script>
<?php 
    if (isset($notFound)) {
        echo "<script>$('#orderidnotfound').modal('show');</script>";
    }
    
?>
</html>