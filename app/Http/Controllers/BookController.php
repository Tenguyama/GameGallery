<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
class BookController extends Controller
{
    private readonly BookService $service;
    public function __construct(
    ){
        $this->service = BookService::getInstance();
    }
    public function index(?string $query = null): Response
    {
        return Inertia::render('Book/List', [
            'books' => $this->service->getPaginatedBooks(6, $query ?? ''),
            'query' => $query ?? '',
        ]);
    }
    public function getById(Book $book): Response
    {
        return Inertia::render('Book/Index', [
            'book' => $this->service->getById($book),
        ]);
    }
    public function create(): Response
    {
        return Inertia::render('Book/Form', []);
    }
    public function edit(Book $book): Response
    {
        return Inertia::render('Book/Form', [
            'book' => $this->service->getById($book),
        ]);
    }
    public function save(BookRequest $request): RedirectResponse
    {
        return redirect()->route('book.index', [
            'book' => $this->service->create($request),
        ]);
    }
    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        return redirect()->route('book.index', [
            'book' =>  $this->service->update($request, $book),
        ]);
    }
    public function delete(Book $book): RedirectResponse
    {
        $this->service->delete($book);
        return Redirect::route('book.list');
    }
}
