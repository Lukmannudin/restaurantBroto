
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/main.css')}}" />
    <script src="main.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
        <img src="{{URL::asset('img/resbroto.png')}}" width="100" height="100" alt="">
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Waiter Dashboard - Add Order
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            </form>
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
            <button type="button" class="btn btn-light btn-back">
                <i class="fa fa-chevron-circle-left" style="font-size:24px"></i>
                <a href="{{@route('orderDetail',['orderid' => $dataEdit[0]->orderid])}}">Back</a>
            </button>
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
                    <button type="submit" class="btn btn-primary btn-submit">CONFIRM CHANGES</button>
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
                        <?php $i=0;foreach ($recipes as $menu): ?>
                        <?php 
                            $cek = "";
                            $qty = NULL;
                            if ($i <= count($dataEdit)-1){
                                if (($menu->recipeid) == $dataEdit[$i]->recipeid) {
                                    $cek="checked";
                                    $qty = $dataEdit[$i]->qtyOrderItem;
                                } else {
                                    $cek = "";
                                }
                                $i=$i+1;
                            } 
                        ?>
                            <tr>
                                <td><input type="checkbox" name="orderItem[]" value="<?php echo $menu->recipeid ?>" <?php echo $cek; ?>></td>
                                <td><?php echo $menu->title; ?></td>
                                <td><input type="text" name="jml[]" class="form-control" placeholder="0" value="<?php echo $qty; ?>"></td>
                            </tr>
                            <?php endforeach ?> 
                            
                        </tbody>
                    </table>
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

</html>