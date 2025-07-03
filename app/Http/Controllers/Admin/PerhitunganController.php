<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Barryvdh\DomPDF\Facade\Pdf;

class PerhitunganController extends Controller
{
    public function index()
    {
        $metode = request('metode', 'wp');
        $hasil = $this->hitung($metode);
        return view('admin.perhitungan.index', compact('hasil', 'metode'));
    }

    public function cetakPDF()
    {
        $metode = request('metode', 'wp');
        $hasil = $this->hitung($metode);

        $pdf = Pdf::loadView('admin.perhitungan.pdf', compact('hasil', 'metode'));
        return $pdf->download("hasil-perhitungan-{$metode}.pdf");
    }

    private function hitung($metode)
    {
        if ($metode === 'vikor') {
            return $this->hitungVIKOR();
        }

        return $this->hitungWP();
    }

    private function hitungWP()
    {
        $kriterias = Kriteria::all();
        $totalBobot = $kriterias->sum('bobot');

        $bobotTernormalisasi = $kriterias->mapWithKeys(function ($item) use ($totalBobot) {
            $normal = $item->bobot / $totalBobot;
            return [$item->id => $item->sifat === 'cost' ? -$normal : $normal];
        });

        $alternatifs = Alternatif::with('nilai.kriteria')->get();
        $alternatifsSiap = $alternatifs->filter(function ($alt) use ($kriterias) {
            return $alt->nilai->count() === $kriterias->count();
        });

        $hasil = $alternatifsSiap->map(function ($alt) use ($bobotTernormalisasi) {
            $nilaiS = 1;
            foreach ($alt->nilai as $nilai) {
                $bobot = $bobotTernormalisasi[$nilai->kriteria_id] ?? 0;
                $nilaiS *= pow($nilai->nilai, $bobot);
            }
            return [
                'nama' => $alt->nama,
                'nilai_s' => $nilaiS,
            ];
        });

        $totalS = $hasil->sum('nilai_s');

        return $hasil->map(function ($item) use ($totalS) {
            $item['nilai_v'] = $totalS > 0 ? $item['nilai_s'] / $totalS : 0;
            return $item;
        })->sortByDesc('nilai_v')->values();
    }

    private function hitungVIKOR()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::with('nilai')->get();

        $data = [];
        foreach ($alternatifs as $alt) {
            if ($alt->nilai->count() === $kriterias->count()) {
                $data[] = [
                    'id' => $alt->id,
                    'nama' => $alt->nama,
                    'nilai' => $alt->nilai->pluck('nilai', 'kriteria_id')->toArray(),
                ];
            }
        }

        if (empty($data)) return [];

        $fplus = [];
        $fmin = [];
        foreach ($kriterias as $kriteria) {
            $values = collect($data)->pluck("nilai.{$kriteria->id}")->map(fn($v) => (float) $v);
            $fplus[$kriteria->id] = $kriteria->sifat === 'benefit' ? $values->max() : $values->min();
            $fmin[$kriteria->id] = $kriteria->sifat === 'benefit' ? $values->min() : $values->max();
        }

        $bobot = $kriterias->pluck('bobot', 'id');
        $results = [];
        foreach ($data as $alt) {
            $S = 0;
            $R = 0;

            foreach ($alt['nilai'] as $kid => $v) {
                $div = ($fplus[$kid] - $fmin[$kid]) ?: 1;
                $Q = ($fplus[$kid] - $v) / $div;
                $bobotW = $bobot[$kid];
                $S += $bobotW * $Q;
                $R = max($R, $Q);
            }

            $results[] = [
                'nama' => $alt['nama'],
                'S' => $S,
                'R' => $R,
            ];
        }

        $Smin = collect($results)->min('S');
        $Smax = collect($results)->max('S');
        $Rmin = collect($results)->min('R');
        $Rmax = collect($results)->max('R');

        foreach ($results as &$res) {
            $v = 0.5; // compromise coefficient
            $res['nilai_q'] = $v * (($res['S'] - $Smin) / max($Smax - $Smin, 0.00001)) +
                              (1 - $v) * (($res['R'] - $Rmin) / max($Rmax - $Rmin, 0.00001));
        }

        return collect($results)->sortBy('nilai_q')->values();
    }
}
