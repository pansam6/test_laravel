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
    <title>test</title>
</head>
<body>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="form-label">Name Product</label>
                        <input type="text" class="form-control" id="insert_name" value="" >
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Price</label>
                        <input type="number" class="form-control" id="insert_price" value="">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Date</label>
                        <input type="date" class="form-control" id="insert_date" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="insert_product()">Save</button>
                </div>
        </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <input type="text" style="display: none" name="id" id="id" value="">
                    <div class="mb-3">
                        <label  class="form-label">Name Product</label>
                        <input type="text" class="form-control" name="name" id="name" value="">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" value="">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button  utton type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="update_product()">Save changes</button>
                </div>
        </div>
        </div>
    </div>

    <div class="container" style="margin-top: 50px">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
        <button type="button" class="btn btn-danger" onclick="delete_product()">Delete</button>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select_all">
                        <label class="form-check-label">Delete All</label>
                    </div>
                </th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">date</th>
                <th scope="col">Edit</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="checkbox form-check-input" type="checkbox" id="checkbox_dalete" value="{{$product->id}}">
                        </div>
                    </th>
                    <th>{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->date}}</td>
                    <td><button type="button" class="btn btn-success" onclick="edit_product({{$product->id}})" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function add_product(){
            $.ajax({
                url: "/get_product",
                type: "GET",
                success: (res) => {
                    console.log(res)
                    $('table tbody').empty()
                    for (let x of res) {
                        $('table tbody').append(`
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="checkbox form-check-input" type="checkbox" name="check[]" value="${x.id}">
                                </div>
                            </th>
                            <th>${x.id}</th>
                            <td>${x.name}</td>
                            <td>${x.price}</td>
                            <td>${x.date}</td>
                            <td><button type="button" class="btn btn-success" onclick="edit_product(${x.id})" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button></td>
                        </tr>
                        `)
                    }
                }
            })
        }

        function insert_product() {
            let name = $('#insert_name').val();
            let price = $('#insert_price').val();
            let date = $('#insert_date').val();
            $.ajax({
                url :  "/add_product",
                type : "POST",
                data : {
                    name: name,
                    price: price,
                    date: date,
                },
                success : function() {
                    add_product()
                }
            });
            $('input').val('');
            $('.modal').modal('hide'),
            Swal.fire('Good job!','You clicked the button!','success')
        }

        function edit_product(id) {
            $.ajax({url: `http://localhost:8000/api/insertproductByid/${id}`, success: function(product){
                console.log(product);
                $('#id').val(product.id);
                $('#name').val(product.name);
                $('#price').val(product.price);
                $('#date').val(product.date);
            }});
        }

        function update_product() {
            let id = $('#id').val();
            let name = $('#name').val();
            let price = $('#price').val();
            let date = $('#date').val();
            $.ajax({
                url: `/update_productByid`,
                type : "PUT",
                data : {
                    id: id,
                    name: name,
                    price: price,
                    date: date,
                },
                success : function() {
                    add_product()
                }
            })
            $('.modal').modal('hide'),
            Swal.fire('Good job!','You clicked the button!','success')
        }

        function delete_product() {
            let products = $('.checkbox')
            let filterProduct = products.filter((i, el) => {
                return el.checked == true
            })

            let array = []
            for(fil of filterProduct) {
                array.push(fil.value)
            }

            console.log(array)

            $.ajax({
                url: "/delete_product",
                type: "post",
                data: {
                    check: array
                },
                success: (res) => {
                    console.log(res)
                    add_product()
                    Swal.fire('Good job!','ลบสำเร็จ','success')
                }
            })

        }

        $(document).ready(function() {

            $('#select_all').on('click', function() {
                console.log(this)
                if (this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    })
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    })
                }
            })

            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#select_all').prop('checked', true);
                } else {
                    $('#select_all').prop('checked', false);
                }
            })
        })



    </script>

</body>
</html>