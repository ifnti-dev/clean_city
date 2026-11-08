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
        $success = session('success');
        $error = session('error');
        if ($error === null && is_string(session('errors'))) {
            $error = session('errors');
        }

        if ($success) {
            // Toast with pause on hover
            if (session('text')) {
                Swal::success([
                    'title' => $success,
                    'text' => session('text'),
                    'showConfirmButton' => true,
                ]);
            } else {
                Swal::success([
                    'title' => $success,
                    'text' => session('text'),
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ]);
            }
        }

        if ($error) {
            if (session('text')) {
                Swal::error([
                    'title' => $error,
                    'text' => session('text'),
                    'showConfirmButton' => true,
                ]);
            } else {
                Swal::error([
                    'title' => $error,
                    'text' => session('text'),
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ]);
            }
           
        }
    }


}
