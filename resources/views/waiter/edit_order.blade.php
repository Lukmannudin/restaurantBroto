
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
    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/waiter.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main.css')}}" />
    
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
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <?php foreach ($notifications as $notif) : ?>
                            <a class="dropdown-item" href="{{@route('orderDetail',['orderid' => $notif->orderid])}}"><?php echo $notif->notification ?></a>
                        <?php endforeach; ?> 
                    </div>
                </li>
            </ul>
            
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
        </div>
    </nav>
    <form class="" action="{{@route('updateOrder')}}" method="post">
        <input type="hidden" name="tableBefore" value="<?php echo $dataEdit[0]->tableid; ?>">
        <input type="hidden" name="orderid" value="<?php echo $dataEdit[0]->orderid; ?>">
        {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-4">
               
                <!-- <a href="{{@route('orderDetail',['orderid' => $dataEdit[0]->orderid])}}">Back</a> -->
                    <!-- <a onlick="back()"></a> -->
                    <a href="#"><button  onclick="back()" type="button" class="btn btn-light btn-back"><i class="fa fa-chevron-circle-left" style="font-size:24px"></i>Back</button></a>
                    <div class="form">
                    <label for="exampleInputEmail1">Name:</label>
                        <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your customer name" value="<?php echo $dataEdit[0]->customer_name ?>">
                    </div>
                    <div class="form">
                        <label for="exampleFormControlSelect1">Table No.</label>
                        <select name="orderTable" class="form-control" id="exampleFormControlSelect1">
                        <?php foreach ($tables as $table): ?>
                            <?php if (($table->status != 0) || ($dataEdit[0]->tableid) ==$table->tableid): ?>
                                <option value="<?php echo $table->tableid;  ?>"><?php echo $table->identifier; ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form">
                        <label for="exampleInputEmail1">Persons</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="persons" value="<?php echo $dataEdit[0]->persons; ?>">
                    </div>
                    <button type="submit" class="btn btn-success btn-submit mt-3" >CONFIRM CHANGES</button>
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
                        
                        
                        <?php $cDedit;$cek = "";$xz=0;$xPenyetara=0;$yPenyetara=0;$cekcek2 = $recipes[0]->title;
                        foreach ($recipes as $recipe) : 
                            if ($recipe->recipeid != $cek) {
                                $cek = $recipe->recipeid;
                                $cek2= "";$qty=0;
                                $yPenyetara=$yPenyetara+1;
                                ?>
                                                                 
                                <?php
                                
                                for ($i=0; $i < count($dataEdit) ; $i++) { ?>
                             
                             <?php
                                    if ($recipe->recipeid == $dataEdit[$i]->recipeid) {
                                        $qty=$dataEdit[$i]->qtyOrderItem;
                                        $max=0;

                                        for ($j=0; $j < count($maxAvailable) ; $j++) { 
                                            if ($dataEdit[$i]->recipeid == $maxAvailable[$j]['recipeid']) {
                                               $max = $maxAvailable[$j]['max'];
                                               $xPenyetara = $xPenyetara +1;
                                               ?>
                                                <tr class="ingredientComponent" id="test">
                                                    <td scope="row"> <?php echo $recipe->title; ?></td>
                                                    <td> <?php  echo $recipe->price; ?> </td>
                                                    <td>
                                                    <input  type="number" name="jml[]" class="form-control" min=0 max=<?php echo $max ?> id="qtyI" onchange="check(this.value, this.nextElementSibling)" placeholder="0" value="<?php echo $qty; ?>" min="0" max=$maxAvailable[$j]['max']>
                                                    <input class="ingredientid" type="checkbox" name="orderItem[]" value="<?php echo $recipe->recipeid ?>" checked >                                        
                                                    </td>
                                                </tr> 
                                               <?php
                                            }
                                        }
                                    } else{
                                        if ($recipe->title != $dataEdit[0]->title) {
                                            if ($cekcek2 != $recipe->title && $recipe->title != $dataEdit[0]->title) {
                                                    $cekcek2 = $recipe->title;
                                                } else {
                                                    for ($j=0; $j < count($maxAvailable) ; $j++) { 
                                                        if ($recipe->recipeid == $maxAvailable[$j]['recipeid']) {
                                                           $max = $maxAvailable[$j]['max'];
                                                           $xPenyetara = $xPenyetara +1;
                                                           ?>
                                                            <tr class="ingredientComponent" id="test">
                                                                <td scope="row"> <?php echo $recipe->title; ?></td>
                                                                <td> <?php  echo $recipe->price; ?> </td>
                                                                <td>
                                                                <input  type="number" name="jml[]" class="form-control" min=0 max=<?php echo $max ?> id="qtyI" onchange="check(this.value, this.nextElementSibling)" placeholder="0" value="<?php echo $qty; ?>" min="0" max=$maxAvailable[$j]['max']>
                                                                <input class="ingredientid" type="checkbox" name="orderItem[]" value="<?php echo $recipe->recipeid ?>" checked >                                        
                                                                </td>
                                                            </tr> 
                                                           <?php
                                                        }
                                                    }
                                                    
                                                }                         
                                        }
                                        
                                    }
                                    
                                } 
                            };endforeach;
                               
                            
                              ?>

                        </tbody>
                    </table>
            </div>
        </div>




    </div>
</form>
<div class="modal fade" id="orderidnotfound" tabindex="-1" role="dialog" aria-labelledby="orderidnotfoundLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderidnotfound">
                    <!-- <i class="fa fa-question-circle" aria-hidden="true"></i> -->
                    <!-- <i class="fa fa-exclamation-circle"></i> -->
                    <i class="fa fa-warning" aria-hidden="true"></i>
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
                <a href="{{@route('orderDetail',['orderid'=>$dataEdit[0]->orderid])}}"><button type="button" class="btn btn-primary">Yes</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="somethingWrong" tabindex="-1" role="dialog" aria-labelledby="somethingWrong" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="somethingWrongLabel">
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
                        if ($message!= "") {
                            echo $message;
                        } else {
                            echo "Something Wrong";
                        } 
                    } 
               ?>
            </div>
            
            <div class="modal-footer d-flex justify-content-center">
                <a href="{{@route('orderDetail',['orderid'=>$dataEdit[0]->orderid])}}"><button type="button" class="btn btn-primary">Yes</button></a>
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
    <script>
    <?php 
        if (isset($message)) {
          echo   "$('#somethingWrong').modal('show');";
        }
    ?>
    
    function back(){
        $('#orderidnotfound').modal('show');
    }
        
    function check(value, next) {    
        /* var input_value = document.getElementById("checkbox-value").value; */
        console.log(next);
        console.log(value);
        
        if (value >= 1) {
            next.checked = true;
        }else{
            next.checked = false; 
        }
    }
</script>
</html>