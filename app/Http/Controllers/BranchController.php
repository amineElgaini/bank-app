<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
        public function index()
        {
            $branches = Branch::all();
    
            return view('admin.branches.index', compact('branches'));
        }
    
        public function create()
        {
            return view('admin.branches.create');
        }
    
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);
    
            Branch::create([
                'name' => $validated['name'],
                'address' => $validated['address'],
            ]);
    
            return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
        }
    
        public function edit($id)
        {
            $branch = Branch::findOrFail($id);
    
            return view('admin.branches.edit', compact('branch'));
        }
    
        public function update(Request $request, $id)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);
    
            $branch = Branch::findOrFail($id);
            $branch->update([
                'name' => $validated['name'],
                'address' => $validated['address'],
            ]);
    
            return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
        }
    
        public function destroy($id)
        {
            $branch = Branch::findOrFail($id);
            $branch->delete();
    
            return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
        }
}
