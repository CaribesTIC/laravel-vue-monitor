<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request, GeneralSettings $settings)
    {
        /* Initialize query */
        $query = Product::query();

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where("name", "like", "%$search%");
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $products = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Products/Index", [
            "rows" => $products,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

    public function create()
    {
        return Inertia::render("Products/Create");
    }

    public function store(Request $request)
    {             
        $data = $request->validate([
            "name" => ["required", "max:50"],
            "description" => ["required"],
            "url_path" => ["required"],
            "img_path" => ["required"],
        ]);

        Product::create([
            "name" => $data["name"],
            "description" => $data["description"],
            "url_path" => $data["url_path"],
            "img_path" => $data["img_path"]
        ]);

        return redirect()
            ->route("products")
            ->with("success", "Producto creado.");
    }

    public function show(Product $product)
    {
        return Inertia::render("Products/Show", [
            "product" => $product->only(["name"]),
        ]);
    }

    public function edit(Product $product)
    {
        return Inertia::render("Products/Edit", [
            "product" => $product->only(["id", "name", "description", "url_path" , "img_path"]),
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "max:50"],
            "description" => ["required"],
            "url_path" => ["required"],
            "img_path" => ["required"],
        ]);

        $product->update($data);

        return redirect()
            ->route("products")
            ->with("success", "Producto actualizado.");
    }

    public function destroy(Product $product)
    {

        $product->delete();

        return redirect()
            ->route("products")
            ->with("success", "Producto eliminado.");
    }
}
