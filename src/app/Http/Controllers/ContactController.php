<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
{
    $contacts = Contact::with('category')->get();
    $categories = Category::all();

    return view('index', compact('contacts', 'categories'));
}

public function confirm(ContactRequest $request)
{
    $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'content', 'detail']);
    
    $category = Category::find($contact['category_id']);
    if ($category) {
        $contact['category'] = $category->toArray();
    }
    
    return view('confirm', compact('contact'));
}

public function store(Request $request)
{
    $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail']);
    Contact::create($contact);

    return view('thanks');
}

public function search(Request $request)
{
    $query = Contact::with('category');

    // 名前とメールアドレス検索
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    // 性別検索
    if ($request->filled('gender') && $request->gender !== 'all') {
        $query->where('gender', $request->gender);
    }

    // カテゴリ検索
    if ($request->filled('category_id')) {
        $query->CategorySearch($request->category_id);
    }

    // 日付検索
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->paginate(7);
    $categories = Category::all();

    return view('auth.admin', compact('contacts', 'categories'));
}

public function destroy(Request $request)
{
  Contact::find($request->id)->delete();

  return redirect('/admin');
}

}
