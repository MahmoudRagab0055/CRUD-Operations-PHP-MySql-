<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php if (isset($_SESSION['msg'])) { ?>
    <div class="msg">
        <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            ?>
    </div>
    <?php } ?>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Address</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><a class="del_btn" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
            <td><a class="edit_btn" href="index.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
            </tr>
            <tr>
            <?php } ?>
        </tbody>
    </table>
    <form method="post" action="server.php" >
        <input type="hidden" name="id" value="<?php echo $id; ?>" required>
        <div class="input-group">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" >
        </div>
        <div class="input-group">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="input-group">
            <?php if ($edit_state == false) : ?> 
            <button type="submit" name="save" class="btn">Save</button>
            <?php else : ?>
            <button type="submit" name="update" class="btn">Update</button>
            <?php endif ?>

        </div>
    </form>
</body>

</html>