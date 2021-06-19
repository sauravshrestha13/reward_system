@extends('layouts.admin')

@section('title', 'Customers')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
@endsection

@section('body')
   
   <div class="content-header row">
   </div>

   <div class="content-body">

       <div class="card">
           <div class="card-header">
               <h4 class="card-title">Customers</h4>
               <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
               <div class="heading-elements">
                   <ul class="list-inline mb-0">
                       <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                       <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                   </ul>
               </div>
           </div>
           <div class="card-body collapse in">
               <div class="card-block card-dashboard">
                   <div class="table-responsive">
                       <table class="table">
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Name</th>
                                   <th>Total Sales</th>
                                   <th>Total Rewards Earned</th>
                                   <th>Current Credit Points</th>
                                   <th width="20%">Actions</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($customers as $customer)
                               <tr> 
                                   <td>{{ $loop->iteration + (($customers->currentPage()-1) * $customers->perPage()) }}</td>
                                   <td>{{ $customer->name }}</td>
                                   <td>{{$customer->currency}}: {{ $customer->orders->where('status','Completed')->sum('sale_amount') }}</td>
                                   <td>{{ $customer->rewards->sum('reward_amount') }} pts.</td>
                                    <td>{{ $customer->credit }} pts. ({{$customer->currency}}: {{$customer->credit_worth}})</td>
                                   <td>
                                        <a class="btn btn-outline-primary" title="View Rewards" href="/customers/rewards?customer_id={{$customer->id}}">View Rewards</a>
                                        <a class="btn btn-outline-danger mt-1" title="View Rewards" href="/customers/expiry-logs?customer_id={{$customer->id}}">View Expired log</a>
                                    
                                    </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                       @if($customers->total() == 0)
                            <div class="text-xs-center my-3 text-muted">
                                <p>No Customers Yet</p>
                            </div>
                       @endif

                       <div class="text-xs-center mb-3">
                           <nav aria-label="Page navigation">
                               {{ $customers->links() }}
                           </nav>
                       </div>
                   </div>
                     <p>* For Testing Purpose: </p>
                    <a class="btn btn-primary" href="/task-expire-rewards" style="color:white">Trigger Expiry for Jan 1, 2022</a>
               </div>
           </div>
       </div>
   </div>
@endsection

