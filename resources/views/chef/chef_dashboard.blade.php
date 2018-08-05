
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
                    <a class="nav-link" href="{{@route('chef')}}">Chef Dashboard
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
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <div class="input-group mr-2">
                    <input class="form-control" type="search" placeholder="Search">
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
            <div class="col-6 d-flex justify-content-end">
                <div class="flex-fill card border-light mt-4" style="max-width: 18rem;">
                    <div class="card-header">Today Orders</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Ordered  <span class="badge badge-pill badge-secondary"><?php echo $orderOrderedCount; ?></span></li>
                        <li class="list-group-item">Cooked  <span class="badge badge-pill badge-secondary"><?php echo $orderCookedCount; ?></span></li>
                        <li class="list-group-item">Delivered  <span class="badge badge-pill badge-secondary"><?php echo $orderDeliveredCount; ?></span></li>
                    </ul>
                    <div class="card-body">
                        <a href="{{@route('chefToday')}}" class="btn btn-outline-secondary">Show more</a>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-start">
                <div class="flex-fill card border-light mt-4" style="max-width: 18rem;">
                    <div class="card-header">Recipe</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Available  <span class="badge badge-pill badge-secondary"><?php echo $recipeAvailableCount ?></span></li>
                        <li class="list-group-item">Unavailable  <span class="badge badge-pill badge-secondary"><?php echo $recipeUnvailableCount ?></span></li>                        
                    </ul>
                    <div class="card-body">
                        <a href="{{@route('recipeList')}}" class="btn btn-outline-secondary">Show more</a>
                    </div>
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

</html>