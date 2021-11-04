<!-- User Info -->
<div class="user-info">
    <div class="image">
        <img src="{{asset('admin/images/user.png')}}" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{@\Auth::user()->name}}</div>
        <div class="email">{{@\Auth::user()->email}}</div>
        {{--<div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li> -->
                <li role="separator" class="divider"></li>
                <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="material-icons">input</i>Sign Out</a></li>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        </div>--}}
    </div>
</div>
<!-- #User Info -->
<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <?php 
        $master_data_menu = ['wallet','category'];
        ?>
        <li class="@if(in_array(@$sidebar,$master_data_menu)) active @endif">
            <a href="javascript:void(0);" class="menu-toggle @if(in_array(@$sidebar,$master_data_menu)) toggled @endif">
                <i class="material-icons">dashboard</i>
                <span>Master Data</span>
            </a>
            <ul class="ml-menu">
                <li class="{{@$sidebar == 'wallet' ? 'active': ''}}">
                    <a href="{{route('masterData.wallet.index')}}">Dompet</a>
                </li>
                <li class="{{@$sidebar == 'category' ? 'active': ''}}">
                    <a href="{{route('masterData.category.index')}}">Kategori</a>
                </li>
            </ul>
        </li>
        <?php 
        $transaksi_menu = ['wallet_in','wallet_out'];
        ?>
        <li class="@if(in_array(@$sidebar,$transaksi_menu)) active @endif">
            <a href="javascript:void(0);" class="menu-toggle @if(in_array(@$sidebar,$transaksi_menu)) toggled @endif">
                <i class="material-icons">credit_card</i>
                <span>Transaksi</span>
            </a>
            <ul class="ml-menu">
                <li class="{{@$sidebar == 'wallet_in' ? 'active': ''}}">
                    <a href="{{route('transaction.index',['id'=>1])}}">Dompet Masuk</a>
                </li>
                <li class="{{@$sidebar == 'wallet_out' ? 'active': ''}}">
                    <a href="{{route('transaction.index',['id'=>2])}}">Dompet Keluar</a>
                </li>
            </ul>
        </li>
        <li class="{{@$sidebar == 'report' ? 'active': ''}}">
            <a href="{{route('report.index')}}">
                <i class="material-icons">insert_chart</i>
                <span>Laporan</span>
            </a>
        </li>
    </ul>
</div>
<!-- #Menu -->
<!-- Footer -->
<div class="legal">
    <div class="copyright">
        &copy; <a href="javascript:void(0);">Maju Bersama Atomic Indonesia</a>.
    </div>
    <div class="version">
        <b>Version: </b> 1
    </div>
</div>
<!-- #Footer -->