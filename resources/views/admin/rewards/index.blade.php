@extends('layouts.admin')

@section('title', 'Rewards')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
@endsection

@section('body')
   
   <div class="content-header row">
   </div>

   <div class="content-body">
        <a href="/customers" class="btn btn-primary mb-1">Back</a>
       <div class="card">
           <div class="card-header">
           <h4 class="card-title" style="text-transform: none">Rewards earned by {{$customer->name}} ( customer id: {{$customer->id}} )</h4>
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
                                   <th>Order</th>
                                   <th>Sale Amount</th>
                                   <th>Reward Points</th>
                                   <th>Status</th>
                                   <th>Expiry Date</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($rewards as $reward)
                               <tr>
                                   <td>{{ $loop->iteration + (($rewards->currentPage()-1) * $rewards->perPage()) }}</td>
                                    <td>Order: #{{ $reward->order->id }} ({{$reward->order->name}}) </td>
                                    <td>{{$reward->order->currency}}: {{$reward->order->sale_amount}}</td>
                                    <td>{{ $reward->reward_amount }} pts. </td>
                                    <td> {{ $reward->expiry_status}} </td>
                                    <td>{!! date('M d, Y', strtotime($reward->expiry_date)) !!}</td>
                                   <td>
                                       @if($reward->status=="Pending")
                                            <a class="btn btn-outline-primary" title="Mark as Completed" href="/rewards/complete-reward?id={{$reward->id}}">Mark as Completed</a>
                                        @endif
                                    </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                       @if($rewards->total() == 0)
                            <div class="text-xs-center my-3 text-muted">
                                <p>No Rewards Yet</p>
                            </div>
                       @endif

                       <div class="text-xs-center mb-3">
                           <nav aria-label="Page navigation">
                               {{ $rewards->links() }}
                           </nav>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection

