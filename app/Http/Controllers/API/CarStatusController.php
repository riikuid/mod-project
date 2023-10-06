<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CarStatus;
use Illuminate\Http\Request;

class CarStatusController extends Controller
{
    public function all()
    {
        $status = CarStatus::find(1);
        if (!$status) {
            return ResponseFormatter::error(
                null,
                'Data car status tidak ada'
            );
        }

        return ResponseFormatter::success(
            $status,
            'Data car status berhasil diambil'
        );
    }

    public function update(Request $request)
    {
        // dd($request);
        $status = CarStatus::find(1);
        $data = $request->json()->all();
        // $data = [
        //     'temperature' => $request->input('temperature'),
        //     'origin' => $request->input('origin'),
        //     'destination' => $request->input('destination'),
        //     'next_station' => $request->input('next_station'),
        // ];
        dd($data);


        if (!$status) {
            return ResponseFormatter::error(
                null,
                'Data car status tidak ditemukan'
            );
        } else {
            $status->update($data);
            return ResponseFormatter::success(
                $status,
                'Data car status berhasil diperbarui'
            );
        }

        // $status->temperature = $request->input('temperature');
        // $status->origin = $request->input('origin');
        // $status->destination = $request->input('destination');
        // $status->next_station = $request->input('next_station');


        // dd($request->input('temperature'));
    }
}
