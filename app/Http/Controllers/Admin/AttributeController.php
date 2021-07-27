<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\AttributeOptionRequest;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\CollectionPaginate;

class AttributeController extends Controller
{
    private $attribute;
    private $attributeOptions;

    public function __construct()
    {
        $this->attribute = new Attribute();
        $this->attributeOptions = new AttributeOption();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $attributeId)
    {
        // find
        $attribute = $this->attribute->findOrFail($attributeId);
        
        // sanitasi input
        $filter = General::sanitasiInputString($request->except("_token", "_method"));

        // unset code
        unset($filter['code']);

        // make boolen
        $filter['is_required'] = (boolean) $filter['is_required'];
        $filter['is_unique'] = (boolean) $filter['is_unique'];
        $filter['validation'] = (boolean) $filter['validation'];
        $filter['is_configurable'] = (boolean) $filter['is_configurable'];
        $filter['is_filterable'] = (boolean) $filter['is_filterable'];

        // update
        $update = false;
        $update = DB::transaction(function() use($filter, $attribute){
            $attribute->update($filter);
            return true;
        });
        
        if(!$update)
        {
            return redirect()->back()->with(['error' => "Failed to updated data."]);
        }

        return redirect('admin/master/attribute')
            ->with(['message' => "Data attribute has beend updated."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = $this->attribute->findOrFail($id);

        if(!$attribute)
        {
            return response()->json([
                "error" => true,
                "message" => "Data not found. Failed to deleted data."
            ], 404);
        }
        
        $delete = false;
        $delete = DB::transaction(function() use($attribute) {
            $attribute->delete();
            return true;
        });

        if(!$delete)
        {
            return response()->json([
                "error" => true,
                "message" => "Internal server error. Failed to deleted data."
            ], 500);
        }

        return response()->json([
            "error" => false,
            "message" => "Data has been deleted."
        ], 200);
    }

    /**
     * @param int attributeId
     */
    public function options($attributeId)
    {
        if(empty($attributeId))
        {
            return redirect('admin/master/attribute/create')
                ->with(['error' => 'You attribute not found. Please create add some new attribute.']);
        }

        // find or fail
        $this->data['attribute'] = $this->attribute->findOrFail($attributeId);
        $this->data['options'] = CollectionPaginate::paginate(
            $this->data['attribute']->attributeOptions, 2
        );

        return view('admins.attribute_options.index', $this->data);
    }
    
    /**
     * @param int attributeId
     * for view attribute option
     */
    public function createOptions($attributeId)
    {

    }

    /**
     * @param Request $request
     * @param int $attributeId
     * for store or update attribute option
     */
    public function storeOptions(AttributeOptionRequest $request)
    {
        $id = $request->id;
        $data = $request->except("_token", "_method");
        $data['id'] = $data['option_id'];

        unset($data['option_id']);
        
        if(is_null($id))
        {
            unset($data['id']);
            $saveOrUpdate = AttributeOption::create($data);
        } else {
            $option = AttributeOption::findOrFail($id);
            $saveOrUpdate = $option->update($data);
        }

        if(!$saveOrUpdate)
        {
            return response()->json([
                "error" => true,
                "message" => "Failed to saved data."
            ], 500);
        }

        return response()->json([
            "error" => false,
            "message" => "Data has been saved."
        ], 200);
    }

    public function destroyOptions($optionId)
    {
        dd($optionId);
    }
}