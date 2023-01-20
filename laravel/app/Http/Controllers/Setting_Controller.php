<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Auth;

use App\Models\V_target_rkap_perbulan;
use App\Exports\Target_rkap_perbulanExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\V_menu;
use App\Models\DataModel;

use App\Models\V_syscode;
use App\Models\V_satuan_rkap;


class Setting_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function setting_menu()
    {
        $title = "setting_menu";
        $setting_menus = \App\Models\V_menu::where('sub_menu','0')->orderBy('id', 'ASC') ->get();
        $setting_submenu = \App\Models\V_menu::where('sub_menu','0') ->orderBy('id', 'ASC') ->get();
        $setting_submenu2 = \App\Models\V_menu::where('sub_menu','1') ->orderBy('id', 'ASC') ->get();
        $users = \App\Models\User::orderBy('id', 'ASC') ->get();

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('setting.menu',$leftmenu)->with(compact('title','setting_menus','setting_submenu','setting_submenu2','users'));
    }

        public function cari(Request $request)
        {
            $title = "setting_menu";
            $setting_submenu = \App\Models\V_menu::where('sub_menu','0') ->orderBy('id', 'ASC') ->get();
            $setting_submenu2 = \App\Models\V_menu::where('sub_menu','1') ->orderBy('id', 'ASC') ->get();

            $users = \App\Models\User::orderBy('id', 'ASC') ->get();

            $menu=new DataModel();
            $leftmenu=$menu->getmenu();
            // menangkap data pencarian
            $cari = $request->cari;

            // mengambil data dari table pegawai sesuai pencarian data
            $setting_menus = DB::table('v_menu')->where('sub_menu','like',"%".$cari."%")->orderBy('id', 'ASC') ->get();

            return view('setting.menu',$leftmenu)->with(compact('title','setting_menus','setting_submenu','setting_submenu2','users'));
        }

        public function tambah_setting_menu(Request $request)
        {
            //$request->request->add(['role_id' => Auth::user()->id ]);
            //$request->request->add(['menu_url' => Str::slug($request->menu_label, '_')]);

            $setting_menu = V_menu::create($request->all());

            return redirect ('/setting_menu')->with('success', 'Data Berhasil Ditambah');
        }

        public function edit_setting_menu($id)
        {
            $title = "setting_menu";
            $setting_menu = \App\Models\V_menu::find($id);
            $menu_parent = \App\Models\V_menu::orderBy('id', 'ASC') ->get();
            $users = \App\Models\User::orderBy('id', 'ASC') ->get();

            $menu=new DataModel();
            $leftmenu=$menu->getmenu();

            return view('setting.menu_edit',$leftmenu)->with(compact('title','setting_menu','menu_parent','users'));
        }
     
        public function update_setting_menu(Request $request ,$id)
        {       
            $setting_menu = \App\Models\V_menu::find($id);
            $setting_menu->update($request->all());

            return redirect ('/setting_menu')->with('success', 'Data Berhasil Diupdate');
        }

        public function hapus_setting_menu($id)
        {
            $setting_menu = V_menu::find($id);
            $setting_menu->delete();

            return redirect('setting_menu')->with('success', 'Data berhasil dihapus');
        }

    public function setting_user()
    {
        $title = "setting_user";
        $users = \App\Models\User::orderBy('id', 'ASC') ->get();

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('setting.user',$leftmenu)->with(compact('title','users'));
    }

        public function tambah_setting_user(Request $request)
        {
            $password = $request->password;
            // Validasi kekuatan password
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
             
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {

                return redirect ('/setting_user')->with('warning', 'Pasword setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan spesial karakter.')->withInput();

            }else{
                
                if ($_POST['password']==$_POST['password_confirmation'] ) {

                    $messages = [
                        'email' => '*kolom email tidak boleh sama !',
                    ];
             
                    $this->validate($request,[
                        'email' => ['required', 'max:255',Rule::unique('users')->where('email', $request->email)],
                    ],$messages);

                    //input pendaftaran sebagai user dulu
                    $user = new User;
                    $user->role = $request->role;
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $user->save();

                    return redirect ('/setting_user')->with('success', 'Data Berhasil Ditambah');

                }else {
                    return redirect ('/setting_user')->with('warning', 'Password yang Anda Masukan Tidak Sama! Silakan ulangi kembali!')->withInput();
                }
            }
        }

        public function edit_setting_user($id)
        {
            $title = "setting_user";
            $user = \App\Models\User::find($id);

            $menu=new DataModel();
            $leftmenu=$menu->getmenu();

            return view('setting.user_edit',$leftmenu)->with(compact('title','user'));
        }
     
        public function update_setting_user(Request $request ,$id)
        {       
            $user = \App\Models\User::find($id);
            $user->update($request->all());

            return redirect ('/setting_user')->with('success', 'Data Berhasil Diupdate');
        }

        public function hapus_setting_user($id)
        {
            $user = User::find($id);
            $user->delete();

            return redirect('setting_user')->with('success', 'Data berhasil dihapus');
        }


    public function setting_rkap()
    {
        $title = "setting_rkap";
        $target_rkap_perbulan = V_target_rkap_perbulan::orderBy('tahun', 'ASC')->get();
        $tahun_rkap =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN order by Tahun DESC');
        $satuan_rkap =  DB::select('SELECT distinct SATUAN From DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN');

        $select_tahun =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='TAHUN' order by VALUE_NUMBER DESC");
        $select_satuan =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='SATUAN' order by ID asc");
        $select_type =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='TYPE' order by ID asc");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        $pilih_satuan_rkap = V_satuan_rkap::orderBy('id', 'ASC')->get();

        return view('setting.rkap',$leftmenu)->with(compact('title','target_rkap_perbulan','tahun_rkap','satuan_rkap','select_tahun','select_satuan','select_type','pilih_satuan_rkap'));
    }

        public function cari_tahun_setting_rkap(Request $request)
        {
            $title = "setting_rkap";
            $tahun_rkap =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN order by Tahun DESC');
            $satuan_rkap =  DB::select('SELECT distinct SATUAN From DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN');

            // menangkap data pencarian
            $cari_tahun = $request->cari_tahun;
            $cari_satuan = $request->cari_satuan;
            $target_rkap_perbulan =  DB::select("SELECT * from DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN LIKE'%$cari_tahun%' and SATUAN='$cari_satuan' order by ID");

            $select_tahun =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='TAHUN' order by VALUE_NUMBER DESC");
            $select_satuan =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='SATUAN' order by ID asc");
            $select_type =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='TYPE' order by ID asc");

            $menu=new DataModel();
            $leftmenu=$menu->getmenu();

            return view('setting.rkap',$leftmenu)->with(compact('title','target_rkap_perbulan','tahun_rkap','satuan_rkap','select_tahun','select_satuan','select_type'));
        }

        public function tambah_setting_rkap(Request $request)
        {
            $target_rkap_perbulan = V_target_rkap_perbulan::create($request->all());

            return redirect ('/setting_rkap')->with('success', 'Data berhasil ditambah');
        }

        public function edit_setting_rkap($id)
        {
            $title = "setting_rkap";   
            $target_rkap_perbulan = \App\Models\V_target_rkap_perbulan::find($id);

            $select_tahun =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='TAHUN' order by VALUE_NUMBER DESC");
            $select_satuan =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='SATUAN' order by ID asc");
            $select_type =  DB::select("SELECT * from DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='TYPE' order by ID asc");

            $menu=new DataModel();
            $leftmenu=$menu->getmenu();

            $pilih_satuan_rkap = V_satuan_rkap::orderBy('id', 'ASC')->get();

            return view('setting.rkap_edit',$leftmenu)->with(compact('title','target_rkap_perbulan','select_tahun','select_satuan','select_type','pilih_satuan_rkap'));
        }
     
        public function update_setting_rkap(Request $request ,$id)
        {       
            $target_rkap_perbulan = \App\Models\V_target_rkap_perbulan::find($id);
            $target_rkap_perbulan->update($request->all());

            return redirect ('/setting_rkap')->with('success', 'Data Berhasil Diupdate');
        }

        public function hapus_setting_rkap($id)
        {
            $target_rkap_perbulan = V_target_rkap_perbulan::find($id);
            $target_rkap_perbulan->delete();

            return redirect('setting_rkap')->with('success', 'Data berhasil dihapus');
        }

        public function export_excel()
        {
            return Excel::download(new Target_rkap_perbulanExport, 'RKAP.xls');
        }

        //////////////////////////////////////////////

        public function tambah_setting_satuan_rkap(Request $request)
        {
            $satuan_rkap = V_satuan_rkap::create($request->all());

            return redirect ('/setting_rkap')->with('success', 'Data berhasil ditambah');
        }

        public function edit_setting_satuan_rkap($id)
        {
            $title = "setting_rkap";   
            $satuan_rkap = \App\Models\V_satuan_rkap::find($id);

            $menu=new DataModel();
            $leftmenu=$menu->getmenu();

            return view('setting.rkap_satuan_edit',$leftmenu)->with(compact('title','satuan_rkap'));

            return view('setting.rkap_edit', 
                [
                'title' => $title,
                'target_rkap_perbulan' => $target_rkap_perbulan,
                'select_tahun' => $select_tahun,
                'select_satuan' => $select_satuan,
                'select_type' => $select_type,
            ]);
        }
     
        public function update_setting_satuan_rkap(Request $request ,$id)
        {       
            $satuan_rkap = \App\Models\V_satuan_rkap::find($id);
            $satuan_rkap->update($request->all());

            return redirect ('/setting_rkap')->with('success', 'Data Berhasil Diupdate');
        }

        public function hapus_setting_satuan_rkap($id)
        {
            $satuan_rkap = V_satuan_rkap::find($id);
            $satuan_rkap->delete();

            return redirect('setting_rkap')->with('success', 'Data berhasil dihapus');
        }

}
