<!DOCTYPE html>
<html>
<head>
<title>Quick Admin</title>
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
<div class="main">
<div class="container">
<div class="row">
    <div class="col-md-4 "></div>
    <div class="col-md-4 login">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-b-0">Quick Admin Login </h5>
            </div>
            <div class="card-body ">
                <form method="post" action="{{ route('autlogin') }}" autocomplete="off">
                   @csrf
                    <div class="form-group">
                        <input required="" class="form-control" placeholder="User Name" name="username" maxlength="50" autofocus="" value="" type="text" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input required="" maxlength="55" class="form-control" placeholder="Password" name="password" type="password" required="" autocomplete="off">
                    </div>
                    <div class="form-check m-b-20">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox"> Remember me
                        </label>
                      </div>
                    <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>