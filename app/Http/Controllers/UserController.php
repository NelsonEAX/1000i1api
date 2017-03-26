<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Return current user info
     *
     * @return \Illuminate\Http\Response
     */
    public function getInfo(Request $request)
    {
        //return $request->user();
        $user = $request->user();
        if( $user->is_confirmed )
        {
            $rule = [ 'confirmed' => $user->is_confirmed ];
            $rule += $this->getRuleArray( $user );

            return response()->json([
                'user' => [
                    'login'         => $user->login,
                    'name'          => $user->name,
                    'lastname'      => $user->lastname,
                    'middlename'    => $user->middlename,
                    'phone'         => $user->phone,
                    'email'         => $user->email,
                    'photo'         => $user->photo,
                    'birthday'      => $user->birthday,
                    'rule'          => $rule
                ]
            ]);
        }else{
            return response()->json([
                'user' => [
                    'rule' => [
                        'confirmed' => false
                    ]
                ]
            ]);
        }
    }



    private function getRuleArray($user)
    {
        $rule = [];

        if( $user->is_eax )
            $rule += [ 'eax' => $user->is_eax ];
        if( $user->is_admin )
            $rule += [ 'admin' => $user->is_admin ];
/*        if( $user->is_private )
            $rule += [ 'private' => $user->is_private ];
        if( $user->is_legal )
            $rule += [ 'legal' => $user->is_legal ];
*/
        if( $user->is_manager )
            $rule += [ 'manager' => $user->is_manager ];
        /*if( $user->is_manager_production )
            $rule += [ 'manager_production' => $user->is_manager_production ];
        if( $user->is_cutter )
            $rule += [ 'cutter' => $user->is_cutter ];
        if( $user->is_shareholder )
            $rule += [ 'shareholder' => $user->is_shareholder ];
        if( $user->is_storekeeper )
            $rule += [ 'storekeeper' => $user->is_storekeeper ];
*/
        if( $user->is_dealer )
            $rule += [ 'dealer' => $user->is_dealer ];
        if( $user->is_franchise )
            $rule += [ 'franchise' => $user->is_franchise ];
        if( $user->is_agent )
            $rule += [ 'agent' => $user->is_agent ];
        if( $user->is_related )
            $rule += [ 'related' => $user->is_related ];
/*
        if( $user->is_measurer )
            $rule += [ 'measurer' => $user->is_measurer ];
        if( $user->is_installer )
            $rule += [ 'installer' => $user->is_installer ];
        if( $user->is_delivery_city )
            $rule += [ 'delivery_city' => $user->is_delivery_city ];
        if( $user->is_delivery_region )
            $rule += [ 'delivery_region' => $user->is_delivery_region ];
*/
        return $rule;
    }
}
