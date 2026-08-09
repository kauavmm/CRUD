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

<div class="page-container">
    <div class="content-box">
        <div class="page-header">
            <div>
                <h1>Create user</h1>
                <p>Fill in the fields below to register a new user</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="name" id="inputName" placeholder=" " required>
                    <label for="inputName">Name</label>
                    <div class="invalid-feedback">
                        Please choose a name.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="surname" id="inputSurname" placeholder=" " required>
                    <label for="inputSurname">Surname</label>
                    <div class="invalid-feedback">
                        Please choose a surname.
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="username" id="inputUsername" placeholder=" " required>
                        <label for="inputUsername">Username</label>
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" class="form-control" name="phone" id="inputPhone" placeholder=" " required>
                    <label for="inputPhone">Phone</label>
                    <div class="invalid-feedback">
                        Please enter a valid phone.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" class="form-control" name="age" id="inputAge" placeholder=" " required>
                    <label for="inputAge">Age</label>
                    <div class="invalid-feedback">
                        Please enter a valid age.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control" name="email" id="inputEmail" placeholder=" " required>
                    <label for="inputEmail">E-mail</label>
                    <div class="invalid-feedback">
                        Please enter a valid e-mail.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group has-validation">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder=" " required>
                        <label for="inputPassword">Password</label>
                        <div class="invalid-feedback">
                            Please enter a password.
                        </div>
                    </div>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1" aria-label="Show password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            
                <div id="passwordCriteria" class="d-none mt-2">
                    <div class="progress" style="height: 4px;">
                        <div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                    </div>
            
                    <ul class="list-unstyled mt-2 mb-0" style="font-size: 12px;">
                        <li id="criteria-length" class="text-muted">
                            <i class="bi bi-circle"></i> At least 8 characters
                        </li>
                        <li id="criteria-uppercase" class="text-muted">
                            <i class="bi bi-circle"></i> One uppercase letter
                        </li>
                        <li id="criteria-lowercase" class="text-muted">
                            <i class="bi bi-circle"></i> One lowercase letter
                        </li>
                        <li id="criteria-number" class="text-muted">
                            <i class="bi bi-circle"></i> One number
                        </li>
                        <li id="criteria-special" class="text-muted">
                            <i class="bi bi-circle"></i> One special character
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
