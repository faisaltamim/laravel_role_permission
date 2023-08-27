 @extends('Backend.layouts.master')

 @section('title')
     Admin Dashboard - Users Lists
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
                         <li><span>Users</span></li>
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
                         <h4 class="header-title">All Users
                             <a href="{{ route('admin.users.create') }}" class="btn btn-info btn-xs float-right">Create
                                 New</a>
                         </h4>
                         <div class="data-tables datatable-primary">
                             <table id="dataTable2" class="text-center RolesDataTable">
                                 <thead class="text-capitalize">
                                     <tr>
                                         <th>SI</th>
                                         <th>User Name</th>
                                         <th>User Email</th>
                                         <th>User Role</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($users as $user)
                                         <tr>
                                             <td>{{ $loop->index + 1 }}</td>
                                             <td>{{ $user->name }}</td>
                                             <td>{{ $user->email }}</td>
                                             <td width="50%" class="">
                                                {{-- here we found all roles into user data using spatie default functionality --}}
                                                 @foreach ($user->roles as $permit)
                                                     <span
                                                         class="bg-info d-inline-block text-light rounded p-1 m-1">{{ $permit->name }}</span>
                                                 @endforeach
                                             </td>
                                             <td><a class="btn btn-info btn-xs"
                                                     href="{{ route('admin.users.edit', $user->id) }}"><i
                                                         class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


                                                 <a class="btn btn-xs btn-danger text-white"
                                                     href="{{ route('admin.users.destroy', $user->id) }}"
                                                     onclick="dltAlert(event);">
                                                     <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                 </a>

                                                 <form id="deleteRoleForm-{{ $user->id }}"
                                                     action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
                     document.getElementById('deleteRoleForm-{{ $user->id }}').submit();
                     //  window.location.href = urlRedirectTo;

                 }
             })
         }

         //  toastr msg show after delete
     </script>
 @endsection
