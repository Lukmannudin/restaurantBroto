
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
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/waiter.css')}}" />
    

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="../resbroto.png" width="100" height="100" alt=""></a>

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

        <form class="form-inline my-2 my-lg-0" method="post" action="{{@route('searchRecipeWaiter')}}">
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
        </div>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
    </nav>

    <form class="" action="{{@route('orderWaiter')}}" method="post">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-4">
            <a href="#" onclick="back()"><button type="button" class="btn btn-light btn-back">
                <i class="fa fa-chevron-circle-left" style="font-size:24px"></i>
                Back
            </button></a>
                    <div class="form">
                    <label for="exampleInputEmail1">Name:</label>
                        <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your customer name">

                    </div>
                    <div class="form">
                        <label for="exampleFormControlSelect1">Table No.</label>
                        <select name="orderTable" class="form-control" id="exampleFormControlSelect1"> 
                            <?php foreach ($tables as $table): ?>
                            <?php if ($table->status != 0): ?>
                                <option value="<?php echo $table->tableid;  ?>"><?php echo $table->identifier; ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form">
                        <label for="exampleInputEmail1">Persons</label>
                        <input type="number" class="form-control" min=1 id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="persons">
                    </div>
            </div>
            <div class="col-8">
                
                
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">orders</th>
                                <th scope="col">Price/item</th>
                                <th scope="col">Qty</th>
    
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $tempCek ="";$i=0;
                            foreach ($recipes as $recipe): ?>
                            <?php 
                                
                                    if (($tempCek != $recipe->recipeid))  :
                                        $tempCek = $recipe->recipeid;   
                                        if ($maxAvailable[$i]['max']>0) :
                                   ?>
                            <tr>
                                <td><?php echo $recipe->title; ?></td>
                                <td><?php echo $recipe->price;?></td>
                                <td>
                                    <input type="number" class="form-control" placeholder="0" onchange="check(this.value, this.nextElementSibling)" name="jml[]" max=<?php echo $maxAvailable[$i]['max'] ?> min=0>
                                    <input type="checkbox" name="orderItem[]" value="<?php echo $recipe->recipeid ?>" name="checkbox-recipe">
                                </td>
                                    
                                </tr>
                                        
                                    <?php endif; ?>   
                                <?php $i = $i+1; ?>

                                <?php endif;?>
                            <?php endforeach ?> 
                            

                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-light btn-submit mr-auto">ORDER</button>
                
            </div>
        </div>




    </div>

<div class="modal fade" id="warningFailed" tabindex="-1" role="dialog" aria-labelledby="warningFailedLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningFailed">
                    <!-- <i class="fa fa-question-circle" aria-hidden="true"></i> -->
                    <!-- <i class="fa fa-exclamation-circle"></i> -->
                    <i class="fa fa-warning" aria-hidden="true"></i>
                    Warning
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
               Failed to save
            </div>   
        </div>
    </div>
</div>

<div class="modal fade" id="searchNotFound" tabindex="-1" role="dialog" aria-labelledby="searchNotFoundLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchNotFound">
                    <!-- <i class="fa fa-question-circle" aria-hidden="true"></i> -->
                    <i class="fa fa-exclamation-circle"></i>
                    <!-- <i class="fa fa-warning" aria-hidden="true"></i> -->
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
                        echo 'Something Wrong';
                    }
                ?>
            </div>   
        </div>
    </div>
</div>


<div class="modal fade" id="backDialog" tabindex="-1" role="dialog" aria-labelledby="backDialogLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backDialogLabel">
                    <!-- <i class="fa fa-question-circle" aria-hidden="true"></i> -->
                    <i class="fa fa-exclamation-circle"></i>
                    <!-- <i class="fa fa-warning" aria-hidden="true"></i> -->
                    Confirmation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
               Changes you have made won't be saved, are you sure?
            </div>
            
            <div class="modal-footer d-flex justify-content-center">
                <a href="{{@route('waiter')}}"><button type="button" class="btn btn-primary">Yes</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
</form>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
    crossorigin="anonymous"></script>

<script src="{{asset('js/waiter.js')}}"></script>
    <script>
         function back(){
            $('#backDialog').modal('show');
        }

        
        if (isset($message)) {
            if ($message != "") {
                $('#searchNotFound').modal('show');
            }
        }
    </script>

</html>