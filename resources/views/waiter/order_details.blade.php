
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">
    <link rel="shortcut icon" href="{{asset('img/resbroto.png')}}" type="image/x-icon">
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
                     <a class="nav-link" href="{{@route('waiter')}}">Waiter Dashboard - Today's Orders
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
          
            <form class="form-inline my-2 my-lg-0" method="post" action="{{@route('searchOrderRecipeCustomer')}}">
            {{ csrf_field() }}
                <div class="input-group mr-2">
                    <input type="hidden" name="orderid" value="<?php echo $data[0]->orderid; ?>">
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
        <div class="row">
            <div class="col-4">
            <a href="{{@route('waiter')}}">
            <button type="button" class="btn btn-light btn-back">
                <i class="fa fa-chevron-circle-left" style="font-size:24px"></i>
                Back
            </button></a>
                <div class="row">
                    <div class="col-6">
                        <ul>
                            <li>orderid</li>
                            <li>Name</li>
                            <li>Table No.</li>
                            <li>Persons</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul>
                            <li><?php echo $data[0]->orderid ?></li>
                            <li><?php echo $data[0]->customer_name ?></li>
                            <li><?php echo $data[0]->identifier ?></li>
                            <li><?php echo $data[0]->persons ?></li>
                        </ul>
                    </div>
                </div>
                <?php if ($data[0]->status_order=="ordered") :?>
                    <button type="button" class="btn btn-info"><a href="{{@route('editOrder',['orderid' =>  $data[0]->orderid])}}"> Edit Order</a></button>
                    <button type="button" class="btn btn-danger" onclick="deleteL()"><a href="#">Delete Order</a></button>
                <?php else: ?>
                    <button type="button" class="btn btn-info disabled"> Edit Order</button>
                    <button type="button" class="btn btn-danger disabled">Delete Order</button>
                <?php endif; ?>
            </div>
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">orders</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($data as $data): ?>
                        <tr>
                            <td><?php echo $data->title ?></td>
                            <td><?php echo $data->qtyOrderItem ?></td>
                            <td><?php echo $data->price ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        
        
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <!-- <i class="fa fa-exclamation-circle"></i> -->
                    <!--<i class="fa fa-warning" aria-hidden="true"></i> -->
                    Confirmation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
               Are you sure to delete these order?
            </div>
            
            <div class="modal-footer d-flex justify-content-center">

                <a href="{{@route('deleteOrder',['orderid' => $data->orderid])}}"> <button type="button" class="btn btn-primary">Yes</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
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
    <script>
        function deleteL(){
            $('#deleteModal').modal('show');
        }    
    </script>

    
</html>
