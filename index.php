<?php
$insert=FALSE ;
    $servername = "localhost" ;
    $username = "root" ;
    $password = "" ;
    $database = "notes" ;
    $con = mysqli_connect($servername, $username, $password, $database);
    if(!$con){
        echo("sorry".mysqli_connect_error()); 
    }
    else{
        $insert = true;
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = $_POST["title"] ;
        $description = $_POST["desc"] ;
        $sql = "INSERT INTO `note` (`title`, `description`) VALUES ('$title', '$description');" ;
        $result = mysqli_query($con, $sql) ;
        if($result){
            // echo"success added" ;
        }
        else{
            echo"not inserted".mysqli_error($conn) ;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css.css">

</head>

<body>
    <!-- Button trigger modal
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <input type="hidden" name="snoedit" id="snoedit">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="title">
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="desc" placeholder="Leave a comment here"
                                id="floatingTextarea1"></textarea>
                            <label for="floatingTextarea">Note Description</label><br>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Note</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
    </div>
    <div data-bs-theme="dark" class="p-3 text-body bg-body">
        <nav class="navbar navbar-expand-lg bg-body-tertiary ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo031" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">INotes</a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo031">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Contact Us</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <!-- <?php
    if($insert){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success added Note!</strong> 
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  
</div>" ;
    }
?> -->
    <div class="container my-4">
        <h2>Add a Note</h2>
        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="title">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="desc" placeholder="Leave a comment here"
                    id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Note Description</label><br>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>
    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <!-- <th scope="col">Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sno =0;
        $sql = "select * from `note`" ;
        $result = mysqli_query($con , $sql) ;
        while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1 ;
            echo "<tr>
            <th scope='row'>"."$sno"."</th>
            <td>".$row['title']."</td>
            <td>".$row['description']."</td>
           
            </tr>" ;
        }

        ?>
            </tbody>
        </table>

    </div>
    <hr>
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit", );
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innertext;
            description = tr.getElementsByTagName("td")[1].innertext;
            console.log(title, description);
            titleEdit.value = description;
            descriptionEdit.value = description;
            snoEdit.value = e.target.id;
            $('#editModal').modal('toggle');
        })
    })
    </script>
</body>

</html>