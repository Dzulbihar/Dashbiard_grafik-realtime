<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_syscode;
use DB;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function syscode()
    {
        $title = "syscode";
        $syscodes = \App\Models\V_syscode::orderBy('id', 'ASC')
        ->get();
        return view('master.syscode.syscode',
            [
            'title' => $title,
            'syscodes' => $syscodes,
        ]);
    }

        public function tambah_tahun(Request $request)
        {
            $syscode = V_syscode::create($request->all());

            return redirect ('/syscode')->with('success', 'Data Tahun berhasil ditambah');
        }

        public function edit_tahun($id)
        {
            $title = "syscode";
            $syscode = \App\Models\V_syscode::find($id);

            return view('master.syscode.edit', [
                'title' => $title,
                'syscode' => $syscode,
            ]);
        }
     
        public function update_tahun(Request $request ,$id)
        {       
            $syscode = \App\Models\V_syscode::find($id);
            $syscode->update($request->all());

            return redirect ('/syscode')->with('success', 'Data Tahun Berhasil Diupdate');
        }

        public function hapus_tahun($id)
        {
            $syscode = V_syscode::find($id);
            $syscode->delete();

            return redirect('syscode')->with('success', 'Data Tahun berhasil dihapus');
        }

        public function tambah_waktu(Request $request)
        {
            $syscode = V_syscode::create($request->all());

            return redirect ('/syscode')->with('success', 'Data Waktu berhasil ditambah');
        }

        public function edit_waktu($id)
        {
            $title = "syscode";
            $syscode = \App\Models\V_syscode::find($id);

            return view('master.syscode.edit', [
                'title' => $title,
                'syscode' => $syscode,
            ]);
        }
     
        public function update_waktu(Request $request ,$id)
        {       
            $syscode = \App\Models\V_syscode::find($id);
            $syscode->update($request->all());

            return redirect ('/syscode')->with('success', 'Data Waktu Berhasil Diupdate');
        }

        public function hapus_waktu($id)
        {
            $syscode = V_syscode::find($id);
            $syscode->delete();

            return redirect('syscode')->with('success', 'Data Waktu berhasil dihapus');
        }

        public function tambah_type(Request $request)
        {
            $syscode = V_syscode::create($request->all());

            return redirect ('/syscode')->with('success', 'Data Type berhasil ditambah');
        }

        public function edit_type($id)
        {
            $title = "syscode";
            $syscode = \App\Models\V_syscode::find($id);

            return view('master.syscode.edit', [
                'title' => $title,
                'syscode' => $syscode,
            ]);
        }
     
        public function update_type(Request $request ,$id)
        {       
            $syscode = \App\Models\V_syscode::find($id);
            $syscode->update($request->all());

            return redirect ('/syscode')->with('success', 'Data Type Berhasil Diupdate');
        }

        public function hapus_type($id)
        {
            $syscode = V_syscode::find($id);
            $syscode->delete();

            return redirect('syscode')->with('success', 'Data Type berhasil dihapus');
        }

        public function tambah_satuan(Request $request)
        {
            $syscode = V_syscode::create($request->all());

            return redirect ('/syscode')->with('success', 'Data Satuan berhasil ditambah');
        }

        public function edit_satuan($id)
        {
            $title = "syscode";
            $syscode = \App\Models\V_syscode::find($id);

            return view('master.syscode.edit', [
                'title' => $title,
                'syscode' => $syscode,
            ]);
        }
     
        public function update_satuan(Request $request ,$id)
        {       
            $syscode = \App\Models\V_syscode::find($id);
            $syscode->update($request->all());

            return redirect ('/syscode')->with('success', 'Data Satuan Berhasil Diupdate');
        }

        public function hapus_satuan($id)
        {
            $syscode = V_syscode::find($id);
            $syscode->delete();

            return redirect('syscode')->with('success', 'Data Satuan berhasil dihapus');
        }    

}
