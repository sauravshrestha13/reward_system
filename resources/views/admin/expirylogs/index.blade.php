@extends('layouts.admin')

@section('title', 'Expiry Logs')

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
           <h4 class="card-title" style="text-transform: none">Expiry Logs of {{$customer->name}} ( customer id: {{$customer->id}} )</h4>
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
                                   <th>Expired Amount</th>
                                   <th>Expired Date</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($logs as $log)
                               <tr>
                                   <td>{{ $loop->iteration + (($logs->currentPage()-1) * $logs->perPage()) }}</td>
                                    <td> {{ $log->expired_amount }} pts. </td>
                                    <td> {!! date('M d, Y', strtotime($log->expired_date)) !!} </td>

                                  
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                       @if($logs->total() == 0)
                            <div class="text-xs-center my-3 text-muted">
                                <p>No Expiry Logs Yet</p>
                            </div>
                       @endif

                       <div class="text-xs-center mb-3">
                           <nav aria-label="Page navigation">
                               {{ $logs->links() }}
                           </nav>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection

