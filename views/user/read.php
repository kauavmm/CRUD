<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kauã Melo">
    <meta name="Description" content="Read database">
    <title>Read</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

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
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>               
                <th scope='row'><p><a href="index.php?route=edit&id=<?= $user['id'] ?>">Edit</a></p></th>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['surname'] ?></td>
                <td>@<?= $user['username'] ?></td>
                <td><?= $user['phone'] ?></td>
                <td><?= $user['age'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['create_at'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a class="btn btn-primary" href="../../index.php?route=create" role="button">Add user</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>