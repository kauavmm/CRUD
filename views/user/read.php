<?php 

/** @var array $users */
/** @var int $usersCount */

$this->layout('layout', [
    'title' => 'Read', 
    'description' => 'Read database'
]); 

?>

<div class="page-container">
    <div class="content-box">
        <div class="page-header">
            <div>
                <h1>Users</h1>
                <!-- If there is more than one user, add an "s" at the end -->
                <p class="page-subtitle"><?= $usersCount ?> user<?= $usersCount !== 1 ? 's' : '' ?> registered</p> 
            </div>
            <a href="/users/create" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add user
            </a>
        </div>

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Age</th>
                    <th scope="col">Create on</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-id"><?= $user['id'] ?></div>
                            <div>
                                <div class="user-name"><?= $user['name'] ?> <?= $user['surname'] ?></div>
                                <div class="user-username">@<?= $user['username'] ?></div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="user-email"><?= $user['email'] ?></div>
                        <div class="user-phone"><?= $user['phone'] ?></div>
                    </td>

                    <td>
                        <span class="badge-age"><?= $user['age'] ?></span>
                    </td>

                    <td class="user-date">
                        <?= $user['create_at'] ?>
                    </td>

                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/users/<?= $user['id'] ?>/edit" class="btn-icon" aria-label="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/users/<?= $user['id'] ?>/delete" class="btn-icon btn-icon-danger" aria-label="Delete">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
