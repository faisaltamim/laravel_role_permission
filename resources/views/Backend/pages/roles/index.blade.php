 @extends('Backend.layouts.master')

 @section('title')
     Admin Dashboard - Roles Lists
 @endsection


 @section('main_content')
     <!-- page title area start -->
     <div class="page-title-area">
         <div class="row align-items-center">
             {{-- header breadcrumbs area --}}
             <div class="col-sm-6 clearfix">
                 <div class="breadcrumbs-area clearfix">
                     <h4 class="page-title pull-left">Dashboard</h4>
                     <ul class="breadcrumbs pull-left">
                         <li><span>Roles</span></li>
                     </ul>
                 </div>
             </div>
             {{-- header right corner profile view --}}
             <div class="col-sm-6">
                 <x-myProfileInHeader>
                 </x-myProfileInHeader>
             </div>
         </div>
     </div>
     <!-- page title area end -->
     <div class="main-content-inner">
         <div class="row">
             <!-- Primary table start -->
             <div class="col-1"></div>
             <div class="col-10 mt-5">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="header-title">All Roles
                             <a href="{{ route('admin.roles.create') }}" class="btn btn-info btn-xs float-right">Create
                                 New</a>
                         </h4>
                         <div class="data-tables datatable-primary">
                             <table id="dataTable2" class="text-center RolesDataTable">
                                 <thead class="text-capitalize">
                                     <tr>
                                         <th>SI</th>
                                         <th>Role Name</th>
                                         <th>Role Permission</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($roles as $role)
                                         <tr>
                                             <td>{{ $loop->index + 1 }}</td>
                                             <td>{{ $role->name }}</td>
                                             <td width="50%" class="">
                                                 {{-- $role->permission is a default methods of spatie to get all permission in role table..but role table has no permission column but i can find permission if i use $role->permission --}}
                                                 @foreach ($role->permissions as $permit)
                                                     <span
                                                         class="bg-info d-inline-block text-light rounded p-1 m-1">{{ $permit->name }}</span>
                                                 @endforeach
                                             </td>
                                             <td><a class="btn btn-info btn-xs"
                                                     href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                         class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


                                                 <a class="btn btn-xs btn-danger text-white"
                                                     href="{{ route('admin.roles.destroy', $role->id) }}"
                                                     onclick="dltAlert(event);">
                                                     <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                 </a>

                                                 <form id="deleteRoleForm-{{ $role->id }}"
                                                     action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                     style="display: none;">
                                                     @method('DELETE')
                                                     @csrf
                                                 </form>
                                             </td>
                                         </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Primary table end -->
         </div>
     </div>

     <script>
         function dltAlert(e) {
             e.preventDefault();
             let urlRedirectTo = e.currentTarget.getAttribute('href');

             Swal.fire({
                 title: 'Are you sure?',
                 text: "You won't be able to revert this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     document.getElementById('deleteRoleForm-{{ $role->id }}').submit();
                     //  window.location.href = urlRedirectTo;

                 }
             })
         }

         //  toastr msg show after delete
     </script>
 @endsection
