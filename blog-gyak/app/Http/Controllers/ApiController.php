<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{

    public function getPosts(Request $request, string|null $id = null) {
        if(isset($id)) {
            return new PostResource(Post::with('categories')->findOrFail($id));
        }
        return PostResource::collection(Post::all());
    }


    public function deleteCategory(Request $request, $id) {
        $category = Category::findOrFail($id);
        if($request->user()->tokenCan('admin')) {
            $category->delete();
            return response(status: 204);
        }
        return response()->json([
            'error' => 'A művelet elvégzéséhez csak adminisztrátornak van joga',
        ], 403);
    }

    public function updateCategory(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'style' => [
                'required',
                Rule::in(Category::$styles),
            ],
        ]);
        // if(!requi)
        $category = Category::findOrFail($id);
        $category->update($validated);
        return response()->json($category,201);
    }

    public function createCategory(StoreCategoryRequest $request) {
        $validated = $request->validated();
        $category = Category::factory()->create($validated);
        return response()->json($category,201);
    }

    public function getCategories(Request $request, string|null $id = null) {
        if(isset($id)) {
            return Category::findOrFail($id);
        }
        return Category::all();
    }


    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ],400);
        }
        $validated = $validator->validated();
        $user = User::create($validated);
        $token = $user->createToken($user->email);
        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email',
            'password'  => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ],400);
        }
        $validated = $validator->validated();

        $user = User::where('email',$validated['email'])->first();
        if(!$user) {
            return response()->json([
                'error' => 'Nem regisztrált email cím.',
            ],404);
        }

        if(Auth::attempt($validated)) {
            if($user->admin){
                $token = $user->createToken($user->email,['admin']);
            }
            else {
                $token = $user->createToken($user->email,[]);
            }
            return response()->json([
                'token' => $token->plainTextToken,
            ]);
        }
        else {
            return response()->json([
                'error' => 'Nem megfelelő jelszó.'
            ],401);
        }
    }

    public function user(Request $request) {
        return $request->user();
    }
}
