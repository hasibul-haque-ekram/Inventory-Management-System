<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>

    </style>
</head>
<body>
    <section class="gradient-custom ">
        <form action="save.php" method="post">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Inventory Management System</h2>
                                <p class="text-white-50 mb-5">Please enter your email and password!</p>
                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="pass" id="typePasswordX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>
                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>
                            </div>
                            <!-- <div>
                                <p class="mb-0">Don't have an account? <a href="./signup.html" target="_blank" class="text-white-50 fw-bold">Sign up</a></p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
