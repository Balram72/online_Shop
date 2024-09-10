@extends('admin/layout')
@section('page_title','contact')
@section('contact_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Contact</h1>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>                        
                        <th class="text-center">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">{{ $list->name }}</td>
                            <td class="text-center">{{ $list->email }}</td>
                            <td class="text-center">{{ $list->massage }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

@endsection
                    
               