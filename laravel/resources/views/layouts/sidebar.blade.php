  <aside class="main-sidebar sidebar-light-dark ">
    <!-- Brand Logo -
    <a href="{{url('/home')}}" class="brand-link">
      <img src="{{asset('logo/pelindo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle " style="opacity: .8">
      <span class="brand-text font-weight-light"> EIS TPSM </span>
    </a>-->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('logo/user.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/home')}}" class="d-block"> {{ Auth::user()->name }}  </a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Home -->
          <!-- <li class="nav-item">
            <a href="{{url('/home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
              </p>
            </a>
          </li> -->

          @foreach ($menu as $item=>$value)
          <li class="nav-item">
            <a href="{{url('/'.$value->menu_url)}}" target="_self" class="nav-link">
              <i class="{{$value->menu_icon}}"></i>
              <p>
                {{$value->menu_label}}
                <i class="{{$value->alt_url}}"></i>
              </p>
            </a>
            @foreach ($submenu as $key=>$sub1)
            @if($sub1->menu_parent==$value->id)
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/'.$sub1->menu_url)}}" target="_self" class="nav-link">
                  <i class="{{$sub1->menu_icon}} nav-icon"></i>
                  <p>
                    {{$sub1->menu_label}}
                    <i class="{{$sub1->alt_url}}"></i>
                  </p>
                </a>
                @foreach ($sub2menu as $key2=>$sub2)
                @if($sub2->menu_parent==$sub1->id)
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/'.$sub2->menu_url)}}" target="_self" class="nav-link">
                      <i class="{{$sub2->menu_icon}}"></i>
                      <p>
                        {{$sub2->menu_label}}
                      </p>
                    </a>
                  </li>
                </ul>
                @endif
                @endforeach
              </li>
            </ul>
            @endif
            @endforeach
          </li>
          @endforeach


          <!-- Arus -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link {{($title === "arus_kunjungan_kapal_domestik") || ($title === "arus_kunjungan_kapal_international") || ($title === "arus_petikemas_domestik")|| ($title === "arus_petikemas_international") ? 'active' : ''}}">
              <i class="nav-icon fa fa-bar-chart"></i>
              <p>
                Arus
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "arus_kunjungan_kapal_domestik") || ($title === "arus_kunjungan_kapal_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-ship"></i>
                  <p>
                    Kunjungan Kapal
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/arus_kunjungan_kapal_domestik')}}" class="nav-link {{($title === "arus_kunjungan_kapal_domestik") ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon text-warning"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/arus_kunjungan_kapal_international')}}" class="nav-link {{($title === "arus_kunjungan_kapal_international") ? 'active' : ''}}">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "arus_petikemas_domestik") || ($title === "arus_petikemas_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-archive"></i>
                  <p>
                    Petikemas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/arus_petikemas_domestik')}}" class="nav-link {{($title === "arus_petikemas_domestik") ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon text-info"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/arus_petikemas_international')}}" class="nav-link {{($title === "arus_petikemas_international") ? 'active' : ''}}">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
            </ul>
          </li> -->

          <!-- Produksi -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link {{($title === "produksi_petikemas_domestik") || ($title === "produksi_petikemas_international") ? 'active' : ''}}">
              <i class="nav-icon fa fa-cubes"></i>
              <p>
                Produksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "produksi_petikemas_domestik") || ($title === "user") || ($title === "produksi_petikemas_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-archive"></i>
                  <p>
                    Petikemas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/produksi_petikemas_domestik')}}" class="nav-link {{($title === "produksi_petikemas_domestik") ? 'active' : ''}}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/produksi_petikemas_international')}}" class="nav-link {{($title === "produksi_petikemas_international") ? 'active' : ''}}">
                        <i class="nav-icon fa fa-circle"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
            </ul>
          </li> -->

          <!-- Pendapatan -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link {{($title === "pendapatan_kegiatan_bongkar_muat_domestik") || ($title === "pendapatan_kegiatan_bongkar_muat_international") || ($title === "pendapatan_kegiatan_lapangan_domestik") || ($title === "pendapatan_kegiatan_lapangan_international") ? 'active' : ''}}">
              <i class="nav-icon fas fa-usd"></i>
              <p>
                Pendapatan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "pendapatan_kegiatan_bongkar_muat_domestik") || ($title === "pendapatan_kegiatan_bongkar_muat_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-cubes"></i>
                  <p>
                    Kegiatan Bongkar Muat
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/pendapatan_kegiatan_bongkar_muat_domestik')}}" class="nav-link {{($title === "pendapatan_kegiatan_bongkar_muat_domestik") ? 'active' : ''}}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/pendapatan_kegiatan_bongkar_muat_international')}}" class="nav-link {{($title === "pendapatan_kegiatan_bongkar_muat_international") ? 'active' : ''}}">
                        <i class="nav-icon fa fa-circle"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "pendapatan_kegiatan_lapangan_domestik") || ($title === "pendapatan_kegiatan_lapangan_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-bars"></i>
                  <p>
                    Kegiatan Lapangan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/pendapatan_kegiatan_lapangan_domestik')}}" class="nav-link {{($title === "pendapatan_kegiatan_lapangan_domestik") ? 'active' : ''}}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/pendapatan_kegiatan_lapangan_international')}}" class="nav-link {{($title === "pendapatan_kegiatan_lapangan_international") ? 'active' : ''}}">
                        <i class="nav-icon fa fa-circle"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
            </ul>
          </li> -->

          <!-- Kinerja -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link {{($title === "kinerja_bongkar_muat_domestik") || ($title === "kinerja_bongkar_muat_international") || ($title === "kinerja_lapangan_domestik") || ($title === "kinerja_lapangan_international") ? 'active' : ''}}">
              <i class="nav-icon fas fa-bolt"></i>
              <p>
                Kinerja
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "kinerja_bongkar_muat_domestik") || ($title === "kinerja_bongkar_muat_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-cubes"></i>
                  <p>
                    Bongkar Muat
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/kinerja_bongkar_muat_domestik')}}" class="nav-link {{($title === "kinerja_bongkar_muat_domestik") ? 'active' : ''}}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/kinerja_bongkar_muat_international')}}" class="nav-link {{($title === "kinerja_bongkar_muat_international") ? 'active' : ''}}">
                        <i class="nav-icon fa fa-circle"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "kinerja_lapangan_domestik") || ($title === "kinerja_lapangan_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-bars"></i>
                  <p>
                    Lapangan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/kinerja_lapangan_domestik')}}" class="nav-link {{($title === "kinerja_lapangan_domestik") ? 'active' : ''}}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/kinerja_lapangan_international')}}" class="nav-link {{($title === "kinerja_lapangan_international") ? 'active' : ''}}">
                        <i class="nav-icon fa fa-circle"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
            </ul>
          </li> -->

          <!-- Bina Pelanggan -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link {{($title === "bina_pelanggan_market_share_domestik") || ($title === "bina_pelanggan_market_share_international") ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p> 
                Bina Pelanggan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "bina_pelanggan_market_share_domestik") || ($title === "bina_pelanggan_market_share_international") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-map-marker"></i>
                  <p>
                    Market Share
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/bina_pelanggan_market_share_domestik')}}" class="nav-link {{($title === "bina_pelanggan_market_share_domestik") ? 'active' : ''}}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p> Domestik </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/bina_pelanggan_market_share_international')}}" class="nav-link {{($title === "bina_pelanggan_market_share_international") ? 'active' : ''}}">
                        <i class="nav-icon fa fa-circle"></i>
                        <p> International  </p>
                      </a>
                    </li>
                  </ul>
              </li>
            </ul>
          </li> -->

          <!-- Setting -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link {{($title === "setting_master_role") || ($title === "setting_master_user") || ($title === "setting_master_menu") || ($title === "setting_rkap") ? 'active' : ''}}">
              <i class="fa fa-cogs nav-icon"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/setting_master_role')}}" class="nav-link {{($title === "setting_master_role") ? 'active' : ''}}">
                  <i class="fa fa-user-secret nav-icon"></i>
                  <p> Master Role </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/setting_master_user')}}" class="nav-link {{($title === "setting_master_user") ? 'active' : ''}}">
                  <i class="fa fa-user nav-icon"></i>
                  <p> Master User </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/setting_master_menu')}}" class="nav-link {{($title === "setting_master_menu") ? 'active' : ''}}">
                  <i class="fa fa-bars nav-icon"></i>
                  <p> Master Menu </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/setting_rkap')}}" class="nav-link {{($title === "setting_rkap") ? 'active' : ''}}">
                  <i class="fa fa-sort-amount-asc nav-icon"></i>
                  <p> RKAP </p>
                </a>
              </li>
            </ul>
          </li> -->




          <!-- Kunjungan Kapal 
          <li class="nav-item">
            <a href="#" class="nav-link {{($title === "data_kunjungan_kapal") || ($title === "grafik_kunjungan_kapal") ? 'active' : ''}}">
              <i class="fa fa-ship nav-icon"></i>
              <p>
                Kunjungan Kapal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/data_kunjungan_kapal')}}" class="nav-link {{($title === "data_kunjungan_kapal") ? 'active' : ''}}">
                  <i class="fa fa-database nav-icon"></i>
                  <p> Data </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/grafik_kunjungan_kapal')}}" class="nav-link {{($title === "grafik_kunjungan_kapal") ? 'active' : ''}}">
                  <i class="fa fa-line-chart nav-icon"></i>
                  <p> Grafik  </p>
                </a>
              </li>
            </ul>
          </li>
          -->

          <!-- Arus Petikemas 
          <li class="nav-item">
            <a href="#" class="nav-link {{($title === "data_arus_petikemas") || ($title === "grafik_arus_petikemas") ? 'active' : ''}}">
              <i class="fa fa-archive nav-icon"></i>
              <p>
                Arus Petikemas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/data_arus_petikemas')}}" class="nav-link {{($title === "data_arus_petikemas") ? 'active' : ''}}">
                  <i class="fa fa-database nav-icon"></i>
                  <p> Data </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/grafik_arus_petikemas')}}" class="nav-link {{($title === "grafik_arus_petikemas") ? 'active' : ''}}">
                  <i class="fa fa-line-chart nav-icon"></i>
                  <p> Grafik  </p>
                </a>
              </li>
            </ul>
          </li>
          -->

          <!-- Market Share 
          <li class="nav-item">
            <a href="#" class="nav-link {{($title === "data_market_share") || ($title === "grafik_market_share") ? 'active' : ''}}">
              <i class="fa fa-map-marker nav-icon"></i>
              <p>
                Market Share
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/data_market_share')}}" class="nav-link {{($title === "data_market_share") ? 'active' : ''}}">
                  <i class="fa fa-database nav-icon"></i>
                  <p> Data </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/grafik_market_share')}}" class="nav-link {{($title === "grafik_market_share") ? 'active' : ''}}">
                  <i class="fa fa-line-chart nav-icon"></i>
                  <p> Grafik  </p>
                </a>
              </li>
            </ul>
          </li>
           -->
         




          <!-- Log
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Log
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "syscode") || ($title === "user") || ($title === "target_rkap") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-cogs"></i>
                  <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url('/syscode')}}" class="nav-link {{($title === "syscode") ? 'active' : ''}}">
                        <i class="fa fa-cog nav-icon"></i>
                        <p> Syscode </p>
                      </a>
                    </li>
                  </ul>
              </li>


              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "shipcall_gt") || ($title === "arus_domestik") || ($title === "arus_international")  || ($title === "arus_total") || ($title === "produksi_pendapatan") || ($title === "kinerja_kapal") || ($title === "market_domestik") || ($title === "market_international") || ($title === "market_total") || ($title === "arus_grafik") || ($title === "market_share") || ($title === "nota") || ($title === "departure") ? 'active' : ''}}">
                  <i class="fa fa-sliders nav-icon"></i>
                  <p>
                    Slide Grafik
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="{{url('/shipcall_gt')}}" class="nav-link {{($title === "shipcall_gt") ? 'active' : ''}}">
                      <i class="fa fa-ship nav-icon"></i>
                      <p> Arus Kapal </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{url('/arus_grafik')}}" class="nav-link {{($title === "arus_grafik") ? 'active' : ''}}">
                      <i class="fa fa-bar-chart nav-icon"></i>
                      <p> Arus Grafik </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{url('/market_share')}}" class="nav-link {{($title === "market_share") ? 'active' : ''}}">
                      <i class="fa fa-pie-chart nav-icon"></i>
                      <p> Market Share </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{url('/nota')}}" class="nav-link {{($title === "nota") ? 'active' : ''}}">
                      <i class="nav-icon fa fa-sticky-note"></i>
                      <p> Nota </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{url('/departure')}}" class="nav-link {{($title === "departure") ? 'active' : ''}}">
                      <i class="nav-icon fa fa-bookmark"></i>
                      <p> Departure </p>
                    </a>
                  </li>
                </ul>
              </li>


              <li class="nav-item">
                <a href="#" class="nav-link {{($title === "vessel_detail") || ($title === "vessel_performance") || ($title === "grafik_vessel_performance") || ($title === "tanggal_vessel_performance") || ($title === "bulan_vessel_performance") ? 'active' : ''}}">
                  <i class="nav-icon fa fa-cogs"></i>
                  <p>
                    Kinerja
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/vessel_detail')}}" class="nav-link {{($title === "vessel_detail") ? 'active' : ''}}">
                      <i class="fa fa-ship nav-icon"></i>
                      <p> Data Vessel Details </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/vessel_performance')}}" class="nav-link {{($title === "vessel_performance") ? 'active' : ''}}">
                      <i class="fa fa-ship nav-icon"></i>
                      <p> Data Vessel Performance </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/grafik_vessel_performance')}}" class="nav-link {{($title === "grafik_vessel_performance") ? 'active' : ''}}">
                      <i class="fa fa-line-chart nav-icon"></i>
                      <p> Grafik Vessel Performance </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{url('/tanggal_vessel_performance')}}" class="nav-link {{($title === "tanggal_vessel_performance") ? 'active' : ''}}">
                      <i class="fa fa-line-chart nav-icon"></i>
                      <p> Grafik perhari Vessel </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/bulan_vessel_performance')}}" class="nav-link {{($title === "bulan_vessel_performance") ? 'active' : ''}}">
                      <i class="fa fa-line-chart nav-icon"></i>
                      <p> Grafik perbulan Vessel </p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
           -->

          <!-- Fullscreen 
          <li class="nav-item">
            <a href="#" class="nav-link" data-widget="fullscreen" role="button">
              <i class="nav-icon fas fa-expand-arrows-alt"></i>
              <p>Fullscreen</p>
            </a>
          </li>
          -->

          <!-- Logout
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fa fa-sign-out" aria-hidden="true"></i>
              <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
           -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>