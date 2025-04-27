<div id="preloader">
    <div class="loader"></div>
</div>

<!-- sidebar menu area start -->
@php($role = \Sentinel::getUser()->roles()->first()->name)
@php($url = Request::url())
<style>
    .slimScrollBar {
        opacity: 0.1 !important;
    }
</style>
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="text-light text-center mt-2">
            <div>Logged In: <a class="text-info" style="font-size:16px" href="javascript:">{{ \Sentinel::check()? \Sentinel::getUser()->name:'User' }}</a></div>
            <div>Role: {{$role }}</div>
            <br>
            <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm"><i class="ti-power-off"> </i></a>
        </div>
        <div class="text-info text-center mt-2">
            <div>{{date('D M d, Y')}}<br>{{date('H:i A')}}</div>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ str_contains($url,"dashboard/task")?"active":"" }}">
                        <a href="{{route('task')}}"><span>Task Management</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="add_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title_body1" class="modal-title">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div id="add_body" class="modal-body" style="min-height: 240px">
            </div>
        </div>
    </div>
</div>
