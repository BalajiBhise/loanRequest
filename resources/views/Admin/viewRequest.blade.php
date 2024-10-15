<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url('/public/asset')}}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{url('/public/asset')}}/css/toastr.css" rel="stylesheet" />
    <link href="{{url('/public/asset')}}/css/dataTables.dataTables.min.css" rel="stylesheet" />
    <script src="{{url('/public/asset/js/jquery.min.js')}}"></script>
    <script src="{{url('/public/asset/js/toastr.min.js')}}"></script>
    <script src="{{url('/public/asset/js/dataTables.min.js')}}"></script>
    <title>Admin - View Request</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center">View Request</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="tableData">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>ApplyDate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$dt)
                    <tr>
                        <td>{{$key + 1}} </td>
                        <td>{{$dt->name}}</td>
                        <td>{{$dt->amount}}</td>
                        <td>
                            <select name="status" id="status{{$dt->id}}" onchange="updateStatus('{{$dt->id}}')" class="form-select">
                                <option value="pending" {{$dt->status == 'pending' ? 'selected' : ''}}>pending</option>
                                <option value="Approved" {{$dt->status == 'Approved' ? 'selected' : ''}}>Approved</option>
                                <option value="Rejected" {{$dt->status == 'Rejected' ? 'selected' : ''}}>Rejected</option>
                            </select>
                        </td>
                        <td>{{date("d-m-Y h:i A",strtotime($dt->created_at))}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="deleterequest('{{$dt->id}}')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#tableData").dataTable();
        })

        function updateStatus(id) {
            let status = $("#status" + id).val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                }
            })
            $.ajax({
                type: "POST",
                url: "{{url('/admin/updateStatus')}}",
                data: {
                    id: id,
                    status: status,
                },
                success: function(response) {
                    if (response.hasOwnProperty("error"))
                        toastr.error(response.error)
                    else
                        toastr.success(response.success);
                }
            })
        }

        function deleterequest(id) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                }
            })
            $.ajax({
                type: "POST",
                url: "{{url('/admin/deleterequest')}}",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.hasOwnProperty("error"))
                        toastr.error(response.error)
                    else {
                        toastr.success(response.success);
                        location.reload();
                    }
                }
            })
        }
    </script>
</body>

</html>