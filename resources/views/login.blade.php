<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Log in</title>
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sign in</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>
                <div class="alert alert-danger" role="alert" id="alert_sign" style="display: none">กรุณากรอกข้อมูลให้ครบและถูกต้อง</div>
                <div class="mb-3">
                    <label class="form-label">Name :</label>
                    <input type="email" class="form-control" aria-describedby="emailHelp" id="name" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address :</label>
                    <input type="email" class="form-control" aria-describedby="emailHelp" id="email" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password :</label>
                    <input type="password" class="form-control" id="password" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password :</label>
                    <input type="password" class="form-control" id="confirmpassword" value="">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-warning" onclick="signin()">Submit</button>
            </div>
        </div>
        </div>
    </div>

    <div class="container" style="margin-top: 3rem">
        <h1>Log in</h1>
        <div class="d-flex flex-row-reverse bd-highlight">
            <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Sign in</button>
        </div>
        <div class="alert alert-danger" role="alert" id="alert_login" style="display: none">อีเมลหรือรหัสผ่านของท่านไม่ถูกต้อง</div>
        <div class="mb-3">
            <label class="form-label">Email address :</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" id="email_login" value="">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Password :</label>
            <input type="password" class="form-control" id="password_login" value="">
        </div>
            <button type="submit" class="btn btn-primary" onclick="login()">Submit</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function signin() {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let confirmpassword = $('#confirmpassword').val();
            $.ajax({
                url: "/signin",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    password: password
                },
                success: (res) => {
                    if(res == 1) {
                        $('#alert_sign').css("display", "")
                    } else {
                        $('.modal').modal('hide')
                        Swal.fire('Good job!','ลบสำเร็จ','success')
                    }
                    console.log(res)
                }
            })
        }

        function login() {
            let email = $('#email_login').val();
            let password = $('#password_login').val();
            $.ajax({
                url: "/loginsuccess",
                type: "post",
                data: {
                    email: email,
                    password: password
                },
                success: (res) => {
                    if(res == 1) {
                        $('#alert_login').css("display", "")
                    } else {
                        location.replace(res);
                        console.log(res)
                    }

                }
            })
        }

    </script>
</body>
</html>
