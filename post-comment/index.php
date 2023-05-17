<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post-Comment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header ch">
                <img class="avatar me-3" src="https://robohash.org/verovoluptasvoluptate.png" alt="avatar">
                <div style="display: flex; flex-direction: column; margin: 0;">
                    <h5>LEO</h5>
                    <span>2023</span>
                </div>

            </div>
            <div class="card-body">
                <p class="card-text ms-5">talo lakers</p>
                <div>
                    <a href="#">Like</a>
                    <a href="#">Comments</a>
                </div>
                <hr>
                <ul class="list-group list-group-flush ms-5 ms-5">
                    <!-- Comment -->
                    <li class="list-group-item">
                        <div class="col">
                            <img class="avatar me-3" src="https://robohash.org/verovoluptasvoluptate.png" alt="avatar">
                            <span>Jerick</span>
                        </div>

                    </li>
                    <!-- end comment -->
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">
                        dfadfas
                    </li>
                </ul>
                <form class="row">
                    <div class="col-sm-6 col-md-8">
                        <textarea name="comment" class="form-control" placeholder="Add comment"></textarea>
                    </div>
                    <div class="col-6 col-md-4">
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>