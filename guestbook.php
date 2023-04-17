<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();

// TODO 2: ROUTING

if (!empty($_POST)){
    $jsonString = json_encode($_POST);
    $fileStream = fopen ('comments.csv','a');
    fwrite($fileStream , $jsonString ."\n");
    fclose($fileStream);
}
// TODO 4: RENDER: 1) view (html) 2) data (from php)

?>

<!DOCTYPE html>
<html>

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">
    <!-- navbar menu -->
    <?php require_once 'sectionNavbar.php' ?>
    <br>
    <!-- guestbook section -->
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            GuestBook
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email"/>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name"/>
                        </div>
                        <div class="form-group">
                            <label>Text</label>
                            <input class="form-control" type="text" name="comment"/>
                        </div>
                        <div class="form-group">
                            <label>+</label>
                            <input class="form-control" type="text" name="plus"/>
                        </div>
                        <div class="form-group">
                            <label>-</label>
                            <input class="form-control" type="text" name="minus"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="form"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            Сomments
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    if ( file_exists ('comments.csv')){
                        $fileStream = fopen('comments.csv', "r");
                        while(!feof($fileStream)){
                            $jsonString = fgets ($fileStream);
                            $array = json_decode ($jsonString, true);

                            if (empty ($array)) break ;

                            echo $array ['email'] . '<br>';
                            echo $array ['name'] . '<br>';
                            echo $array ['comment'] . '<br>';
                            echo "+:" . '<br>';
                            echo $array ['plus'] . '<br>';
                            echo "-:" . '<br>';
                            echo $array ['minus'] . '<br><hr>';
                        }
                        fclose ($fileStream );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>