<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    private $attribute;

    public function __construct()
    {
        $this->attribute = new Attribute();
        $this->data['types'] = $this->attribute->types();
        $this->data['booleanOptions'] = $this->attribute->booleanOptions();
        $this->data['validations'] = $this->attribute->validations();
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
        return view('admins.attributes.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $filter = General::sanitasiInputString($request->except('_token', "_method"));
        // make boolen
        $filter['is_required'] = (boolean) $filter['is_required'];
        $filter['is_unique'] = (boolean) $filter['is_unique'];
        $filter['validation'] = (boolean) $filter['validation'];
        $filter['is_configurable'] = (boolean) $filter['is_configurable'];
        $filter['is_filterable'] = (boolean) $filter['is_filterable'];
        
        // save data attribute
        $saveAttribute = false;
        $saveAttribute = DB::transaction(function() use($filter) {
            Attribute::create($filter);
            return true;
        });
        
        // cek gagal save attribute
        if(!$saveAttribute)
        {
            return redirect()->back()->with(['error' => 'Failed to saved attribute.']);
        }

        return redirect("admin/master/attribute")
            ->with(['message' => 'Data attribute has been saved.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['attribute'] = $this->attribute->findOrFail($id);
        
        return view('admins.attributes.edit', $this->data);
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