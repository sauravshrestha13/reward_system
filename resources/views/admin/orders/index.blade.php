@extends('layouts.admin')

@section('title', 'Orders')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
@endsection

@section('body')
   
   <div class="content-header row">
   </div>

   <div class="content-body">
       <div class="card">
           <div class="card-header">
               <h4 class="card-title"><a data-action="collapse">Add New Orders</a></h4>
               <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
               <div class="heading-elements">
                   <ul class="list-inline mb-0">
                       <li><a data-action="collapse"><i class="{{ count($errors)>0 ? 'icon-minus4':'icon-plus4' }}"></i></a></li>
                       <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                   </ul>
               </div>
           </div>
           <div class="card-body collapse {{ count($errors)>0 ? 'in':'out' }}">
               <div class="card-block card-dashboard">
                   <form class="form" method="POST" id="AddBlogForm" action="/orders/create" enctype="multipart/form-data">
                       {{ csrf_field() }}
                       <div class="form-body">
                            <h4 class="form-section"><i class="icon-eye6"></i> Orders</h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Name</label>
                                        <input placeholder="eg: Ordered Steam Gift Card ($5)" class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                        @if ($errors->has('name'))
                                            <div class="alert alert-danger no-border mb-2">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Select Customer</label>
                                        <select id="customer_id" class="form-control {{ $errors->has('customer_id') ? ' border-danger' : '' }}" name="customer_id" value="{{ old('customer_id') }}" required>
                                            @foreach($customers as $customer)
                                        <option curr="{{$customer->currency}}" value="{{$customer->id}}">{{$customer->name}} {{"(".$customer->currency.")"}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('customer_id'))
                                            <div class="alert alert-danger no-border mb-2">
                                                <strong>{{ $errors->first('customer_id') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Sale Amount (<span id="selectedCurrency">{{$customers[0]->currency}}</span>)</label>
                                        <input class="form-control{{ $errors->has('sale_amount') ? ' border-danger' : '' }}" id="sale_amount" type="number" class="form-control" name="sale_amount" value="{{ old('sale_amount') }}" required>

                                        @if ($errors->has('sale_amount'))
                                            <div class="alert alert-danger no-border mb-2">
                                                <strong>{{ $errors->first('sale_amount') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                              


                       </div>

                       <div class="form-actions right">
                           <button type="submit" class="btn btn-primary">
                               <i class="icon-check2"></i> Add
                           </button>
                       </div>
                   </form>
               </div>
           </div>
       </div>

       <div class="card">
           <div class="card-header">
               <h4 class="card-title">Orders</h4>
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
                                   <th>Customer</th>
                                   <th>Sale Amount</th>
                                   <th>Status</th>
                                   <th width="20%">Actions</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($orders as $order)
                               <tr>
                                   <td>{{ $loop->iteration + (($orders->currentPage()-1) * $orders->perPage()) }}</td>
                                   <td>{{ $order->name }}</td>
                                   <td>{{ $order->customer->name }}</td>
                                   <td>{{$order->currency}}: {{ $order->sale_amount }}</td>
                                   <td>{{ $order->status }}</td>
                                   <td>
                                       @if($order->status=="Pending")
                                            <a class="btn btn-outline-primary" title="Mark as Completed" href="/orders/complete-order?id={{$order->id}}">Mark as Completed</a>
                                        @endif
                                    </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                       @if($orders->total() == 0)
                            <div class="text-xs-center my-3 text-muted">
                                <p>No Orders Yet</p>
                            </div>
                       @endif

                       <div class="text-xs-center mb-3">
                           <nav aria-label="Page navigation">
                               {{ $orders->links() }}
                           </nav>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection


@section('js')
<script>
    $(document).ready(function(){
        $('#customer_id').on('change',function(){
        var e=$('#customer_id option:selected').attr('curr');
            $('#selectedCurrency').html(e);
        })
    })
</script>
@endsection