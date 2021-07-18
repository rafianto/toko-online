<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private $category;

    /**
     * Construct for instansiasi Class Category on Models
     * 
     */
    public function __construct()
    {
        // parent::__construct();

        $this->data['currentAdminMenu'] = 'catalog';
        $this->data['currentAdminSubMenu'] = 'category';
        $this->category = new Category();
    }

    /**
     * Author Rahmatulah Sidik
     * Method index for first view
     * 
     */
    public function index()
    {
        $categories = $this->category->getAllData();
        return view('admins.categories.index', compact("categories"));
    }

    /**
     * Author Rahmatulah Sidik
     * Method for pagination, searching and size
     * 
     */
    public function search(Request $request)
    {
        $categories = $this->category->getAllData($request->input('keyword'), (int)$request->input('size'));
        return view('admins.categories.search', compact('categories'))->render();
    }

    /**
     * Author Rahmatulah Sidik
     * method for return view create
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = null;
        return view('admins.categories.form', $this->data);
    }

    /**
     * Author Rahmatulah Sidik
     * method for store data to database
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->except('_token');
        $params['name'] = htmlspecialchars(strtolower($params["name"]));
        $params['slug'] = Str::slug($params['name']);
        $params['parent_id'] = (int)$params['parent_id'];

        $save = $this->category->create($params);
        
        if ($save) {
            return redirect("admin/category")->with(['message' => 'Data has been saved']);
        } else {
            return redirect()->back()->with(['error' => 'Failed to saved data!']);
        }
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->orderBy('name', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = $category;
        return view('admins.categories.form', $this->data);
    }

    public function destroy($id)
    {
        $category = $this->category->destroy($id);
        if(!$category)
        {
            return false;
        }
        return response("ok");
    }

    public function update(CategoryRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $params['parent_id'] = (int)$params['parent_id'];

        $category = $this->category->findOrFail($id);
        $update = $category->update($params);
        if ($update) {
            Session::flash('success', 'Category has been updated.');
            return redirect("admin/category")->with(['message' => 'Data has been saved']);
        } else {
            return redirect()->back()->with(["error" => "Failed to saved data"]);
        }

    }

}