<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kauã Melo">
    <meta name="Description" content="Create user for database">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" placeholder="Name">
                <label for="floatingName">Name</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingSurname" placeholder="Surname">
                <label for="floatingSurname">Surname</label>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">@</span>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Username">
            <label for="floatingInputGroup1">Username</label>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingPhone" placeholder="Phone">
                <label for="floatingPhone">Phone</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingAge" placeholder="Age">
                <label for="floatingAge">Age</label>
            </div>
        </div>
    </div>  

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>