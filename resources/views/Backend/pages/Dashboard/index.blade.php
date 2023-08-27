 @extends('Backend.layouts.master')

 @section('title')
     Admin Dashboard - Role & Permission System
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
                         <li><span>Home</span></li>
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
         <div class="row mt-5">
             <div class="col-md-2"></div>
             <div class="col-md-8 mt-5">
                 <div class="card mt-5 py-5">
                     <h3 class="p-5 text-center">Welcome To Dashboard</h3>
                 </div>
             </div>
             <div class="col-md-2"></div>
         </div>
     </div>
 @endsection
