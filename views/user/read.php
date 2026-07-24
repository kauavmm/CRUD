<?php 

$this->layout('layout', [
    'title' => 'Read', 
    'description' => 'Read database'
]); 

?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Username</th>
            <th scope="col">Phone</th>
            <th scope="col">Age</th>
            <th scope="col">Email</th>
            <th scope="col">Create on</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>               
            <th scope='row'><p><a href="/users/<?= $user['id'] ?>/edit">Edit</a></p></th>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['surname'] ?></td>
            <td>@<?= $user['username'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['age'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['create_at'] ?></td>
            <td><p><a href="users/<?= $user['id'] ?>/delete">Delete</a></p></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a class="btn btn-primary" href="/users/create" role="button">Add user</a>
