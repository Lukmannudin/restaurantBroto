<?php 
    // echo '<pre>';
    // var_dump($data);
?>
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
                    Critic
                </li>

            </ul>



        </div>
    </nav>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
            <a href="{{@route('customer_service')}}"><button type="button" class="btn btn-light btn-back">
                <i class="fa fa-chevron-circle-left" style="font-size:24px"></i>
                Back
            </button></a>
                <div class="row mt-3">
                    <div class="col-2 ">
                        
                           <div>
                               orderid
                           </div>
                           <div>
                               Customer Name
                           </div>
                           <div>
                               Date Order
                           </div>
    

                    </div>
                    <div class="col-6">
                        
                           <div>
                               <?php echo $data[0]->criticid; ?>
                           </div>
                           <div>
                               <?php echo $data[0]->customer_name; ?>
                           </div>
                           <div>
                           <?php $date = strtotime($data[0]->dateOrder); ?>
                            <?php echo date('d-m-Y',$date); ?>
                           </div>

                    </div>
                    <div class="col-12 mt-3">
                        <textarea class="form-control" name="" id="" rows="4"><?php echo $data[0]->comments ?></textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row d-flex justify-content-center">
                            <div class="col-4 d-flex flex-column align-items-center">
                                <div>
                                    Coziness
                                </div>
                                <div>
                                    <?php for ($i=0; $i < $data[0]->coziness; $i++) : ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="col-4 d-flex flex-column align-items-center">
                                <div>
                                    Services
                                </div>
                                <div>
                                <?php for ($i=0; $i < $data[0]->services; $i++) : ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>   
                            <div class="col-4 d-flex flex-column align-items-center">
                                <div>
                                    Menu
                                </div>
                                <div>
                                <?php for ($i=0; $i < $data[0]->menu; $i++) : ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <a href="{{@route('deleteCritic',['criticid'=>$data[0]->criticid])}}"><button class="btn btn-danger">DELETE CRITIC</button></a> 
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
</html>