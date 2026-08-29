<?php 

/** @var \App\Entity\User[] $users */
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
                            <div class="user-id"><?= $user->getId() ?></div>
                            <div>
                                <div class="user-name"><?= $user->getName() ?> <?= $user->getSurname() ?></div>
                                <div class="user-username">@<?= $user->getUsername() ?></div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="user-email"><?= $user->getEmail() ?></div>
                        <div class="user-phone"><?= $user->getPhone() ?></div>
                    </td>

                    <td>
                        <span class="badge-age"><?= $user->getAge() ?></span>
                    </td>

                    <td class="user-date">
                        <?= $user->getCreateAt()->format('d/m/Y H:i') ?>
                    </td>

                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/users/<?= $user->getId() ?>/edit" class="btn-icon" aria-label="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button type="button"
                                    class="btn-icon btn-icon-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-user-id="<?= $user->getId() ?>"
                                    data-user-name="<?= $user->getName() ?> <?= $user->getSurname() ?>"
                                    aria-label="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>Delete this user?</h5>
                        <p class="text-secondary">
                            This will permanently remove <strong id="deleteModalName"></strong> from the database. This action can't be undone.
                        </p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <form id="deleteForm" method="GET" action="">
                            <button type="submit" class="btn btn-danger">
                                Delete user
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
