 @extends('Backend.layouts.master')

 @section('title')
     Admin Dashboard - Create Roles
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
                         <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                         <li><span>Create Roles</span></li>
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
             <div class="col-3"></div>
             <div class="col-6 mt-5">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="header-title">
                             Create Roles
                             <a href="{{ route('admin.roles.index') }}" class="btn btn-info btn-xs float-right">All
                                 Roles</a>
                         </h4>
                         <form action="{{ route('admin.roles.store') }}" method="POST">
                             @csrf
                             <div class="form-group">
                                 <label for="name">Role Name</label>
                                 <input type="name" class="form-control  @error('name') is-invalid @enderror "
                                     id="name" name="name" placeholder="Role Name">
                                 @error('name')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                             @error('permission')
                                 <span class="fw-bold text-danger">{{ $message }}</span>
                             @enderror
                             <div class="form-check">
                                 <input type="checkbox" class="form-check-input" name="checkPermissionAll"
                                     id="checkPermissionAll">
                                 <label class="form-check-label font-weight-bold" style="cursor: pointer;"
                                     for="checkPermissionAll">Permission All</label>
                             </div>

                             @php $i = 1; @endphp
                             @foreach ($permissions as $grp_name => $all_permissions)
                                 <hr>
                                 <div class="row">
                                     {{-- permission group checkbox --}}
                                     <div class="col-md-3">
                                         <div class="form-check permission_group">
                                             <input type="checkbox" id="{{ $i }}Management"
                                                 class="form-check-input" name="permission_by_grp[]"
                                                 onchange="checkPermissionByGroup('role-{{ $i }}-management-checkbox',this)"
                                                 id="grp_permission">
                                             <label class="form-check-label font-weight-bold" style="cursor: pointer;"
                                                 for="{{ $i }}Management">{{ ucfirst($grp_name) }}</label>
                                         </div>
                                     </div>
                                     {{-- permission checkbox --}}
                                     <div
                                         class="col-md-9 customSingleInputClassForAllChecked role-{{ $i }}-management-checkbox">
                                         @foreach ($all_permissions as $permission)
                                             <div class="form-check">
                                                 <input type="checkbox" class="form-check-input" name="permission[]"
                                                     id="permission[{{ $permission->id }}]"
                                                     value="{{ $permission->name }}"
                                                     onchange="checkSinglePermission('role-{{ $i }}-management-checkbox','{{ $i }}Management',{{ count($all_permissions) }})">

                                                 <label class="form-check-label" style="cursor: pointer;"
                                                     for="permission[{{ $permission->id }}]">{{ ucfirst(str_replace('.', '-', $permission->name)) }}</label>
                                             </div>
                                         @endforeach
                                     </div>
                                 </div>
                                 @php $i++; @endphp
                             @endforeach


                             <button type="submit" class="btn btn-success mt-4 pr-4 pl-4">Create Roles</button>
                         </form>
                     </div>
                 </div>
             </div>
             <!-- Primary table end -->
         </div>
     </div>
 @endsection
 @section('customJs')
     {{-- include update jquery plugins.old one not work properly --}}
     <script src="{{ asset('backend/assets/js/vendor/jquery_3.6.4.min.js') }}"></script>
     @include('Backend/pages/roles/partials/script')
 @endsection
