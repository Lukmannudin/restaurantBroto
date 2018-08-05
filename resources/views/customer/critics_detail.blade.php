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
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main.css')}}" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="resbroto.png" width="100" height="100" alt="">
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                </li>
            </ul>



        </div>
    </nav>
    <form action="{{@route('insertCritic')}}" method="post">
                           
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <div class="row mt-3">
                        <div class="col-12 ">
                             {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Your Order ID:</label>
                                    <input type="text" class="form-control" name="orderid" id="name" aria-describedby="name" placeholder="" required>
                                </div>
                        </div>
                        <div class="col-12 mt-3">
                            <textarea class="form-control" name="critic" id="" rows="4"></textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row d-flex justify-content-center">
                                <div class="col-4 d-flex flex-column align-items-center">
                                    <div>
                                        Coziness
                                    </div>
                                    <div class="rating">
                                        <label>
                                            <input type="radio" name="coziness" value="1" />
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="coziness" value="2" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="coziness" value="3" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>   
                                        </label>
                                        <label>
                                            <input type="radio" name="coziness" value="4" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="coziness" value="5" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                    </div>
                              </div>
                                <div class="col-4 d-flex flex-column align-items-center">
                                    <div>
                                        Services
                                    </div>
                                    <div class="rating">
                                        <label>
                                            <input type="radio" name="services" value="1" />
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="services" value="2" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="services" value="3" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>   
                                        </label>
                                        <label>
                                            <input type="radio" name="services" value="4" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="services" value="5" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                    </div>
                                </div>   
                                <div class="col-4 d-flex flex-column align-items-center">
                                    <div>
                                        Menu
                                    </div>
                                    <div class="rating">
                                        <label>
                                            <input type="radio" name="menu" value="1" />
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="menu" value="2" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="menu" value="3" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>   
                                        </label>
                                        <label>
                                            <input type="radio" name="menu" value="4" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="menu" value="5" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                    </div>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5 d-flex justify-content-center">
                        <button class="btn btn-success">SUBMIT</button> 
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
    <script>
        $(':radio').change(function() {
            console.log('New star rating: ' + this.value);
        });
    </script>
</html>