<?php

/** @var array $userData */

$this->layout('layout', [
    'title' => 'Edit', 
    'description' => 'Edit user'
]);

?>

<?php

    $errors = \App\Helpers\Session::flash('errors') ?? []; // Captures input errors
    $old = \App\Helpers\Session::flash('old') ?? []; // Return the validated/correct inputs
    
?>

<div class="page-container">
    <div class="content-box">
        <div class="page-header">
            <div>
                <h1>Update user</h1>
                <p>Fill in the fields below to update your user</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" method="POST" action="/users/<?= $userData['id'] ?>" novalidate>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                           name="name" 
                           id="inputName" 
                           value="<?= htmlspecialchars($old['name'] ?? $userData['name']); ?>"
                           placeholder=" " 
                           required>
                    <label for="inputName">Name</label>
                    <div class="invalid-feedback">
                        <?= $errors['name'] ?? 'Please choose a name.' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control <?= isset($errors['surname']) ? 'is-invalid' : '' ?>" 
                           name="surname" 
                           id="inputSurname" 
                           value="<?= htmlspecialchars($old['surname'] ?? $userData['surname']); ?>"
                           placeholder=" " 
                           required>
                    <label for="inputSurname">Surname</label>
                    <div class="invalid-feedback">
                        <?= $errors['surname'] ?? 'Please choose a surname.' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <div class="form-floating">
                        <input type="text" 
                               class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" 
                               name="username" 
                               id="inputUsername" 
                               value="<?= htmlspecialchars($old['username'] ?? $userData['username']); ?>"
                               placeholder=" " 
                               required>
                        <label for="inputUsername">Username</label>
                        <div class="invalid-feedback">
                            <?= $errors['username'] ?? 'Please choose a username.' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" 
                           class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" 
                           name="phone" 
                           id="inputPhone" 
                           value="<?= htmlspecialchars($old['phone'] ?? $userData['phone']); ?>"
                           placeholder=" " 
                           required>
                    <label for="inputPhone">Phone</label>
                    <div class="invalid-feedback">
                        <?= $errors['phone'] ?? 'Please enter a valid phone.' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" 
                           class="form-control <?= isset($errors['age']) ? 'is-invalid' : '' ?>" 
                           name="age" 
                           id="inputAge" 
                           value="<?= htmlspecialchars($old['age'] ?? $userData['age']); ?>"
                           placeholder=" " 
                           required>
                    <label for="inputAge">Age</label>
                    <div class="invalid-feedback">
                        <?= $errors['age'] ?? 'Please enter a valid age.' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" 
                           class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                           name="email" 
                           id="inputEmail" 
                           value="<?= htmlspecialchars($old['email'] ?? $userData['email']); ?>"
                           placeholder=" " 
                           required>
                    <label for="inputEmail">E-mail</label>
                    <div class="invalid-feedback">
                        <?= $errors['email'] ?? 'Please enter a valid e-mail.' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group has-validation">
                    <div class="form-floating">
                        <input type="password" 
                               class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
                               name="password" 
                               id="inputPassword" 
                               placeholder=" ">
                        <label for="inputPassword">Password</label>
                        <div class="invalid-feedback">
                            <?= $errors['password'] ?? 'Please enter a password.' ?>
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
