@extends('layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Remaining Balance<button type="button" class="btn btn-success">{{$balance->balance}} </button>
                  <br><button type="button" class="btn btn-success"> Add funds</button></h4> 

                 <form action="{{ route('payment.topup') }}" method="POST" class="topup-form">
    @csrf
    <div>
        <label for="amount">Deposit Amount (USD):</label>
        <input type="number" name="amount" id="amount" min="10" step="0.01" required 
               placeholder="e.g., 25.00" value="{{ old('amount') }}">
        <small>Minimum: $10.00</small>
        @error('amount')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit">Deposit with Paystack</button>
</form>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> Date</th>
                            <th> Amount</th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody> 
                          <tr>
                            <td> 12/8/2024</td>
                            <td>$800</td>
                            <td><div class="badge badge-outline-success">Success</div></td>
                          </tr>
                          
                          <tr>
                            <td> 12/8/2024</td>
                            <td>$1200</td>
                            <td><div class="badge badge-outline-danger">Failed</div></td>
                          </tr>
                          
                        </tbody>
                      </table>
                       <div class="d-flex justify-content-end">
   
</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>
           
          <!-- content-wrapper ends -->
          @endsection