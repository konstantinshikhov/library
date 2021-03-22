<?php

namespace App\Http\Controllers;

use App\Http\Filters\BookFilter;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Services\ImageRemoveService;
use App\Services\ImageUploadService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookFilter $bookFilter)
    {
        $books = Book::with('authors')->filter($bookFilter)->paginate(15);
        $authors = Author::all();
        return view('book.index',compact(['books','authors']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $imageName = ImageUploadService::upload($request->file('image'));

        $book = Book::create([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $imageName,
            'publish_at'  => Carbon::parse($request->publish_at),
        ]);

        $book->authors()->attach($request->authors);

        return response()->json(['success' => 'Книга успешно добавлена'], 201);
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
        $book = Book::with('authors')->find($id);
        $authors = Author::get();
        return view('book.partials.edit',compact(['book','authors']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookUpdateRequest  $request
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request,Book $book)
    {
        if ($request->file('image')) {
            ImageRemoveService::removeImage($book->image);
            $book->image = ImageUploadService::upload($request->file('image'));
        }

        $book->name = $request->name;
        $book->description = $request->description;
        $book->publish_at = Carbon::parse($request->publish_at);

        $book->save();
        $book->authors()->sync($request->authors);

        return response()->json(['success' => 'Data is successfully updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        ImageRemoveService::removeImage($book->image);
        $book->delete();

        return response()->json(['message' => "Книга удалена"], 200);
    }
}
