<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class NilaiAlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        return view('hrd.nilai.index', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatifs,id',
            'nilai' => 'required|array',
        ]);

        $kriterias = Kriteria::all()->keyBy('id');

        foreach ($request->nilai as $kriteria_id => $value) {
            $kriteria = $kriterias[$kriteria_id];

            if (is_array($value)) {
                $rawNilai = floatval($value['value']);
                $satuan = $value['satuan'];

                // Konversi meter ke kilometer jika perlu
                $finalNilai = strtolower($satuan) === 'm' ? $rawNilai / 1000 : $rawNilai;
            } else {
                $finalNilai = floatval($value);
            }

            NilaiAlternatif::updateOrCreate(
                [
                    'alternatif_id' => $request->alternatif_id,
                    'kriteria_id' => $kriteria_id
                ],
                ['nilai' => $finalNilai]
            );
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }
}
