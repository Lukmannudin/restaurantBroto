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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/main.css" />



</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="/resbroto.png" width="100" height="100" alt="">
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    Customer Service Dashboard 
                </li>

            </ul>

            <form class="form-inline my-2 my-lg-0">
                <div class="input-group mr-2">
                    <input class="form-control" type="search" placeholder="Search" >
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
            
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-12 mt-3">
                <h6>Date</h6>

                <input  type="text" name="daterange" class="form-control" value="" />


            </div>
            
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" data-field="id" data-sortable="true">criticsid</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Coziness</th>
                            <th scope="col">Services</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Date Order</th>
                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $data) : ?>
                        <tr>
                            <th scope="row"><a href="{{@route('customer_service_detail',['criticid'=>$data->criticid])}}"><?php echo $data->criticid ?></a></th>
                            <td><?php echo $data->customer_name ?></td>
                            <td><?php echo $data->coziness ?> <i class="fa fa-star-o" aria-hidden="true"></i></td>
                            <td><?php echo $data->services ?> <i class="fa fa-star-o" aria-hidden="true"></i></td>
                            <td><?php echo $data->menu ?> <i class="fa fa-star-o" aria-hidden="true"></i></td>
                            <td><?php echo $data->comments ?></td>
                            <?php $date = strtotime($data->dateOrder); ?>
                            <td><?php echo date('d-m-Y',$date); ?></td>
                        </tr>
                        <?php endforeach; ?>

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
    crossorigin="anonymous"></script>

<script>
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format(
                'YYYY-MM-DD'));
        });
    });
</script>

</html>