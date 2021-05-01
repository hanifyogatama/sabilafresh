<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        $this->data['provinces'] = $this->getProvinces();
        $this->data['cities'] = isset(\Auth::user()->provinsi_id) ? $this->getCities(\Auth::user()->provinsi_id) : [];
        $this->data['user'] = $user;

        return $this->load_theme('auth.profile', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');
        $user = \Auth::user();

        if ($user->update($params)) {
            \Session::flash('success', 'profil berhasil diperbarui');
            return redirect('profile');
        }
    }
}
