<div id="preloader">
    <div class="loader"></div>
</div>

<!-- sidebar menu area start -->
@php($role = \Sentinel::getUser()->roles()->first()->name)
@php($url = Request::url())
@php($count = Utils::count('',true))
@if($role == 'Staff' || $role == 'Operator')
    @php($count1 = Utils::count(date('Y-m-d'),true))
@endif

<style>
    .slimScrollBar {
        opacity: 0.1 !important;
    }
</style>
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo p-1">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('logo.png') }}" alt="logo"></a>
        </div>
        <div class="text-light text-center">
            <div>Logged In: <a class="text-info" style="font-size:16px" href="{{route('user.profile')}}">{{ \Sentinel::check()? \Sentinel::getUser()->name:'User' }}</a></div>
            <div>Role: {{$role }}</div>
            <br>
            @if(\Sentinel::inRole('superadmin') || \Sentinel::inRole('admin'))
                <a href="{{route('settings')}}" class="btn btn{{ str_contains($url,"/settings")?"":"-outline" }}-info btn-sm"><i class="ti-settings"> </i> </a>
            @endif
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
                    @if(!\Sentinel::inRole('readonly') && !\Sentinel::inRole('operator'))
                        <li class="{{ str_contains($url,"/dashboard/")?"":"active" }}">
                            <a href="{{ route('dashboard') }}" aria-expanded="true"><span>Dashboard</span></a>
                        </li>
                    @endif
                    @if(\Sentinel::inRole('admin') || \Sentinel::inRole('staff') || \Sentinel::inRole('superadmin') || \Sentinel::inRole('supervisor') || \Sentinel::inRole('autovalidate'))
                        <li class="{{ str_contains($url,"dashboard/incident/report")?"active":"" }}">
                            <a href="{{route('incident.reporting')}}"><span>Incident Reporting</span>@if($count['qcf_incident']!=0)<span class="badge badge1">{{$count['qcf_incident']}}</span>@endif</a>
                        </li>
                    @endif

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
