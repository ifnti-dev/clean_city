<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SweetAlert2\Laravel\Swal;

class SweetAlert extends Model
{
    //

    public static function sweetAlertMessage()
    {
        // dd(session('success'));
        if (session(('success'))) {
            // Toast with pause on hover
            if (session('text')) {
                Swal::success([
                    'title' => session('success'),
                    'text' => session('text'),
                    'showConfirmButton' => true,
                ]);
            } else {
                Swal::success([
                    'title' => session('success'),
                    'text' => session('text'),
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ]);
            }
        }

        if (session(('error'))) {
            if (session('text')) {
                Swal::error([
                    'title' => session('error'),
                    'text' => session('text'),
                    'showConfirmButton' => true,
                ]);
            } else {
                Swal::error([
                    'title' => session('error'),
                    'text' => session('text'),
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ]);
            }
           
        }
    }


}
