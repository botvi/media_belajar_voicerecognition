<?php

namespace App\Http\Controllers\superadmin;

use App\Models\AbjadAlfabet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AbjadAlfabetController extends Controller
{
    public function index()
    {
        $abjadAlfabet = AbjadAlfabet::all();
        return view('pageadmin.abjad-alfabet.index', compact('abjadAlfabet'));
    }

    public function create()
    {
        return view('pageadmin.abjad-alfabet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alfabet' => 'required|array|min:1',
            'alfabet.*' => 'required|string',
            'suara' => 'required|array|min:1',
            'suara.*' => 'required|file|mimes:mp3,wav'
        ]);

        $alfabetData = [];
        foreach($request->alfabet as $key => $huruf) {
            $suaraFile = $request->file('suara')[$key];
            $suaraName = 'suara_abjad_' . time() . '_' . $key . '.' . $suaraFile->getClientOriginalExtension();
            $suaraFile->move(public_path('suara_abjad'), $suaraName);
            
            $alfabetData[] = [
                'huruf' => $huruf,
                'suara' => 'suara_abjad/' . $suaraName
            ];
        }

        AbjadAlfabet::create([
            'alfabet' => $alfabetData
        ]);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('abjad-alfabet.index');
    }


    public function edit(AbjadAlfabet $abjadAlfabet)
    {
        return view('pageadmin.abjad-alfabet.edit', compact('abjadAlfabet'));
    }

    public function update(Request $request, AbjadAlfabet $abjadAlfabet)
    {
        $request->validate([
            'alfabet' => 'required|array',
            'suara' => 'nullable|array',
            'suara.*' => 'nullable|file|mimes:mp3,wav'
        ]);

        $alfabetData = [];
        foreach($request->alfabet as $key => $huruf) {
            $data = [
                'huruf' => $huruf,
                'suara' => $abjadAlfabet->alfabet[$key]['suara'] ?? null
            ];

            if(isset($request->file('suara')[$key])) {
                $suaraFile = $request->file('suara')[$key];
                $suaraName = 'suara_abjad_' . time() . '_' . $key . '.' . $suaraFile->getClientOriginalExtension();
                $suaraFile->move(public_path('suara_abjad'), $suaraName);
                $data['suara'] = 'suara_abjad/' . $suaraName;
            }

            $alfabetData[] = $data;
        }

        $abjadAlfabet->update([
            'alfabet' => $alfabetData
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('abjad-alfabet.index');
    }

    public function destroy(AbjadAlfabet $abjadAlfabet)
    {
        $abjadAlfabet->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('abjad-alfabet.index');
    }
}
