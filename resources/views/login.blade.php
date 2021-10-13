<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Log in</title>
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Sing up</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/singin">
                @csrf
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="mb-3" >
                        <label for="exampleFormControlInput1" class="form-label">Username :</label>
                        <input type="text" class="form-control" placeholder="username" name="username" id="username" value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Password :</label>
                        <input type="text" class="form-control"  placeholder="password" name="password" id="password" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" onclick="singin()">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <div class="container" style="margin-top: 2rem;">
        <h1>Log in</h1>
        <div class="d-flex flex-row-reverse bd-highlight">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Sign up</button>
        </div>
        <div class="mb-3" >
            <label for="exampleFormControlInput1" class="form-label">Username :</label>
            <input type="text" class="form-control" placeholder="username">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Password :</label>
            <input type="text" class="form-control"  placeholder="password">
        </div>
        <div class="d-flex flex-row bd-highlight mb-3">
            <button type="button" class="btn btn-primary">Log in</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function singin() {
            let username = $('#username').val();
            let password = $('#password').val();
            // $.ajax({
            //     url :  "/singin",
            //     type : "POST",

            //     success : function(res) {
            //         console.log(res)
            //     }
            // });
            // console.log(username , password)
        }

    </script>


</body>
</html>
