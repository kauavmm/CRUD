<?php

$this->layout('layout', [
    'title' => 'Create', 
    'description' => 'Create user for the database'
]); 

?>

<?php

    use App\Helpers\Session;

    Session::flashOutput('emailFilter');
    Session::flashOutput('emailExists');
    Session::flashOutput('emptyPassword');
    
?>

<form action="/users" method="POST">
    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="floatingName" placeholder="Name">
                <label for="floatingName">Name</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="surname" id="floatingSurname" placeholder="Surname">
                <label for="floatingSurname">Surname</label>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">@</span>
        <div class="form-floating">
            <input type="text" class="form-control" name="username" id="floatingInputGroup1" placeholder="Username">
            <label for="floatingInputGroup1">Username</label>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="phone" id="floatingPhone" placeholder="Phone">
                <label for="floatingPhone">Phone</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="age" id="floatingAge" placeholder="Age">
                <label for="floatingAge">Age</label>
            </div>
        </div>
    </div>  

    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>