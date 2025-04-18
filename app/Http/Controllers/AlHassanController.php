<?php 

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Fix for File namespace
use Illuminate\Support\Facades\Validator;

class AlHassanController extends Controller
{
    public function index() 
    {
        $products = Product::orderBy('created_at', 'DESC')->get(); // Change AlHassan to Product
        return view('al_hassan.index', ['products' => $products]);
    }
    
    public function create()
    {
        return view('al_hassan.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:10',
            'email' => 'required|email',
            'address' => 'required|min:10',
            'price' => 'required|numeric',
            'password' => 'required|min:10', // Hash this before saving
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|max:2048'; // Optional size limit
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('al_hassan.create')
                ->withInput() 
                ->withErrors($validator); 
        }

        // Insert into al_hassan in db
        $product = new product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->email = $request->email;
        $product->address = $request->address;
        $product->price = $request->price;
        $product->password =($request->password); // Hash the password

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('upload/category'), $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect()->route('al_hassan.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('al_hassan.edit', compact('product'));
    }

    public function update($id, Request $request)
    {
        // Find the product by ID or fail
        $product = Product::findOrFail($id);  
    
        // Define validation rules
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:10',
            'email' => 'required|email',
            'address' => 'required|min:10',
            'price' => 'required|numeric',
        ];
    
        // Optional image validation
        if ($request->hasFile('image')) {
            $rules['image'] = 'image|max:2048'; // Optional size limit
        }
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->route('al_hassan.edit', $product->id)
                ->withInput() 
                ->withErrors($validator); 
        }
    
        // Update product properties
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description; // Assuming description is optional
        $product->email = $request->email;
        $product->address = $request->address;
        $product->price = $request->price;
    
        // Check if a new password is provided
        if ($request->filled('password')) {
            // Hash the new password if provided
            $product->password =$request->password;
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if (!empty($product->image)) {
                File::delete(public_path('upload/category/' . $product->image));
            }
            
            // Update image file path
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('upload/category'), $imageName);
            $product->image = $imageName;
        }
    
        // Save the updated product
        $product->save();
    
        // Redirect back to the index with a success message
        return redirect()->route('al_hassan.index')->with('success', 'Product updated successfully.');
    }
    
    // this method is used for destory Colum
    
    public function destroy($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return redirect()->route('al_hassan.index')->with('error', 'Product not found.');
        }
    
        $product->delete();
    
        return redirect()->route('al_hassan.index')->with('success', 'Product deleted successfully.');
    }
    
    
    }


    
    






//     public function edit(){

//     }
//     // this method is show for delete al_hassan page
//    public function destory(){


//    } 

// }
