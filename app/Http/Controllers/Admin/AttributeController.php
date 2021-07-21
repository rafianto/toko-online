<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    private $attribute;

    public function __construct()
    {
        $this->attribute = new Attribute();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['attributes'] = $this->attribute->getAllData();
        return view('admins.attributes.index', $this->data);
    }

    /**
     * get all data for list index attributes
     * and for ajax request list
     */
    public function search(Request $request)
    {
        $filter = General::sanitasiInputString($request->input());
        
        $this->data['attributes'] = $this->attribute->getAllData($filter['keyword'], (int)$filter['size']);
        return view('admins.attributes.search', $this->data)->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['types'] = $this->attribute->types();
        
        return view('admins.attributes.create', $this->data);
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
     * @param int id
     */
    public function options($attributeId)
    {
        
    }
}