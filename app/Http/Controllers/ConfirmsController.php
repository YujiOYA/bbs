<?php

namespace App\Http\Controllers;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Confirm;

class ConfirmsController extends Controller
{
    public function store(Request $request)
    {
        $confirm = new Confirm;
        $confirm -> post_id = $request -> post_id;
        $confirm -> confirm = $request -> confirm;
        $confirm -> create($request->all());

        return redirect()->route('top');
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
}
