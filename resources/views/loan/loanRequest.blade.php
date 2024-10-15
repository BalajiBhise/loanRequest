<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('/public/asset')}}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{url('/public/asset')}}/css/dataTables.dataTables.min.css" rel="stylesheet"/>
    <script src="{{url('/public/asset/js/jquery.min.js')}}"></script>
    <script src="{{url('/public/asset/js/dataTables.min.js')}}"></script>

    <title>Loan Request Form</title>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">Loan Request Form 
                <a href="{{url('/')}}" class="float-end"> << Back</a>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has("success"))
                    <span class="text-success">{{session()->get('success')}}</span>
                    @elseif(session()->has('error'))
                    <span class="text-danger">{{session()->get('error')}}</span>
                    @endif
                    <form action="{{url('/submitLoanRequest')}}" method="post">@csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name e.g. Balaji Bhise">
                            </div>
                            <div class="col-md-4">
                                <label for="LoanAmount">Loan Amount:</label>
                                <input type="Number" class="form-control" min="1" id="LoanAmount" name="LoanAmount" placeholder="Enter Amount e.g. 500000">
                            </div>
                            <div class="col-md-2 mt-4">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">Loan Details</h3>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$dt)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$dt->name}}</td>
                            <td>{{$dt->amount}}</td>
                            <td>{{$dt->status}}</td>
                            <td>{{date("d-m-Y h:i A",strtotime($dt->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
             </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#tableData").dataTable();
        })
    </script>
</body>
</html>