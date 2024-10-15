<div class="modal-body">
    <div class="row">
        <div class="col-md-12"> 
             
                <div class="row">
                    <div class="col-md-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"  disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="LoanAmount">Loan Amount:</label>
                        <input type="Number" class="form-control" min="1" id="LoanAmount" name="LoanAmount" disabled >
                    </div>
                    <div class="col-md-3">
                        <label for="status">status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{$dt->status == 'pending' : 'selected' : ''}}></option>
                            <option value="Approved" {{$dt->status == 'Approved' : 'selected' : ''}}></option>
                            <option value="Rejected" {{$dt->status == 'Rejected' : 'selected' : ''}}></option>
                        </select>
                    </div>
                    <div class="col-md-2 mt-3">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
             
        </div>
    </div>
</div>